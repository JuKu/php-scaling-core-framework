<?php

/**
 * Created by PhpStorm.
 * User: Justin
 * Date: 14.07.2016
 * Time: 16:42
 */
class Domain {

    protected static $instance = null;

    protected $id = 0;
    protected $row = null;

    public function __construct() {
        //
    }

    public function load ($id = null) {
        $this->id = $id;

        if (Cache::get2ndLvlCache()->contains("domain", "domain_" . $id)) {
            $this->row = Cache::get2ndLvlCache()->get("domain", "domain_" . $id);
        } else {
            //load domain from database
            $row = Database::getInstance()->getRow("SELECT * FROM `{praefix}domain` WHERE `id` = :id; ", array('id', $id));

            if (!$row) {
                throw new DomainNotFoundException("Couldnt find domainID " . $id . " in database.");
            }

            $this->row = $row;

            //put row into cache
            Cache::get2ndLvlCache()->put("domain", "domain_" . $id, $this->row);
        }

        //throw event, so plugin can execute code here
        Events::throwEvent("load_domain", array(
            'id' => &$this->id,
            'row' => &$this->row
        ));
    }

    public function isAlias () {
        return $this->row['alias'] != -1 && $this->row['alias'] != 0;
    }

    public static function getIDByDomain ($domain) {
        if (Cache::getCache()->contains("domain", "id_" . $domain)) {
            return (int) Cache::getCache()->contains("domain", "id_" . $domain);
        } else {
            //get id from database
            $row = Database::getInstance()->getRow("SELECT * FROM `{praefix}domain` WHERE `domain` = :domain AND `activated` = '1'; ", array('domain' => $domain));

            $id = -1;

            if ($row) {
                //get id from database row
                $id = $row['id'];
            }

            if ($id == -1) {
                $wildcard_domain_row = self::getWildcardDomainRow();

                //check, if id belongs to wildcard domain
                if ($wildcard_domain_row['domain'] != $domain) {
                    //get id of wildcard domain
                    return self::getIDByDomain(self::getWildcardDomainID());
                } else {
                    //throw exception
                    throw new DomainNotFoundException("Couldnt find domain " . htmlspecialchars($domain) . " in database.");
                }
            }

            //add id to cache
            Cache::getCache()->put("domain", "id_" . $domain, $id);
        }
    }

    public static function getWildcardDomainID () {
        $row = self::getWildcardDomainRow();

        if (!$row) {
            throw new WildcardDomainNotFoundException("Couldnt found wildcard domain in database.");
        }

        return $row['id'];
    }

    public static function getWildcardDomainRow () {
        if (Cache::getCache()->contains("domain", "wildcard_domain_row")) {
            return Cache::getCache()->get("domain", "wildcard_domain_row");
        } else {
            //get domain id from database
            $row = Database::getInstance()->getRow("SELECT * FROM `{praefix}domain` WHERE `wildcard` = 'YES' AND `activated` = '1'; ");

            if (!$row) {
                throw new WildcardDomainNotFoundException("Couldnt found wildcard domain in database.");
            }

            //put id into cache
            Cache::getCache()->put("domain", "wildcard_domain_row", $row);

            //return id
            return $row;
        }
    }

    public static function getCurrent () {
        //check, if instance exists
        if (self::$instance == null) {
            //create new instance of domain
            self::$instance = new Domain();

            //get id of domain
            $domainID = self::getIDByDomain(DomainUtils::getDomain());

            //load data of domain with id
            self::$instance->load($domainID);
        }

        return self::$instance;
    }

}
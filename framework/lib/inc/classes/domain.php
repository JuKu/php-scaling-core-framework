<?php

/**
 * Created by PhpStorm.
 * User: Justin
 * Date: 14.07.2016
 * Time: 16:42
 */
class Domain {

    protected static $instance = null;

    protected $row = null;

    public function __construct() {
        //
    }

    public function load ($id = null) {
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
    }

    public function isAlias () {
        return $this->row['alias'] != -1 && $this->row['alias'] != 0;
    }

    public static function getIDByDomain ($domain) {
        if (Cache::getCache()->contains("domain", "id_" . $domain)) {
            return (int) Cache::getCache()->contains("domain", "id_" . $domain);
        } else {
            //get id from database
            $row = Database::getInstance()->getRow("SELECT * FROM `{praefix}domain` WHERE `domain` = :domain AND `activated` = '1'; ", array('domain', $domain));

            $id = -1;

            if ($row) {
                $id = $row['id'];
            }

            if ($id == -1) {
                throw new DomainNotFoundException("Couldnt find domain " . htmlspecialchars($domain) . " in database.");
            }

            //add id to cache
            Cache::getCache()->put("domain", "id_" . $domain, $id);
        }
    }

    public static function getCurrent () {
        if (self::$instance == null) {
            //create new instance of domain
            self::$instance = new Domain();

            //get id of domain
            $domainID = self::getIDByDomain(DomainUtils::getDomain());

            //load data of domain with id
            self::$instance->load($domainID);
        }
    }

}
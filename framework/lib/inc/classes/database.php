<?php

/**
 * Database class
 *
 * User: Justin
 * Date: 07.07.2016
 * Time: 17:38
 */
class Database {

    /**
     * array with database instances
     */
    protected static $instances = array();

    public static function getInstance ($name = "") {
        if ($name == "") {
            $name = "default";
        }

        if (!isset(self::$instances[$name])) {
            //create new database connection
            self::createInstance($name);
        }

        return self::$instances[$name];
    }

    public static function createInstance ($name) {
        //
    }

}
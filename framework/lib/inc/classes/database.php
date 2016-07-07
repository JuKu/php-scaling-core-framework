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

    protected static $db_settings = null;

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
        if ($name == "default") {
            //get database configuration
            require(LIB_PSF_CONFIG . "database.php");

            //save configuration
            self::$db_settings = $database;

            //get database driver and config
            $db_class_name = self::$db_settings['driver'];
            $db_config_path = self::$db_settings['config'];

            //create new database class instance from string
            $db_instance = new $db_class_name();

            //check, if instance is an database driver
            if (!$db_instance instanceof DBDriver) {
                throw new BadMethodCallException("Cannot initialize database driver " . $db_class_name . ", driver doesnt implements interface DBDriver.");
            }
        }
    }

}
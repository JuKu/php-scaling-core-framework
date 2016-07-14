<?php

/**
 * Created by PhpStorm.
 * User: Justin
 * Date: 14.07.2016
 * Time: 17:51
 */
class PostGreSQLDriver extends MySQLDriver {

    public function connect ($config_path) {
        if (file_exists($config_path)) {
            require($config_path);
        } else if (file_exists(LIB_PSF_CONFIG . $config_path)) {
            require(LIB_PSF_CONFIG . $config_path);
        } else {
            throw new ConfigurationException("Couldnt found postgresql database configuration file " . $config_path . ".");
        }

        //get mysql connection data from configuration
        $this->host = $pqsql_settings['host'];
        $this->port = pqsql_settings['port'];
        $this->username = $pqsql_settings['username'];
        $this->password = $pqsql_settings['password'];
        $this->praefix = $pqsql_settings['praefix'];
        $this->database = $pqsql_settings['database'];
        $this->options = $pqsql_settings['options'];

        try {
            //create new database instance
            $this->conn = new PDO("pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->database . "", $this->username, $this->password, $this->options);
        } catch (PDOException $e) {
            echo "Couldnt connect to database!";
            echo $e->getTraceAsString();

            throw $e;
        }
    }

}
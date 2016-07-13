<?php

/**
 * Created by PhpStorm.
 * User: Justin
 * Date: 13.07.2016
 * Time: 19:41
 */
class MySQLDriver implements DBDriver {

    protected $host = "localhost";
    protected $port = 3306;
    protected $username = "";
    protected $password = "";
    protected $praefix = "";
    protected $database = "";

    protected $conn = null;

    public function connect($config_path) {
        require($config_path);

        //get mysql connection data from configuration
        $this->host = $mysql_settings['host'];
        $this->port = $mysql_settings['port'];
        $this->username = $mysql_settings['username'];
        $this->password = $mysql_settings['password'];
        $this->praefix = $mysql_settings['praefix'];
        $this->database = $mysql_settings['database'];

        //create new database instance
        $this->conn = new PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->database . "", $this->username, $this->password);
    }

    public function update($sql) {
        // TODO: Implement update() method.
    }

    public function close() {
        $this->conn = null;
    }
}
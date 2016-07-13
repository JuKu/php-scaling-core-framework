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
    protected $options = array();

    protected $conn = null;

    public function connect ($config_path) {
        require($config_path);

        //get mysql connection data from configuration
        $this->host = $mysql_settings['host'];
        $this->port = $mysql_settings['port'];
        $this->username = $mysql_settings['username'];
        $this->password = $mysql_settings['password'];
        $this->praefix = $mysql_settings['praefix'];
        $this->database = $mysql_settings['database'];
        $this->options = $mysql_settings['options'];

        try {
            //create new database instance
            $this->conn = new PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->database . "", $this->username, $this->password, $this->options);
        } catch (PDOException $e) {
            echo "Couldnt connect to database!";
            echo $e->getTraceAsString();

            throw $e;
        }
    }

    public function update ($sql) {
        $this->execute($sql);
    }

    public function close () {
        $this->conn = null;
    }

    public function execute ($sql) {
        $this->conn->exec($this->getQuery($sql));
    }

    public function listAllDrivers () {
        return $this->conn->getAvailableDrivers();
    }

    public function quote ($str) : string {
        return $this->conn->quote($str);
    }

    private function getQuery ($sql) {
        return str_replace("{PRAEFIX}", $this->praefix, $sql);
    }

    public function query($sql) : PDOStatement{
        return $this->conn->query($this->getQuery($sql));
    }

    public function listTables() : array {
        $rows = $this->query("SHOW TABLES;")->fetchAll();

        return $rows;
    }

    public function getRow($sql) : array {
        return $this->query($sql)->fetch();
    }

    public function listRows($sql) : array {
        return $this->query($sql)->fetchAll();
    }

    public function escape(string $str) : string {
        return $this->quote($str);
    }
}
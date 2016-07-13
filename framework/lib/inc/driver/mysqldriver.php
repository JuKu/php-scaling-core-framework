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

    protected $queries = 0;

    protected $conn = null;

    protected $prepared_cache = array();

    public function connect ($config_path) {
        if (file_exists($config_path)) {
            require($config_path);
        } else if (file_exists(LIB_PSF_CONFIG . $config_path)) {
            require(LIB_PSF_CONFIG . $config_path);
        } else {
            throw new ConfigurationException("Couldnt found database configuration file " . $config_path . ".");
        }

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
        $this->queries++;
        return $this->conn->query($this->getQuery($sql));
    }

    public function listTables() : array {
        $rows = $this->query("SHOW TABLES;")->fetchAll();

        return $rows;
    }

    public function getRow($sql, $params = array()) : array {
        //get prepared statement
        $stmt = $this->prepare($sql);

        foreach ($params as $key=>$value) {
            if (is_array($value)) {
                $stmt->bindValue(":" . $key, $value['value'], $value['type']);
            } else {
                $stmt->bindValue(":" . $key, $value, PDO::PARAM_STR);
            }
        }

        //execute query
        $stmt->execute();

        //fetch row
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listRows($sql, $params = array()) : array {
        //get prepared statement
        $stmt = $this->prepare($sql);

        foreach ($params as $key=>$value) {
            if (is_array($value)) {
                $stmt->bindValue(":" . $key, $value['value'], $value['type']);
            } else {
                $stmt->bindValue(":" . $key, $value, PDO::PARAM_STR);
            }
        }

        //execute query
        $stmt->execute();

        //fetch rows
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function escape(string $str) : string {
        return $this->quote($str);
    }

    public function countQueries() : int {
        return $this->queries;
    }

    public function beginTransaction () {
        $this->conn->beginTransaction();
    }

    public function rollback() {
        $this->conn->rollback();
    }

    public function commit() {
        $this->conn->commit();
    }

    public function prepare($sql) : PDOStatement {
        $sql = $this->getQuery($sql);

        if (isset($this->prepared_cache[md5($sql)])) {
            return $this->prepared_cache[md5($sql)];
        } else {
            $stmt = $this->conn->prepare($sql);

            //put prepared statement into cache
            $this->prepared_cache[md5($sql)] = $stmt;
            return $stmt;
        }
    }
}
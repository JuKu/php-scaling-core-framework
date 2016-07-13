<?php

/**
 * Created by PhpStorm.
 * User: Justin
 * Date: 07.07.2016
 * Time: 17:47
 */
interface DBDriver {

    //http://www.peterkropff.de/site/mysql/advanced_mysql.htm

    //http://www.peterkropff.de/site/php/pdo.htm

    public function connect ($config_path);

    public function update ($sql);

    public function execute ($sql);

    public function quote ($str) : string;

    public function query ($sql) : PDOStatement;

    public function listTables () : array;

    public function getRow ($sql) : array;

    public function listRows ($sql) : array;

    public function escape (string $str) : string;

    public function close ();

}
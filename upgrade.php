<?php

/**
 * Upgrade Script
 */

//define root path
define('ROOT_PATH', dirname(__FILE__) . "/");

//allow error reporting
error_reporting(E_ALL);

//include autoloader and basic framework files and classes
require(LIB_PSF_ROOT . "inc/lib.php");
require(LIB_PSF_ROOT . "inc/autoload.php");

//initialize database
Database::getInstance();

?>
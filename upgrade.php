<?php

/**
 * Upgrade Script
 *
 * MIT License
 * Copyright (c) 2016 Justin Kuenzel
 */

//define root path
define('ROOT_PATH', dirname(__FILE__) . "/");

//define lib path
define('LIB_PSF_ROOT', dirname(__FILE__) . "/framework/lib/");

//allow error reporting
error_reporting(E_ALL);

//include autoloader and basic framework files and classes
require(LIB_PSF_ROOT . "inc/lib.php");
require(LIB_PSF_ROOT . "inc/autoload.php");

//initialize database
Database::getInstance();

?>
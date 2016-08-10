<?php

/**
 * Upgrade Script
 *
 * MIT License
 * Copyright (c) 2016 Justin Kuenzel
 */

//define root path
define('ROOT_PATH', dirname(__FILE__) . "/");

//define lib root path
define('LIB_PSF_ROOT', dirname(__FILE__) . "/framework/lib/");

//define lib paths
define('LIB_PSF_CACHE', LIB_PSF_ROOT . "../cache/");
define('LIB_PSF_CONFIG', LIB_PSF_ROOT . "config/");
define('LIB_PSF_STORE', LIB_PSF_ROOT . "store/");
define('LIB_PSF_PACKAGES', LIB_PSF_ROOT . "packages/");
define('LIB_PSF_PLUGINS', LIB_PSF_ROOT . "plugins/");

//allow error reporting
error_reporting(E_ALL);

//include autoloader and basic framework files and classes
require(LIB_PSF_ROOT . "inc/lib.php");
require(LIB_PSF_ROOT . "inc/autoload.php");

//initialize database
Database::getInstance();

?>
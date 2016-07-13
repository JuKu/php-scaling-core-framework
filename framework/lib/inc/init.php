<?php

/*
* Initialization Script
*
* MIT License
*/

//define lib path
define('LIB_PSF_ROOT', dirname(__FILE__) . "/../");

if (!defined('LIB_PSF_CACHE')) {
    //define cache path
    define('LIB_PSF_CACHE', LIB_PSF_ROOT . "../cache/");
}

//set config directory
if (!defined('LIB_PSF_CONFIG')) {
    //define cache path
    define('LIB_PSF_CONFIG', LIB_PSF_ROOT . "config/");
}

//set config directory
if (!defined('LIB_PSF_STORE')) {
    //define cache path
    define('LIB_PSF_STORE', LIB_PSF_ROOT . "store/");
}

//set packages directory
if (!defined('LIB_PSF_PACKAGES')) {
    //define cache path
    define('LIB_PSF_PACKAGES', LIB_PSF_ROOT . "packages/");
}

//set plugin directory
if (!defined('LIB_PSF_PLUGINS')) {
    //define cache path
    define('LIB_PSF_PLUGINS', LIB_PSF_ROOT . "plugins/");
}

//start session
session_start();

//TODO: remove this line
error_reporting(E_ALL);

//include autoloader and basic framework files and classes
require(LIB_PSF_ROOT . "inc/lib.php");
require(LIB_PSF_ROOT . "inc/autoload.php");

//check php version
if (!version_compare(PHP_VERSION, FPS_MIN_PHP_VERSION, '>=')) {
    echo "[PFS init.php] Error! PHP version " . PHP_VERSION . " isnt supported, <b>PHP " . FPS_MIN_PHP_VERSION . "+ is required</b>.<br />Current PHP version: " . PHP_VERSION . ".";
    exit;
}

//initialize autoloader cache
AutoLoaderCache::init();

//load required classes from cache
AutoLoaderCache::load();

//initialize events
Events::init();

//throw init event
Events::throwEvent("init");

//include xtpl
//require_once(LIB_PSF_ROOT . "engine/xtpl/caching_xtemplate.class.php");

//check secure php options
Security::check();

Events::throwEvent("init_security");

//initialize cache
Cache::init();

Events::throwEvent("init_cache");

//initialize host and load lokal configuration
Host::init();

?>

<?php

/*
* Initialization Script
*
* MIT License
*/

//define lib path
define('LIB_PSF_ROOT', dirname(__FILE__) . "/");

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

//start session
session_start();

//TODO: remove this line
error_reporting(E_ALL);

//include autoloader and basic framework files and classes
require(LIB_PSF_ROOT . "lib.php");
require(LIB_PSF_ROOT . "inc/autoload.php");

//check php version
if (!version_compare(PHP_VERSION, FPS_MIN_PHP_VERSION, '>=')) {
    echo "[PFS init.php] PHP version " . PHP_VERSION . " isnt supported, PHP 7.0.7+ is required.";
    exit;
}

require(LIB_PSF_CACHE . "settings.php");

if (!isset($psf_settings) || !isset($psf_settings['cache'])) {
    echo "[PFS init.php] Cache section isnt configured in cache settings.php (cache directory / settings.php).";
    exit;
}

if (!isset($psf_settings['gzip'])) {
    echo "[PFS init.php] Error! gzip configuration in <Cache> / settings.php doesnt exists.";
    exit;
}

if ($psf_settings['gzip'] == true) {
    //activate gzip compression
    ob_start();

    echo "<!-- gzip enabled -->";
}

//include xtpl
require_once(LIB_PSF_ROOT . "engine/xtpl/caching_xtemplate.class.php");

?>

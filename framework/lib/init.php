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
    define('LIB_PSF_CONFIG', LIB_PSF_ROOT . "../config/");
}

//include autoloader and basic framework files and classes
require(LIB_PSF_ROOT . "lib.php");
require(LIB_PSF_ROOT . "inc/autoload.php");

//check php version
if (!version_compare(PHP_VERSION, FPS_MIN_PHP_VERSION, '>=')) {
    echo "PHP version " . PHP_VERSION . " isnt supported, PHP 7.0.7+ is required.";
    exit;
}

require(LIB_PSF_CACHE . "settings.php");

if (!isset($psf_settings) || !isset($psf_settings['cache'])) {
    echo "Cache section isnt configured in cache settings.php (cache directory / settings.php).";
    exit;
}

if ($psf_settings['gzip'] == true) {
    //activate gzip compression
    if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
        ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS ^
            PHP_OUTPUT_HANDLER_REMOVABLE);
    } else {
        ob_start(null, 0, false);
    }
}

?>

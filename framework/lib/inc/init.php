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
    //define packages path
    define('LIB_PSF_PACKAGES', LIB_PSF_ROOT . "packages/");
}

//set plugin directory
if (!defined('LIB_PSF_PLUGINS')) {
    //define plugins path
    define('LIB_PSF_PLUGINS', LIB_PSF_ROOT . "plugins/");
}

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

//initialize host and load lokal configuration
Host::init();

//initialize events
Events::init();

//throw init event
Events::throwEvent("init");

//initialize cache
Cache::init();

Events::throwEvent("init_cache");

//check, if session is enabled
if (Host::isSessionEnabled()) {
    //check, if another session handler was choosen
    $handler_class = Host::getSessionHandler();

    Events::throwEvent("init_session");

    if ($handler_class != "default" && $handler_class != "files") {
        //create new instance of session handler
        $handler_instance = new $handler_class();

        $override_handler = true;

        Events::throwEvent("override_session_handler", array(
            'handler_class' => $handler_class,
            'handler_instance' => &$handler_instance,
            'override_handler' => &$override_handler
        ));

        if ($override_handler) {
            if ($handler_instance instanceof SessionHandlerInterface) {
                //set session handler
                session_set_save_handler($handler_instance, true);
            } else {
                throw new ConfigurationException("session handler " . $handler_class . " doesnt implements interface SessionHandlerInterface.");
            }
        }
    }

    //set session cache expire
    session_cache_expire(Host::getSessionTTLInMinutes());

    Events::throwEvent("start_session");

    //start session
    session_start();
}

//check secure php options
Security::check();

Events::throwEvent("init_security");

?>

<?php

/*
 * Attention! - Dont edit this file!
 *
 * this file was auto generated and will be overriden by application automatically.
 */

//for security reasons, settings.php can only included once
if (defined('PSCF_SETTINGS_INCLUDED')) {
    echo "settings already included. Abort now!";
    @ob_flush();
    exit;
}

$psf_settings = array(
    'cache' => array(
        'type' => "FileCache",
        'name' => "File Caching",
        'class_path' => LIB_PSF_ROOT . "inc/classes/filecache.php"
    ),
    'gzip' => true,

    /**
     * Debug Mode
     *
     * if debug mode is on, every thing will be printed to website as html comment
     *
     * possible values:
     *  - false (Debug mode disabled)
     *  - true (Debug mode enabled)
     */
    'debug' => false,
    'session' => array(
        'enabled' => true,
        /**
         * handler types:
         *
         *  - default - use php internal session handler, dont override session handler
         */
        'handler' => "default",
        'ttl' => 180 * 60,
    )
);

//define debug mode
define('DEBUG_MODE', $psf_settings['debug']);

define('PSCF_SETTINGS_INCLUDED', true);

?>
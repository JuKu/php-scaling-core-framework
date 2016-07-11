<?php

/**
 * Created by PhpStorm.
 * User: Justin
 * Date: 06.07.2016
 * Time: 19:52
 */
class Host {

    protected static $psf_settings = null;

    public static function init () {
        //check
        //load local settings
        require(LIB_PSF_CACHE . "settings.php");

        self::$psf_settings = $psf_settings;

        if (!isset($psf_settings['gzip'])) {
            echo "[PFS init.php] Error! gzip configuration in <Cache> / settings.php doesnt exists.";
            ob_flush();
            exit;
        }

        if ($psf_settings['gzip'] == true) {
            //activate gzip compression
            ob_start();

            echo "<!-- gzip enabled -->";
        }
    }

    public static function getUUIDPrefix () {
        //TODO: implement this function

        return "";
    }

    public static function isDebugEnabled () {
        return true;
    }

    public static function getAdminMail () {
        return "mail@example.com";
    }

}
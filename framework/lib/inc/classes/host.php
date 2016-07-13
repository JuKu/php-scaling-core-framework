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
        require(LIB_PSF_STORE . "settings/settings.php");

        self::$psf_settings = $psf_settings;

        if (!isset($psf_settings['gzip'])) {
            echo "[PFS init.php] Error! gzip configuration in <Cache> / settings.php doesnt exists.";
            ob_flush();
            exit;
        }

        if ($psf_settings['gzip'] == true) {
            //activate gzip compression
            ob_start();

            //echo "<!-- gzip enabled -->";
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

    public static function isSessionEnabled () {
        return isset(self::$psf_settings['session']) && isset(self::$psf_settings['session']['enabled']) && self::$psf_settings['session']['enabled'];
    }

    public static function getSessionHandler () {
        return self::$psf_settings['session']['handler'];
    }

    public static function getSessionTTL () {
        return self::$psf_settings['session']['ttl'];
    }

    public static function getSessionTTLInMinutes () {
        return (int) (self::$psf_settings['session']['ttl'] / 60);
    }

    public static function containsSetting ($key) {
        return isset(self::$psf_settings[$key]);
    }

    public static function getSetting ($key) {
        return self::$psf_settings[$key];
    }

}

?>
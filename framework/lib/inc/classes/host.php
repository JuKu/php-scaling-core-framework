<?php

/**
 * Created by PhpStorm.
 * User: Justin
 * Date: 06.07.2016
 * Time: 19:52
 */
class Host {

    public static function init () {
        //check
        //load local settings
        require(LIB_PSF_CACHE . "settings.php");
    }

    public static function getUUIDPrefix () {
        //TODO: implement this function

        return "";
    }

}
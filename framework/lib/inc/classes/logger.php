<?php

/**
 * Created by PhpStorm.
 * User: Justin
 * Date: 07.07.2016
 * Time: 17:49
 */
class Logger {
    
    public static function error ($text) {
        self::append($text);

        echo "An Error oncurred! Please contact " . Host::getAdminMail() . " !";

        if (Host::isDebugEnabled()) {
            echo $text;
        }

        //exit application
        exit;
    }

    private static function append ($text) {
        //TODO: write log file
    }

}
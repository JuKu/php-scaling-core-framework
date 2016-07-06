<?php

/**
 * Created by PhpStorm.
 * User: Justin
 * Date: 06.07.2016
 * Time: 19:46
 */
class Tracker {

    public static function getTrackerID () {
        //check, if tracker id is set
        if (isset($_COOKIE['trackerID']) && !empty($_COOKIE['trackerID']) && self::isTrackingEnabled()) {
            return $_COOKIE['trackerID'];
        } else {
            //generate new tracker ID
            $trackerID = self::generateNewTrackerID();

            //check, if tracking is enabled
            if (self::isTrackingEnabled()) {
                //set cookie
                $_COOKIE['trackerID'] = $trackerID;
            }

            return $trackerID;
        }
    }

    public static function isTrackingEnabled () {
        return true;
    }

    public static function generateNewTrackerID () {
        $random = substr(base64_encode(sha1(mt_rand())), 0, 10);

        //create new md5 hash
        return md5($random);
    }

}
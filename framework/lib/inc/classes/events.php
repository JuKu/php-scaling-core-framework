<?php

/**
 * Created by PhpStorm.
 * User: Justin
 * Date: 11.07.2016
 * Time: 23:50
 */
class Events {

    protected static $events = array();

    protected static $isInitialized = false;

    public static function init () {
        //
    }

    public static function throwEvent ($name, $params = array()) {
        if (!is_array($params)) {
            throw new IllegalArgumentException("second parameter params has to be an array.");
        }

        //check, if events was initialized first
        if (!self::$isInitialized) {
            //initialize events
            self::init();
        }

        if (isset(self::$events[$name])) {
            foreach (self::$events as $event) {
                self::executeEvent($event, $params);
            }
        }
    }

    protected static function executeEvent ($row, $params) {
        //TODO: execute event here
    }

}
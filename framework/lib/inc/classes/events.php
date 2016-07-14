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
        if (Cache::get2ndLvlCache()->contains("events", "events")) {
            self::$events = Cache::get2ndLvlCache()->get("events", "events");
        } else {
            //load events from database
            $rows = Database::getInstance()->listRows("SELECT * FROM `{PRAEFIX}events` WHERE `activated` = '1'; ");

            //iterate through rows
            foreach ($rows as $row) {
                //get name of event
                $name = $row['name'];

                //check, if name exists in array
                if (!isset(self::$events[$name])) {
                    self::$events[$name] = array();
                }

                //add row to array
                self::$events[$name][] = $row;
            }

            //put events into cache
            Cache::get2ndLvlCache()->put("events", "events", self::$events);
        }

        //set initialized flag to true
        self::$isInitialized = true;
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
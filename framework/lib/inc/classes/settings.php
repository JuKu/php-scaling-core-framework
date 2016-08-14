<?php

/**
 * Created by PhpStorm.
 * User: Justin
 * Date: 14.07.2016
 * Time: 14:25
 */
class Settings {

    /**
     * settings
     *
     *  - area type
     *  - area
     *  - key
     *  - value
     */
    protected static $settings = array();

    protected $areaType = "core";
    protected $area = "";

    /**
     * default constructor
     *
     * @param $area area of settings (for example "core" or name of plugin)
     * @param $areaType optional areaType, for example "core", "plugin" or "style"
     */
    public function __construct($area, $areaType = "core") {
        //
    }

    public function load () {
        //
    }

    /**
     * get setting
     */
    public function get ($key, $area = "core", $areaType = "core", $device = "", $lang = "", $domain = "") {
        if (isset(self::$settings[$areaType]) && isset(self::$settings[$areaType][$area]) && isset(self::$settings[$areaType][$area][$key])) {
            return self::$settings[$areaType][$area][$key];
        } else {
            //load from database
            return $this->getFromDB($key, $area, $areaType);
        }
    }

    public function getFromDB ($key, $area = "core", $areaType = "core") {
        //
    }

    public function put ($key, $value, $area = "core", $areaType = "core") {
        //
    }

    public function putIfAbsent ($key, $value, $area = "core", $areaType = "core") {
        //
    }

    public static function getInstance () {
        //
    }

}
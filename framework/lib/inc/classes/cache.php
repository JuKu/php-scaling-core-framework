<?php

/**
 * Created by PhpStorm.
 * User: Justin
 * Date: 26.06.2016
 * Time: 17:26
 */

class Cache {

    /**
     * first level cache for sessions and so on
     */
    protected $instance = null;

    /**
     * second level cache for normal cache entries
     */
    protected $second_level_cache = null;

    public static function init () {
        //TODO: read config and create cache instances
    }

    public function &getCache () {
        return $this->instance;
    }

    public function &get2ndLvlCache () {
        return $this->second_level_cache;
    }

}
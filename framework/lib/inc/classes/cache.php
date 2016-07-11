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
    protected static $instance = null;

    /**
     * second level cache for normal cache entries
     */
    protected static $second_level_cache = null;

    public static function init () {
        require(LIB_PSF_CONFIG . "cache.php");
        
        if (!isset($config['first_lvl_cache']) || !isset($config['first_lvl_cache']['class_name'])) {
            throw new ConfigurationException("cache configuration or class name of 'first_lvl_cache' isnt set.");
        }

        if (!isset($config['second_lvl_cache']) || !isset($config['second_lvl_cache']['class_name'])) {
            throw new ConfigurationException("cache configuration or class name of 'second_lvl_cache' isnt set.");
        }
        
        //create new instance of first level cache
        $class_name = $config['first_lvl_cache']['class_name'];
        self::$instance = new $class_name();

        if (!self::$instance instanceof ICache) {
            throw new ConfigurationException("first level cache isnt instance of ICache.");
        }

        //call cache init function
        self::$instance->init($config['first_lvl_cache']);

        //check, if second level cache is activated
        if (isset($config['second_lvl_cache']['activated']) && $config['second_lvl_cache']['activated']) {
            //create new instance of second level cache
            $class_name = $config['second_lvl_cache']['class_name'];
            self::$second_level_cache = new $class_name();

            if (!self::$second_level_cache instanceof ICache) {
                throw new ConfigurationException("second level cache isnt instance of ICache.");
            }

            //call cache init function
            self::$second_level_cache->init($config['second_lvl_cache']);
        } else {
            //else use first level cache instead
            self::$second_level_cache = &self::$instance;
        }
    }

    public function &getCache () {
        return $this->instance;
    }

    public function &get2ndLvlCache () {
        return $this->second_level_cache;
    }

}
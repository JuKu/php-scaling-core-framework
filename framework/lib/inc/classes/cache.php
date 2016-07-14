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

    /**
     * cache instances
     */
    protected static $cache_instances = array();

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

        self::$cache_instances['first_lvl_cache'] = &self::$instance;

        if (isset($config['first_lvl_cache']['names']) && is_array($config['first_lvl_cache']['names'])) {
            $names = $config['first_lvl_cache']['names'];

            foreach ($names as $name) {
                self::$cache_instances[$name] = &self::$instance;
            }
        }

        //check, if second level cache is activated
        if (isset($config['second_lvl_cache']['activated']) && $config['second_lvl_cache']['activated'] == true) {
            //create new instance of second level cache
            $class_name = $config['second_lvl_cache']['class_name'];
            self::$second_level_cache = new $class_name();

            if (!self::$second_level_cache instanceof ICache) {
                throw new ConfigurationException("second level cache isnt instance of ICache.");
            }

            //call cache init function
            self::$second_level_cache->init($config['second_lvl_cache']);

            if (isset($config['second_lvl_cache']['names']) && is_array($config['second_lvl_cache']['names'])) {
                $names = $config['second_lvl_cache']['names'];

                foreach ($names as $name) {
                    self::$cache_instances[$name] = &self::$second_level_cache;
                }
            }
        } else {
            //else use first level cache instead
            self::$second_level_cache = &self::$instance;
        }

        self::$cache_instances['second_lvl_cache'] = &self::$second_level_cache;

        //TODO: load other caches
    }

    public static function &getCache ($name = "") : ICache {
        if ($name == "") {
            return self::$instance;
        } else {
            //check, if cache exists
            if (self::containsCache($name)) {
                return self::$cache_instances[$name];
            } else {
                throw new CacheNotFoundException("Couldnt found cache " . $name . ".");
            }
        }
    }

    public static function &get2ndLvlCache () : ICache {
        if (self::$second_level_cache == null) {
            throw new Exception("second level cache is null.");
        }

        return self::$second_level_cache;
    }

    public static function containsCache ($name) {
        return isset(self::$cache_instances[$name]);
    }

    public static function putCache ($name, &$cache_instance) {
        if ($name == null || $name == "") {
            throw new NullPointerException("cache name cannot be null.");
        }

        //check, if instance is an cache instance
        if ($cache_instance instanceof ICache) {
            //put cache
            self::$cache_instances[$name] = &$cache_instance;
        } else {
            throw new ClassLoaderException("cannot add cache " . $name . ", because cache instance of class " . get_class($cache_instance) . " doesnt implements ICache.");
        }

        //check, if cache is also second level cache
        if ($name == "second_lvl_cache") {
            self::$second_level_cache = &$cache_instance;
        }
    }

    public static function removeCache ($name) {
        unset(self::$cache_instances[$name]);
    }

}
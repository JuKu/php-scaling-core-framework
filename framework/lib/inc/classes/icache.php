<?php

interface ICache {

    public function init ($config);

    /**
     * put session
     *
     * @param $area cache area
     * @param $key cache key
     * @param $value cache entry value, can also be an object
     * @param $ttl time to live of cache entry in seconds (optional)
     */
    public function put ($area, $key, $value, $ttl = 180 * 60);

    public function get ($area, $key);

    public function contains ($area, $key);

    public function clear ($area = "", $key = "");

}

?>
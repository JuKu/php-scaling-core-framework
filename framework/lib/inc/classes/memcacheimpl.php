<?php

/**
 * Memcache Cache Implementation
 *
 * Warning! - Memcache and Memcached arent the same!
 *
 * We do not recommend to use memcache anymore, use memcached instead.
 */
class MemcacheImpl implements ICache {

    protected $memcache = null;

    public function __construct() {
        if (!PHPUtils::isMemcacheAvailable()) {
            throw new ConfigurationException("Memcache PECL extension for PHP isnt loaded.");
        }

        //create new instance of memcache
        $this->memcache = new Memcache();
    }

    public function connect ($host, $port) {
        $this->memcache->connect($host, $port);
    }

    public function init($config) {
        require(LIB_PSF_CONFIG . "memcache.php");
        
        $host = $memcache_config['host'];
        $port = $memcache_config['port'];
    }

    public function put($area, $key, $value) {
        $this->memcache->set($this->getKey($area, $key), serialize($value));
    }

    public function get($area, $key) {
        return unserialize($this->memcache->get($this->getKey($area, $key)));
    }

    public function contains($area, $key) {
        return $this->memcache->get($this->getKey($area, $key)) != false;
    }

    public function clear($area = "", $key = "") {
        if ($area != "" && $key != "") {
            $this->memcache->delete($this->getKey($area, $key));
        } else if ($area != "" && $key == "") {
            //remove area from cache

            //TODO: find an efficienter way

            //list all keys
            $keys = $this->listAllKeys();

            foreach ($keys as $key) {
                //check, if key belongs to this area
                if (substr($key, 0, strlen($area)) === $$area) {
                    //remove key
                    $this->memcache->delete($key);
                } else {
                    //key doesnt belongs to this area
                    continue;
                }
            }
        } else {
            //remove all cache entries
            $this->memcache->flush();
        }
    }

    private function getKey ($area, $key) {
        return md5($area) . md5($key);
    }

    private function listAllKeys ($limit = 10000) {
        //list with keys
        $keys = array();

        //get extended states
        $stats = $this->memcache->getExtendedStats('slabs');

        foreach ($stats as $serverStats) {
            foreach ($serverStats as $id => $stateMeta) {
                try {
                    $cacheDump = $this->memcache->getExtendedStats('cachedump', (int) $id, 1000);
                } catch (Exception $e) {
                    continue;
                }

                if (!is_array($cacheDump)) {
                    continue;
                }

                foreach ($cacheDump as $dump) {

                    if (!is_array($dump)) {
                        continue;
                    }

                    foreach ($dump as $key => $value) {
                        //add key to list
                        $keys[] = $key;

                        if (count($keys) >= $limit) {
                            return $keys;
                        }
                    }
                }
            }
        }

        return $keys;
    }

}
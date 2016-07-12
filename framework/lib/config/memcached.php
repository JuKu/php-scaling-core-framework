<?php

/**
 * Memcached configuration
 *
 * PSF Framework doesnt require memcached, but you can use it to speed up your website.
 * Note: If you want to use memcached, you have also to configure in file cache.php
 *
 * Attention! - memcache and memcached arent the same!
 */

//Memcache Statistic Report: https://github.com/DBezemer/memcachephp

//http://php.net/manual/de/memcache.examples-overview.php

$memcached_config = array(
    'server' => array(
        array(
            'host' => "127.0.0.1",
            'port' => "11211"
        ),
        /*array(
            'host' => "127.0.0.1",
            'port' => "11211"
        ),*/
    )
);

?>
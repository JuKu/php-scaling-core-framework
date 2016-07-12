<?php

/**
 * Memcache configuration
 *
 * PSF Framework doesnt require memcache, but you can use it to speed up your website.
 * Note: If you want to use memcache, you have also to configure in file cache.php
 */

//Memcache Statistic Report: https://github.com/DBezemer/memcachephp

$memcache = array(
    'host' => "127.0.0.1",
    'port' => "11211",
    'authentification' => array(
        'enabled' => false,
        'user' => "",
        'password' => ""
    )
);

?>
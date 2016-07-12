<?php

/*
 * example index.php file
 */

$start_time = microtime(true);

define('ROOT_PATH', dirname(__FILE__) . "/");

require(ROOT_PATH . "framework/lib/inc/init.php");

try {
    //your application code here

    //...
} catch (Exception $e) {
    echo $e->getTraceAsString();

    //clear caches to avoid other exceptions
    Cache::getCache()->clear();
    Cache::get2ndLvlCache()->clear();
}

$end_time = microtime(true);
$time_diff = $end_time - $start_time;

//clear all cached files
//TODO: remove this lines, they are only for tests
Cache::getCache()->clear();
Cache::get2ndLvlCache()->clear();

if (Host::isDebugEnabled()) {
    //print all loaded classes
    echo "<!-- loaded classes:\r\n\r\n";

    foreach (PFS_Autoloader::listLoadedClasses() as $class_name) {
        echo "" . $class_name . "\r\n";
    }

    echo "\r\n\r\n -->";
}

echo "<!-- website generated in " . $time_diff . "ms -->";

?>
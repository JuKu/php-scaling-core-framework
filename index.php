<?php

/*
 * example index.php file
 */

//get start time in microseconds for script execution time calculation
$start_time = microtime(true);

//define root path
define('ROOT_PATH', dirname(__FILE__) . "/");

//require initialization script to add autoloader and so on
require(ROOT_PATH . "framework/lib/inc/init.php");

try {
    //your application code here

    /*$headers = apache_request_headers();

    foreach ($headers as $header => $value) {
        echo "$header: $value <br />\n";
    }*/

    //...
} catch (Exception $e) {
    echo $e->getTraceAsString();

    //clear caches to avoid other exceptions
    Cache::getCache()->clear();
    Cache::get2ndLvlCache()->clear();
}

//throw event, so plugins can execute here
Events::throwEvent("after_execution");

if (Host::isDebugEnabled()) {
    //print debug message
    echo "<!-- Debug Mode is enabled - dont use in production! -->\r\n\r\n";

    //print all loaded classes
    echo "<!-- loaded classes:\r\n\r\n";

    foreach (PFS_Autoloader::listLoadedClasses() as $class_name) {
        echo "" . $class_name . "\r\n";
    }

    echo "\r\n\r\n -->\r\n";

    //clear all cached files
    echo "<!-- clear cache -->\r\n\r\n";

    //TODO: remove this lines, they are only for tests
    Cache::getCache()->clear();
    Cache::get2ndLvlCache()->clear();

    //print number of database queries
    echo "<!-- " . Database::getInstance()->countQueries() . " database queries executed. -->\r\n\r\n";
}

//get microtime to calculate execution time
$end_time = microtime(true);
$time_diff = $end_time - $start_time;

echo "<!-- website generated in " . $time_diff . "ms -->";

?>
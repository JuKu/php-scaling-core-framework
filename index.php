<?php

/*
 * example index.php file
 */

$start_time = microtime(true);

define('ROOT_PATH', dirname(__FILE__) . "/");

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

if (Host::isDebugEnabled()) {
    //print debug message
    echo "<!-- Debug Mode is enabled - dont use in production! -->\r\n\r\n";

    //print all loaded classes
    echo "<!-- loaded classes:\r\n\r\n";

    foreach (PFS_Autoloader::listLoadedClasses() as $class_name) {
        echo "" . $class_name . "\r\n";
    }

    echo "\r\n\r\n -->";

    //clear all cached files
    echo "<!-- clear cache -->\r\n\r\n";

    //TODO: remove this lines, they are only for tests
    Cache::getCache()->clear();
    Cache::get2ndLvlCache()->clear();

    //print number of database queries
    echo "<!-- " . Database::getInstance()->countQueries() . " database queries executed. -->\r\n\r\n";
}

$end_time = microtime(true);
$time_diff = $end_time - $start_time;

echo "<!-- website generated in " . $time_diff . "ms -->";

?>
<?php

/*
 * example index.php file
 */

$start_time = microtime(true);

//start session
session_start();

//enable gzip compression
ob_start();

//TODO: remove this line
error_reporting(E_ALL);

define('ROOT_PATH', dirname(__FILE__) . "/");

require(ROOT_PATH . "lib/inc/init.php");

//check secure php options
Security::check();

//initialize cache
Cache::init();

//initialize host and load lokal configuration
Host::init();

//your application code here

//...

$end_time = microtime(true);
$time_diff = $end_time - $start_time;

echo "<!-- website generated in " . $time_diff . "ms -->";

?>
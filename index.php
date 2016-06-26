<?php

/*
 * example index.php file
 */

$start_time = microtime(true);

ob_start();

define('ROOT_PATH', dirname(__FILE__) . "/");

require(ROOT_PATH . "lib/inc/init.php");

//...

$end_time = microtime(true);
$time_diff = $end_time - $start_time;

echo "<!-- website generated in " . $time_diff . "ms -->";

?>
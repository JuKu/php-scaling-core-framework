<?php

/**
 * Database configuration
 */

$database = array(
    'driver' => "MySQLDriver",
    'config' => "mysql.cfg.php",
    'primary' => array(
        'readonly' => false,
        'config' => "mysql.cfg.php",
        'driver' => "MySQLDriver"
    ),
    'second' => array(
        //
    )
);

?>
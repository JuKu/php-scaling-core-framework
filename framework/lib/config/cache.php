<?php

/**
 * Cache configuration
 */

$config = array(
    'first_lvl_cache' => array(
        'activated' => true,
        'class_name' => "FileCache"
    ),
    'second_lvl_cache' => array(
        'activated' => true,
        'class_name' => "FileCache"
    )
);

?>
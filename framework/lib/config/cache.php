<?php

/**
 * Cache configuration
 */

$config = array(
    'first_lvl_cache' => array(
        'activated' => true,
        'type' => "FileCache"
    ),
    'second_lvl_cache' => array(
        'activated' => true,
        'type' => "FileCache"
    )
);

?>
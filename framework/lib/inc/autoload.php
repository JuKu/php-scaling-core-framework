<?php

/*
 * Autoloader for Framework classes
 */

class PFS_Autoloader {

    //counter of loaded classes, for statistics
    protected static $loaded_classes = 0;

    /**
     * return number of loaded classes
     *
     * @return number of loaded classes
     */
    public static function countLoadedClasses () {
        return self::loaded_classes;
    }

    /**
     * try to load class with autoloader
     */
    public function loadClass ($class_name) {
        $loaded = false;

        return $loaded;
    }

}

?>
<?php

/*
 * Autoloader for Framework classes
 */

class PFS_Autoloader {

    //array with loaded classes, for statistics
    protected static $loaded_classes = array();

    //array with all not founded classes
    protected static $error_logs = array();

    /**
     * return number of loaded classes
     *
     * @return number of loaded classes
     */
    public static function countLoadedClasses () {
        return count(self::loaded_classes);
    }

    /**
     * try to load class with autoloader
     */
    public static function loadClass ($class_name) {
        $loaded = false;

        //convert to array for namespaces
        $array1 = explode("_", $class_name);

        if (sizeof($array1) == 1) {
            //check, if file exists
            if (file_exists(LIB_PSF_ROOT . "inc/classes/" . $class_name . ".php")) {
                //include class
                require(LIB_PSF_ROOT . "inc/classes/" . $class_name . ".php");

                //add class to array
                self::$loaded_classes[] = LIB_PSF_ROOT . "inc/classes/" . $class_name . ".php";

                //set loaded flag to true, class was loaded
                $loaded = true;
            }
        }

        return $loaded;
    }

}

//register autoloader
spl_autoload_register("FPS_Autoloader::load_class");

?>
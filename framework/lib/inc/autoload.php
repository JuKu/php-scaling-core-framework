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

        //convert to lower case
        $class_name = strtolower($class_name);

        //convert to array for namespaces
        $array1 = explode("_", $class_name);

        if (sizeof($array1) == 1) {
            //check, if file exists
            if (file_exists(LIB_PSF_ROOT . "inc/classes/" . $class_name . ".php")) {
                //include class
                require_once(LIB_PSF_ROOT . "inc/classes/" . $class_name . ".php");

                //set loaded flag to true, class was loaded
                $loaded = true;
            }
        } else if (sizeof($array1) == 2) {
            //check, if its an driver class
            if ($array1[0] == "driver") {
                //check, if driver exists
                if (file_exists(LIB_PSF_ROOT . "inc/driver/" . $array1[1] . ".php")) {
                    //include class
                    require_once(LIB_PSF_ROOT . "inc/driver/" . $array1[1] . ".php");

                    //set loaded flag to true, class was loaded
                    $loaded = true;
                } else {
                    throw new ClassLoaderException("Couldnt load database driver " + $class_name + ".");
                }
            }
        }

        if ($loaded) {
            //add class to array
            self::$loaded_classes[] = LIB_PSF_ROOT . "inc/classes/" . $class_name . ".php";
        } else {
            self::$error_logs[] = $class_name;
            echo "<b>Couldnt find class " . $class_name . "</b>";
        }

        return $loaded;
    }

}

//register autoloader
spl_autoload_register("PFS_Autoloader::loadClass");

?>
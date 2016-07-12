<?php

/**
 * Created by PhpStorm.
 * User: Justin
 * Date: 12.07.2016
 * Time: 00:39
 */
class AutoLoaderCache {

    public static function init () {
        //check, if directory autoloader in cache exists
        if (!file_exists(LIB_PSF_CACHE . "autoloader")) {
            mkdir(LIB_PSF_CACHE . "autoloader");
        }

        //check, if autoloader configuration exists
        if (!file_exists(LIB_PSF_STORE . "autoloader/autoloader.php")) {
            throw new ConfigurationException("autoloader configuration not found in store.");
        }

        if (!file_exists(LIB_PSF_CACHE . "autoloader/preloaded_classes.php")) {
            //create cache
            self::createCache();
        }
    }

    public static function load () {
        if (!file_exists(LIB_PSF_STORE . "autoloader/autoloader.php")) {
            throw new ConfigurationException("autoloader configuration not found in store.");
        }

        if (!file_exists(LIB_PSF_CACHE . "autoloader/preloaded_classes.php")) {
            //cache file doesnt exists
            self::createCache();
        }

        //load classes from cache to save I/O
        require(LIB_PSF_CACHE . "autoloader/preloaded_classes_uncompressed.php");
    }

    private static function createCache () {
        require(LIB_PSF_STORE . "autoloader/autoloader.php");

        //create new cache file
        $data = "";

        foreach ($autoloader_classes as $class_path) {
            if (file_exists($class_path)) {
                //get php code directly
                $data .= file_get_contents($class_path);
            } else if (file_exists(LIB_PSF_ROOT . $class_path)) {
                //use LIB_PSF_ROOT prefix
                $data .= file_get_contents(LIB_PSF_ROOT . $class_path);
            } else {
                Logger::warn("class " . $class_path . " couldnt be cached.");
                echo "<!-- class " . $class_path . " couldnt be cached. -->";
            }
        }

        //remove unneccessary php tags
        $data = str_replace("<?php", "", $data);
        $data = str_replace("?>", "", $data);

        $text = "<" . "?" . "php " . $data . " ?" . ">";

        //write data to file in uncrommpressed way
        file_put_contents(LIB_PSF_CACHE . "autoloader/preloaded_classes_uncompressed.php", $text);

        //compress code, remove comments and unneccessary whitespaces with php_strip_whitespace()
        file_put_contents(LIB_PSF_CACHE . "autoloader/preloaded_classes.php", php_strip_whitespace(LIB_PSF_CACHE . "autoloader/preloaded_classes_uncompressed.php"));
    }

}
<?php

/*
 * File cache implementation
 */

class FileCache implements ICache {

    public function put($area, $key, $value, $ttl = 0) {
        //create directory, if neccessary
        $this->check_directory(md5($area));

        //write value to file
        file_put_contents(LIB_PSF_CACHE . "/" . md5($area) . "/" + md5($key) + ".php", serialize($value));
    }

    public function get($area, $key) {
        if ($this->contains($area, $key)) {
            return unserialize(file_get_contents(LIB_PSF_CACHE . "/" . md5($area) . "/" + md5($key) + ".php"));
        } else {
            throw new Exception("File cache object " . $area . "/" . $key + "(" . LIB_PSF_CACHE . md5($area) . "/" . md5($key) . ") doesnt exists.");
        }
    }

    public function contains($area, $key) {
        return file_exists(LIB_PSF_CACHE . "/" . md5($area) . "/" + md5($key) + ".php");
    }

    private function check_directory ($name) {
        if (!file_exists(LIB_PSF_CACHE . $name)) {
            mkdir(LIB_PSF_CACHE . $name);
        }
    }

    public function init($config) {
        //check directory
        if (!file_exists(LIB_PSF_CACHE)) {
            mkdir(LIB_PSF_CACHE);
        }

        //check template directory
        if (!file_exists(LIB_PSF_CACHE . "template")) {
            mkdir(LIB_PSF_CACHE . "template");
        }
    }

    public function clear($area = "", $key = "") {
        if ($area == "") {
            $this->rrmdir(LIB_PSF_CACHE, LIB_PSF_CACHE);
        }
        // TODO: Implement clear() method.
    }

    protected function rrmdir ($dir, $cache_dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir."/".$object))
                        $this->rrmdir($dir."/".$object, $cache_dir);
                    else
                        unlink($dir."/".$object);
                }
            }

            if ($dir != $cache_dir) {
                rmdir($dir);
            }
        }
    }

}

?>
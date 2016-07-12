<?php

/*
 * File cache implementation
 */

class FileCache implements ICache {

    public function put($area, $key, $value) {
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
        // TODO: Implement clear() method.
    }
}

?>
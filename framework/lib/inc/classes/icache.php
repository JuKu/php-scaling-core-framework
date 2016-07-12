<?php

interface ICache {

    public function init ($config);

    public function put ($area, $key, $value);

    public function get ($area, $key);

    public function contains ($area, $key);

    public function clear ($area = "", $key = "");

}

?>
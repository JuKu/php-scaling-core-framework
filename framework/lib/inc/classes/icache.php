<?php

interface ICache {

    public function put ($area, $key, $value);

    public function get ($area, $key);

    public function contains ($area, $key);

}

?>
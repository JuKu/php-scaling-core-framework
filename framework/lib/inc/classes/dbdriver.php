<?php

/**
 * Created by PhpStorm.
 * User: Justin
 * Date: 07.07.2016
 * Time: 17:47
 */
interface DBDriver {

    public function connect ($config_path);

}
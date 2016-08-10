<?php

/**
 * Created by PhpStorm.
 * User: Justin
 * Date: 10.08.2016
 * Time: 20:28
 */
class Browser {

    public function isMobile () {
        //TODO: add code here
    }

    public function isTablet () {
        //TODO: add code here
    }

    public function isAppleiOS () {
        //TODO: add code here
    }

    public function isAndroid () {
        //TODO: add code here
    }

    public function getUserAgent () {
        return htmlentities($_SERVER['HTTP_USER_AGENT']);
    }

}
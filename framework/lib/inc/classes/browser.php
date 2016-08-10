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
        $user_agent = htmlentities($_SERVER['HTTP_USER_AGENT']);

        //throw event, so plugins can modify user agent
        Events::throwEvent("get_user_agent", array(
            'user_agent' => &$user_agent,
        ));

        return $user_agent;
    }

}
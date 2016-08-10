<?php

/**
 * Created by PhpStorm.
 * User: Justin
 * Date: 10.08.2016
 * Time: 20:28
 */
class Browser {

    /**
     * check, if browser is mobile
     *
     * @return true, if browser is mobile
     */
    public function isMobile () : bool {
        return preg_match("/(android|webos|avantgo|iphone|ipad|ipod|blackberry|iemobile|bolt|bo‌​ost|cricket|docomo|fone|hiptop|mini|opera mini|kitkat|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $this->getUserAgent());
    }

    public function isMobilePhone () : bool {
        //TODO: add code here
    }

    public function isTablet () : bool {
        //TODO: add code here
    }

    public function isAppleiOS () : bool {
        //TODO: add code here
    }

    public function isAndroid () : bool {
        //TODO: add code here
    }

    public function getUserAgent () : string {
        $user_agent = strtolower(htmlentities($_SERVER['HTTP_USER_AGENT']));

        //throw event, so plugins can modify user agent
        Events::throwEvent("get_user_agent", array(
            'user_agent' => &$user_agent,
        ));

        return $user_agent;
    }

}
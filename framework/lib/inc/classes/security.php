<?php

/**
 * Created by PhpStorm.
 * User: Justin
 * Date: 06.07.2016
 * Time: 19:56
 */
class Security {

    protected static $csrf_token = "";

    public static function checkPHPOptions () {
        if (get_magic_quotes_gpc()) {
            throw new SecurityException("magic quotes is on.");
        }

        /**
         * dont allow DDT to avoid some XXE attacks
         *
         * @link https://www.owasp.org/index.php/XML_External_Entity_(XXE)_Prevention_Cheat_Sheet
         * @link http://php.net/manual/en/function.libxml-disable-entity-loader.php
         * @link https://www.sensepost.com/blog/2014/revisting-xxe-and-abusing-protocols/
         *
         * @link https://gist.github.com/lukaskuzmiak/c8306a5af855c6faaaee#file-php_xxe_tester-php
         */
        libxml_disable_entity_loader(true);
    }

    public static function check () {
        //check php options
        self::checkPHPOptions();

        //remove php version header
        header_remove("X-Powered-By");

        //remove server os header
        header_remove("Server");

        //check, if csrf token exists and if not generate an new csrf token
        self::initCSRFToken();
    }

    protected static function initCSRFToken () {
        if (!isset($_SESSION['csrf_token'])) {
            /*self::$csrf_token = hash_hmac(
                'sha512',
                openssl_random_pseudo_bytes(32),
                openssl_random_pseudo_bytes(16)
            );*/

            //generate new random token with 32 bytes
            self::$csrf_token = base64_encode( openssl_random_pseudo_bytes(32));

            $_SESSION['csrf_token'] = self::$csrf_token;
        } else {
            //get CSRF token from string
            self::$csrf_token = $_SESSION['csrf_token'];
        }
    }

    public static function getCSRFToken () {
        //return CSRF token
        return self::$csrf_token;
    }

    public static function getCSRFTokenField () {
        return "<input type=\"hidden\" name=<\"csrf_token\" value=\"" . self::$csrf_token . "\" />";
    }

    public static function checkCSRFToken ($value) {
        return self::$csrf_token == $value;
    }

}
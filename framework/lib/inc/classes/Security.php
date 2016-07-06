<?php

/**
 * Created by PhpStorm.
 * User: Justin
 * Date: 06.07.2016
 * Time: 19:56
 */
class Security {

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
        self::checkPHPOptions();
    }

}
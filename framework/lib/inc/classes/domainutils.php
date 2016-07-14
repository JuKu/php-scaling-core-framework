<?php

/**
 * Created by PhpStorm.
 * User: Justin
 * Date: 13.07.2016
 * Time: 22:48
 */
class DomainUtils {

    public static function getTLD ($url) {
        $domain_tld = "";

        //http://news.mullerdigital.com/2013/10/30/how-to-get-the-domain-and-tld-from-a-url-using-php-and-regular-expression/

        preg_match("/[a-z0-9\-]{1,63}\.[a-z\.]{2,6}$/", parse_url($url, PHP_URL_HOST), $domain_tld);

        return $domain_tld[0];
    }

    public static function isHTTPS () {
        return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off";
    }

    public static function getPort () {
        return (int) $_SERVER['SERVER_PORT'];
    }

    public static function isProxyUsed () {
        return isset($_SERVER['HTTP_X_FORWARDED_HOST']) && !empty($_SERVER['HTTP_X_FORWARDED_HOST']);
    }

    public static function getHost () {
        $host = "";

        if (isset($_SERVER['HTTP_X_FORWARDED_HOST']) && !empty($_SERVER['HTTP_X_FORWARDED_HOST'])) {
            $host = $_SERVER['HTTP_X_FORWARDED_HOST'];

            //because HTTP_X_FORWARDED_HOST can contains more than 1 host, we only want to get the last host name
            $elements = explode(',', $host);
            $host = end($elements);
        } else if (isset($_SERVER['SERVER_NAME']) && !empty($_SERVER['SERVER_NAME'])) {
            $host = $_SERVER['SERVER_NAME'];
        } else if (isset($_SERVER['HTTP_HOST']) && !empty($_SERVER['HTTP_HOST'])) {
            $host = $_SERVER['HTTP_HOST'];
        } else {
            //unknown host

            //use server ip
            return htmlentities($_SERVER['SERVER_ADDR']);
        }

        // Remove port number from host
        $host = preg_replace("%:\d+$%", "", $host);

        return trim($host);
    }

    /**
     * get domain
     *
     * alias to getHost()
     */
    public function getDomain () {
        return self::getHost();
    }

    public static function getReferer () {
        return htmlentities($_SERVER['HTTP_REFERER']);
    }

    public static function getRequestMethod () {
        return htmlspecialchars($_SERVER['REQUEST_METHOD']);
    }

    public static function getRequestURI () {
        return htmlentities($_SERVER['REQUEST_URI']);
    }

    public static function getBaseURL () {
        $url = "";

        //add protocol
        if (self::isHTTPS()) {
            $url .= "https://";
        } else {
            $url .= "http://";
        }

        //add domain
        $url .= self::getDomain();

        //check, if an specific server port is used
        if (self::getPort() != 80 && self::getPort() != 433) {
            $url .= ":" . self::getPort();
        }

        return $url;
    }

    public static function getURL () {
        return self::getBaseURL() . self::getRequestURI();
    }

}
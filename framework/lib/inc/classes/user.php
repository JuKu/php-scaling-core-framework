<?php

/**
 * Created by PhpStorm.
 * User: Justin
 * Date: 06.07.2016
 * Time: 19:00
 */
class User {

    /**
     * static instance of current user
     *
     * singleton design pattern
     */
    protected static $instance = null;

    /**
     * cluster wide unique ID of user
     */
    protected $userID = 0;

    protected $username = "Guest";

    public function __construct() {
        //
    }

    /**
     * initialize user and load user data from session
     */
    public final function init () {
        //check, if user is logged in
        if ($this->isLoggedIn()) {
            //load data from session
            $this->loadDataFromSession();
        }

        //call onInit() function to make initialization extensible
        $this->onInit();
    }

    protected function onInit () {
        //
    }

    /**
     * check, if user is logged in
     */
    public function isLoggedIn () {
        return isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true && isset($_SESSION['userID']) && $_SESSION['userID'] != 0;
    }

    protected function checkForLogout () {
        /**
         * check, if logout is set in POST request
         *
         * only allow POST and NOT GET, do avoid some SSRF and CSRF attacks!
         */
        if (isset($_POST['logout']) && $_POST['logout'] == true) {
            //logout user
            $this->logout();
        }
    }

    /**
     * logout user
     */
    public function logout () {
        //reset session
        $_SESSION['userID'] = 0;
        $_SESSION['isLoggedIn'] = false;
    }

    protected function loadDataFromSession () {
        //check, if session is complete
        if (!isset($_SESSION['userID']) || !isset($_SESSION['username'])) {
            //throw exception, maybe its also an hacker (?)
            throw new Exception("session data isnt complete.");
        }
    }

    public function onLogout () {
        //
    }

    public function getUserID () {
        return $this->userID;
    }

    public function getName () {
        return $this->username;
    }

    public static function getCurrent () {
        //check, if instance exists
        if (self::$instance == null) {
            //create new instance of user
            self::$instance = new User();

            //initialize user
            self::$instance->init();
        }

        //return instance
        return self::$instance;
    }
    
    public static function setCurrent (User $user) {
        if ($user == null) {
            throw new NullPointerException("user instance is null.");
        }

        self::$instance = $user;
    }

}

?>
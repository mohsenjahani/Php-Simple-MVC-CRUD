<?php
/**
 * Created by PhpStorm.
 * User: Jimbo-programing1
 * Date: 10/19/2017
 * Time: 9:39 PM
 */

namespace lib\Session;

class Session
{
    /**
     * Session start
     */
    public static function init()
    {
        @session_start();
    }

    /*
     * Get Session
     */
    public static function get($key){
        if(isset($_SESSION[$key]))
            return $_SESSION[$key];
        else
            return null;
    }

    /*
     * Get Boolean Variable
     */
    public static function getBool($key){
        if(isset($_SESSION[$key]))
            return true;
        return false;
    }

    /*
     * Set Session
     */
    public static function set($key, $value){
        $_SESSION[$key] = $value;
    }

    /*
     * Delete Session
     */
    public static function delete($key){
        unset($_SESSION[$key]);
    }

    /**
     * Session destroy
     */
    public static function destroy()
    {
        @session_destroy();
    }






}
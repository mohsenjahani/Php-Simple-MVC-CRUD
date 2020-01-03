<?php
namespace lib\Utils\Validate;

class Validate
{
    /*
     * Username Validate
     */
    public static function validateUsername($username){
        return preg_match('/^[a-zA-Z0-9]{5,15}$/', $username);
    }

    /*
     * Password Validate
     */
    public static function validatePassword($password){
        return preg_match('/^[a-zA-Z0-9]{6,50}$/', $password);
    }
    /*
     * Email Validate
     */
    public static function validateEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
<?php
namespace lib\Utils;

use lib\Utils\Config;
use lib\Utils\ImageManipulator;

class Utils
{

    public static function explodeSlash($string, $split = '/', $tolowerCase = true){

        $u = trim($string);
        if($tolowerCase)
            $u = strtolower($u);
        $u = rtrim($u, $split);

        $urls = explode($split, $u);
        $cleaned = array();
        foreach ($urls as $u){
            if($u=="") continue;
            $cleaned[] = $tolowerCase?ucfirst($u):$u;
        }
        return $cleaned;

    }


    /*
     * get _POST Value
     */
    public static function _Post($key = null){
        if($key)
            return isset($_POST[$key])?trim($_POST[$key]):null;
        else
            return isset($_POST)?$_POST:null;
    }
    /*
     * get _File Value
     */
    public static function _File($key = null){
        if ($key)
            return isset($_FILES[$key]) ? $_FILES[$key] : null;
        else
            return isset($_FILES) ? $_FILES : null;
    }

    /*
     * get _GET Value
     */
    public static function _Get($key = null){
        if ($key)
            return isset($_GET[$key])?$_GET[$key]:null;
        else
            return isset($_GET)?$_GET:null;
    }

    /*
     * get json body as array
     */
    public static function _JsonBody(){
        return @json_decode(file_get_contents('php://input'), true);
    }


    public static function uploadAvatar($avatar, $userID){
        if ($avatar['error'] > 0) {
            return false;
        } else {    // array of valid extensions
            $validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
            // get extension of the uploaded file
            $fileExtension = strrchr($avatar['name'], ".");
            // check if file Extension is on the list of allowed ones
            if (in_array($fileExtension, $validExtensions)) {
                $newNamePrefix = time() . '_';
                $im = new ImageManipulator($avatar['tmp_name']);
                $width = $im->getWidth();
                $height = $im->getHeight();
                $centreX = round($width / 2);
                $centreY = round($height / 2);
                if($height>$width){
                    $x1 = $centreX - round($width / 2);
                    $y1 = $centreY - round($width / 2);
                    $x2 = $centreX + round($width / 2);
                    $y2 = $centreY + round($width / 2);
                } else {
                    $x1 = $centreX - round($height / 2);
                    $y1 = $centreY - round($height / 2);
                    $x2 = $centreX + round($height / 2);
                    $y2 = $centreY + round($height / 2);
                }
                $im->crop($x1, $y1, $x2, $y2);
                $im->resample(200, 200);
                // saving file to uploads folder
                $im->save('public/img/' . $userID . '.jpg');
                return true;
            } else {
                return false;
            }
        }
    }


    public static function uploadFile($file, $name){
        if ($file['error'] > 0) {
            return false;
        } else {
            $validExtensions = Config::get('site.allowed_files');
            // get extension of the uploaded file
            $fileExtension = strrchr($file['name'], ".");
            // check if file Extension is on the list of allowed ones
            if (in_array($fileExtension, $validExtensions)){
                move_uploaded_file($file['tmp_name'], 'public/files/'.$name.$fileExtension);
                return true;
            } else {
                return false;
            }
        }
    }

    public static function dd($data){
        echo "<pre dir='ltr'>";
        var_dump($data);
        echo "</pre>";
//        exit;
    }

    public static function error($data){
        echo "<pre dir='ltr'>";
        echo $data;
        echo "</pre>";
//        exit;
    }



    public static function getRequestHeaders() {
        $headers = array();
        foreach($_SERVER as $key => $value) {
            if (substr($key, 0, 5) <> 'HTTP_') {
                continue;
            }
            $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
            $headers[$header] = $value;
        }
        return $headers;
    }



    public static function crypto_rand_secure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }

    public static function getToken($length)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[self::crypto_rand_secure(0, $max-1)];
        }

        return $token;
    }

    public static function randomNumber($length) {
        $result = '';

        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }

        return $result;
    }

}
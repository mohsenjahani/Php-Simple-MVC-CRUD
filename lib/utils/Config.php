<?php
namespace lib\Utils;

use lib\Utils\Utils;

class Config
{
    /*
     * ex parameter: filename/index
     */
    public static function get($filename_index, $path = 'config/'){
        $exp = Utils::explodeSlash($filename_index, ".", false);
        if(sizeof($exp)==2){
            $filename = $exp[0];
            $key = $exp[1];
            $file_path = $path.$filename.'.php';
            if(file_exists($file_path)) {
                $conf_array = include $file_path;
                if(array_key_exists($key, $conf_array)){
                    return $conf_array[$key];
                }else return null;
            }
        }else return null;
    }
    /*
     * ex parameter: filename/index
     */
    public static function getFileArray($filename, $path = 'config/'){
        $file_path = $path.$filename.'.php';
        if(file_exists($file_path)) {
            return include $file_path;
        }
    }
}
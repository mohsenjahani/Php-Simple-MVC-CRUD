<?php
namespace lib\Utils\Text;


use lib\Utils\Config;

class Text
{
    /*
     * ex parameter: filename/index
     */
    public static function get($filename_index) {
        return Config::get($filename_index,  'config/texts/');
    }

}
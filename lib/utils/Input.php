<?php

namespace lib\utils;

use lib\Session\Session;
use lib\Utils\Utils\Utils;

/**
 * Created by PhpStorm.
 * User: Mohsen Jahani
 * Date: 11/7/2017
 * Time: 5:21 PM
 */

class Input
{
    const param = 'input';

    public static function set($d = null, $time = 3){
        Session::init();

        $data = array(
            'time' => $time
        );


        if($d)
            $data['data'] = $d;
        else
            $data['data'] = Utils::_Post();


//        dd('Input::set()');
//        dd($data);

        Session::set(self::param, $data);
    }

    public static function get($index = null){
        Session::init();
        $input = Session::get(self::param);
        $data = $input['data'];
//        Session::delete(self::param);
        if($input)
            if($index){
                return array_key_exists($index, $data) ? $data[$index] : '';
            } else
                return $input;

            return null;

    }


    public static function destroy(){
//        dd('wtf');
        Session::init();
        $input = Session::get(self::param);
        $data = $input['data'];
//        dd($input);
        if($input){
            if($input['time']<=0)
                Session::delete(self::param);
            else {
                $input['time'] -= 1;
                self::set($data, $input['time'] - 1);
            }
        }
    }
}
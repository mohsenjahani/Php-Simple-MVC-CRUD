<?php

use lib\Utils\Utils;

/**
 * Created by PhpStorm.
 * User: Mohsen Jahani
 * Date: 10/28/2017
 * Time: 4:04 PM
 */

function error($data){
    Utils::error($data);
}
function dd($data){
    Utils::dd($data);
}
function ddE($data){
    Utils::dd($data);
    exit;
}
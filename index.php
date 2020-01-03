<?php
/**
 * Created by PhpStorm.
 * User: Mohsen Jahani
 * Date: 10/19/2017
 * Time: 4:56 PM
 */

$folders = array('lib/interfaces', 'lib/base', 'lib/utils', 'classes', 'models');

foreach ($folders as $folder){
    foreach (glob($folder."/*.php") as $filename)
    {
        require $filename;
    }
}


$boot = new Boot();
<?php

/**
 * Created by PhpStorm.
 * User: Mohsen Jahani
 * Date: 10/19/2017
 * Time: 5:04 PM
 */

use lib\Utils\Utils;

class Boot
{

    /**
     * Boot constructor.
     */
    public function __construct()
    {

        $url = Utils::_Get('url');
        $urls = Utils::explodeSlash($url);

        $main_controller = null;

        $controller_file = 'controller/Main.php';
        if(file_exists($controller_file)){
            require $controller_file;
            $main_controller = new Main();
        }

        if($main_controller) {
            if (!$url) {
                $main_controller->index();
                return;
            }else if ($main_controller && method_exists($main_controller, $urls[0])) {
                if(sizeof($urls)==1)
                    $main_controller->$urls[0]();
                elseif(sizeof($urls)==2)
                    $main_controller->$urls[0]($urls[1]);
                return;
            }
        } else {
            echo "Main Controller Not Found!";
            return;
        }

        if(sizeof($urls)>1){
            if($this->controllerExist($urls[0].'/'.$urls[1])) {
                $this->loadSubConroller($urls);
                return;
            }
        }

        $controller_file = 'controller/'.$urls[0].'.php';

        if(file_exists($controller_file)){
            require $controller_file;

            $controller = new $urls[0]();


            if(sizeof($urls)==1){
                if(method_exists($controller, "index"))
                    $controller->Index();
            }else{
                if(sizeof($urls)==2){
                    if (method_exists($controller, $urls[1])){
                        $m = $urls[1];
                        $controller->$m();
                    } else if ($main_controller && method_exists($main_controller, $urls[0])) {
                        $m = $urls[0];
                        $main_controller->$m($urls[1]);
                        return;
                    }else if (method_exists($controller, "index")){
                        $controller->Index($urls[1]);
                    }
                }else{
                    if (method_exists($controller, $urls[1])) {
                        $m = $urls[1];
                        $controller->$m($urls[2]);
                    }
                }

            }
            return;
        }

        echo "404 - Not Found!";
//        dd($url);
    }


    function loadSubConroller($urls){
        if (sizeof($urls)>1){
            $this->includeController($urls[0].'/'.$urls[1]);
            $c = new $urls[1](true);

            if(sizeof($urls)==2){
                $c->index();
            }else if(sizeof($urls)==3){
                $c->$urls[2]();
            }else{
                $c->$urls[2]($urls[3]);
            }

        }
    }


    function includeController($name){
//        if($this->controllerExist($name))
        require 'controller/'.$name.'.php';
    }

    function controllerExist($name){
        $path =  'controller/'.$name.'.php';
        return file_exists($path);
    }
}
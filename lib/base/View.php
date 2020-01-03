<?php

use lib\Utils\Alert;
use lib\Utils\Config;
use lib\utils\Input;
use lib\Utils\Utils;

/**
 * Created by PhpStorm.
 * User: Mohsen Jahani
 * Date: 10/25/2017
 * Time: 11:21 AM
 */

class View
{

    /**
     * View constructor.
     */
    public function __construct()
    {
        // Estefade az Tanzimate View Dar View mesle url site ya title site
        $this->site = Config::getFileArray('site');
        $this->url = Utils::explodeSlash(Utils::_Get('url'));
    }


    public function render($views, $title = false, $description = false, $keywords = false, $noInclude = false){

        $this->title = self::pageTitle($title);
        $this->description = $description;
        $this->keywords = $keywords;


        if($noInclude){
            $this->includeViews($views);
        }else{
            require 'views/layout/header.php';
            $this->includeViews($views);
            require 'views/layout/footer.php';
        }

        return true;
    }


    function includeViews($views){

        if(!is_array($views)) {
            $view_path = 'views/'.$views.'.php';
            require $view_path;
        } else
            foreach ($views as $view){

                $view_path = 'views/'.$view.'.php';

                if(!file_exists($view_path)){
                    error('View Not Found: "'.$view .'".');
                    continue;
                }

                require $view_path;

            }
    }


    public function with($array_data){
        foreach ($array_data as $k => $v){
            $this->$k = $v;
        }
    }

    private function pageTitle($title){
        if (!empty($title))
            return $title;
        else
            return Config::get('site.site_title');
    }


    public function alertView(){
        $alert = Alert::get();

        if($alert){
            $this->alert = $alert;
            require 'views/layout/alert.php';
        }

    }


    public function paginationView($currentPage, $lastPage, $url, $search = false){
            $this->pagination['current'] = $currentPage;
            $this->pagination['last'] = $lastPage;
            $this->pagination['url'] = $url;
            $this->pagination['search'] = $search;
            require 'views/layout/pagination.php';

    }

    public function __destruct()
    {
        Input::destroy();
    }
}
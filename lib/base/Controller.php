<?php

use classes\Urls\Urls;
use lib\Session\Session;
use lib\Utils\Alert;
use lib\Utils\Config;
use lib\utils\Input;
use lib\Utils\Utils;

/**
 * Created by PhpStorm.
 * User: Mohsen Jahani
 * Date: 10/19/2017
 * Time: 5:11 PM
 * @property View view
 */

class Controller
{

    protected $model;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        Session::init();
        $this->view = new View();
    }

    protected function view($name, $title = false, $description = false, $keywords = false, $noInclude = false){
        return $this->view->render($name, $title, $description, $keywords, $noInclude);
    }

    /*
     * Ersale Data be view wa estefade az aan dar view
     */
    protected function viewWith($data_array){
        $this->view->with($data_array);
    }


//
//    protected function usersPage(){
//        if(!Session::getBool('logged')){
//            Direct::toLoginPage();
//        }
//    }
//
//
//    protected function guestPage(){
//        if(Session::getBool('logged')){
//            Direct::toDashboardPage();
//        }
//    }


    public function loadModel($name){
        $file_path = 'models/'.$name.'_Model.php';

        if (file_exists($file_path)){
            require $file_path;

            $model_name = $name.'_Model';
            $this->model = new $model_name();

        }
        else
            $this->model = null;
    }
//
//    function loadUserData(){
//
//        $user = $this->model->getCurentUser();
//
//        $user['avatar'] = Urls::getUserAvatarUrl($user['id']);
//
//        $this->user = $user;
//        $this->viewWith(array(
//            'user' => $user
//        ));
//
//    }

//    function logout(){
//        Session::delete('logged');
//        Session::delete('username');
//        Direct::toLoginPage();
//    }

    function index()
    {
        echo "Index function not defined!";
    }




}
<?php

/**
 * Created by PhpStorm.
 * User: Mohsen Jahani
 */

class Main extends Controller
{


    function index()
    {
        return $this->view('main/index');
    }

}
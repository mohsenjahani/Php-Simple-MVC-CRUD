<?php

use lib\Utils\Response\Response;
use lib\Utils\Utils;


/**
 * Created by PhpStorm.
 * User: Mohsen Jahani
 * Date: 10/25/2017
 * Time: 11:13 AM
 */

class BaseApiUserService extends BaseApi
{
    const token_perfix = 'Bearer ';

    protected $json_body = array(), $user;

    public function __construct($model = true)
    {
        parent::__construct($model); 

        if(array_key_exists('Authorization', $this->headers))
            $token = substr($this->headers['Authorization'], strlen(self::token_perfix));
        else $token = "";
        //unauthorized

        $md5Token = md5($token);

        $user = $this->model->getUserByToken($md5Token);

//        dd(__METHOD__);

        if(!$user){
            Response::errorResponse('Not Authorized..', false, 'unauthorized');
            exit;
        }else{
            $this->user = $user;
        }
    }
 


}
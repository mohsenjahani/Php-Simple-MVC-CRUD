<?php

use lib\Utils\Response\Response;
use lib\Utils\Utils;


/**
 * Created by PhpStorm.
 * User: Mohsen Jahani
 * Date: 10/25/2017
 * Time: 11:13 AM
 */

class BaseApi extends Controller
{ 

    protected $json_body = array();

    public function __construct($model = true)
    {
        parent::__construct($model);

        // client json body
        $this->json_body = Utils::_JsonBody();
        $this->headers = apache_request_headers();
 
    }


    /*
     * Gereftane object az jsonbody ersal shode az samte client
     */
    protected function getJsonBodyObj($key){
        return @array_key_exists($key, $this->json_body) ? $this->json_body[$key] : false;
    }

 
}
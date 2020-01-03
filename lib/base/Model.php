<?php

use lib\Session\Session;
use lib\Utils\Alert;
use lib\Utils\Config;
use lib\utils\Input;
use lib\Utils\Validate\Validate;

/**
 * Created by PhpStorm.
 * User: Mohsen Jahani
 * Date: 10/25/2017
 * Time: 12:01 PM
 * @property Database db
 */

class Model
{

    /**
     * singleton
     * @return Model
     */
    protected static function Instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new Model();
        }
        return $inst;
    }

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = Database::Instance();
    }


    protected function getData($query, $input_parameters = null ){
        $q = $this->db->prepare($query);

        if($input_parameters){
            if(is_array($input_parameters)){

                foreach ($input_parameters as $k => $v){
                    if(is_numeric($v))
                        $q->bindValue($k, $v, PDO::PARAM_INT);
                    else {
                        $q->bindValue($k, $v, PDO::PARAM_STR);
                    }
                }
            }
        }

        $q->execute();
        return $q->fetchAll();
    }

    protected function getFirst($query, $input_parameters = null ){
        $data = $this->getData($query, $input_parameters);
        if($data)
            return $data[0];
        return null;
    }


    protected function execute($query, $input_parameters = null){
        $q = $this->db->prepare($query);

        if($input_parameters){
            if(is_array($input_parameters)){

                foreach ($input_parameters as $k => $v){
                    if(is_numeric($v))
                        $q->bindValue($k, $v, PDO::PARAM_INT);
                    else {
                        $q->bindValue($k, $v, PDO::PARAM_STR);
                    }
                }
            }
        }

        $q->execute();
        return $this->db->lastInsertId();
    }


}
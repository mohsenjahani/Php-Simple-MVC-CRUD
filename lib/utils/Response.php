<?php
namespace lib\Utils\Response;

class Response
{

    public static function successResponse($data, $message = null, $code = null){
        return self::responseJson(true, $message, $data, $code, 200);
    }


    public static function errorResponse($message, $data = false, $code = null){
       return self::responseJson(false, $message, $data, $code, 400);
    }

    public static function errorValidResponse($message){
       return self::responseJson(false, $message, false, "NOT-VALID", 400);
    }

    private static function responseJson($status, $message = null, $data = false, $code = null, $http_code = 200){

        header('Content-Type: application/json');

        http_response_code($http_code);

        $arr = array(
            'ok' => $status,
        );
        if($code) $arr['code'] = $code;
        if($message) $arr['msg'] = $message;
        if($data !== false) $arr['data'] = $data;

        echo json_encode($arr);

        return true;
    }
}
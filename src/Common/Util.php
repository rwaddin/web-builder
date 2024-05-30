<?php
namespace Rumahweb\Common;

class Util{

    // public static function cURL(){

    // }

    public static function response(string $message, int $code = 400, $data = []){
        $result = [
            "code" => $code,
            "message" => $message
        ];
        if($data){
            $result["data"] = (array) $data;
        }
        return $result;
    }
}
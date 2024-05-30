<?php
namespace Rumahweb\Common;

class Util{

    // public static function cURL(){

    // }

    public static function response(string $message, int $code = 400, array $data = []){
        $result = [
            "code" => $code,
            "message" => $message
        ];
        if($data){
            $result["data"] = $data;
        }
        return $result;
    }
}
<?php

namespace Rumahweb\Common;
// require_once "Util.php";

use Rumahweb\Common\Util;

class Recaptcha{

    public static string $secretKey = "";

    public static function verify(string $tokenResponse){
        try {
           if(empty(self::$secretKey)){
            throw new \Exception("Missing secret key");
           }

           $verifyResult = self::cURL($tokenResponse);
           if(!$verifyResult->success){
            $error = "error-codes";
            throw new \Exception($verifyResult->$error[0]);
           }
   
           return Util::response("Success", 200, $verifyResult);
        } catch (\Exception $e) {
           return Util::response($e->getMessage());
        }
    }

    private static function cURL(string $token){
        $params = [
            "secret" => self::$secretKey,
            "response" => $token,
            "remoteip" => $_SERVER["REMOTE_ADDR"]
        ];
    
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new \Exception('Error:' . curl_error($ch));
        }
        curl_close($ch);
    
        return json_decode($result);
    }
}
<?php

namespace Rumahweb\Common;

class Clientzone {

    public static string $URL = "";
    public static string $KEY = "";

    public static function Register(array $params){
        try {
            $regResult = self::cURL("POST", $params);
            if((isset($regResult->status) && $regResult->status != "success") || isset($regResult->code) && $regResult->code != 200){
                throw new \Exception($regResult->message);
            }
            return Util::response("Success",200);
        } catch (\Exception $e) {
            return Util::response($e->getMessage());
        }
    }

    public static function AddTrial(string $email){
        try {
            $addTrialResult = self::cURL("POST",[
                "email" => $email
            ]);
            if($addTrialResult->status != "success"){
                throw new \Exception($addTrialResult->message);
            }
            return Util::response("Success",200, ["url"=>$addTrialResult->data->url]);
        } catch (\Exception $e) {
            return Util::response($e->getMessage());
        }
    }

    public static function SignIn($params){
        try {
            $signInResult = self::cURL("POST", $params);
            if($signInResult->status != "success"){
                throw new \Exception($signInResult->message);
            }
            return Util::response("success",200, ["userid" => $signInResult->data->userid]);
        } catch (\Exception $e) {
            return Util::response($e->getMessage());
        }
    }

    public static function Client(){
        try {
            $clientResult = self::cURL("GET");
            if($clientResult->status != "success"){
                throw new \Exception($clientResult->message);
            }
            return Util::response("Success",200, $clientResult->data);
        } catch (\Exception $e) {
            return Util::response($e->getMessage());
        }
    }

    private static function cURL(string $method = "GET", $params = []){
        if(empty(self::$URL)){
            throw new \Exception("Missing URL");
        }
        if(empty(self::$KEY)){
            throw new \Exception("Missing KEY");
        }

        $method = strtoupper($method);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, self::$URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        if(in_array($method,["POST"])){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }

        $headers = array();
        $headers[] = 'Authorization: '.self::$KEY;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (curl_errno($ch)) {
            throw new \Exception( "Error : {$httpcode}" . curl_error($ch));
        }
        curl_close($ch);

        // print_r([$params, $method, self::$KEY, self::$URL, $result]);
        if ($httpcode >= 500){
            throw new \Exception("Error code ".$httpcode);
        }

        return json_decode($result);
    }
}
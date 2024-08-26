<?php
namespace Rumahweb;

use Rumahweb\Common\Recaptcha;
use Rumahweb\Common\Clientzone;

class App{

    public string $RECAPTCHA_KEY = "";
    public string $CZ_URL = "";
    public string $CZ_TOKEN = "";

    public function reCaptchaVerify(string $tokenResponse){
        Recaptcha::$secretKey = $this->RECAPTCHA_KEY;
        return Recaptcha::verify($tokenResponse);
    }

    public function register(array $params){
        Clientzone::$URL = $this->CZ_URL;
        Clientzone::$KEY = $this->CZ_TOKEN;
        return Clientzone::Register($params);
    }

    public function client(){
        Clientzone::$URL = $this->CZ_URL;
        Clientzone::$KEY = $this->CZ_TOKEN;
        return Clientzone::Client();
    }

    public function signin($param){
        Clientzone::$URL = $this->CZ_URL;
        Clientzone::$KEY = $this->CZ_TOKEN;
        return Clientzone::SignIn($param);
    }

    public function addTrial(array $params){
        Clientzone::$URL = $this->CZ_URL;
        Clientzone::$KEY = $this->CZ_TOKEN;
        return Clientzone::AddTrial($params);
    }
}
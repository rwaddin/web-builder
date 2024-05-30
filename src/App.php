<?php
namespace Rumahweb;

use Rumahweb\Common\Recaptcha;

class App{

    public string $RECAPTCHA_KEY = "";
    public string $CZ_URL = "";
    public string $CZ_TOKEN = "";

    public function reCaptchaVerify(string $tokenResponse){
        Recaptcha::$secretKey = $this->RECAPTCHA_KEY;
        return Recaptcha::verify($tokenResponse);
    }
}
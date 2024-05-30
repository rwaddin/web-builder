<?php
namespace Rumahweb;

// require_once "Common/Recaptcha.php";

use Rumahweb\Common\Recaptcha;

class App{

    public string $RECAPTCHA_KEY = "";
    public string $CZ_URL = "";
    public string $CZ_TOKEN = "";
    
    public function tes(){
        Recaptcha::$secretKey = $this->RECAPTCHA_KEY;
        $x = Recaptcha::verify("tokenkak");
        return $x;
    }


}
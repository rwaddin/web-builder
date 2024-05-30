<pre>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// require_once "src/App.php";
require_once "vendor/autoload.php";

$x = new Rumahweb\App();

$x->RECAPTCHA_KEY = "key1";
print_r($x->tes()) ;
<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

define('DB_HOST', $_ENV['DB_HOST']);
define('DB_USERNAME', $_ENV['DB_USERNAME']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
define('DB_DATABASE', $_ENV['DB_DATABASE']);

// var_dump($_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);


// Add this line to verify the config is loaded
define('CONFIG_LOADED', true);

function autoload($class){
    $cDir = ['Entity'];
    $iDir = null;


    foreach($cDir as $dirName):

    if(!$iDir && file_exists(__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $class . ".class.php")):

    include_once(__DIR__ .  DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $class . ".class.php");
    $iDir= true;

    endif;

    endforeach;
}



spl_autoload_register('autoload');

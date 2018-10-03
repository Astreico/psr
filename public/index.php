<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Component\Http\Request;


chdir(dirname(__DIR__));

require './vendor/autoload.php';

$request = Request::createFromGlobals($_GET, $_POST);

//var_dump($request->getQuery());
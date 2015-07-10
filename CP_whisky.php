<?php
session_start();
ob_start(); 

error_reporting(E_ALL);
ini_set("display_errors", 1);


use src\ProjectWhisky\business\WhiskyBusiness;
use src\ProjectWhisky\business\BarrelBusiness;
use src\ProjectWhisky\business\DistilleryBusiness;
use Doctrine\Common\ClassLoader;

require_once("rolestarter.php");
require_once('Doctrine/Common/ClassLoader.php');
$classLoader = new ClassLoader("src");
$classLoader->register();

require_once("lib/Twig/Autoloader.php");
Twig_Autoloader::register();

$whiskyBiz = new WhiskyBusiness;
//$whiskyList = $whiskyBiz->getWhisky();

$loader = new Twig_Loader_Filesystem("src/ProjectWhisky/presentation");
$twig = new Twig_Environment($loader);

$view = $twig->render("CP_whisky.twig", array("user" => $_SESSION['user'], "whiskies"=>$whiskyBiz->getWhiskyList()));

print($view);




ob_flush();
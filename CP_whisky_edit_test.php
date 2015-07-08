<?php
ob_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

use src\ProjectWhisky\business\WhiskyBusiness;
use src\ProjectWhisky\business\BarrelBusiness;
use src\ProjectWhisky\business\DistilleryBusiness;
use Doctrine\Common\ClassLoader;


require_once('Doctrine/Common/ClassLoader.php');
$classLoader = new ClassLoader("src");
$classLoader->register();

require_once("lib/Twig/Autoloader.php");
Twig_Autoloader::register();
$whisky_id = isset($_GET["id"])? $_GET["id"]:0;
$whisky

    
$whiskyBiz = new WhiskyBusiness();
$addWhisky = $whiskyBiz->($_GET["id"]);


$loader = new Twig_Loader_Filesystem("src/ProjectWhisky/presentation");
$twig = new Twig_Environment($loader);

$view = $twig->render("whisky_edit.twig", array("user" => $_SESSION['user'], "whiskies"=>$whiskyList));

print($view);




ob_flush();


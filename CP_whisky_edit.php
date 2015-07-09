<?php
ob_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

use src\ProjectWhisky\business\WhiskyBusiness;
use src\ProjectWhisky\business\BarrelBusiness;
use src\ProjectWhisky\business\DistilleryBusiness;
use src\ProjectWhisky\business\UserBusiness;
use Doctrine\Common\ClassLoader;


require_once('Doctrine/Common/ClassLoader.php');
$classLoader = new ClassLoader("src");
$classLoader->register();

require_once("lib/Twig/Autoloader.php");
Twig_Autoloader::register();

// Get Whisky ID
$id = isset($_GET["id"])? $_GET["id"]: print("GEEN ID OPGEGEVEN!");
// Get Whisky Data
$whiskyBiz = new WhiskyBusiness();
$whisky_data = $whiskyBiz->getWhisky($id);
$loader = new Twig_Loader_Filesystem("src/ProjectWhisky/presentation");
$twig = new Twig_Environment($loader);

$view = $twig->render("CP_whisky_edit.twig", array("whisky" => $whisky_data));

print($view);




ob_flush();


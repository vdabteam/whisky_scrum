<?php

use src\ProjectWhisky\business\WhiskyBusiness;
use src\ProjectWhisky\business\CommentBusiness;
use Doctrine\Common\ClassLoader;



/**
 * Connecting doctrine autoloader
 */
require_once('Doctrine/Common/ClassLoader.php');
$classLoader = new ClassLoader("src");
$classLoader->register();

require_once("lib/Twig/Autoloader.php"); 
Twig_Autoloader::register(); 

$whiskyBiz = new WhiskyBusiness();
$whisky = $whiskyBiz->getWhisky($_GET["id"]);

$commentBiz = new CommentBusiness();

$loader = new Twig_Loader_Filesystem("src/ProjectWhisky/presentation"); 
$twig = new Twig_Environment($loader); 
$view = $twig->render("whisky_page.twig", array( "whisky" => $whisky, "comments" => $commentBiz->showComments($_GET["id"])));

print($view); 
<?php

//MOET HIER NOG ZOIETS SESSIONIG BIJ?


use src\ProjectWhisky\business\WhiskyBusiness;
use Doctrine\Common\ClassLoader;

/**
 * Connecting doctrine autoloader
 */
require_once'Doctrine/Common/ClassLoader.php';
$classLoader = new ClassLoader("src");
$classLoader->register();

require_once("lib/Twig/Autoloader.php"); 
Twig_Autoloader::register(); 

$whiskyList = WhiskyBusiness::getWhiskyList();


$loader = new Twig_Loader_Filesystem("src/ProjectWhisky/presentation"); 
$twig = new Twig_Environment($loader); 
$view = $twig->render("home.twig", array( "whiskies" => $whiskyList)); 
                         
print($view); 

<?php
ob_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

use src\ProjectWhisky\business\WhiskyBusiness;
use Doctrine\Common\ClassLoader;




$loader = new Twig_Loader_Filesystem("src/ProjectWhisky/presentation");
$twig = new Twig_Environment($loader);

    $view = $twig->render("test.twig", array("user" => $_SESSION['user']));




ob_flush();


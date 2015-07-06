<?php
ob_start();

session_start();

use src\ProjectWhisky\business\WhiskyBusiness;
use src\ProjectWhisky\business\CommentBusiness;
use src\ProjectWhisky\business\BarrelBusiness;
use Doctrine\Common\ClassLoader;



if ((isset($_GET['id'])) && (is_int((int)$_GET['id'])))
{
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
    
    $BarrelBiz = new BarrelBusiness();
    $barrel = $BarrelBiz ->showBarrel($_GET["id"]);

    $commentBiz = new CommentBusiness();


    $loader = new Twig_Loader_Filesystem("src/ProjectWhisky/presentation");
    $twig = new Twig_Environment($loader);
    $view = $twig->render("whisky_page.twig", array("user" => $_SESSION['user'], "whisky" => $whisky, "comments" => $commentBiz->showComments($_GET["id"]), "barrel" => $barrel['type']));

    print($view);

}
else
{
    header("Location: index.php");
}


print_r($barrel['type']);
ob_flush();


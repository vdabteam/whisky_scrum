<?php
ob_start();

session_start();

use src\ProjectWhisky\business\WhiskyBusiness;
use src\ProjectWhisky\business\CommentBusiness;
use src\ProjectWhisky\business\BarrelBusiness;
use src\ProjectWhisky\business\UserBusiness;
use src\ProjectWhisky\business\DistilleryBusiness;
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
    
    $barrelBiz = new BarrelBusiness();
    $barrel = $barrelBiz ->showBarrel($_GET["id"]);
    
    $distilleryBiz = new DistilleryBusiness();
    $distillery = $distilleryBiz ->getByWhisky($_GET["id"]);

    $commentBiz = new CommentBusiness();
    
    $userBiz = new UserBusiness();
   //$user = $userBiz->getUserByComment($commentId);
    
    
    
    


    $loader = new Twig_Loader_Filesystem("src/ProjectWhisky/presentation");
    $twig = new Twig_Environment($loader);
    $view = $twig->render("whisky_page.twig", array("user" => $_SESSION['user'], "whisky" => $whisky, "comments" => $commentBiz->showComments($_GET["id"]), "barrel" => $barrel['type'], "region" => $distillery['region'] ));

    print($view);

}
else
{
    header("Location: index.php");
}


if (isset($_POST['sendMsgBtn'])) {
	echo "<pre>";
    print_r($_POST);
    echo "</pre>";
}

echo "<pre>";


foreach ($commentBiz->showComments($_GET["id"]) as $key => $comment) {
	print_r($comment->getId());
}
    
    echo "</pre>";



ob_flush();


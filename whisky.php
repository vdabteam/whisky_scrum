<?php
ob_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

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

    /**
     * Put comments data with user info into an array $participatedUsers
     */
    foreach ($commentBiz->showComments($_GET["id"]) as $key => $comment)
    {
        $usersDataFromComments = $userBiz->getUserByComment($comment->getId());
        $participatedUsers[$key]['commentId'] = $usersDataFromComments->getId();
        $participatedUsers[$key]['username'] = $usersDataFromComments->getUsername();
        $participatedUsers[$key]['imagePath'] = $usersDataFromComments->getImagePath();
        $participatedUsers[$key]['comment'] = $comment->getComment();
        $participatedUsers[$key]['commentTime'] = $comment->getCommentTime();
        $participatedUsers[$key]['commentDate'] = $comment->getCommentDate();

    }


    $loader = new Twig_Loader_Filesystem("src/ProjectWhisky/presentation");
    $twig = new Twig_Environment($loader);

    $view = $twig->render("whisky_page.twig", array("user" => $_SESSION['user'], "whisky" => $whisky, "participatedUsers" => $participatedUsers, "barrel" => $barrel['type'], "region" => $distillery['region']));


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





ob_flush();


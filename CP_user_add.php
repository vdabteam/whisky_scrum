<?php
session_start();
ob_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

use src\ProjectWhisky\business\UserBusiness;
use src\ProjectWhisky\business\ProfileBusiness;
use Doctrine\Common\ClassLoader;

require_once("rolestarter.php");
require_once('Doctrine/Common/ClassLoader.php');
$classLoader = new ClassLoader("src");
$classLoader->register();

require_once("lib/Twig/Autoloader.php");
Twig_Autoloader::register();

// check form submit
if(isset($_POST["userUsername"]))
{
    //form POST data
    $userId = $_GET["id"];
    $username = $_POST['userUsername'];
    $password = $_POST['userPassword'];
    $email = $_POST['userEmail'];
    $firstname = $_POST['userFirstName'];
    $lastname = $_POST['userLastName'];
    $admin = "0";
    $blocked = "0";
    $imagePath = "default.jpg";
    
    $userBiz = new UserBusiness();
    $userBiz->addBarrel($type);
    header("location:cp_user.php");
}    



$loader = new Twig_Loader_Filesystem("src/ProjectWhisky/presentation");
$twig = new Twig_Environment($loader);

$view = $twig->render("CP_user_add.twig", array("user" => $_SESSION['user']));

print($view);

ob_flush();
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




//GET userdata by id
$userBiz = new UserBusiness;
$userdata = $userBiz->getUserbyId($_GET["id"]);

if (isset($_POST['userUsername']))
{
    //form POST data
    $userId = $_GET["id"];
    $username = $_POST['userUsername'];
    $password = $_POST['userPassword'];
    $email = $_POST['userEmail'];
    $firstname = $_POST['userFirstName'];
    $lastname = $_POST['userLastName'];
    $admin = "1";
    $blocked = "0";
    $imagePath = "test.jpg";
    
    
    $userBiz->updateUserById($userId, $username, $password, $email, $firstname, $lastname, $admin, $blocked);
    
}










$loader = new Twig_Loader_Filesystem("src/ProjectWhisky/presentation");
$twig = new Twig_Environment($loader);

$view = $twig->render("CP_user_edit.twig", array("user" => $_SESSION['user'], "userdata" => $userdata ));

print($view);

ob_flush();
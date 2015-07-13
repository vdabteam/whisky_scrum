<?php
session_start();
ob_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

use src\ProjectWhisky\business\WhiskyBusiness;
use src\ProjectWhisky\business\BarrelBusiness;
use src\ProjectWhisky\business\DistilleryBusiness;
use src\ProjectWhisky\business\UserBusiness;
use Doctrine\Common\ClassLoader;

require_once("rolestarter.php");
require_once('Doctrine/Common/ClassLoader.php');
$classLoader = new ClassLoader("src");
$classLoader->register();

require_once("lib/Twig/Autoloader.php");
Twig_Autoloader::register();
$msg = "";


// Check GET variable
if(!empty($_GET))
{    // count nonempty items
    $isset = 0;
    for($i=0; $i<count($_GET); $i++)
    {
       $isset+=!empty($_GET[array_keys($_GET)[$i]]);
    }

    // Create variables, fill in for nonempty fields
            $name=!empty($_GET["whisky_name"]) ? $_GET["whisky_name"] : 0;
            $distillery=!empty($_GET["distillery_id"]) ? $_GET["distillery_id"] : 0;
            $price=!empty($_GET["whisky_price"]) ? $_GET["whisky_price"] : 0;
            $age=!empty($_GET["whisky_age"]) ? $_GET["whisky_age"] : 0;
            $strength=!empty($_GET["whisky_strength"]) ? $_GET["whisky_strength"] : 0;
            $barrel_id=!empty($_GET["barrel"]) ? $_GET["barrel"] : 0;
            $image_path=!empty($_GET["whisky_image"]) ? $_GET["whisky_image"] : 0;
            $hidden=!empty($_GET["hidden"]) ? $_GET["hidden"] : 0;
            $rating_aroma=!empty($_GET["rating_aroma"]) ? $_GET["rating_aroma"] : 0;
            $rating_color=!empty($_GET["rating_color"]) ? $_GET["rating_color"] : 0;
            $rating_taste=!empty($_GET["rating_taste"]) ? $_GET["rating_taste"] : 0;
            $rating_aftertaste=!empty($_GET["rating_aftertaste"]) ? $_GET["rating_aftertaste"] : 0;
            $text_aroma=!empty($_GET["text_aroma"]) ? $_GET["text_aroma"] : 0;
            $text_color=!empty($_GET["text_color"]) ? $_GET["text_color"] : 0;
            $text_taste=!empty($_GET["text_taste"]) ? $_GET["text_taste"] : 0;
            $text_aftertaste=!empty($_GET["text_aftertaste"]) ? $_GET["text_aftertaste"] : 0;
            $review=!empty($_GET["text_review"]) ? $_GET["text_review"] : 0;
            $user_id=$_SESSION["user"]["id"];

    // decide action by number of nonempty fields
    if($isset===17) // everything, including "hidden" checkbox checked
    {
        $whiskyBiz = new WhiskyBusiness();
        $addWhisky = $whiskyBiz->addWhisky($name, $distillery, $price, $age, $strength, $barrel_id, $image_path, $hidden, $rating_aroma, $rating_color, $rating_taste, $rating_aftertaste, $text_aroma, $text_color, $text_taste, $text_aftertaste, $review, $user_id);
        $msg = $addWhisky ? "Whisky add successful! Notice: whisky still hidden." : "";
        header("refresh: 2; url=CP_whisky.php");
        //exit;
    }
    elseif ($isset===16 && !isset($_GET["hidden"]))
    {
        $whiskyBiz = new WhiskyBusiness();
        $addWhisky = $whiskyBiz->addWhisky($name, $distillery, $price, $age, $strength, $barrel_id, $image_path, $hidden, $rating_aroma, $rating_color, $rating_taste, $rating_aftertaste, $text_aroma, $text_color, $text_taste, $text_aftertaste, $review, $user_id);
        $msg = $addWhisky ? "Whisky add successful!" : "";
        header("refresh: 2; url=CP_whisky.php");
        //exit;    
    }
    else // less than 16 -> always hidden
    {
        $whiskyBiz = new WhiskyBusiness();
        $addWhisky = $whiskyBiz->addWhisky($name, $distillery, $price, $age, $strength, $barrel_id, $image_path, 1, $rating_aroma, $rating_color, $rating_taste, $rating_aftertaste, $text_aroma, $text_color, $text_taste, $text_aftertaste, $review, $user_id);
        $msg = $addWhisky ? "Fields missing! Data saved, but stays hidden until complete." : "";
        header("refresh: 2; url=CP_whisky.php");
        //exit;
    }
}        
//////////////////////////////////////////////////////////////////
// Prepare to render TWIG
// Get Distillery Data
$distilleryBiz = new DistilleryBusiness();
$distillery_data = $distilleryBiz->getDistilleryList();
// Get Barrel Data
$barrelBiz = new BarrelBusiness();
$barrel_data = $barrelBiz->showAllBarrels();

$loader = new Twig_Loader_Filesystem("src/ProjectWhisky/presentation");
$twig = new Twig_Environment($loader);

$view = $twig->render("CP_whisky_add.twig", array("user" => $_SESSION['user'], "distilleries"=>$distillery_data, "barrels"=>$barrel_data, "msg"=>$msg ));

print($view);

ob_flush();

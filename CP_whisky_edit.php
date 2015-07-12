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

if(empty($_GET["id"])) // id missing -> send to CP_whisky
{
    header("location: CP_whisky.php");
}
// count nonempty items
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
            $image_path=!empty($_GET["whisky_image"]) ? $_GET["whisky_image"] : "default.jpg";
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
            $whisky_id=$_GET["id"];
            $msg = "";
            
// check if everything filled in
if($isset == 18 || ($isset==17 && !$hidden)) // all fields filled in (hidden either checked or unchecked
{
    // overwrite things in DB, send back to CP_whisky?
    $whiskyBiz = new WhiskyBusiness();
    $editWhisky = $whiskyBiz->editWhisky($name, $distillery, $price, $age, $strength, $barrel_id, $image_path, $hidden, $rating_aroma, $rating_color, $rating_taste, $rating_aftertaste, $text_aroma, $text_color, $text_taste, $text_aftertaste, $review, $whisky_id);
    $msg = $hidden ? "Changes saved, whisky hidden" : "Changes saved!";
     
            
}
elseif(($isset < 17 && $isset >1) || $hidden) // always when <17 fields, or <18 but hidden
{
    // write to DB, hidden,  give warning message
    $hidden = 1;
    $whiskyBiz = new WhiskyBusiness();
    $editWhisky = $whiskyBiz->editWhisky($name, $distillery, $price, $age, $strength, $barrel_id, $image_path, $hidden, $rating_aroma, $rating_color, $rating_taste, $rating_aftertaste, $text_aroma, $text_color, $text_taste, $text_aftertaste, $review, $whisky_id);
    $msg = "Fields missing! Changes saved, but  whisky is hidden.";
    
}            
    
     
    


// Get Whisky Data
$whiskyBiz = new WhiskyBusiness();
$whisky_data = $whiskyBiz->getWhisky($whisky_id);
// Get Distillery Data
$distilleryBiz = new DistilleryBusiness();
$distillery_data = $distilleryBiz->getDistilleryList();
// Get Barrel Data
$barrelBiz = new BarrelBusiness();
$barrel_data = $barrelBiz->showAllBarrels();



$loader = new Twig_Loader_Filesystem("src/ProjectWhisky/presentation");
$twig = new Twig_Environment($loader);

$view = $twig->render("CP_whisky_edit.twig", array("user" => $_SESSION['user'], "whisky" => $whisky_data, "distilleries" =>$distillery_data, "barrels" =>$barrel_data, "msg"=>$msg));

print($view);




ob_flush();


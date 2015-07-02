<?php
use src\ProjectWhisky\business\DistilleryBusiness;
use Doctrine\Common\ClassLoader;

/**
 * Connecting doctrine autoloader
 */
require_once'Doctrine/Common/ClassLoader.php';
$classLoader = new ClassLoader("src");
$classLoader->register();



$distilleryBiz = new DistilleryBusiness();

$distillery = $distilleryBiz->getDistillery($_GET["id"]);

print("<pre>");
print_r($distillery);
print("</pre>");
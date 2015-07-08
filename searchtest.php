<?php
use src\ProjectWhisky\business\WhiskyBusiness;
use Doctrine\Common\ClassLoader;

/**
 * Connecting doctrine autoloader
 */
require_once'Doctrine/Common/ClassLoader.php';
$classLoader = new ClassLoader("src");
$classLoader->register();



$whiskyBusiness = new WhiskyBusiness();

$list = $whiskyBusiness->getWhiskyBySearch($_GET["barrel_id"], $_GET["strength_min"], $_GET["strength_max"]);
print("<pre>");
print_r($list);
print("</pre>");
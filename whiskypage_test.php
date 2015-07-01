<?php
use src\ProjectWhisky\business\WhiskyBusiness;
use Doctrine\Common\ClassLoader;

/**
 * Connecting doctrine autoloader
 */
require_once'Doctrine/Common/ClassLoader.php';
$classLoader = new ClassLoader("src");
$classLoader->register();



$whiskyBiz = new WhiskyBusiness();

$whisky = $whiskyBiz->getWhisky($_GET["id"]);

print("<pre>");
print_r($whisky); 
print("</pre>");
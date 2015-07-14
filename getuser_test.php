<?php
use src\ProjectWhisky\business\UserBusiness;
use Doctrine\Common\ClassLoader;

/**
 * Connecting doctrine autoloader
 */
require_once'Doctrine/Common/ClassLoader.php';
$classLoader = new ClassLoader("src");
$classLoader->register();



$userBiz = new UserBusiness;
$user = $userBiz->getUserbyId($_GET["id"]);

print("<pre>");
print_r($user);
print("</pre>");
<?php
use src\ProjectWhisky\business\CommentBusiness;
use Doctrine\Common\ClassLoader;

/**
 * Connecting doctrine autoloader
 */
require_once'Doctrine/Common/ClassLoader.php';
$classLoader = new ClassLoader("src");
$classLoader->register();



$commentBusiness = new CommentBusiness();

$list = $commentBusiness->showComments($_GET["whisky_id"]);
print("<pre>");
print_r($list);
print("</pre>");
<?php

use src\ProjectWhisky\business\UserBusiness;
use src\ProjectWhisky\exceptions\UserDoesntExistException;
use Doctrine\Common\ClassLoader;


/**
 * Connecting doctrine autoloader
 */
require_once'Doctrine/Common/ClassLoader.php';
$classLoader = new ClassLoader("src");
$classLoader->register();



$obj = new UserBusiness();
echo "<pre>";
print_r($obj->getAllUsers());
echo "</pre>";


try
{
    $user = $obj->searchUserByEmail("admin@mail.com");
    echo "<pre>";
    print_r($user);
    echo "</pre>";

}
catch (UserDoesntExistException $e)
{
    echo "This user doesn't exist";
}
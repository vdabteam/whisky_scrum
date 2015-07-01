<?php

use src\ProjectWhisky\business\UserBusiness;
use src\ProjectWhisky\business\AuthorizationBusiness;
use src\ProjectWhisky\exceptions\UserDoesntExistException;
use src\ProjectWhisky\exceptions\LoginFailureException;
use src\ProjectWhisky\exceptions\PasswordFailureException;
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

$obj2 = new AuthorizationBusiness();


try
{
    $user = $obj2->authorize("admin@mail.com", "654321");
    echo "<pre>";
    print_r($user->getPassword());
    echo "</pre>";

}
catch (UserDoesntExistException $e) //todo: change exception to "DataFailureException()" with message "Wrong e-mail - password combination"
{
    echo "This user doesn't exist";
}
catch (LoginFailureException $e) //todo: change exception to "DataFailureException()" with message "Wrong e-mail - password combination"
{
    echo "Wrong login";
}
catch (PasswordFailureException $e) //todo: change exception to "DataFailureException()" with message "Wrong e-mail - password combination"
{
    echo "Wrong pass";
}
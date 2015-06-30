<?php


use src\ProjectWhisky\business\UserBusiness;
use src\ProjectWhisky\business\AuthorizationBusiness;
use src\ProjectWhisky\exceptions\WrongDataException;
use src\ProjectWhisky\exceptions\EmptyDataException;
use Doctrine\Common\ClassLoader;


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authorization</title>
</head>
<body>
<form action="authorization.php" method="post">
    <input type="text" placeholder="E-mail" name="emailField"/>
    <br>
    <input type="password" placeholder="Password" name="passField"/>
    <br>
    <input type="submit" value="Log in" name="loginBtn"/>
</form>

</body>
</html>


<?php


/**
 * Check entered e-mail and password when "log in" button has been pressed
 */
if(isset($_POST['loginBtn']))
{
    $email = $_POST['emailField'];
    $password = $_POST['passField'];

    /**
     * Connecting doctrine autoloader
     */
    require_once'Doctrine/Common/ClassLoader.php';
    $classLoader = new ClassLoader("src");
    $classLoader->register();

    try
    {
        /**
         * Throw error if email and password fields are empty
         */
        if (empty($email) || empty($password)) throw new EmptyDataException();


        $email = filter_var(trim($_POST['emailField']), FILTER_VALIDATE_EMAIL); // validate e-mail
        $password = trim(htmlspecialchars($_POST['passField'])); // validate pass

        /**
         * Throw error if email and password contain wrong characters
         */
        if(empty($email) && empty($password)) throw new WrongDataException();


        /**
         * Authorize user
         * Throw error if email-password combination is wrong (Exception comes from AuthorizationBusiness)
         */
        $authorization = new AuthorizationBusiness();
        $user = $authorization->authorize($email, $password);

        echo "Authorized";
        /**
         *
         *
         * PUT VARIABLE IN SESSION HERE
         *
         *
         *
         */

        echo "<pre>";
        print_r($user->getAdmin());
        echo "</pre>";




    }
    catch (EmptyDataException $e)
    {
        echo "E-mail and password fields can't be empty";
    }
    catch (WrongDataException $e)
    {
        echo "Wrong e-mail and password combination.";
    }

}







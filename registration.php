<?php

ob_start();

use src\ProjectWhisky\business\UserBusiness;
use src\ProjectWhisky\exceptions\WrongDataException;
use src\ProjectWhisky\exceptions\EmptyDataException;
use src\ProjectWhisky\exceptions\PasswordsDontMatchException;
use src\ProjectWhisky\exceptions\WrongEmailFormException;
use src\ProjectWhisky\exceptions\UsernameExistsException;
use src\ProjectWhisky\exceptions\EmailExistsException;

use Doctrine\Common\ClassLoader;






/**
 * Check entered e-mail and password when "log in" button has been pressed
 */
if(isset($_POST['firstname']))
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rpassword = $_POST['rpassword'];

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
        if (empty($firstname) || empty($lastname) || empty($email) || empty($username) || empty($password) || empty($rpassword)) throw new EmptyDataException();


        $firstname = trim(htmlspecialchars($firstname)); // validate firstname todo: use regex to exclude forbidden chars
        $lastname = trim(htmlspecialchars($lastname)); // validate lastname
        $email = filter_var(trim($email), FILTER_VALIDATE_EMAIL); // validate e-mail
        $username = trim(htmlspecialchars($username)); // validate username
        $password = trim(htmlspecialchars($password)); // validate pass
        $rpassword = trim(htmlspecialchars($rpassword)); // validate repeated pass

        /**
         * Check if e-mail pattern is correct
         */
        if(empty($email)) throw new WrongEmailFormException();

        /**
         * Check whether passwords are the same
         */
        if($password !== $rpassword) throw new PasswordsDontMatchException();


        $user = new UserBusiness();
        /**
         * Look if user with entered e-mail already exists
         */
        if(!empty($user->checkUserByEmail($email))) throw new EmailExistsException();
        /**
         * Look if user with entered username already exists
         */
        if(!empty($user->checkUserByUsername($username))) throw new UsernameExistsException();


        /**
         * Create user
         */
        $user->createNewUser($username,$password,$email,$firstname,$lastname);

        echo "<span class='success'>Registration complete! You can log in now.</span>";


?>
        <script>
//            jQuery("#register_form").fadeOut(10);
        </script>
<?php







    }
    catch (EmptyDataException $e)
    {
        echo "Please fill in all fields to become a whiskyman!";
    }
    catch (WrongDataException $e)
    {
        echo "Wrong e-mail and password combination.";
    }
    catch (PasswordsDontMatchException $e)
    {
        echo "Passwords must be the same";
    }
    catch(WrongEmailFormException $e)
    {
        echo "Wrong e-mail pattern";
    }
    catch(UsernameExistsException $e)
    {
        echo "Username already exists - choose another username.";
    }
    catch(EmailExistsException $e)
    {
        echo "User with this e-mail already exists - choose another e-mail.";
    }

}
else
{
    header("Location: index.php");
}

ob_flush();







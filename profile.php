<?php
ob_start();

/*error_reporting(E_ALL);
ini_set("display_errors", 1);*/
/**
 * User profile controller
 */

/**
 * IMPORTANT: add following things in every controller:
 * session_start()
 * require_once("rolestarter.php");
 * "user" => $_SESSION['user'] needs to be sent to Twig
 */

session_start();


use src\ProjectWhisky\business\ProfileBusiness;
use src\ProjectWhisky\exceptions\WrongDataException;
use src\ProjectWhisky\exceptions\PasswordsDontMatchException;
use src\ProjectWhisky\exceptions\FuckedUpException;
use src\ProjectWhisky\exceptions\EmptyDataException;
use Doctrine\Common\ClassLoader;

require_once("rolestarter.php"); // gives to user role = 0 on first visit of the website: role = 0 - guest


if (isset($_SESSION['user']['id']) && (is_int((int)$_SESSION['user']['id'])))
{
    $userId = $_SESSION['user']['id'];

    /**
     * Connecting doctrine autoloader
     */
    require_once'Doctrine/Common/ClassLoader.php';
    $classLoader = new ClassLoader("src");
    $classLoader->register();

    require_once("lib/Twig/Autoloader.php");
    Twig_Autoloader::register();

    /**
     * Creating new profile object
     */
    $profile = new ProfileBusiness();

    /**
     * Get user data by user id: firstname, lastname, e-mail, user image
     */
    $userData = $profile->getUserDataByUserId($userId); // sended to twig on the end


    /**
     * Perform form workout
     */
    if (isset($_POST['userFirstName']))
    {
        try
        {
            if((empty($_POST['userFirstName'])) || (empty($_POST['userLastName'])) || empty($_POST['userEmail'])) throw new EmptyDataException;

            $firstname = $_POST['userFirstName'];
            $lastname = $_POST['userLastName'];
            $email = $_POST['userEmail'];
            /**
             * Perform updating fields
             */
            if ($profile->updateUserDataByUserId($userId, $firstname, $lastname, $email) !== true) throw new FuckedUpException();

            echo "Profile updated";

            header("Refresh: 1");

        }
        catch (EmptyDataException $e)
        {
            echo "We need your firstname, lastname and e-mail";
        }
        catch (FuckedUpException $e)
        {
            echo "Someting went wrong, restart your computer 3 times.";
        }

    }








    /**
     * Upload files
     */
    if (isset($_FILES['userImage']))
    {
        $file = $_FILES['userImage'];

        /**
         * File properties
         */
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];

        /**
         * Work out the file extension
         * If move_uploaded_file gives permission error, 'cd' to 'userimages' folder and give it wright permissions: 'chmod 0777 userimages' (both machines)
         */
        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));

        $allowed = array('png');

        if (in_array($file_ext, $allowed))
        {
            if ($file_error === 0)
            {
                if ($file_size <= 2097152)
                {
                    $file_name_new = uniqid('', true) . '.' . $file_ext; // uniqid - creates unique id based on current timestamp in microseconds


                    $file_destination = 'src/ProjectWhisky/presentation/userimages/' . $file_name_new;

                    if (move_uploaded_file($file_tmp, $file_destination))
                    {
                        echo $file_destination;
                    }
                }
            }
        }
    }







    /**
     * Perform password change only if user presses "Change password" button on profile page
     */
    if (isset($_POST['userOldPassword']))
    {
        $oldPassword = $_POST['userOldPassword'];
        $newPassword = $_POST['userNewPassword'];
        $newPasswordRepeat = $_POST['userNewPasswordRepeat'];

        try
        {
            $profile->checkOldPassword($userId, $oldPassword);

            /**
             * Check if passwords are matching
             */
            if ($_POST['userNewPassword'] !== $_POST['userNewPasswordRepeat']) throw new PasswordsDontMatchException();

            /**
             * Update old password
             */
            if ($profile->updateNewPassword($userId, $newPassword) !== true) throw new FuckedUpException();
            echo "password changed";

        }
        catch (WrongDataException $e)
        {
            echo "Wrong password";
        }
        catch (PasswordsDontMatchException $e)
        {
            echo "New passwords don't match";
        }
        catch (FuckedUpException $e)
        {
            echo "Someting went wrong, restart your computer 3 times.";
        }

    }







    $loader = new Twig_Loader_Filesystem("src/ProjectWhisky/presentation");
    $twig = new Twig_Environment($loader);
    $view = $twig->render("profile.twig", array("user" => $_SESSION['user'], "userData" => $userData));

    print($view);


    echo "<pre>";
    print_r($_SESSION['user']);
    echo "</pre>";
}
else
{
    header("Location: index.php");
}


ob_flush();



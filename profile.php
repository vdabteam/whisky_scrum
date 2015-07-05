<?php
ob_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);
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
    /**
     * Dialog variable which stores and shows errors or success messages
     */
    if (!isset($_SESSION['dialogBlock']))
    {
        $_SESSION['dialogBlock'] = "";
    }





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

            $_SESSION['dialogBlock'] = "Profile updated";
            $_SESSION['reload'] = 1;

//            header("Refresh: 0");
            header('Location: profile.php?updated=1');

        }
        catch (EmptyDataException $e)
        {
            $_SESSION['dialogBlock'] = "We need your firstname, lastname and e-mail";
        }
        catch (FuckedUpException $e)
        {
            $_SESSION['dialogBlock'] = "Someting went wrong, restart your computer 3 times.";
        }

    }




    /*
     * A defined function which renames image path
     * Object $profile required to be given to this function
     */
    function updateImagePathInDB($userId, $newImagePath, $profile)
    {
       return $profile->updateUserImagePath($userId, $newImagePath);
    }



    /**
     * Upload image
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

        /**
         * Define allowed file extensions
         */
        $allowed = array('png', 'jpg', 'jpeg', 'gif');

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
                        $newImagePath = $file_name_new;
                        /**
                         * Calling defined function and giving parameters. $profile is an object
                         */
                        updateImagePathInDB($userId, $newImagePath, $profile);
                    }
                }
            }
        }
    }


    /**
     * Remove image path (images itself remain in userimages folder)
     */
    if (isset($_POST['removeProfileImageBtn']))
    {
        /**
         * if user removes his picture, a default.jpg will be added to his profile
         */
        $newImagePath = "default.jpg";
        /**
         * Change image name in DB
         */
        if (updateImagePathInDB($userId, $newImagePath, $profile))
        {
            $_SESSION['dialogBlock'] = "Your profile image has been removed";
        }
        else
        {
            $_SESSION['dialogBlock'] = "Something went wrong";
        }
        header('Refresh: 0');
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
            $_SESSION['dialogBlock'] = "Wrong old password";
        }
        catch (PasswordsDontMatchException $e)
        {
            $_SESSION['dialogBlock'] = "New passwords don't match";
        }
        catch (FuckedUpException $e)
        {
            $_SESSION['dialogBlock'] = "Someting went wrong, restart your computer 3 times.";
        }

    }


    /**
     * Load Twig template
     */
    $loader = new Twig_Loader_Filesystem("src/ProjectWhisky/presentation");
    $twig = new Twig_Environment($loader);
    $view = $twig->render("profile.twig", array("user" => $_SESSION['user'], "userData" => $userData, "dialogBlock" => $_SESSION['dialogBlock']));

    print($view);


    /***
     * todo: REMOVE ALL MESSAGES FROM SESSION AFTER PAGE RELOADING
     */
    if(isset($_SESSION['reload']) && ($_SESSION['reload'] == 1) && ($_GET['updated'] == 1))
    {
        $_SESSION['dialogBlock'] = "";
        unset($_SESSION['reload']);
    }
    elseif(!isset($_SESSION['reload']) && (isset($_GET)))
    {
//        header('Location: profile.php');
    }


}
else
{
    header("Location: index.php");
}








ob_flush();



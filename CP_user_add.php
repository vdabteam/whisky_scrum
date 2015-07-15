<?php
session_start();
ob_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

use src\ProjectWhisky\business\UserBusiness;
use src\ProjectWhisky\business\ProfileBusiness;
use src\ProjectWhisky\exceptions\ImageException;
use src\ProjectWhisky\exceptions\UserExistsException;
use Doctrine\Common\ClassLoader;

require_once("rolestarter.php");
require_once("adminRights.php"); // Redirects users ir guest from control panel to index.php if is not admin

require_once('Doctrine/Common/ClassLoader.php');
$classLoader = new ClassLoader("src");
$classLoader->register();

require_once("lib/Twig/Autoloader.php");
Twig_Autoloader::register();

// check form submit
if(isset($_POST["userUsername"]))
{
    try
    {
        $userBiz = new UserBusiness();

        //form POST data
        $username = $_POST['userUsername'];
        $password = $_POST['userPassword'];
        $email = $_POST['userEmail'];
        $firstname = $_POST['userFirstName'];
        $lastname = $_POST['userLastName'];

        $admin = false;
        if(isset($_POST['userAdmin'])){
            $admin = true;
        }

        $blocked = false;
        if(isset($_POST['userBlocked'])){
            $blocked = true;
        }


        /**
         * Look if user with entered username already exists
         */
        if(!empty($userBiz->checkUserByUsername($username))) throw new UserExistsException("This username already exists.");


        /**
         * Look if user with entered e-mail already exists
         */
        if(!empty($userBiz->checkUserByEmail($email))) throw new UserExistsException("User with this e-mail already exists.");


        $userImage = "default.jpg";


        if (isset($_FILES['user_image']) && (!empty($_FILES['user_image']['name'])))
        {

            $file = $_FILES['user_image'];

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
                            $userImage = $file_name_new;
                        }
                    }
                    else
                    {
//                        $_SESSION['userDialogBlock'] = "Allowed file size is 2MB";
                        throw new ImageException('Allowed file size is 2MB');
                    }
                }
            }
            else
            {
                throw new ImageException('Only .png, .jpg, .jpeg and .gif files are allowed.');
            }
        }


        $userBiz->addCPUser($username, $password, $email, $firstname, $lastname, $admin, $blocked, $userImage);
    }
    catch(ImageException $e)
    {
        $_SESSION['userDialogBlock'] = $e->getMessage();
    }
    catch(UserExistsException $e)
    {
        $_SESSION['userDialogBlock'] = $e->getMessage();
    }


}    



$loader = new Twig_Loader_Filesystem("src/ProjectWhisky/presentation");
$twig = new Twig_Environment($loader);

$view = $twig->render("CP_user_add.twig", array("user" => $_SESSION['user']));

print($view);

ob_flush();
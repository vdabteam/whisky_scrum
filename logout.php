<?php

session_start();


/**
 * Log out user
 */
if(isset($_GET['logout']) && ($_GET['logout'] == true))
{
    $_SESSION['user'] = array();
    header("Location: index.php");
}

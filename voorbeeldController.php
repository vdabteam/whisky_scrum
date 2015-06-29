<?php

ob_start();
use src\ProjectBioscoop\business\UsersBusiness;
use src\ProjectBioscoop\business\ReservatiesBusiness;
use src\ProjectBioscoop\exceptions\OngeldigeVoornaamException;
use src\ProjectBioscoop\exceptions\OngeldigeFamilienaamException;
use src\ProjectBioscoop\exceptions\OngeldigeInputException;
use src\ProjectBioscoop\exceptions\OngeldigeEmailException;
use Doctrine\Common\ClassLoader;
session_start();




require_once'Doctrine/Common/ClassLoader.php';
$classLoader = new ClassLoader("src");
$classLoader->register();




if ((isset($_POST['bestelBtn'])) && (!empty($_POST['userName'])) && (!empty($_POST['userSurname'])) && (!empty($_POST['userEmail'])))
{
    $_SESSION['voornaam'] = $voornaam = $_POST['userName'];
    $_SESSION['familienaam'] = $familienaam = $_POST['userSurname'];
    $_SESSION['email'] = $email = $_POST['userEmail'];

    try
    {
        if(!isset($_SESSION['gekozenDatum'])) throw new OngeldigeInputException();

            if(!ctype_alpha(str_replace(' ', '', $voornaam))) throw new OngeldigeVoornaamException(); // "Voornaam" validation
        if(!ctype_alpha(str_replace(' ', '', $familienaam))) throw new OngeldigeFamilienaamException(); // "Familienaam" validation
        if(!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) throw new OngeldigeEmailException(); // "Email" validation

        /**
         * Insert new user (in case it doesn't exost) and return the 'user_id'
         */
        $usersObj = new UsersBusiness();
        $userId = $usersObj->creerGebruiker($voornaam, $familienaam, $email);

        /**
         * Generate random code (20 chrs)
         */
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = strlen($characters);
        $reservatieCode = '';
        for ($i = 0; $i < 20; $i++) {
            $reservatieCode .= $characters[rand(0, $length - 1)];
        }

        /**
         * Insert new reservation
         */
        $gekozenDatum = explode("/", $_SESSION['gekozenDatum']);
        $gekozenDatum = $gekozenDatum[2] . "-" . $gekozenDatum[1] . "-" . $gekozenDatum[0];

        $reservatiesObj = new ReservatiesBusiness();
        $reservatie = $reservatiesObj->voegNieuweReservatie($userId, $_SESSION['gekozenRij'], $_SESSION['gekozenKolom'], $gekozenDatum, $_SESSION['programmatie'], $reservatieCode);

        $_SESSION = array();
        unset($_COOKIE[session_name()]);

        $_SESSION['reservatieCode'] = $reservatieCode;

        header("Location: checkout.php");




    }
    catch(OngeldigeEmailException $e)
    {
        $errors[] = "Ongeldige e-mail";
    }
    catch(OngeldigeVoornaamException $e)
    {
        $errors[] = "Ongeldige voornaam";
    }
    catch(OngeldigeFamilienaamException $e)
    {
        $errors[] = "Ongeldige familienaam";
    }
    catch(OngeldigeInputException $e)
    {
        header("Location: index.php");
    }



}
else
{
    $errors[] = "Alle velden moeten ingevuld zijn";
}


if (isset($errors) && !empty($errors))
{
    $_SESSION['errors'] = $errors;
    $path = "Location: overzicht.php?rij=" . $_SESSION['gekozenRij'] . "&kolom=" . $_SESSION['gekozenKolom'];
    header($path);
}
else
{
    $_SESSION['errors'] = "";
}






ob_flush();
<?php


function hashPassword($passwordToHash, $rounds = 10)
{

    $crypt_options = array('cost' => $rounds);
    $hash = password_hash($passwordToHash, PASSWORD_BCRYPT, $crypt_options);
    return $hash;
}


echo hashPassword("654321");



<?php

/**
 * This file must be included at the top of every controller!
 * Responsible for assigning role for guest
 *
 */


if(!isset($_SESSION['user']))
{
    $_SESSION['user']['role'] = 0; // guest
}
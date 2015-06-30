<?php
use src\ProjectWhisky\business\WhiskyBusiness;
use Doctrine\Common\ClassLoader;

$whiskyBusiness = new WhiskyBusiness();

$list = $whiskyBusiness->getWhiskyList();
print("<pre>");
print_r($list);
print("</pre>");
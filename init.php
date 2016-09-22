<?php
require 'helpers.php';
spl_autoload_register('myAutoLoad');

$packUrl = new packUrl();
$packUrl->setDate('2016-10-17'); 
$packUrl->setFromStation('HDP'); 
$packUrl->setToStation('BXP'); 
$resData = httpRequest($packUrl->buildUrl());

$format = new Format($resData);
$res = $format->getHighRails();
print_r($res);

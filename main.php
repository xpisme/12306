<?php
require 'helpers.php';
spl_autoload_register('myAutoLoad');

$packUrl = new packUrl();
$packUrl->setDate('2016-10-27'); 
$packUrl->setFromStation('HDP'); 
$packUrl->setToStation('BXP'); 
$resData = httpRequest($packUrl->buildUrl());

$format = new Rails($resData);
$hide = false;
$format->getHighRails($hide);
$format->getOrdinaryRails($hide);

<?php
require 'helpers.php';
spl_autoload_register('myAutoLoad');
unset($argv[0]);
list($start, $end, $date) = Arguments::analyze($argv);
$startName = current($start);
$startSn = key($start);
$endName = current($end);
$endSn = key($end);

echo "日期：{$date}   出发地：{$startName}   目的地：{$endName}" . PHP_EOL . PHP_EOL;

$packUrl = new packUrl();
$packUrl->setDate($date); 
$packUrl->setFromStation($startSn); 
$packUrl->setToStation($endSn); 
$resData = httpRequest($packUrl->buildUrl());

$format = new Rails($resData);
$hide = false;
$format->getHighRails($hide);
$format->getOrdinaryRails($hide);

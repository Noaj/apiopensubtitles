<?php

namespace Noaj\Tools\OpenSubtitles\Example;
require __DIR__.'/../vendor/autoload.php';

use Noaj\Tools\OpenSubtitles\Client\XmlrpcClient;
use Noaj\Tools\OpenSubtitles\Client\XmlrpcReturn;

//include_once('../Client/XmlrpcClient.php');
//include_once('../Client/XmlrpcReturn.php');

//Te user name and password can be empty but the userAgent
$username = '';
$password = '';
//As language use ​ISO639 2 letter code

$language = 'en';
//For test purposes special user agent
$useragent = "OS Test User Agent";
//var_dump("Here2");
$client = new XmlrpcClient($username, $password, $language, $useragent);
//var_dump("Here2");
$result = $client->searchTvShowSubtitles($client->getToken(), 'south park', null, null, 'eng');
//var_dump("Here3");
$returnMethod = new XmlrpcReturn();
//var_dump($result);
$jsonData = $returnMethod->returnXml($result);

var_dump($jsonData);


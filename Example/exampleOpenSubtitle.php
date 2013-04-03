<?php

require __DIR__.'/../vendor/autoload.php';

include_once('../Client/xmlrpc_client.php');
include_once('../Client/apiMethodReturn.php');

//Te user name and password can be empty but the userAgent
$username = '';
$password = '';
//As language use ​ISO639 2 letter code
$language = 'en';
//For test purposes special user agent
$useragent = "OS Test User Agent";

$client = new xmlrpc_client($username, $password, $language, $useragent);
$result = $client->searchTvShowSubtitles($client->getToken(), 'south park', null, null, 'eng');

$returnMethod = new apiMethodReturn();
$jsonData = $returnMethod->returnXml($result);

var_dump($jsonData);


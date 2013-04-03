<?php

require __DIR__.'/../vendor/autoload.php';
//use ApiOpenSubtitles\Client\xmlrpc_client;
include_once('../Client/xmlrpc_client.php');
include_once('../Client/apiMethodReturn.php');

$client = new xmlrpc_client('theTester', 'gotapaximi', 'en', 'apiOpenSubtitles v0.1');//new xmlrpc_client('theTester', 'gotapaximi', 'en', "apiOpenSubtitles v0.1");

$result = $client->searchMovieSubtitles($client->getToken(), 'matrix', 'eng');

$returnMethod = new apiMethodReturn();
$jsonData = $returnMethod->returnXml($result);
var_dump($jsonData);


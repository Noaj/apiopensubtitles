<?php

/**
 * 
 */
//namespace ApiOpenSubtitles/Example;

require __DIR__.'/../vendor/autoload.php';
use Zend\XmlRpc\Client;

$client = new Zend\XmlRpc\Client('http://api.opensubtitles.org/xml-rpc');

$username = '';
$password = '';
$language = 'en';
$userAgent = "OS Test User Agent";

try {

    $token = $client->call('LogIn', array($username, $password, $language, $userAgent));
	//var_dump($token["token"]);
	$result = $client->call('SearchSubtitles', $token["token"], 
	array('query' => 'south park', 'season' => 1, 'episode' => 1, 'sublanguageid'=>'all'));
	//$result = $client->getLastResponse();
	var_dump($result); 
	
} catch (Zend\XmlRpc\Client\Exception\HttpException $e) {

     $e->getCode();// returns 404
     echo $e->getMessage();// returns "Not Found"
}

<?php

namespace Noaj\Tools\OpenSubtitles\Tests;

use Noaj\Tool\OpenSubtitles\Client;
//include_once('../Client/xmlrpcClient.php');
//include_once('../Client/apiMethodReturn.php');
//require_once 'PHPUnit/Framework/TestCase.php';


class XmlrpcClientTest extends PHPUnit_Framework_TestCase
{
	/**
	 * 
	 * @var string $token
	 */
	protected $token;
	
	/**
	 * @var XmlRpc $client
	 */
	protected $client;
	
	/**
	 * 
	 * @var string $username
	 */
	protected $username = '';
	
	/**
	 * 
	 * @var string $password
	 */
	protected $password = '';
	
	/**
	 * As language use ​ISO639 2 letter code
	 * @var string $language
	 */
	protected $language = 'en';
	
	/**
	 * For test purposes special user agent
	 * 
	 * @var string $userAgent
	 */
	protected $userAgent = "OS Test User Agent";
	
	/**
	 * Result of the search
	 * @var array $result
	 */
	protected $result = array();
	
	/**
	 * Result Method. Encode Array to Json or Xml
	 * @var mixed $returnMethod
	 */
	protected $returnMethod;
	
	/**
	 * Set Up
	 */
	public function setUp()
	{
		$this->client = new xmlrpc_client($this->username, $this->password, $this->language, $this->userAgent);
		$this->returnMethod = new apiMethodReturn();
		
	}
	
	/**
	 * Test login
	 */
	public function testLogin()
	{	
		$status = $this->client->getStatus();
		$this->assertTrue($status == "200 OK", "The status is ". $status );
	
	}
	
	/**
	 * Test search
	 */
	public function testSearch()
	{
		$this->result = $this->client->searchTvShowSubtitles($this->client->getToken(), 'south park', null, null, 'eng');
		$this->assertFalse(empty($this->result), "Coudnt find any results ");
		
	}
	
	/**
	 * Test array result to Json 
	 */
	public function testArrayToJson()
	{
		$this->result = $this->client->searchTvShowSubtitles($this->client->getToken(), 'south park', null, null, 'eng');
		$jsonData = $this->returnMethod->returnJson($this->result);
		//var_dump($this->result);
		$error = json_last_error();
		$this->assertFalse($error == JSON_ERROR_UTF8, "Coudnt encode Array to Json");
	}
	
	/**
	 * Test is the server is up
	 */
	public function testServerInfo()
	{
		$serverInfo = $this->client->serverInfo();
		$this->assertFalse(empty($serverInfo), "The server is not Online or you are not Conected to internet ");
		
	}
	
	/**
	 * Test Log out
	 */
	public function testLogout()
	{
		$this->token = $this->client->getToken();
		$this->client->logOut($this->token);
		$status = $this->client->getStatus();
		$this->assertTrue($status == "200 OK", "The status is ". $status );
	
	}
		
}
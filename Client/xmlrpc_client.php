<?php

require __DIR__.'/../vendor/autoload.php';
use Zend\XmlRpc\Client;
use Zend\XmlRpc\Client\Exception\HttpException;

/**
 * 
 * @author joan
 *
 */
class xmlrpc_client {
	
	/**
	 * Requested Url
	 * @var string
	 */
    private $url = 'http://api.opensubtitles.org/xml-rpc';
    
    /**
     * Method to use
     * @var unknown_type
     */
    private $methods;
    
    /**
     * XML-RPC Client
     */
    private $client;
    
    /**
     * XML-RPC Client Token
     */
    private $token;
    
    /**
     * This will login user
     * @param string $username
     * @param string $password
     * @param string $language
     * @param string $userAgent
     */
    function __construct($username, $password, $language, $userAgent) {
    	
    	try {
    		
    		$this->client = new Client($this->url);
        	$clientToken = $this->client->call('LogIn', array($username, $password, $language, $userAgent));
        	$this->setToken($clientToken["token"]);
        	return $this->client;
    		
    	}catch (HttpException $e) {
    		
     		$e->getCode();
     		echo $e->getMessage();
		 }                  
    }
    
    /**
     * This will logout user
     * @param string $token
     */
    public function logOut($token) {
    	
    	try{
    		$this->client->call('LogOut', $token);
        
        	return $this->client;
        	
    	}catch (HttpException $e) {
    		
     		$e->getCode();
     		echo $e->getMessage();
		 }
    }       
    
    /**
     * Look Subtitles for Tv shows
     * @param string $token
     * @param array $information
     */
    public function searchTvShowSubtitles($token, array $information) {
    	
    	try{
    		$this->token = $token;
    		$this->client->call('SearchSubtitles', 
    		array($this->token, array( 
    		array('query' => 'south park', 'season' => 1, 'episode' => 1, 'sublanguageid'=>'eng'))));
    		
    	}catch (HttpException $e) {
    		
     		$e->getCode();
     		echo $e->getMessage();
		 }
    }
    
	/**
     * Look Subtitles for Movies
     * @param string $token
     * @param string $movieName
     * @param string $languages
     */
    public function searchMovieSubtitles($token, $movieName, $languages) {
    	
    	try{
    		
    		$this->token = $token;
    		$result = $this->client->call('SearchSubtitles', 
    		array($token, array(
    		array('query' => $movieName, 'sublanguageid'=> $languages))));
    		
    		return $result;
    		
    	}catch (HttpException $e) {
    		
     		$e->getCode();
     		echo $e->getMessage();
		 }
    }
    
    /**
     * Get xmlrpc_client token
     */
    public function getToken(){
    	
    	return $this->token;
    	
    }
    
    /**
     * Set xmlrpc_client token
     * @param unknown_type $token
     */
    public function setToken($token){
    	
    	$this->token = $token;
    	
    }
       
}

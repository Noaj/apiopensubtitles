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
     * Search qith query or ImdbId. Default Query.
     */
    private $query = 'query';
    
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
     * @param string $tvShowName
     * @param int    $season
     * @param int    $episode
     * @param string $sublanguage
     */
    public function searchTvShowSubtitles($token, $tvShowName, $season = null, $episode = null, $sublanguage = 'all' ) {
    	
    	$information = array($this->query => $tvShowName, 'season' => $season, 'episode' => $episode, 'sublanguageid'=> $sublanguage);
    	
    	try{
    		$this->token = $token;
    		$result = $this->client->call('SearchSubtitles', 
    		array($this->token, array($information)));
    		
    		return $result;
    		
    	}catch (HttpException $e) {
    		
     		$e->getCode();
     		echo $e->getMessage();
		 }
    }
    
	/**
     * Look Subtitles for Movies
     * @param string $token
     * @param string $movieName
     * @param string $languages The params could be: 'eng,esp' or 'eng'
     */
    public function searchMovieSubtitles($token, $movieName, $sublanguage) {
    	
    	try{
    		
    		$this->token = $token;
    		$result = $this->client->call('SearchSubtitles', 
    		array($token, array(
    		array($this->query => $movieName, 'sublanguageid'=> $sublanguage))));
    		
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
    
    /**
     * Set search method by query or imdbid. query by default
     * @param string $query
     */
    public function setQuery($query){
    	
    	$this->query = $query;
    	
    }
       
}

<?php

require __DIR__.'/../vendor/autoload.php';
use Zend\XmlRpc\Client;

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
     * This will login user
     * @param string $username
     * @param string $password
     * @param string $language
     * @param string $userAgent
     */
    function __construct($username, $password, $language, $userAgent) {
    	
        $this->client = new Zend\XmlRpc\Client($this->url);
        $this->client->call('LogIn', array($username, $password, $language, $userAgent));
        
        return $this->client;
                    
    }
    
    /**
     * This will logout user
     * @param string $token
     */
    public function logOut($token) {
    	
        $this->client->call('LogOut', $token);
        
        return $this->client;
    }       
    
    /**
     * Look for Subtitles
     * @param string $token
     * @param array $information
     */
    public function searchSubtitles($token, array $information) {
    	
    	$this->token = $token;
    	$this->client->call('SearchSubtitles', $this->token, $information);
    }
    
    
    
}

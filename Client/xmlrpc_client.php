<?php

require_once('../Resources/curl.class.php');

/**
 * 
 * @author joan
 *
 */
class xmlrpc_client {
	
	/**
	 * Requested Url
	 * @var unknown_type
	 */
    private $url;
    
    /**
     * Method to use
     * @var unknown_type
     */
    private $methods;
    
    /**
     * 
     * @param $url
     * @param $autoload
     */
    function __construct($url, $autoload=true) {
    	
        $this->url = $url;
        $this->connection = new curl();
        $this->methods = array();
        
        if ($autoload) {
            $resp = $this->call('ServerInfo', null);
            $this->methods = $resp;
        }
        
    }
    
    public function call($method, $params = null) {
    	
        $post = xmlrpc_encode_request($method, $params);
        
        return xmlrpc_decode($this->connection->post($this->url, $post));
    }       
    
}

	header('Content-Type: text/plain');
	//die('Here');
	$rpc = "http://api.opensubtitles.org/xml-rpc";

	$client = new xmlrpc_client($rpc, true);
	//var_dump($client); die('Here');

	$resp = $client->call('ServerInfo', array());
	print_r($resp);
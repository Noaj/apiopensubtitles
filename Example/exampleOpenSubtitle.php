<?php

require('../Client/xmlrpc_client.php');

	///header('Content-Type: text/plain');
	//die('Here');
	$rpc = "http://api.opensubtitles.org/xml-rpc";
	//die('Here');
	try {
		$client = new xmlrpc_client($rpc, true);
		var_dump($client); die('Here');
		
	} catch (ErrorException $e){
	   var_dump($e);
	
	}

	$resp = $client->call('ServerInfo', array());
	print_r($resp);
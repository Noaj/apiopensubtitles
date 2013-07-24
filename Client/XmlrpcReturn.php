<?php


namespace Noaj\Tool\OpenSubtitles\Client;


/**
 * 
 * @author joan
 *
 */
class XmlrpcReturn {
	
	/**
	 * Return Json Data
	 * @param array $data
	 */
	public function returnJson(array $data){
		
		$jsonData = json_encode($data);
		
		return $jsonData;
	}
	
	/**
	 * Return xml data
	 * @param array $data
	 */
	public function returnXml(array $data){
		
		$xmlData = new SimpleXMLElement("<?xml version=\"1.0\"?><subtitleResult></subtitleResult>");

		$this->arrayToXml($data, $xmlData);
		$result = $xmlData->asXML();
		
		return $result;
		
	}
	
	/**
	 * Function defination to convert array to xml
	 * 
	 */
	public function arrayToXml($data, $xmlData)
        {
		
            foreach($data as $key => $value) {
                
        	if(is_array($value)) {
            	
                    if(!is_numeric($key)){
                
                        $subnode = $xmlData->addChild("$key");
                	$this->arrayToXml($value, $subnode);
                    }else {
                	
                        $this->arrayToXml($value, $xmlData);
                    }
                
        	}else {
                    
                    $xmlData->addChild("$key","$value");
        	}
            }
	}
	
}
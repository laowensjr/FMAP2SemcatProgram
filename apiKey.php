<?php 
class apiKey{
	public $apikey;
	public $authenticity_token;
		
	
	 function getApiKey(){
		//Get api_key and pass it in
		$apikey = null;
		$authenticity_token = null;
		$doc = new DOMDocument();
		$semcatStartUrl = 'https://entryform.semcat.net/1800stonewall';
		libxml_use_internal_errors(true);
		$doc->loadHTMLFile("$semcatStartUrl");
		libxml_clear_errors();
		$apikey = $doc->getElementById('api_key')->getAttribute('value');
				
		//Original 2 Lines
		//$xpath = new DOMXPath($doc);
		//$input = $xpath->query("input[@name=authenticity_token]")->item(0)->getAttribute("value");
		
			//Modified 2 Lines and added 2 Lines
		$xpath = new DOMXPath($doc);	
		$input = $xpath->query("//input[@name='authenticity_token']"); 
		$authenticity_token = $input->item(0)->getAttribute('value');
		$this->authenticity_token = $authenticity_token;
		
		return $apikey;
			
	}
	
	function getAuthenticityToken(){
		
				return $this->authenticity_token;
	}
	
}


?>
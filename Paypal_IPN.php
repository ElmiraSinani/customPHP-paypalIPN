<?php

class Paypal_IPN{
	
	//** @var string $_url The paypal url to go to through cURL 
	private $_url;
	
	/**
	* @param string $mode 'live' or 'sandbox'
	*/
	public function __construct( $mode = 'live' )
	{
		if ( $mode == 'live' )
			$this->_url = 'https://www.paypal.com/cgi-bin/webscr';		
		else 
			$this->_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';		
	}
	
	public function run(){
		
		$postFields = 'cmd=_notify-validate';
		
		foreach( $_POST as $key => $value )
		{
			$postFields .= "&$key=".urlencode($value);
		}
		
		$ch = curl_init();
		
		curl_setopt_array( $ch, array(
			CURLOPT_URL => $this->_url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postFields
		));
		
		$result = curl_exec($ch);
		//echo curl_error($ch);
		curl_close($ch);
		
		$fh = fopen( 'result.txt', 'w' );
		fwrite( $fh, $result . ' -- ' . $postFields );
		fclose($fh);
		
		echo $result;
		
	}
}
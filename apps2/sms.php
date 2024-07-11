<?php

	// Account details
	$apiKey = urlencode('NTg3MTZmNTY1ODU4NTM0MjQxNzU0NjczNjY2NjQ2NzQ=');
	
	$numbers = urlencode('8669062338');
	$sender = urlencode('ASFENT');
	$empname= "Razaulhaque Khan";
	$company = "AASIF ENTERPRIES";
	$userphone ="9923377552@1994";
	$emppassword ="75521994";
	$message = rawurlencode('Dear%2C%0D%0A%20'.$empname.'%20thank%20for%20registering%20from%20'.$company.'%20your%20user%20id%20is%20'.$userphone.'%20and%20password%20is%20'.$emppassword.'.%0D%0A%0D%0Aregards%0D%0AmyManage%20team');
	
	// Prepare data for POST request
	$data = 'apikey=' . $apiKey . '&numbers=' . $numbers . "&sender=" . $sender . "&message=" . $message;
	
	// Send the GET request with cURL
	$ch = curl_init('https://api.textlocal.in/send/?' . $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	
	// Process your response here
	echo $response;
?>

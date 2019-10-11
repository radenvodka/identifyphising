<?php
error_reporting(0);

$path = array('/','n','netflix.com' ,'netflix' ,'paypal' ,'paypal.com' , 'paypalcom' , 'chase' , 'DHL' , 'login/session' , 'login' , 'style' , 'session');
$file = array('robots.txt','verify.ini','assets/css/app.css','assets/js/Valid.UK.js' , 'assets/js/jquery.payment.js' , 'assets/css/verify.css', 'javascripts/geral.js', 'assets/css/Second.css', 'assets/css/Login.css', 'assets/js/enc.js', 'readme.txt', 'assets/css/unusual.css', 'assets/css/yahoo-main.css' , 'assets/css/hotmail.css' , 'assets/custom.css' , 'js/clavier.js' , 'images/cas4.png', 'images/dhl_logo.gif', 'images/ms-logo-v2.jpg' , 'css/login.css' , 'css/style.css' , 'images/h1.png');
$text = array('HijaIyh','Apple','apple','paypalobjects','ccno','ccexp','lname','creditcard','visa','applyBml','checkCard','apple','Aes','HIJAIYH','yahoo','Microsoft','WebSSO_BP','ibb.co','BPGO','encodeBase64LCL','problem','PP-Utility');


$target = 'https://example.com';

foreach ($path as $key => $setPatch) {
	foreach ($file as $key => $setFile) {
		$arrayURL[] = str_replace("///", "/", $target."/".$setPatch."/".$setFile);
	}
}
foreach ($arrayURL as $key => $urls) {

	$ch = curl_init($urls);
	curl_setopt($ch, CURLOPT_HEADER, true); 
	curl_setopt($ch, CURLOPT_NOBODY, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_TIMEOUT,10);
	$output 	= curl_exec($ch);
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	
	echo "[+][".$httpcode."] Check : ".$urls."\r\n";
	foreach ($text  as $key => $findMe) {
		preg_match_all('/'.$findMe.'/mi', $output, $matches);
		if($matches[0][0]){
			$keyFound = $findMe;
			break;
		}
	}
	if(!empty($keyFound)){
		break;
	}
}
if($keyFound){
	echo " -- Phising Detected --";
}else{
	echo " -- SAFE --";
}

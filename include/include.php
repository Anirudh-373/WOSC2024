<?php
//	session_start();
	
	$basename=basename($_SERVER['SCRIPT_NAME']);
	echo "Base Name-->>" .$basename;
	$today_data=date("Y/m/d H:i:s",time());
	$close_date=strtotime("20-04-2019 5:30:00 PM");
	//$testing_mode="local";
	$testing_mode="live";
	
	if($testing_mode=="local"){
		$db_psw="";
		$tbl_ut15_abstract_upload="UT15_abstract_upload";
		$tbl_ut15_transaction="ut15_transaction";
		$tbl_ut15="ut_15";
	} else if($testing_mode=="live"){
		$db_psw="@#%n10T$^PWD";
		$tbl_ut15_abstract_upload="UT15_Abstract_Upload";
		$tbl_ut15_transaction="UT15_Transaction";
		$tbl_ut15="UT_15";
	}
	/*mysql_connect("localhost","root",$db_psw) or die("could not connect");
	mysql_select_db("web_niotsrvr");*/
	$browser = getBrowser();
	$browser_name=$browser['name'];

	/*function exec_query($query){
		$result = mysql_query($query);
		$array = Array();
		if(!$result) return $array;
		while ($row = mysql_fetch_assoc($result)) {
            $array[] = $row;
        }
		return $array;
	}*/
	function getBrowser() { 
		$u_agent = $_SERVER['HTTP_USER_AGENT']; 
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";

		//First get the platform?
		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'linux';
		}
		elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'mac';
		}
		elseif (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'windows';
		}
		
		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Internet Explorer'; 
			$ub = "MSIE"; 
		} 
		elseif(preg_match('/Firefox/i',$u_agent)) 
		{ 
			$bname = 'Mozilla Firefox'; 
			$ub = "Firefox"; 
		} 
		elseif(preg_match('/Chrome/i',$u_agent)) 
		{ 
			$bname = 'Google Chrome'; 
			$ub = "Chrome"; 
		} 
		elseif(preg_match('/Safari/i',$u_agent)) 
		{ 
			$bname = 'Apple Safari'; 
			$ub = "Safari"; 
		} 
		elseif(preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Opera'; 
			$ub = "Opera"; 
		} 
		elseif(preg_match('/Netscape/i',$u_agent)) 
		{ 
			$bname = 'Netscape'; 
			$ub = "Netscape"; 
		} 
		
		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
			// we have no matching number just continue
		}
		
		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			}
			else {
				$version= $matches['version'][1];
			}
		}
		else {
			$version= $matches['version'][0];
		}
		
		// check if we have a number
		if ($version==null || $version=="") {$version="?";}
		
		return array(
			'userAgent' => $u_agent,
			'name'      => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'    => $pattern
		);
	} 

	/*$sq1="select * from ".$tbl_ut15." where utregid='UT15-0001' and mailid='set@DASD.go'";
	$arr=exec_query($sq1);
	
	echo "<pre>";
	print_r($arr);
	echo "</pre>";*/

?>

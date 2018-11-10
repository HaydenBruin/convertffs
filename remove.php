<?php
	/**
	*
	* convertFFS.com
	*
	* This allows the user to remove extended data held on their IP.
	*
	*/
	
	
	//Including the Stats class.
	require_once( 'php/stats.php' );
	
	//Loading the Stats class.
	$stats = new Stats( );
	
	//Removing the user's data from the qualityControl table.
	$stats->removeQualityControlData( );
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>convertFFS - Advanced object, vehicle conversion for SA-MP and MTA</title>
<meta charset="utf-8" />
<meta name="description" content="A converter that supports every popular object and vehicle format for the Grand Theft Auto: San Andreas (tm) modifications SA-MP and MTA." />
</head>
<body style="background:url(images/backgroundTop.gif) #b6f2fa;background-repeat:repeat-x;text-align:center;width:100%;height:100%;position:absolute;top:0px;left:0px;z-index:30000;text-shadow:-1px 1px 0px #000;color:#fff;font-size:x-large;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;overflow:hidden">
	Extended data from your IP address has been removed from the database.<br /><br />
	<a href="http://www.convertffs.com" style="color:#FFF;">Click here to return to convertFFS</a>
</body>
</html>
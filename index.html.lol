
<!DOCTYPE html>
<html lang="en">
<head>
	<title>convertFFS - Advanced object, vehicle conversion for SA-MP and MTA (SA-MP object converter, SA-MP converter, MTA map converter, MTA converter, SA-MP map converter)</title>
	<meta charset="utf-8" />
	<meta name="description" content="The best object and vehicle converter around for the GTA: San Andreas modifications SA-MP and MTA. Custom formats, extensive options and more!" />
	<link rel="shortcut icon" type="image/x-icon" href="http://www.convertffs.com/favicon.ico">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script src="javascript/textAreaResize.js"></script>
	<script src="javascript/fancyZoom.js"></script>
	<script src="javascript/ajaxUpload.js"></script>
	<script type="text/javascript">
		var ieVersion = 0;
	</script>
	<!--[if IE 7]>
		<script type="text/javascript">
			ieVersion = 7;
		</script>
	<![endif]-->
	<!--[if IE 8]>
		<script type="text/javascript">
			ieVersion = 8;
		</script>
	<![endif]-->
	<script src="javascript/convertFFS.js"></script>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<!--[if lte IE 7]>
		<link rel="stylesheet" href="css/ie.css" type="text/css" />
	<![endif]--> 
</head>
<body>
	<noscript>
		<!-- The div is required because internet explorer is an idiot, and decides to render noscript styles regardless of the browsers javascript ability -->
		<div id="noscript">
			Your browser does not support javascript, or javascript is not enabled.<br /><br />You must enable it, or upgrade to a browser that supports javascript in order to use convertFFS.
		</div>
	</noscript>
	<div id="loading"></div>
	<div id="addObjectFormat" class="addCustomFormat">
		<strong style="font-size:large;margin-bottom:10px;display:block">Add custom object format</strong>
		<table class="customParamTable">
			<tr>
				<td style="background:#eee">
					<strong>What you want </strong><br />
					X position<br />
					Y position<br />
					Z position<br />
					X rotation<br />
					Y rotation<br />
					Z rotation
				</td>
				<td>
					<strong> What to input</strong><br />
					{x}<br />
					{y}<br />
					{z}<br />
					{rx}<br />
					{ry}<br />
					{rz}
				</td>
				<td style="background:#eee">
					<strong>What you want </strong><br />
					Model ID<br />
					Unique ID<br />
					Draw-distance<br />
					Virtual world<br />
					Interior<br />
					Player ID
				</td>
				<td>
					<strong> What to input</strong><br />
					{model}<br />
					{id}<br />
					{dd}<br />
					{vw}<br />
					{int}<br />
					{pid}
				</td>
			</tr>
		</table><br />
		<input id="addObjectFormatField" type="text" style="width:500px" value="MyObjectFormat({model},{x},{y},{z},{rx},{ry},{rz},{dd}); //Object number {id}">
		<br /><br />
		<input id="addObjectFormatFieldName" type="text" style="width:500px" value="Format name goes here" maxlength="23">
		<br /><br />
		<input type="button" value="Add" onClick="processAddObjectFormat()"> <input type="button" value="Cancel" onClick="$('#addObjectFormat').fadeOut(600);$('#formatOverlay').hide()">
	</div>
	<div id="addVehicleFormat" class="addCustomFormat">
		<strong style="font-size:large">Add custom vehicle format</strong>
		<table class="customParamTable">
			<tr>
				<td style="background:#eee">
					<strong>What you want </strong><br />
					X position<br />
					Y position<br />
					Z position<br />
					Rotation<br />
					Model ID
				</td>
				<td>
					<strong> What to input</strong><br />
					{x}<br />
					{y}<br />
					{z}<br />
					{r}<br />
					{model}
				</td>
				<td style="background:#eee">
					<strong>What you want </strong><br />
					Respawn time<br />
					Unique ID<br />
					Colour one<br />
					Colour two
				</td>
				<td>
					<strong> What to input</strong><br />
					{respawn}<br />
					{id}<br />
					{c1}<br />
					{c2}
				</td>
			</tr>
		</table><br />
		<input id="addVehicleFormatField" type="text" style="width:500px" value="MyVehicleFormat({model},{x},{y},{z},{r},{c1},{c2},{respawn}); //Vehicle number {id}">
		<br /><br />
		<input id="addVehicleFormatFieldName" type="text" style="width:500px" value="Format name goes here" maxlength="23">
		<br /><br />
		<input type="button" value="Add" onClick="processAddVehicleFormat()"> <input type="button" value="Cancel" onClick="$('#addVehicleFormat').fadeOut(600);$('#formatOverlay').hide()">
	</div>
	<div id="formatOverlay"></div>
	<div id="about" class="jsHide">
		<strong class="largeText">About convertFFS</strong><br /><br />
		<div style="text-align:left">
			convertFFS is arguably the best object and vehicle converter out there for the GTA: San Andreas modifications SA-MP and MTA. It supports more object and vehicle formats
			than any other online converter and if that isn't enough there is also our unique custom object and vehicle formats feature; so you can convert <strong>from</strong> anything <strong>to</strong> anything!<br /><br />
			convertFFS has been online since June 2009 and has since seen three major iterations - with the third confirming its place as the best object and vehicle converter around by introducting many innovative
			features such as custom object and vehicle formats as input formats, as well as just output formats (convertFFS has been supporting custom output formats since the start!) and our completely refreshless site that
			allows you to upload, configure and convert faster than any other online converter available today!
		</div>
	</div>
	<div id="inputObjectFormatChange" class="jsHide">
		<strong class="largeText">Change object input format</strong>
		<div class="addObjectFormats" id="_input_">
			<ul>
				<li class="li">SA-MP CreateObject</li>
				<li class="li">MTA 1.0 Object</li>
				<li class="li">MTA Race Object</li>
				<li class="li">Incognito's Streamer Plugin</li>
				<li class="li">YSI CreateDynamicObject</li>
				<li class="li">MTA 1.0 createObject</li>
				<li class="li">xObjects v1</li>
				<li class="li">xStreamer</li>
				<li class="li">Einstein's Object Streamer</li>
				<li class="li">MidoStream Object Streamer</li>
				<li class="li">Double-O-Objects</li>
				<li class="li">Fallout's Object Streamer</li>
				<li class="li">tAxI's Streamer Systems</li>
				<li class="li">rStreamer</li>
				<li class="li">pObjectStreams</li>
				<li class="li">Medit</li>
				<li class="li">Westie's SMD Streamer</li>
				<li class="li" style="font-weight:bold">Don't convert objects</li>
			</ul>
		</div>
		<div class="deleteModeHelp"></div>
		<a href="#cf" onClick="addObjectFormat();return false" class="blackText">Add custom format</a> &nbsp; &nbsp; <a href="#cf" class="deleteMode blackText" onClick="toggleDeleteMode();return false">Enter delete mode</a>
	</div>
	<div id="inputVehicleFormatChange" class="jsHide">
		<strong class="largeText">Change vehicle input format</strong>
		<div class="addVehicleFormats" id="_inputv_">
			<ul>
				<li class="li">MTA Race Spawnpoint</li>
				<li class="li">MTA 1.0 Vehicle</li>
				<li class="li">SA-MP AddStaticVehicleEx</li>
				<li class="li">SA-MP CreateVehicle</li>
				<li class="li">SA-MP AddStaticVehicle</li>
				<li class="li">Double-O-Vehicles</li>
				<li class="li">tAxI's Streamer Systems</li>
				<li class="li" style="font-weight:bold">Don't convert objects</li>
			</ul>
		</div>
		<div class="deleteModeHelp"></div>
		<a href="#cf" onClick="addVehicleFormat();return false" class="blackText">Add custom format</a> &nbsp; &nbsp; <a href="#cf" class="deleteMode blackText" onClick="toggleDeleteMode();return false">Enter delete mode</a>
	</div>
	<div id="outputObjectFormatChange" class="jsHide">
		<strong class="largeText">Change object output format</strong>
		<div class="addObjectFormats" id="_output_">
			<ul>
				<li class="li">SA-MP CreateObject</li>
				<li class="li">MTA 1.0 Object</li>
				<li class="li">MTA Race Object</li>
				<li class="li">Incognito's Streamer Plugin</li>
				<li class="li">YSI CreateDynamicObject</li>
				<li class="li">MTA 1.0 createObject</li>
				<li class="li">xObjects v1</li>
				<li class="li">xStreamer</li>
				<li class="li">Einstein's Object Streamer</li>
				<li class="li">MidoStream Object Streamer</li>
				<li class="li">Double-O-Objects</li>
				<li class="li">Fallout's Object Streamer</li>
				<li class="li">tAxI's Streamer Systems</li>
				<li class="li">rStreamer</li>
				<li class="li">pObjectStreams</li>
				<li class="li">Medit</li>
				<li class="li">Westie's SMD Streamer</li>
				<li class="li" style="font-weight:bold">Don't convert objects</li>
			</ul>
		</div>
		<div class="deleteModeHelp"></div>
		<a href="#cf" onClick="addObjectFormat();return false" class="blackText">Add custom format</a> &nbsp; &nbsp; <a href="#cf" class="deleteMode blackText" onClick="toggleDeleteMode();return false">Enter delete mode</a>
	</div>
	<div id="outputVehicleFormatChange" class="jsHide">
		<strong class="largeText">Change vehicle output format</strong>
		<div class="addVehicleFormats" id="_outputv_">
			<ul>
				<li class="li">MTA Race Spawnpoint</li>
				<li class="li">MTA 1.0 Vehicle</li>
				<li class="li">SA-MP AddStaticVehicleEx</li>
				<li class="li">SA-MP CreateVehicle</li>
				<li class="li">SA-MP AddStaticVehicle</li>
				<li class="li">Double-O-Vehicles</li>
				<li class="li">tAxI's Streamer Systems</li>
				<li class="li" style="font-weight:bold">Don't convert objects</li>
			</ul>
		</div>
		<div class="deleteModeHelp"></div>
		<a href="#cf" onClick="addVehicleFormat();return false" class="blackText">Add custom format</a> &nbsp; &nbsp; <a href="#cf" class="deleteMode blackText" onClick="toggleDeleteMode();return false">Enter delete mode</a>
	</div>
	<div id="changeDrawDistance" class="jsHide">
		<strong class="largeText">Change object draw-distance</strong><br /><br />
		<input id="drawDistance" type="text" value="250" maxlength="14" size="15"/><br /><br />
		<a href="#" onClick="$('#optionsDrawDistance').children('p').text('No change');$('#zoomClose').click();return false" class="blackText">
		Click here to keep the input value<br />(This will default to 250 if there is no current value found)</a><br />
	</div>
	<div id="changeRespawnTime" class="jsHide">
		<strong class="largeText">Change vehicle respawn time</strong><br /><br />
		<input id="respawnTime" type="text" value="15" maxlength="14" size="15"/><br /><br />
		<a href="#" onClick="$('#optionsRespawnTime').children('p').text('No change');$('#zoomClose').click();return false" class="blackText">
		Click here to keep the input value<br />(This will default to 15 if there is no current value found)</a><br />
	</div>
	<div id="changeObjectArray" class="jsHide">
		<strong class="largeText">Change object array</strong><br /><br />
		<input id="objectArray" type="text" value="exampleArray" maxlength="18" size="25"/><br /><br />
		<a href="#" onClick="$('#optionsObjectArray').children('p').text('No');$('#zoomClose').click();return false" class="blackText">
		Click here for no object array</a><br />
	</div>
	<div id="changeVehicleArray" class="jsHide">
		<strong class="largeText">Change vehicle array</strong><br /><br />
		<input id="vehicleArray" type="text" value="exampleArray" maxlength="18" size="25"/><br /><br />
		<a href="#" onClick="$('#optionsVehicleArray').children('p').text('No');$('#zoomClose').click();return false" class="blackText">
		Click here for no vehicle array</a><br />
	</div>
	<div id="changeVehicleColour1" class="jsHide">
		<strong class="largeText">Change vehicle colour one</strong><br /><br />
		<img src="images/vehicleColours.gif" alt="SA-MP and MTA vehicle colours grid" id="vehicleColourGrid1" />
		<br /><br /><input id="vehicleColour1Field" type="text" value="Custom value" maxlength="15" size="16"/>
	</div>
	<div id="changeVehicleColour2" class="jsHide">
		<strong class="largeText">Change vehicle colour two</strong><br /><br />
		<img src="images/vehicleColours.gif" alt="SA-MP and MTA vehicle colours grid" id="vehicleColourGrid2" />
		<br /><br /><input id="vehicleColour2Field" type="text" value="Custom value" maxlength="15" size="16"/>
	</div>
	<div id="qualityControl" class="jsHide">
		<strong class="largeText">What is this about?</strong><br /><br />
		<div style="text-align:left">
			convertFFS randomly selects conversions to have more data saved about them for quality control purposes. We will use this data to detect, and fix bugs and problems with convertFFS to make it better for everyone!<br /><br />
			As well as the data that we store about every single conversion (What formats you converted to and from, the amount of objects and vehicles converted and your IP address) we have stored one of your actual objects that you have converted - both before conversion and after conversion, and the same for vehicles.<br /><br />Are you worried about this data falling into the wrong hands? Don't worry, we will not share this data with anyone outside of convertFFS or serverFFS.<br /><br />If you still do not wish for your conversion to help everyone who uses convertFFS, then <a href="remove.php" class="blackText" style="text-decoration:underline">click here</a> and we will permanently remove it.
		</div>
	</div>
	<div id="changeLog" class="jsHide">
		<strong class="largeText">convertFFS changelog</strong><br /><br />
		<div style="overflow:auto;height:417px">
			<div id="clItem">
				<strong>05/09/2010</strong><br />
				Bug found by [GTA]Deadly_Evil where converting from MTA Race spawnpoint did not work fixed.
			</div>
			<div id="clItem">
				<strong>06/08/2010</strong><br />
				Bug found by Kar and saifo997 regarding irregular indentation on lines fixed.
			</div>
			<div id="clItem">
				<strong>26/07/2010</strong><br />
				Bug found by [Ask]Terminator and Alec_Rae was where semicolons were not encoded before being saved to cookies fixed.
			</div>
			<div id="clItem">
				<strong>20/07/2010</strong><br />
				Bug found by Doerfler regarding converting from any format to an MTA Race map. Same situation as [Ask]Terminator's bug.
			</div>
			<div id="clItem">
				<strong>18/07/2010</strong><br />
				The second bug found by Arrows73 has been fixed. This was that vehicle respawn time was read from the draw distance option due to a simple mistake.
			</div>
			<div id="clItem">
				<strong>18/07/2010</strong><br />
				Awesome new colour picker for vehicle colours! The size of the site's download has also been shrunk.
			</div>
			<div id="clItem">
				<strong>17/07/2010</strong><br />
				Modified the fix for the bug described below to be more robust. A minor bug fixed with the format auto selection.
			</div>
			<div id="clItem">
				<strong>17/07/2010</strong><br />
				Bug found by jonrb regarding output formats changing if you modify the input after choosing formats has been fixed.
			</div>
			<div id="clItem">
				<strong>16/07/2010</strong><br />
				This changelog added!
			</div>
			<div id="clItem">
				<strong>16/07/2010</strong><br />
				Various minor modifications and fixes to do with optimisation, uploading and aesthetics.
			</div>
			<div id="clItem">
				<strong>15/07/2010</strong><br />
				Bug fixes for the upload system.
			</div>
			<div id="clItem">
				<strong>14/07/2010</strong><br />
				Usability fixes - You can now click a link to keep an option the same, and the entirety of the option changing links are clickable, instead of only the value.
			</div>
			<div id="clItem">
				<strong>12/07/2010</strong><br />
				Bug found by Arrows73 regarding vehicle colours when converted from MTA 1.0 not saving has been fixed.
			</div>
			<div id="clItem">
				<strong>12/07/2010</strong><br />
				Bug found by [Ask]Terminator where rotations were not converted from euler to radians when converting to MTA Race has been fixed.
			</div>
		</div>
	</div>
	<div id="zoomOverlay"></div>
	<!--[if lte IE 6]>
		<div id="ie6">
			Internet Explorer 6 and lower are not supported by convertFFS.<br /><br />Please upgrade to a browser that respects web standards, like any of the browsers below.<br /><br /><a href="http://www.mozilla.org/firefox"><img src="images/firefox.jpg" alt="Mozilla Firefox" style="padding:5px"/></a><a href="http://www.google.com/chrome"><img src="images/chrome.jpg" alt="Google Chrome" style="padding:5px"/></a><br /><a href="http://www.apple.com/safari/"><img src="images/safari.jpg" alt="Safari" style="padding:5px"/></a><a href="http://www.opera.com/"><img src="images/opera.jpg" alt="Opera" style="padding:5px"/></a>
		</div>
	<![endif]-->
	<!--
	*
	* MAIN PAGE START
	*
	-->
	<div id="wrapper">
		<div id="dropDownContainer">
			<div id="dropDown">
				<div id="dropDownLeft">
					<strong class="medText">About convertFFS</strong><br />
					convertFFS is arguably the best object and vehicle converter out there for the GTA: San Andreas modifications SA-MP and MTA. (<a href="#about" id="aboutLink">Read more</a>)<br /><br />
					<a href="#changeLog" id="showChangeLog">Click here for our changelog</a>
				</div>
				<div id="dropDownRight">
					<strong class="medText">Contact convertFFS</strong><br />
					Found a bug? Have an idea? <a href="http://forum.sa-mp.com/member.php?u=12959">PM kc on the SA-MP forums!</a><br /><br />
				</div>
				<div id="dropDownCenter">
					<strong class="medText">convertFFS statistics</strong><br />
					<strong id="conversionsToday">(Loading)</strong> conversions today<br />
					<strong id="conversionsWeek">(Loading)</strong> conversions this week<br />
					<strong id="conversionsTotal">(Loading)</strong> conversions since June 2009<br />
					Average of <strong id="conversionsAverage">(Loading)</strong> conversions a minute!
				</div>
				<div id="dropDownClose">
					<div class="sprite close dropDownActivate"></div>
				</div>
			</div>
		</div>
			<div id="pageHeader" class="dropDownActivate">
				<div id="logo" class="sprite"></div>
			</div>
		<div id="pageContainer">
			<div style="text-align:center; width:auto; background:#d1ff9b; padding:5px; border-radius:5px; margin-top:9px; margin-bottom:3px; box-shadow:0px 3px 0px #94ca54;">
				<a style="color:#6daa25; font-size:14pt; text-shadow:0px -1px 1px #d0f2a7" href="#" target="_blank">Hopefully faster new server: Shouldn't be any problems but PM kc if there is!</a>
			</div>
			<div id="uploadLink">I want to upload instead of pasting!</div>
			<div id="inputArea">
				<div class="resizable">
					<textarea id="inputAreaElement" class="inputAreaElementBg" wrap="off"></textarea>
				</div>
			</div>
			<div id="inputBlock" class="spriteBg">
				<div id="inputSprite" class="sprite"></div>
				<a href="#inputObjectFormatChange" id="inputObjectFormat"><span id="inputObjectFormatText">MTA 1.0 Object</span> <p>change</p></a><br />
				<a href="#inputVehicleFormatChange" id="inputVehicleFormat"><span id="inputVehicleFormatText">MTA 1.0 Vehicle</span> <p>change</p></a>
			</div>
			<div id="optionsBlock" class="spriteBg">
				<div id="optionsSprite" class="sprite"></div>
				<div id="optionsBlockLeft">
					<a href="#changeDrawDistance" id="optionsDrawDistance">Draw-distance <p>250</p></a><br />
					<a href="#" onClick="return false" id="optionsComments">Add comments <p>Yes</p></a><br />
					<a href="#changeVehicleArray" id="optionsVehicleArray">Vehicles array <p>No</p></a><br />
					<a href="#changeVehicleColour1" id="vehicleColour1">Vehicle colour one <p>No change</p></a>
				</div>
				<div id="optionsBlockRight">
					<a href="#changeRespawnTime" id="optionsRespawnTime">Vehicle respawn time <p>15</p></a><br />
					<a href="#" onClick="return false" id="optionsScript">Add to SA-MP script <p>No</p></a><br />
					<a href="#changeObjectArray" id="optionsObjectArray">Objects array <p>No</p></a><br />
					<a href="#changeVehicleColour2" id="vehicleColour2">Vehicle colour two <p>No change</p></a>
				</div>
			</div>
			<div id="outputBlock" class="spriteBg">
				<div id="outputSprite" class="sprite"></div>
				<a href="#outputObjectFormatChange" id="outputObjectFormat"><span id="outputObjectFormatText">SA-MP CreateObject</span> <p>change</p></a><br />
				<a href="#outputVehicleFormatChange" id="outputVehicleFormat"><span id="outputVehicleFormatText">SA-MP AddStaticVehicleEx</span> <p>change</p></a>
			</div>
			<div id="convertButton" class="spriteBg">
				<div id="convertButtonSprite" class="sprite"></div>
			</div>
			<div id="reflection"></div>
		</div>
		<div id="pageContainerConverted">
			<div id="selectAllText">Select all of the output</div>
			<div id="outputArea">
				<div class="resizableTextarea">
					<textarea id="outputAreaElement" class="outputAreaElementWait" readonly="readonly" wrap="off"></textarea>
				</div>
			</div>
			<a href="#qualityControl" id="qualityControlLink" >
				<div id="qualityControlWarning" style="display:none" class="blackText">
					This conversion has been selected to have additional data stored about it for quality control purposes.<br />
					Click here to see exactly what data will be stored, and be given the option to remove this information.
				</div>
			</a>
			<a href="http://www.convertffs.com">
				<div id="convertMoreButton" class="spriteBg">
					<div id="convertMoreButtonSprite" class="sprite"></div>
				</div>
			</a>
			<div id="reflectionMore"></div>
		</div>
		<div id="wrapperPush"></div>
	</div>
	<div id="footer"></div>
	<div id="zoom" class="jsHide">
		<div id="vehicleColourTooltip"></div>
		<div id="zoomContent"></div>
		<div id="zoomClose" class="spriteBg">
			<div class="sprite close"></div>
		</div>
	</div>
	<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		try {
		var pageTracker = _gat._getTracker("UA-9224090-2");
		pageTracker._trackPageview();
		} catch(err) {}
	</script>
</body>
</html>

	var
		inputAreaContents,
		supportedInputFormatsObj = new Array(
			'SA-MP CreateObject',
						/CreateObject\(([0-9 ]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+)\);/,
						'Incognito\'s Streamer Plugin',
						'CreateObject({model},{x},{y},{z},{rx},{ry},{rz});{comment}',
			'MTA 1.0 Object',
						/<object(.+)pos(x|X)(.+)\/>/,
						'SA-MP CreateObject',
						'<object id="{comment}" model="{model}" posX="{x}" posY="{y}" posZ="{z}" rotX="{rx}" rotY="{ry}" rotZ="{rz}" dimension="{vw}" interior="{int}" />',
			'MTA Race Object',
						/position(.+)\/position/,
						'SA-MP CreateObject',
						'<object name="{comment}"><position>{x} {y} {z}</position><rotation>{rz} {ry} {rx}</rotation><model>{model}</model></object>',
			'Incognito\'s Streamer Plugin',
						/CreateDynamicObject\(([0-9 ]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+)\);/,
						'SA-MP CreateObject',
						'CreateDynamicObject({model},{x},{y},{z},{rx},{ry},{rz});{comment}',
			'YSI CreateDynamicObject',
						/CreateDynamicObject\(([0-9 ]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+)\);/,
						'SA-MP CreateObject',
						'CreateDynamicObject({model},{x},{y},{z},{rx},{ry},{rz});{comment}',
			'MTA 1.0 createObject',
						/createObject\(([0-9 ]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+)\)/,
						'SA-MP CreateObject',
						'createObject({model},{x},{y},{z},{rx},{ry},{rz}){comment}',
			'xObjects v1',
						/\{([0-9 ]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+)\}/,
						'SA-MP CreateObject',
						'{{model},{x},{y},{z},{rx},{ry},{rz},{dd}},{comment}',
			'xStreamer',
						/CreateStreamedObject\(([0-9 ]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+)\);/,
						'SA-MP CreateObject',
						'CreateStreamedObject({model},{x},{y},{z},{rx},{ry},{rz});{comment}',
			'Einstein\'s Object Streamer',
						/CreateObjectToStream\(([0-9 ]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+)\);/,
						'SA-MP CreateObject',
						'CreateObjectToStream({model},{x},{y},{z},{rx},{ry},{rz});{comment}',
			'MidoStream Object Streamer',
						/CreateStreamObject\(([0-9 ]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+)\);/,
						'SA-MP CreateObject',
						'CreateStreamObject({model},{x},{y},{z},{rx},{ry},{rz},{dd});{comment}',
			'Double-O-Objects',
						/CreateStreamObject\(([0-9 ]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+)\);/,
						'SA-MP CreateObject',
						'CreateStreamObject({model},{x},{y},{z},{rx},{ry},{rz},{dd},{vw});{comment}',
			'Fallout\'s Object Streamer',
						/F_CreateObject\(([0-9 ]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+)\);/,
						'SA-MP CreateObject',
						'F_CreateObject({model},{x},{y},{z},{rx},{ry},{rz});{comment}',
			'tAxI\'s Streamer Systems',
						/CreateStreamObject\(([0-9 ]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+)\);/,
						'SA-MP CreateObject',
						'CreateStreamObject({model},{x},{y},{z},{rx},{ry},{rz},{dd});{comment}',
			'rStreamer',
						/CreateStreamedObject\(([0-9 ]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+)\);/,
						'SA-MP CreateObject',
						'CreateStreamedObject({model},{x},{y},{z},{rx},{ry},{rz},{dd});{comment}',
			'pObjectStreams',
						/CreateDynamicObject\(([0-9 ]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+)\);/,
						'SA-MP CreateObject',
						'CreateDynamicObject({model},{x},{y},{z},{rx},{ry},{rz});{comment}',
			'Medit',
						/([0-9 ]+) ([0-9. -]+) ([0-9. -]+) ([0-9. -]+) ([0-9. -]+) ([0-9. -]+) ([0-9. -]+) E/,
						'Incognito\'s Streamer Plugin',
						'{model} {x} {y} {z} {rx} {ry} {rz} E',
			'Westie\'s SMD Streamer',
						/([0-9]+) ([0-9.-]+) ([0-9.-]+) ([0-9.-]+) ([0-9.-]+) ([0-9.-]+) ([0-9.-]+) ([0-9.-]+)/,
						'Incognito\'s Streamer Plugin',
						'{model} {x} {y} {z} {rx} {ry} {rz} {dd}'
						
						
		),
		supportedInputFormatsVeh = new Array(
			'MTA Race Spawnpoint',
						/<spawnpoint(.*?)>(.+)<\/spawnpoint>/,
						'SA-MP AddStaticVehicleEx',
						'<spawnpoint name="{comment}"><vehicle>{model}</vehicle><position>{x} {y} {z}</position><rotation>{r}</rotation></spawnpoint>',
			'MTA 1.0 Vehicle',
						/<vehicle(.+)pos(x|X)(.+)\/>/,
						'SA-MP AddStaticVehicleEx',
						'<vehicle model="{model}" posX="{x}" posY="{y}" posZ="{z}" rotX="{rx}" rotY="{ry}" rotZ="{r}" color="{c1},{c2}" />',
			'SA-MP AddStaticVehicleEx',
						/AddStaticVehicleEx\(([0-9 ]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9 -]+),([0-9 ]+)\);/,
						'SA-MP CreateVehicle',
						'AddStaticVehicleEx({model},{x},{y},{z},{r},{c1},{c2},{respawn});{comment}',
			'SA-MP CreateVehicle',
						/CreateVehicle\(([0-9 ]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9 -]+),([0-9 ]+)\);/,
						'SA-MP AddStaticVehicleEx',
						'CreateVehicle({model},{x},{y},{z},{r},{c1},{c2},{respawn});{comment}',
			'SA-MP AddStaticVehicle',
						/AddStaticVehicle\(([0-9 ]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9 -]+)\);/,
						'SA-MP CreateVehicle',
						'AddStaticVehicle({model},{x},{y},{z},{r},{c1},{c2});{comment}',
			'Double-O-Vehicles',
						/CreateStreamVehicle\(([0-9 ]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+)\);/,
						'SA-MP CreateVehicle',
						'CreateStreamVehicle({model},{x},{y},{z},{r},{c1},{c2},{respawn});{comment}',
			'tAxI\'s Streamer Systems',
						/CreateStreamVehicle\(([0-9 ]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+),([0-9. -]+)\);/,
						'SA-MP CreateVehicle',
						'CreateStreamVehicle({model},{x},{y},{z},{r},{c1},{c2});{comment}'
		),
		customObjectFormats = new Array(),
		customVehicleFormats = new Array(),
		inputAreaElement,
		outputFormatStick = new Array( false, false );
		
	$(document).ready(function(){
		$( '#loading' ) . remove( );
		$( '.jsHide' ) . css( { 'display' : 'none' } );
		inputAreaElement =  $('#inputAreaElement');
		$('#inputObjectFormat').fancyZoom({width: '350', height: '500'});
		$('#outputObjectFormat').fancyZoom({width: '350', height: '500'});
		$('#inputVehicleFormat').fancyZoom({width: '350', height: '500'});
		$('#outputVehicleFormat').fancyZoom({width: '350', height: '500'});

		$('#aboutLink').fancyZoom({width: '350', height: '500'});
		
		$('#optionsDrawDistance').fancyZoom({width: '350', height: '182'});
		$('#optionsRespawnTime').fancyZoom({width: '350', height: '182'});
		
		$('#optionsObjectArray').fancyZoom({width: '350', height: '172'});
		$('#optionsVehicleArray').fancyZoom({width: '350', height: '172'});
		
		$('#vehicleColour1').fancyZoom({width: '350', height: '340'});
		$('#vehicleColour2').fancyZoom({width: '350', height: '340'});
		
		$('#qualityControlLink').fancyZoom({width: '350', height: '500'});

		$('#showChangeLog').fancyZoom({width: '350', height: '500'});
		
		$('textarea').textAreaResizer();
		inputAreaElement.val('');
		
		if(ieVersion != 0)
		{
			showMessage('Browser incompatibility error', 'We have detected that you are using a deprecated browser to surf the internet.<br /><br />While this site may still function correctly, it will not be shown in your browser as we intended; with aesthetic and usability problems as well as missing features.<br /><br />It is recommended that you upgrade to a browser that respects web standards, like any of the browsers below.<br /><br /><a href="http://www.mozilla.org/firefox"><img src="images/firefox.jpg" alt="Mozilla Firefox"/></a><a href="http://www.google.com/chrome"><img src="images/chrome.jpg" alt="Google Chrome"/></a><br /><a href="http://www.apple.com/safari/"><img src="images/safari.jpg" alt="Safari"/></a><a href="http://www.opera.com/"><img src="images/opera.jpg" alt="Opera"/></a>',475);
			if(ieVersion == 7)
			{
				$('#dropDownContainer').css({'top':'-200px','width':'0px'});
			}
			if(ieVersion > 6)
			{
				$('#uploadLink').click(function(){
					alert('File uploading is not available in your deprecated browser. Please upgrade!');
				});
			}
		}
		else
		{
			new AjaxUpload('uploadLink', {action: 'upload.php', onSubmit: function() { uploadSubmit(); }, onComplete: function(file, response) {uploadComplete(file, response)} });	
		}
		
		$.get('fetchstats.php',function(data)
		{
			var
				counts = data.split('|');
			$('#conversionsToday').html(counts[0]);
			$('#conversionsWeek').html(counts[1]);
			$('#conversionsTotal').html(counts[2]);
			$('#conversionsAverage').html(counts[3]);
		});


        createCookie('FFS', 'Testing for cookies');
        if(readCookie('FFS') == null)
		{
			showMessage('You have disabled cookies', 'Some features on convertFFS require cookies to operate correctly.', 160);
		}
		eraseCookie('FFS');
		var
			temp;
		if(((temp = readCookie('COF'))) != null)
		{
			if(temp != '')
			{
				temp = temp.split('~');
				for(var i = 0; i < temp.length; ++i)
					customObjectFormats.push(temp[i]);
			}
		}
		if(((temp = readCookie('CVF'))) != null)
		{
			if(temp != '')
			{
				temp = temp.split('~');
				for(var i = 0; i < temp.length; ++i)
					customVehicleFormats.push(temp[i]);
			}
		}
		
		var temp;
		if(((temp = readCookie('CSF'))) != null && temp != '')
		{
			temp = temp.split('~');
			if(getObjectFormat(temp[0]) == '~NOT~FOUND~' || getVehicleFormat(temp[1]) == '~NOT~FOUND~' || getObjectFormat(temp[2]) == '~NOT~FOUND~' || getVehicleFormat(temp[3]) == '~NOT~FOUND~')
			{
				eraseCookie('CSF');
			}
			else
			{
				$('#inputObjectFormatText').html(temp[0]);
				$('#inputVehicleFormatText').html(temp[1]);
				$('#outputObjectFormatText').html(temp[2]);
				$('#outputVehicleFormatText').html(temp[3]);
			}
		}
		
		if(document.documentElement.clientHeight < 561)
		{
			$('#wrapper').css({margin : '0em auto 0px'});
			$('#wrapperPush, #footer').css({height : '0px'});
		}
		
		updateObjectFormatList();
		updateVehicleFormatList();
		
		$('li').live('click',function()
		{
			$('.liSelected').each(function()
			{
				$(this).removeClass('liSelected').addClass('li');
			});
			$(this).removeClass('li').addClass('liSelected');
			if($('.deleteMode').html() == 'Leave delete mode')
			{
				if(confirm("Are you sure you want to delete this custom format?"))
				{
					removeCustomFormat($(this));
				}
				return;
			}
			switch($(this).parent().attr('id'))
			{
				case '_input_':
					if($('#outputObjectFormatText').html() == 'Don\'t convert objects')
						$('#outputObjectFormatText').html('SA-MP CreateObject');
					if($(this).html() == 'Don\'t convert objects')
						$('#outputObjectFormatText').html($(this).html());
					$('#inputObjectFormatText').html($(this).html());
					break;
				case '_inputv_':
					if($('#outputVehicleFormatText').html() == 'Don\'t convert vehicles')
						$('#outputVehicleFormatText').html('SA-MP AddStaticVehicleEx');
					if($(this).html() == 'Don\'t convert vehicles')
						$('#outputVehicleFormatText').html($(this).html());
					$('#inputVehicleFormatText').html($(this).html());
					break;
				case '_output_':
					if($('#inputObjectFormatText').html() == 'Don\'t convert objects')
						$('#inputObjectFormatText').html('MTA 1.0 object');
					if($(this).html() == 'Don\'t convert objects')
						$('#inputObjectFormatText').html($(this).html());
					$('#outputObjectFormatText').html($(this).html());
					outputFormatStick[ 0 ] = true;
					break;
				case '_outputv_':
					if($('#inputVehicleFormatText').html() == 'Don\'t convert vehicles')
						$('#inputVehicleFormatText').html('MTA 1.0 vehicle');
					if($(this).html() == 'Don\'t convert vehicles')
						$('#inputVehicleFormatText').html($(this).html());
					$('#outputVehicleFormatText').html($(this).html());
					outputFormatStick[ 1 ] = true;
					break;
			}
			$('#zoomClose').click();
		});
		
		$('#drawDistance').live('keyup',function(){
			if($(this).val() != '' && $(this).val().length <= 14)
				$('#optionsDrawDistance p').text($(this).val());
			else
				$('#optionsDrawDistance p').text('No change');
		});
		
		$('#respawnTime').live('keyup',function(){
			if($(this).val() != '' && $(this).val().length <= 14)
				$('#optionsRespawnTime p').text($(this).val());
			else
				$('#optionsRespawnTime p').text('No change');
		});
		
		$('#objectArray').live('keyup',function(){
			if($(this).val() != '' && $(this).val().length <= 18)
				$('#optionsObjectArray p').text($(this).val()+'[]');
			else
				$('#optionsObjectArray p').text('No');
		});
		
		$('#vehicleArray').live('keyup',function(){
			if($(this).val() != '' && $(this).val().length <= 18)
				$('#optionsVehicleArray p').text($(this).val()+'[]');
			else
				$('#optionsVehicleArray p').text('No');
		});
		
		$('#vehicleColour1Field').live('keyup',function(){
			if($(this).val() != '' && $(this).val().length <= 19)
				$('#vehicleColour1 p').text($(this).val());
			else
				$('#vehicleColour1 p').text('No change');
		});
		
		$('#vehicleColour2Field').live('keyup',function(){
			if($(this).val() != '' && $(this).val().length <= 19)
				$('#vehicleColour2 p').text($(this).val());
			else
				$('#vehicleColour2 p').text('No change');
		});
		
		$('#selectAllText').click(function(){
			$('#outputAreaElement').select();
		});
		
		var
			comment = new Array(
				'Yes',
				'No'
			),
			commentIndex = 0;
		$('#optionsComments').click(function(){
			++commentIndex;
			if(commentIndex == 2)
				commentIndex = 0;
			$('#optionsComments p').text(comment[commentIndex]);
		});
		var
			script = new Array(
				'No',
				'Gamemode',
				'Filterscript'
			),
			scriptIndex = 0;
		$('#optionsScript').click(function(){
			++scriptIndex;
			if(scriptIndex == 3)
				scriptIndex = 0;
			$('#optionsScript p').text(script[scriptIndex]);
		});
		
		$('.dropDownActivate').click(function(){
			if(ieVersion == 7)
			{
				alert('This feature is not available in your deprecated browser. Please upgrade!');
				return;
			}
			if($('#dropDownContainer').css('top') == '-160px')
				$('#dropDownContainer').animate({'top' : '0px'}, 500);
			else
				$('#dropDownContainer').animate({'top' : '-160px'}, 500);
			return;
		});

		inputAreaElement.focus(function(){
			inputAreaElement.removeClass("inputAreaElementBg");
		})
		.blur(function(){
			if(inputAreaElement.val() == '')
				inputAreaElement.addClass("inputAreaElementBg");							 
		})
		.keyup(function(){
				formatUpdate();
		})
		.bind('drop', function(ev) {
			if(inputAreaElement.val() != '')
				inputAreaElement.removeClass("inputAreaElementBg");								   
		});
		$('#convertMoreButton').hover(function(){
				$('#reflectionMore').css({'background-position':'0px -161px'});
		},function(){
			$('#reflectionMore').css({'background-position':'0px -107px'});
		});
		$('#convertButton').hover(function(){
				$('#reflection').css({'background-position':'0px -53px'});
		},function(){
			$('#reflection').css({'background-position':'0px 0px'});
		}).click(function(){
			if($('#inputAreaElement').val() == '')
			{
				showMessage('Convert error','You need to place the objects you wish to convert into the textarea marked "Paste here", or use the upload link to upload your objects before converting.',200);
				return;
			}
			$('#pageContainer').fadeOut('fast',function(){
				$('#pageContainerConverted').fadeIn('fast');
			});
			$('#outputAreaElement').val('');
			var qualityControl = 'No';
			if(Math.random() < 0.10)
			{
				qualityControl = 'Yes';
				$('#qualityControlWarning').show();
			}
			$.post('convert.php',{
				'INPUT_OBJECT':getObjectFormat($('#inputObjectFormatText').html()),
				'INPUT_VEHICLE':getVehicleFormat($('#inputVehicleFormatText').html()),
				'OUTPUT_OBJECT':getObjectFormat($('#outputObjectFormatText').html()),
				'OUTPUT_VEHICLE':getVehicleFormat($('#outputVehicleFormatText').html()),
				'DRAW_DISTANCE':$('#optionsDrawDistance p').text(),
				'VEHICLE_RESPAWN_TIME':$('#optionsRespawnTime p').text(),
				'COMMENT_BEHAVIOUR':$('#optionsComments p').text(),
				'ADD_TO_SAMP_SCRIPT':$('#optionsScript p').text(),
				'VEHICLE_ARRAY':$('#optionsVehicleArray p').text(),
				'OBJECT_ARRAY':$('#optionsObjectArray p').text(),
				'VEHICLE_COLOUR_1':$('#vehicleColour1 p').text(),
				'VEHICLE_COLOUR_2':$('#vehicleColour2 p').text(),
				'QUALITY_CONTROL':qualityControl,
				'INPUT':$('#inputAreaElement').val()
			}, function(response)
			{
				createCookie('CSF', $('#inputObjectFormatText').html()+'~'+
									$('#inputVehicleFormatText').html()+'~'+
									$('#outputObjectFormatText').html()+'~'+
									$('#outputVehicleFormatText').html(), 365);
				if(response == '~ERROR~')
				{
					
					showMessage('Convert error','An unspecified error has occurred. Please try again in a few minutes.',200);
					$('#outputAreaElement').removeClass('outputAreaElementWait').css({'background':'#fff'});
					return;
				}
				if(response == '~XML~ERROR~')
				{
					showMessage('Convert error','Your MTA map is corrupt beyond what convertFFS can manage at the moment. We hope to be able to repair some files in the future, so try again soon!',200);
					$('#outputAreaElement').removeClass('outputAreaElementWait').css({'background':'#fff'});
					return;						
				}
				$('#outputAreaElement').val(response);
				$('#outputAreaElement').removeClass('outputAreaElementWait').css({'background':'#fff'});
			}).fail(function(data){
				console.log(data);
			});
		});

		var offset;
		$( '#vehicleColourGrid1,#vehicleColourGrid2' ) . live( 'mouseover', function( )
		{
			offset = $( this ) . offset( );
			offset . top = Math . round( offset . top - 40 );
			offset . left = Math . round( offset . left - 60 );
			$( '#vehicleColourTooltip' ) . css( { 'display' : 'block' } );
			
		} ) . live( 'mousemove', function( e )
		{
			var top = ( e . clientY - offset . top ),
				left = ( e. clientX - offset . left ),
				colorCode = ( 15 * ( ( ( top - (top % 20) ) / 20 ) - 2 ) ) + ( ( ( left - (left % 20) ) / 20 ) - 3 ),
				tooltipDiv = $( '#vehicleColourTooltip' );
			if( colorCode > 130 )
			{
				tooltipDiv . css( { 'font-size' : '15px' } );
				colorCode = 'No change';
			}
			else
			{
				tooltipDiv . css( { 'font-size' : '30px' } );
			}
			if( colorCode > 126 )
			{
				colorCode = '-1';
			}
			$( '#vehicleColourTooltip' ) . css( { 'top' : ( top - 50 ) + 'px', 'left' : ( left - 60 ) + 'px' } ) .
			html( colorCode );

		} ) . live( 'mouseout', function( )
		{
			$( '#vehicleColourTooltip' ) . css( { 'display' : 'none' } );
		} ) . live( 'click', function( )
		{
			if( $( this ) . attr( 'id' ) == 'vehicleColourGrid1' )
			{
				$( '#vehicleColour1 p' ) . text( $( '#vehicleColourTooltip' ) . html( ) );
			}
			else
			{
				$( '#vehicleColour2 p' ) . text( $( '#vehicleColourTooltip' ) . html( ) );
			}
			$( '#zoomClose' ) . click( );
		} );
	});
	
	function formatUpdate( )
	{
		inputAreaContents = inputAreaElement.val( );
		var
			i = 1,
			inputObjFormatTxt = $('#inputObjectFormatText'),
			outputObjFormatTxt = $('#outputObjectFormatText'),
			inputVehFormatTxt = $('#inputVehicleFormatText'),
			outputVehFormatTxt = $('#outputVehicleFormatText');
		for(; i < supportedInputFormatsObj.length; i += 4)
		{
			if(inputAreaContents.search(supportedInputFormatsObj[i]) != -1)
			{
				inputObjFormatTxt.html(supportedInputFormatsObj[i-1]);
				if( outputFormatStick[ 0 ] )
				{
					break;
				}
				var temp;
				if(((temp = readCookie('CSF'))) != null && temp != '')
				{
					temp = temp.split('~');
					if(temp[0] != supportedInputFormatsObj[i-1])
					{
						outputObjFormatTxt.html(supportedInputFormatsObj[i+1]);
					}
				}
				else
				{
					outputObjFormatTxt.html(supportedInputFormatsObj[i+1]);
				}
				break;
			}
		}
		i = 1;
		for(; i < supportedInputFormatsVeh.length; i += 4)
		{
			if(inputAreaContents.search(supportedInputFormatsVeh[i]) != -1)
			{
				inputVehFormatTxt.html(supportedInputFormatsVeh[i-1]);
				if( outputFormatStick[ 1 ] )
				{
					break;
				}
				var temp;
				if(((temp = readCookie('CSF'))) != null && temp != '')
				{
					temp = temp.split('~');
					if(temp[1] != supportedInputFormatsVeh[i-1])
					{
						outputVehFormatTxt.html(supportedInputFormatsVeh[i+1]);
					}
				}
				else
				{
					outputVehFormatTxt.html(supportedInputFormatsVeh[i+1]);
				}
				break;
			}
		}	
		return;
	}
	function createCookie(name,value,days) {
		if (days) {
			var date = new Date();
			date.setTime(date.getTime()+(days*24*60*60*1000));
			var expires = "; expires="+date.toGMTString();
		}
		else var expires = "";
		document.cookie = name + '=' + encodeURIComponent( value ) + expires + '; path=/';
	}
	
	function readCookie(name) {
		var
			nameEQ = name + '=',
			ca = document.cookie.split(';'),
			c;
		for(var i = 0;i < ca.length;++i) {
			c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return decodeURIComponent( c.substring(nameEQ.length,c.length) );
		}
		return null;
	}
	
	function eraseCookie(name) {
		createCookie(name,"",-1);
	}
	
	function addObjectFormat() {
		var
			width = window.innerWidth || (window.document.documentElement.clientWidth || window.document.body.clientWidth),
			height = window.innerHeight || (window.document.documentElement.clientHeight || window.document.body.clientHeight),
			x = window.pageXOffset || (window.document.documentElement.scrollLeft || window.document.body.scrollLeft),
			y = window.pageYOffset || (window.document.documentElement.scrollTop || window.document.body.scrollTop),
			windowSize = {'width':width, 'height':height, 'x':x, 'y':y},
			newTop = Math.max((windowSize.height/2) - (300/2) + y, 0),
			newLeft = (windowSize.width/2) - (550/2);
		$('#addObjectFormat').css({
			top: newTop + 'px',
      		left: newLeft + 'px',
			width: 550,
			height: 317
		}).fadeIn(300);
		$('#formatOverlay').show();
	}
	
	function addVehicleFormat() {
		var
			width = window.innerWidth || (window.document.documentElement.clientWidth || window.document.body.clientWidth),
			height = window.innerHeight || (window.document.documentElement.clientHeight || window.document.body.clientHeight),
			x = window.pageXOffset || (window.document.documentElement.scrollLeft || window.document.body.scrollLeft),
			y = window.pageYOffset || (window.document.documentElement.scrollTop || window.document.body.scrollTop),
			windowSize = {'width':width, 'height':height, 'x':x, 'y':y},
			newTop = Math.max((windowSize.height/2) - (300/2) + y, 0),
			newLeft = (windowSize.width/2) - (550/2);
		$('#addVehicleFormat').css({
			top: newTop + 'px',
      		left: newLeft + 'px',
			width: 550,
			height: 300
		}).fadeIn(300);
		$('#formatOverlay').show();
	}
	
	function processAddObjectFormat() {
		var
			exists = false;
		for(var i = 0; i < customObjectFormats.length; i+=2)
		{
			if(customObjectFormats[i] == $('#addObjectFormatFieldName').val())
			{
				exists = true;
				break;
			}
		}
		for(var i = 0; i < customVehicleFormats.length; i+=2)
		{
			if(customVehicleFormats[i] == $('#addObjectFormatFieldName').val())
			{
				exists = true;
				break;
			}
		}
		
		if(exists)
		{
			alert('You already have a custom format with that name - Custom formats must be uniquely named.');
			return false;
		}
		
		var
			temp;
		if(((temp = readCookie('COF'))) == null || temp == '')
		{
			createCookie('COF', $('#addObjectFormatFieldName').val()+'~'+$('#addObjectFormatField').val(),365);
		}
		else
		{
			createCookie('COF', temp+'~'+$('#addObjectFormatFieldName').val()+'~'+$('#addObjectFormatField').val(),365);	
		}
		$('#addObjectFormat').fadeOut(300);
		$('#formatOverlay').hide();
		customObjectFormats.push($('#addObjectFormatFieldName').val());
		customObjectFormats.push($('#addObjectFormatField').val());		
		updateObjectFormatList();
	}
	
	function processAddVehicleFormat() {
		var
			exists = false;
		for(var i = 0; i < customObjectFormats.length; i+=2)
		{
			if(customObjectFormats[i] == $('#addObjectFormatFieldName').val())
			{
				exists = true;
				break;
			}
		}
		for(var i = 0; i < customVehicleFormats.length; i+=2)
		{
			if(customVehicleFormats[i] == $('#addObjectFormatFieldName').val())
			{
				exists = true;
				break;
			}
		}
		
		if(exists)
		{
			alert('You already have a custom format with that name - Custom formats must be uniquely named.');
			return false;
		}
		
		var
			temp;
		if(((temp = readCookie('CVF'))) == null || temp == '')
		{
			createCookie('CVF', $('#addVehicleFormatFieldName').val()+'~'+$('#addVehicleFormatField').val(),365);
		}
		else
		{
			createCookie('CVF', temp+'~'+$('#addVehicleFormatFieldName').val()+'~'+$('#addVehicleFormatField').val(),365);	
		}
		$('#addVehicleFormat').fadeOut(300);
		$('#formatOverlay').hide();
		customVehicleFormats.push($('#addVehicleFormatFieldName').val());
		customVehicleFormats.push($('#addVehicleFormatField').val());
		updateVehicleFormatList();
	}
	
	function toggleDeleteMode() {
		var
			selector = $('.deleteMode');
		if(selector.html() == 'Enter delete mode')
		{
			selector.html('Leave delete mode');
			$('.deleteModeHelp').html('Click on a custom format to delete it.');
			flashText($('.deleteModeHelp'),2);
		}
		else
		{
			$('.deleteModeHelp').html('');
			selector.html('Enter delete mode');
		}
	}
	
	function flashText(ele,count)
	{
		if(ele.css('opacity') == '0.5')
		{
			ele.fadeTo(200,1);
			setTimeout(function()
			{
				--count;
				if(count != 0)
					flashText(ele,count);
			},230);
		}
		else
		{
			ele.fadeTo(200,0.5);
			setTimeout(function()
			{
				flashText(ele,count);
			},230);
		}
	}
	
	function removeCustomFormat(format) {
		var
			done = false;
		for(var i = 0; i < customObjectFormats.length; i+=2)
		{
			if('Custom - '+customObjectFormats[i] == format.html())
			{
				customObjectFormats.splice(i,2);
				format.html(supportedInputFormatsObj[0]);
				done = true;
				break;
			}
		}
		for(var i = 0; i < customVehicleFormats.length; i+=2)
		{
			if('Custom - '+customVehicleFormats[i] == format.html())
			{
				customVehicleFormats.splice(i,2);
				format.html(supportedInputFormatsVeh[0]);
				done = true;
				break;
			}
		}
		if(done)
		{
			createCookie('CVF', customVehicleFormats.join('~'), 365);
			updateVehicleFormatList();
			createCookie('COF', customObjectFormats.join('~'), 365);
			updateObjectFormatList();
		}
		else
		{
			alert('The selected format can\'t be removed.');
		}
	}
	function getObjectFormat(name)
	{
		var
			format = '~NOT~FOUND~';
		if(name == "Don't convert objects")
		{
			return '~NO~CONVERT~';	
		}
		if(name.search(/Custom - /) == -1)
		{
			for(var i = 0; i < supportedInputFormatsObj.length; i+=4)
			{
				if(supportedInputFormatsObj[i] == name)
				{
					format = supportedInputFormatsObj[i+3];
					break;
				}
			}
			return format;
		}
		for(var i = 0; i < customObjectFormats.length; i+=2)
		{
			if('Custom - '+customObjectFormats[i] == name)
			{
				format = customObjectFormats[i+1];
				break;
			}
		}
		return format;
	}
	function getVehicleFormat(name)
	{
		var
			format = '~NOT~FOUND~';
		if(name == "Don't convert objects")
		{
			return '~NO~CONVERT~';	
		}
		if(name.search(/Custom - /) == -1)
		{
			for(var i = 0; i < supportedInputFormatsVeh.length; i+=4)
			{
				if(supportedInputFormatsVeh[i] == name)
				{
					format = supportedInputFormatsVeh[i+3];
					break;
				}
			}
			return format;
		}
		for(var i = 0; i < customVehicleFormats.length; i+=2)
		{
			if('Custom - '+customVehicleFormats[i] == name)
			{
				format = customVehicleFormats[i+1];
				break;
			}
		}
		return format;
	}
	
	function updateObjectFormatList() {
		$('.addObjectFormats').each(function()
		{
			var div = $(this);
			div.html('');
			div.append('<ul>');
			for(var i = 0; i < supportedInputFormatsObj.length; i += 4)
			{
				div.append('<li class="li">'+supportedInputFormatsObj[i]+'</li>');
			}
			div.append('<li class="li" style="font-weight:bold">Don\'t convert objects</li>');
			for(var i = 0; i < customObjectFormats.length; i += 2)
			{
				div.append('<li class="li">Custom - '+customObjectFormats[i]+'</li>');
			}
			div.append('</ul>');
		});
	}
	
	function updateVehicleFormatList() {
		$('.addVehicleFormats').each(function()
		{
			var div = $(this);
			div.html('');
			div.append('<ul>');
			for(var i = 0; i < supportedInputFormatsVeh.length; i += 4)
			{
				div.append('<li class="li">'+supportedInputFormatsVeh[i]+'</li>');
			}
			div.append('<li class="li" style="font-weight:bold">Don\'t convert vehicles</li>');
			for(var i = 0; i < customVehicleFormats.length; i += 2)
			{
				div.append('<li class="li">Custom - '+customVehicleFormats[i]+'</li>');
			}
			div.append('</ul>');
		});			
	}
	
	function uploadSubmit() {
		$('#inputAreaElement').addClass('inputAreaElementUpload');
	}
	
	function uploadComplete(file, response) {
		$('#inputAreaElement').removeClass('inputAreaElementUpload');
		if(response == '~UNSUPPORTED~')
		{
			showMessage('Upload error','The file format you attempted to upload is not supported.',180);
			return;
		}
		if(response == '~SIZE~')
		{
			showMessage('Upload error','The size of the file you attempted to upload was greater than the maximum size of 200kb.',200);
			return;
		}
		if(response == '~ERROR~')
		{
			showMessage('Upload error','An unspecified error has occurred. This may be a temporary glitch, or your browser may not support this feature correctly.',220);
			return;	
		}
		$('#inputAreaElement').focus().val(response);
		formatUpdate();
	}
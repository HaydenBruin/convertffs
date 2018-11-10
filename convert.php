<?php
	/**
	*
	* convertFFS.com
	*
	* This puts all of the classes together into the finished product.
	*
	*/
	
	error_reporting(E_ALL);
	require("website-database.php");
	
	//Checking if it is just someone dicking around on convert.php instead of actually converting.
	if( !isset( $_POST[ 'INPUT' ] ) && !isset( $_POST[ 'INPUT_OBJECT' ] ) && !isset( $_POST[ 'OUTPUT_OBJECT' ] ) )
	{
		header( "Location: tsk.html" );
		die( );
	}
/*
	if( isset( $_POST [ "INPUT_OBJECT" ] ) )
	{
		$_POST[ 'INPUT_OBJECT' ] = $_POST[ "INPUT_OBJECT" ];
	}
*/	

	//print_r( $_POST );


	//Setting the content type to plain text to prevent some odd HTML rendering engine behaviour.
	header( 'Content-type: text/plain' );
	set_time_limit( 1000 );
	
	//Start timekeeping.
	$timeStart = microtime( true );
	
	//Variables for quality control.
	$inputObjectLine = '';
	$outputObjectLine = '';
	$inputVehicleLine = '';
	$outputVehicleLine = '';

	//Suppressing XML errors
	libxml_use_internal_errors( true );

	//Including required classes
	require_once( 'php/input.php' );
	require_once( 'php/xml.php' );
	require_once( 'php/output.php' );
	
	//Loading the XML class.
	$xml = new XML( );
	
	//Loading the Input class.
	$input = new Input( );
	
	//Loading the Output class.
	$output = new Output( );
	
	//Checking, and processing objects if they are MTA Race
	if( ( $processedInput = $xml->processMTARaceObjects( $_POST[ 'INPUT_OBJECT' ], $_POST[ 'INPUT' ] ) ) !== false )
	{
		//This is MTA Race, so the rotations need to be converted.
		//$input->setRotationConversion( 'toEulers' );
		//Setting the object custom format to the internal MTA type.
		$_POST[ 'INPUT_OBJECT' ] = $xml->objectCustomFormat;
		//Adding the processed objects to the raw input.
		$_POST[ 'INPUT' ] = sprintf( "%s\r\n\r\n%s", $processedInput, $_POST[ 'INPUT' ] );
	}
	//Checking, and processing vehicles if they are MTA Race
	if( ( $processedInput = $xml->processMTARaceVehicles( $_POST[ 'INPUT_VEHICLE' ], $_POST[ 'INPUT' ] ) ) !== false )
	{
		//Setting the vehicle custom format to the internal MTA type.
		$_POST[ 'INPUT_VEHICLE' ] = $xml->vehicleCustomFormat;
		//Adding the processed vehicles to the raw input.
		$_POST[ 'INPUT' ] = sprintf( "%s\r\n\r\n%s", $processedInput, $_POST[ 'INPUT' ] );	
	}
	//Checking, and processing objects if they are MTA 1.0
	if( ( $processedInput = $xml->processMTA10Objects( $_POST[ 'INPUT_OBJECT' ], $_POST[ 'INPUT' ] ) ) !== false )
	{
		//Setting the object custom format to the internal MTA type.
		$_POST[ 'INPUT_OBJECT' ] = $xml->objectCustomFormat;
		//Adding the processed objects to the raw input.
		$_POST[ 'INPUT' ] = sprintf( "%s\r\n\r\n%s", $processedInput, $_POST[ 'INPUT' ] );
	}
	//Checking, and processing vehicles if they are MTA 1.0
	if( ( $processedInput = $xml->processMTA10Vehicles( $_POST[ 'INPUT_VEHICLE' ], $_POST[ 'INPUT' ] ) ) !== false )
	{
		//Setting the vehicle custom format to the internal MTA type.
		$_POST[ 'INPUT_VEHICLE' ] = $xml->vehicleCustomFormat;
		//Adding the processed vehicles to the raw input.
		$_POST[ 'INPUT' ] = sprintf( "%s\r\n\r\n%s", $processedInput, $_POST[ 'INPUT' ] );
	}
	
	//Setting the input formats
	$input->setObjectFormat( $_POST[ 'INPUT_OBJECT' ] );
	$input->setVehicleFormat( $_POST[ 'INPUT_VEHICLE' ] );
	
	//Setting the output formats
	$output->setObjectFormat( $_POST[ 'OUTPUT_OBJECT' ] );
	$output->setVehicleFormat( $_POST[ 'OUTPUT_VEHICLE' ] );

	//Do we need to convert rotations to support 
	if( $_POST[ 'OUTPUT_OBJECT' ] == '<object name=\"{comment}\"><position>{x} {y} {z}</position><rotation>{rz} {ry} {rx}</rotation><model>{model}</model></object>' &&
		$_POST[ 'INPUT_OBJECT' ] !=  '<object name=\"{comment}\"><position>{x} {y} {z}</position><rotation>{rz} {ry} {rx}</rotation><model>{model}</model></object>')
	{
		$input->setRotationConversion( 'toRadians' );
	}
	
	//Setting the output settings
	$output->setConvertOptions( array( 
									'DRAW_DISTANCE' => $_POST[ 'DRAW_DISTANCE' ],
									'VEHICLE_RESPAWN_TIME' => $_POST[ 'VEHICLE_RESPAWN_TIME' ],
									'COMMENT_BEHAVIOUR' => $_POST[ 'COMMENT_BEHAVIOUR' ],
									'ADD_TO_SAMP_SCRIPT' => $_POST[ 'ADD_TO_SAMP_SCRIPT' ],
									'VEHICLE_ARRAY' => $_POST[ 'VEHICLE_ARRAY' ],
									'OBJECT_ARRAY' => $_POST[ 'OBJECT_ARRAY' ],
									'VEHICLE_COLOUR_1' => $_POST[ 'VEHICLE_COLOUR_1' ],
									'VEHICLE_COLOUR_2' => $_POST[ 'VEHICLE_COLOUR_2' ]
								) );
	
	//If the user has selected the "Add to SA-MP script" option, echo the top half of that here.
	echo $output->additionsTop( );
	
	//Processing the user's raw input.
	$splitInput = $input->processRawInput( $_POST[ 'INPUT' ] );
	
	//Creating the conversionCount variable.
	$conversionCount = 0;
	
	//Beginning the conversion process - iterating through the user's input line by line.
	foreach($splitInput as $inputLine)
	{
		//Was something able to be extracted?
		if( ( $paramAssocArray = $input->processLine( $inputLine ) ) != false )
		{
			//Yes, so convert it and echo the result.
			printf( "%s\r\n", $output->convertLine( $paramAssocArray ) );
		}
		++$conversionCount;
	}
	//$add_conversion = $DBH->query("UPDATE `ffs_statistics` SET `total_conversions` = `total_conversions` + 1 LIMIT 1");
	/*
	require_once( 'php/stats.php' );
	$stats = new Stats( );
	
	$stats->addToStats( $_POST[ 'INPUT_OBJECT' ], $_POST[ 'INPUT_VEHICLE' ], $_POST[ 'OUTPUT_OBJECT' ], $_POST[ 'OUTPUT_VEHICLE' ], $conversionCount );
	
	if( $_POST['QUALITY_CONTROL'] == 'Yes' )
	{
		$stats->addToQualityControl(
			$inputObjectLine, 
			$outputObjectLine, 
			$inputVehicleLine, 
			$outputVehicleLine,
			$_POST[ 'INPUT_OBJECT' ],
			$_POST[ 'INPUT_VEHICLE' ],
			$_POST[ 'OUTPUT_OBJECT' ],
			$_POST[ 'OUTPUT_VEHICLE' ]
		);
	}
	*/

	//Stop timekeeping, and send the conversion time in seconds to the function that deals with it.
	echo $output->returnConversionData( microtime( true ) - $timeStart );
	
	//If the user has selected the "Add to SA-MP script" option, echo the bottom half of that here.
	echo $output->additionsBottom( );
	
?>

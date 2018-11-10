<?php
	/**
	*
	* convertFFS.com
	*
	* This class manages, and converts the users input into a nice assoc array ready for the output class.
	*
	*/
	
	
	class Input
	{
		
		
		//Custom format identifiers that need to be replaced with something more useful.
		private $formatIdentifiers = array( '{model}', '{x}', '{y}', '{z}', '{rx}', '{ry}', '{rz}', '{id}', '{dd}', '{respawn}', '{c1}', '{c2}', '{r}', '{vw}', '{int}', '{pid}', '{comment}' );
		//What those custom format identifiers are replaced with.
		private $formatIdentifiersReplace = array();
		
		//Custom format placeholders
		private $formatPlaceholders = '/\\\{(model|x|y|z|rx|ry|rz|id|dd|respawn|c1|c2|vw|int|pid|r|comment)\\\}/';
		
		//Variables that store the input formats.
		private $objectFormat = 'NaN';
		private $vehicleFormat = 'NaN';
		//Variables that store the input formats in a slightly different format to put the unmarked parameters in a assoc array.
		private $_objectFormat = 'NaN';
		private $_vehicleFormat = 'NaN';
		//Variable that stores what kind of conversion needs to be done on rotations.
		private $rotationConversion = 'none';
		

		/**
		*
		* Construct function.
		*
		* @version 0.1
		* @access private
		*/
		function __construct( )
		{
			//Adding what $formatIdentifiers are going to be replaced with to the array.
			$this->formatIdentifiersReplace[ ] = 'model' . "\x02\x01";
			$this->formatIdentifiersReplace[ ] = 'x' . "\x02\x01";
			$this->formatIdentifiersReplace[ ] = 'y' . "\x02\x01";
			$this->formatIdentifiersReplace[ ] = 'z' . "\x02\x01";
			$this->formatIdentifiersReplace[ ] = 'rx' . "\x02\x01";
			$this->formatIdentifiersReplace[ ] = 'ry' . "\x02\x01";
			$this->formatIdentifiersReplace[ ] = 'rz' . "\x02\x01";
			$this->formatIdentifiersReplace[ ] = 'id' . "\x02\x01";
			$this->formatIdentifiersReplace[ ] = 'dd' . "\x02\x01";
			$this->formatIdentifiersReplace[ ] = 'respawn' . "\x02\x01";
			$this->formatIdentifiersReplace[ ] = 'c1' . "\x02\x01";
			$this->formatIdentifiersReplace[ ] = 'c2' . "\x02\x01";
			$this->formatIdentifiersReplace[ ] = 'r' . "\x02\x01";
			$this->formatIdentifiersReplace[ ] = 'vw' . "\x02\x01";
			$this->formatIdentifiersReplace[ ] = 'int' . "\x02\x01";
			$this->formatIdentifiersReplace[ ] = 'pid' . "\x02\x01";
			$this->formatIdentifiersReplace[ ] = 'comment' . "\x02\x01";
			}
		
		
		/**
		*
		* Sets the variable that tells the class to convert rotations or not.
		*
		* @version 0.1
		* @access public
		*
		* @param string $rotationConversion What to convert to
		* @return n/a
		*/
		public function setRotationConversion( $rotationConversion )
		{
			$this->rotationConversion = $rotationConversion;
		}
		
		
		/**
		*
		* Processes the users raw input into something more ...processable.
		*
		* @version 0.1
		* @access public
		*
		* @param string $rawInput The users raw input
		* @return array $rawInput split line by line
		*/
		public function processRawInput( $rawInput )
		{
			//Removes whitespace and useless characters from the input to make it more accurate, and faster to process.
			$rawInput = str_replace( array( "\r", "\t", "\x0B" ), '', $rawInput );
			//Making the string all lowercase to prevent issues.
			$rawInput = strtolower( $rawInput );
			//Explode the raw input by LF.
			$splitInput = explode( "\n", $rawInput );
			//Return the exploded input.
			return $splitInput;
		}
		
		
		/**
		*
		* Sets the object format, and processes it to be ready to accept input.
		*
		* @version 0.1.5
		* @access public
		*
		* @param string $objectFormat The format that the user specified
		* @return n/a
		*/
		public function setObjectFormat( $objectFormat )
		{
			//Resolving ~NOT~FOUND~ and ~NO~CONVERT~ to internal ignore flag.
			if( $objectFormat == '~NOT~FOUND~' || $objectFormat == '~NO~CONVERT~' )
			{
				$objectFormat = "\x03";
			}
			//Removes whitespace and useless characters from the format to make it more accurate, and faster to process.
			$objectFormat = str_replace( array( "\r", "\t", "\x0B" ), '', $objectFormat );		
			//Making the string all lowercase to prevent issues.
			$objectFormat = strtolower( $objectFormat );
			
			//Fix possible issues with stray indenting.
			$objectFormat = $this->replaceOnce( ' (', '(', $objectFormat );
			$objectFormat = $this->replaceOnce( ' )', ')', $objectFormat );
			$objectFormat = str_replace( ' ,', ',', $objectFormat );
			
			//Fix magic quotes being a cunt and ruining everything.
			$objectFormat = stripslashes( $objectFormat );
			
			//Replace the custom format placeholders with the identifier + delimiter strings used to retrieve the property each param belongs to.
			$this->_objectFormat = str_replace( $this->formatIdentifiers, $this->formatIdentifiersReplace, $objectFormat );
			
			//Sanitize the users input format ready for regex.
			$objectFormat = preg_quote( $objectFormat, '/' );
			//Replace the custom format placeholders with the regex syntax.
			$this->objectFormat = preg_replace( $this->formatPlaceholders, '(.*?)', $objectFormat );
		}
		
		
		/**
		*
		* Sets the vehicle format, and processes it to be ready to accept input.
		*
		* @version 0.1.5
		* @access public
		*
		* @param string $vehicleFormat The format that the user specified
		* @return n/a
		*/
		public function setVehicleFormat( $vehicleFormat )
		{
			//Resolving ~NOT~FOUND~ and ~NO~CONVERT~ to internal ignore flag.
			if( $vehicleFormat == '~NOT~FOUND~' || $vehicleFormat == '~NO~CONVERT~' )
			{
				$vehicleFormat = "\x03";
			}
			//Removes whitespace and useless characters from the format to make it more accurate, and faster to process.
			$vehicleFormat = str_replace( array( "\r", "\t", "\x0B" ), '', $vehicleFormat );
			//Making the string all lowercase to prevent issues.
			$vehicleFormat = strtolower( $vehicleFormat );
			
			//Fix possible issues with stray indenting.
			$vehicleFormat = $this->replaceOnce( ' (', '(', $vehicleFormat );
			$vehicleFormat = $this->replaceOnce( ' )', ')', $vehicleFormat );
			$vehicleFormat = str_replace( ' ,', ',', $vehicleFormat );
			
			//Fix magic quotes being a cunt and ruining everything.
			$vehicleFormat = stripslashes( $vehicleFormat );
			
			//Replace the custom format placeholders with the identifier + delimiter strings used to retrieve the property each param belongs to.
			$this->_vehicleFormat = str_replace( $this->formatIdentifiers, $this->formatIdentifiersReplace, $vehicleFormat );
			
			//Sanitize the users input format ready for regex.
			$vehicleFormat = preg_quote( $vehicleFormat, '/' );
			//Replace the custom format placeholders with the regex syntax.
			$this->vehicleFormat = preg_replace( $this->formatPlaceholders, '(.*?)', $vehicleFormat );		
		}


		/**
		*
		* Processes a line of the input into an assoc array for objects.
		*
		* @version 0.2
		* @access private
		*
		* @param string $inputLine The line of the users input
		* @return array Assoc array containing the parameters of the line.
		*/
		private function processLineForObjects( $inputLine )
		{
			if( $this->objectFormat == "\x03" )
			{
				//The user does not want objects converted.
				return false;
			}
			//Trim useless characters from the beginning and end in an effort to reduce pointless processing.
			$inputLine = trim( $inputLine );
			//For quality control
			$inputLineOriginal = $inputLine;
			//Fix possible issues with stray indenting.
			$inputLine = $this->replaceOnce( ' (', '(', $inputLine );
			$inputLine = $this->replaceOnce( ' )', ')', $inputLine );
			$inputLine = str_replace( ' ,', ',', $inputLine );
			//We are processing as an object at the moment, so make the isObject assoc array index.
			$paramAssocArray[ 'isObject' ] = 1;
			//Fetching the parameters.
			$fetchedParamValues = $this->fetchObjectParamValues( $inputLine );
			$paramAssocArray[ 'count' ] = count($fetchedParamValues);
			//Set the $inputLine variable to the identifier + delimiter strings used to retrieve the property each param belongs to.
			$inputLine = $this->_objectFormat;
			//Looping through each param value we managed to fetch.
			foreach( $fetchedParamValues as $paramValue )
			{
				//Placing the param values we fetched into the identifier + delimiter strings used to retrieve the property each param belongs to.
				$inputLine = $this->replaceOnce( "\x01", $paramValue, $inputLine );
				//$inputLine = preg_replace( "/\x01/", $paramValue, $inputLine, 1 );
			}
			//Fetching the parameters again.
			$fetchedParamValues = $this->fetchObjectParamValues( $inputLine );
			//Looping through each param value we managed to fetch again.
			foreach( $fetchedParamValues as $specificParamCouple )
			{
				//Splitting the identifier and the actual param value using the delimiter.
				$specificParamCouple = explode( "\x02", $specificParamCouple );
				//Adding to the assoc array, getting rid of troublesome whitespace in the process.
				$paramAssocArray[ $specificParamCouple[ 0 ] ] = trim( $specificParamCouple[ 1 ] );
			}
			//Do the rotations need to be converted to eulers?
			switch( $this->rotationConversion )
			{
				case 'toEulers' : 
				{
					$paramAssocArray[ 'rx' ] = @rad2deg( $paramAssocArray[ 'rx' ] );
					$paramAssocArray[ 'ry' ] = @rad2deg( $paramAssocArray[ 'ry' ] );
					$paramAssocArray[ 'rz' ] = @rad2deg( $paramAssocArray[ 'rz' ] );
					break;		
				}
				case 'toRadians' :
				{
					$paramAssocArray[ 'rx' ] = @deg2rad( $paramAssocArray[ 'rx' ] );
					$paramAssocArray[ 'ry' ] = @deg2rad( $paramAssocArray[ 'ry' ] );
					$paramAssocArray[ 'rz' ] = @deg2rad( $paramAssocArray[ 'rz' ] );
					break;				
				}
			}
			//Getting an object for quality control.
			if( empty( $GLOBALS[ 'inputObjectLine' ] ) && $paramAssocArray[ 'count' ] > 0  )
			{
				$GLOBALS[ 'inputObjectLine' ] = $inputLineOriginal;
			}
			//Returning the assoc array.
			return $paramAssocArray;
		}


		/**
		*
		* Processes a line of the input into an assoc array for vehicles.
		*
		* @version 0.2
		* @access private
		*
		* @param string $inputLine The line of the users input
		* @return array Assoc array containing the parameters of the line.
		*/
		private function processLineForVehicles( $inputLine )
		{
			if( $this->vehicleFormat == "\x03" )
			{
				//The user does not want vehicles converted.
				return false;
			}
			//Trim useless characters from the beginning and end in an effort to reduce pointless processing.
			$inputLine = trim( $inputLine );
			//For quality control
			$inputLineOriginal = $inputLine;
			//Fix possible issues with stray indenting.
			$inputLine = $this->replaceOnce( ' (', '(', $inputLine );
			$inputLine = $this->replaceOnce( ' )', ')', $inputLine );
			$inputLine = str_replace( ' ,', ',', $inputLine );
			//We are not processing as an object at the moment, so don't make the isObject assoc array index.
			//Fetching the parameters.
			$fetchedParamValues = $this->fetchVehicleParamValues( $inputLine );
			$paramAssocArray[ 'count' ] = count($fetchedParamValues);
			//Set the $inputLine variable to the identifier + delimiter strings used to retrieve the property each param belongs to.
			$inputLine = $this->_vehicleFormat;
			//Looping through each param value we managed to fetch.
			foreach( $fetchedParamValues as $paramValue )
			{
				//Placing the param values we fetched into the identifier + delimiter strings used to retrieve the property each param belongs to.
				$inputLine = $this->replaceOnce( "\x01", $paramValue, $inputLine );
				//$inputLine = preg_replace( "/\x01/", $paramValue, $inputLine, 1 );
			}
			//Fetching the parameters again.
			$fetchedParamValues = $this->fetchVehicleParamValues( $inputLine );
			//Looping through each param value we managed to fetch again.
			foreach( $fetchedParamValues as $specificParamCouple )
			{
				//Splitting the identifier and the actual param value using the delimiter.
				$specificParamCouple = explode( "\x02", $specificParamCouple );
				//Adding to the assoc array, getting rid of troublesome whitespace in the process.
				$paramAssocArray[ $specificParamCouple[ 0 ] ] = trim( $specificParamCouple[ 1 ] );
			}
			//Getting a vehicle for quality control.
			if( empty( $GLOBALS[ 'inputVehicleLine' ] ) && $paramAssocArray[ 'count' ] > 0 )
			{
				$GLOBALS[ 'inputVehicleLine' ] = $inputLineOriginal;
			}
			//Returning the assoc array.
			return $paramAssocArray;
		}
		
		
		/**
		*
		* Fetches param values for objects.
		*
		* @version 0.1
		* @access private
		*
		* @param string $inputLine The line of the users input
		* @return array Array containing the parameters
		*/
		private function fetchObjectParamValues( $inputLine )
		{
			//Using the input format to fetch the parameters.
			preg_match( '/^' . $this->objectFormat . '$/', $inputLine, $fetchedParamValues );
			//Getting rid of the first array element, which is useless in this case.
			$fetchedParamValues = array_splice( $fetchedParamValues, 1 );
			//Returning the array
			return $fetchedParamValues;
		}
		
		
		/**
		*
		* Fetches param values for vehicles.
		*
		* @version 0.1
		* @access private
		*
		* @param string $inputLine The line of the users input
		* @return array Array containing the parameters
		*/
		private function fetchVehicleParamValues( $inputLine )
		{
			//Using the input format to fetch the parameters.
			preg_match( '/^' . $this->vehicleFormat . '$/', $inputLine, $fetchedParamValues );
			//Getting rid of the first array element, which is useless in this case.
			$fetchedParamValues = array_splice( $fetchedParamValues, 1 );
			//Returning the array
			return $fetchedParamValues;
		}
		
		
		/**
		*
		* Fetches param values for both objects and vehicles
		*
		* @version 0.1
		* @access public
		*
		* @param string $inputLine The line of the users input
		* @return array Assoc array containing the parameters of the line.
		*/
		public function processLine( $inputLine )
		{
			//Lets try and see if it is an object.
			$paramAssocArray = $this->processLineForObjects( $inputLine );
			if( $paramAssocArray[ 'count' ] > 0 )
			{
				//Yep, it is an object so lets return the array that was passed.
				return $paramAssocArray;
			}
			//Nope, so lets try and see if it a vehicle.
			$paramAssocArray = $this->processLineForVehicles( $inputLine );
			if( $paramAssocArray[ 'count' ] > 0 )
			{
				//Yep, it is a vehicle so lets return the array that was passed.
				return $paramAssocArray;
			}
			//It doesn't conform with the users format for object OR vehicle, return false.
			return false;
		}
		
		
		/**
		*
		* Stops after the first instance of a needle being found, unlike str_replace which carries on replacing.
		*
		* @version 0.2
		* @access private
		*
		* @param string $needle The string to search for.
		* @param string $replace The string to replace the search with.
		* @param string $haystack The input string.
		* @return string The string with the replace carried out, or the input string.
		*/
		private function replaceOnce( $needle, $replace, $haystack )
		{
			//Finding the position of the string we want to find, if possible.
			$position = strpos( $haystack, $needle );
			
			//Could strpos find the string we wanted to find?
			if( $position === false )
			{
				//No, return the unchanged string.
				return $haystack;
			}
			//Yes, perform the replace and return the fresh string.
			return substr_replace( $haystack, $replace, $position, strlen( $needle ) );
		}


	}
?>
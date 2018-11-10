<?php
	/**
	*
	* convertFFS.com
	*
	* This class manages, and converts the users input from an MTA XML format into a regular custom format for input processing.
	*
	*/
	class XML
	{
		
		
		//This is the format we process the objects into after converting from MTA.
		public $objectCustomFormat = 'OBJ,{model},{x},{y},{z},{rx},{ry},{rz},{int},{vw},{comment}';
		//This is the format we process the vehicles into after converting from MTA.
		public $vehicleCustomFormat = 'VEH,{model},{x},{y},{z},{r},{c1},{c2}';
		

		/**
		*
		* Processes $rawInput objects as a MTA Race map file.
		*
		* @version 0.1
		* @access public
		*
		* @param string $objectFormat The object format the user wants to use.
		* @param string $rawInput The users input.
		* @return string The processed input, or a bool set to false if the input did not conform to the MTA Race map syntax.
		*/
		public function processMTARaceObjects( $objectFormat, $rawInput )
		{
			//Is this format actually MTA Race
			if( $objectFormat != '<object name="{comment}"><position>{x} {y} {z}</position><rotation>{rz} {ry} {rx}</rotation><model>{model}</model></object>' )
			{
				return false;
			}
			//Getting rid of junk from the input so simpleXML doesn't throw a hissy fit.
			$rawInput = $this->fixingInput( $rawInput );
			//Variable to store the de-XML'd output.
			$processedInput = '';
			
			try
			{
				//Loading simpleXML
				$simpleXML = new SimpleXMLElement( $rawInput );
			}
			catch( Exception $xmlError )
			{
				die( '~XML~ERROR~' );
			}
			
			//Finding all of the objects
			foreach ( $simpleXML->object as $object )
			{
				$processedInput .= 'OBJ,';
				//Getting the x, y, z params
				$positionParams = explode( ' ', trim( preg_replace('/\s\s+/', ' ', $object->position) ) );
				for( $i = 0; $i < 3; ++$i )
				{
					if( empty( $positionParams[ $i ] ) )
					{
						$positionParams[ $i ] = 0.0;	
					}
				}
				$processedInput .= $object->model . ',';
				$processedInput .= $positionParams[ 0 ] . ',';
				$processedInput .= $positionParams[ 1 ] . ',';
				$processedInput .= $positionParams[ 2 ] . ',';
				//Getting the x, y, z rotation params. Note MTA Race is an idiot so it places the rotation params the wrong way round.
				$rotationParams = explode( ' ', trim( preg_replace('/\s\s+/', ' ', $object->rotation) ) );
				for( $i = 0; $i < 3; ++$i )
				{
					if( empty( $rotationParams[ $i ] ) )
					{
						$rotationParams[ $i ] = 0.0;	
					}
				}
				$processedInput .= $rotationParams[ 2 ] . ',';
				$processedInput .= $rotationParams[ 1 ] . ',';
				$processedInput .= $rotationParams[ 0 ] . ',';
				//Interior
				$processedInput .= '0,';
				//Virtual world
				$processedInput .= '0,';
				//Comment
				$processedInput .= $object[ 'name' ] . "\r\n";
			}
			
			//Returning the new and de-XML'd input.
			return $processedInput;
		}
		
		
		/**
		*
		* Processes $rawInput vehicles as a MTA Race map file.
		*
		* @version 0.1
		* @access public
		*
		* @param string $vehicleFormat The vehicle format the user wants to use.
		* @param string $rawInput The users input.
		* @return string The processed input, or a bool set to false if the input did not conform to the MTA Race map syntax.
		*/
		public function processMTARaceVehicles( $vehicleFormat, $rawInput )
		{
			//Is this format actually MTA Race
			if( $vehicleFormat != '<spawnpoint name="{comment}"><vehicle>{model}</vehicle><position>{x} {y} {z}</position><rotation>{r}</rotation></spawnpoint>' )
			{
				return false;
			}
			//Getting rid of junk from the input so simpleXML doesn't throw a hissy fit.
			$rawInput = $this->fixingInput( $rawInput );
			//Variable to store the de-XML'd output.
			$processedInput = '';
			
			try
			{
				//Loading simpleXML
				$simpleXML = new SimpleXMLElement( $rawInput );
			}
			catch( Exception $xmlError )
			{
				die( '~XML~ERROR~' );
			}
			
			//Finding all of the vehicles
			foreach ( $simpleXML->spawnpoint as $vehicle )
			{
				$processedInput .= 'VEH,';
				//Getting the x, y, z params
				$positionParams = explode( ' ', trim( preg_replace('/\s\s+/', ' ', $vehicle->position) ) );
				for( $i = 0; $i < 3; ++$i )
				{
					if( empty( $positionParams[ $i ] ) )
					{
						$positionParams[ $i ] = 0.0;	
					}
				}
				$processedInput .= $vehicle->vehicle . ',';
				$processedInput .= $positionParams[ 0 ] . ',';
				$processedInput .= $positionParams[ 1 ] . ',';
				$processedInput .= $positionParams[ 2 ] . ',';	
				$processedInput .= trim( $vehicle->rotation ) . ",-1,-1\r\n";
				
			}
			
			//Returning the new and de-XML'd input.
			return $processedInput;
		}
		
		
		/**
		*
		* Processes $rawInput objects as a MTA 1.0 map file.
		*
		* @version 0.1
		* @access public
		*
		* @param string $objectFormat The object format the user wants to use.
		* @param string $rawInput The users input.
		* @return string The processed input, or a bool set to false if the input did not conform to the MTA 1.0 map syntax.
		*/
		public function processMTA10Objects( $objectFormat, $rawInput )
		{
			//Is this format actually MTA Race
			
			if( $objectFormat != '<object id="{comment}" model="{model}" posX="{x}" posY="{y}" posZ="{z}" rotX="{rx}" rotY="{ry}" rotZ="{rz}" dimension="{vw}" interior="{int}" />' )
			{
				return false;
			}
			
			//Getting rid of junk from the input so simpleXML doesn't throw a hissy fit.
			$rawInput = $this->fixingInput( $rawInput );
			//Variable to store the de-XML'd output.
			$processedInput = '';
			
			try
			{
				//Loading simpleXML
				$simpleXML = new SimpleXMLElement( $rawInput );
			}
			catch( Exception $xmlError )
			{
				die( '~XML~ERROR~' );
			}
			
			//Finding all of the objects
			foreach( $simpleXML->object as $object )
			{
				$processedInput .= 'OBJ,';
				$processedInput .= $object[ 'model' ] . ',';
				$processedInput .= $object[ 'posx' ] . ',';
				$processedInput .= $object[ 'posy' ] . ',';
				$processedInput .= $object[ 'posz' ] . ',';
				$processedInput .= $object[ 'rotx' ] . ',';
				$processedInput .= $object[ 'roty' ] . ',';
				$processedInput .= $object[ 'rotz' ] . ',';
				$processedInput .= $object[ 'interior' ] . ',';
				$processedInput .= $object[ 'dimension' ] . ',';
				$processedInput .= $object[ 'id' ] . "\r\n";
			}
			//Returning the new and de-XML'd input.
			return $processedInput;
		}
		

		/**
		*
		* Processes $rawInput vehicles as a MTA 1.0 map file.
		*
		* @version 0.1
		* @access public
		*
		* @param string $vehicleFormat The vehicle format the user wants to use.
		* @param string $rawInput The users input.
		* @return string The processed input, or a bool set to false if the input did not conform to the MTA 1.0 map syntax.
		*/
		public function processMTA10Vehicles( $vehicleFormat, $rawInput )
		{
			//Is this format actually MTA1.0
			if( $vehicleFormat != '<vehicle model="{model}" posX="{x}" posY="{y}" posZ="{z}" rotX="{rx}" rotY="{ry}" rotZ="{r}" color="{c1},{c2}" />' )
			{
				return false;
			}
			//Getting rid of junk from the input so simpleXML doesn't throw a hissy fit.
			$rawInput = $this->fixingInput( $rawInput );
			//Variable to store the de-XML'd output.
			$processedInput = '';
			
			try
			{
				//Loading simpleXML
				$simpleXML = new SimpleXMLElement( $rawInput );
			}
			catch( Exception $xmlError )
			{
				die( '~XML~ERROR~' );
			}
			
			//Finding all of the vehicles
			foreach( $simpleXML->vehicle as $vehicle )
			{
				$color = explode( ',', $vehicle[ 'color' ] );
				if( empty( $color[ 0 ] ) )
				{
					$color[ 0 ] = '-1';
				}
				if( empty( $color[ 1 ] ) )
				{
					$color[ 1 ] = '-1';
				}
				$processedInput .= 'VEH,';
				$processedInput .= $vehicle[ 'model' ] . ',';
				$processedInput .= $vehicle[ 'posx' ] . ',';
				$processedInput .= $vehicle[ 'posy' ] . ',';
				$processedInput .= $vehicle[ 'posz' ] . ',';
				$processedInput .= $vehicle[ 'rotz' ] . ',';
				$processedInput .= $color[ 0 ] . ',';
				$processedInput .= $color[ 1 ] . "\r\n";
			}
			
			//Returning the new and de-XML'd input.
			return $processedInput;
		}
		

		/**
		*
		* Gets rid of junk from the input so simpleXML doesn't throw a hissy fit.
		*
		* @version 0.1
		* @access private
		*
		* @param string $rawInput The users raw input.
		* @return string The fixed input.
		*/
		private function fixingInput( $rawInput )
		{		
			//Trim useless characters from the beginning and end in an effort to reduce pointless processing.
			$rawInput = trim( $rawInput );
			//Making the string all lowercase to prevent issues.
			$rawInput = strtolower( $rawInput );
			//Getting rid of junk from the input so simpleXML doesn't throw a hissy fit.
			preg_match_all( '/<(.{0,2}?)(object|position|rotation|model|spawnpoint|vehicle).*>/', $rawInput, $fixedInput );
			//Unsetting useless array index.
			unset( $fixedInput[ 1 ] );
			//Joining up the $fixedInput array.
			$rawInput = implode( '', $fixedInput[0] );
			//Wrapping with surrounding tags.
			$rawInput = '<mtayounoob>' . $rawInput . '</mtayounoob>';
			//Stripping slashes from the input to stop simpleXML bitching.
			$rawInput = stripslashes( $rawInput );
			return $rawInput;
		}
	}
?>
<?php
	/**
	*
	* convertFFS.com
	*
	* This class manages the output formats, including custom output formats, and gets the conversion output ready for the user.
	*
	*/
	
	
	class Output
	{
	
	
		//Variables that store the output formats.
		private $objectFormat = 'NaN';
		private $vehicleFormat = 'NaN';
		private $convertOptions = array(
											'DRAW_DISTANCE' => '250',
											'VEHICLE_RESPAWN_TIME' => '15',
											'COMMENT_BEHAVIOUR' => 'Yes',
											'ADD_TO_SAMP_SCRIPT' => 'No',
											'VEHICLE_ARRAY' => 'No',
											'OBJECT_ARRAY' => 'No',
											'VEHICLE_COLOUR_1' => '-1',
											'VEHICLE_COLOUR_2' => '-1'
										);
		private $vehicleNames = array(
									  		'n/a', 'Landstalker', 'Bravura', 'Buffalo', 'Linerunner', 'Perrenial', 'Sentinel', 'Dumper', 'Firetruck', 'Trashmaster', 'Stretch', 'Manana','Infernus',
											'Voodoo', 'Pony', 'Mule', 'Cheetah', 'Ambulance', 'Leviathan', 'Moonbeam', 'Esperanto', 'Taxi', 'Washington', 'Bobcat', 'Mr Whoopee', 
											'BF Injection', 'Hunter', 'Premier', 'Enforcer', 'Securicar', 'Banshee', 'Predator', 'Bus', 'Rhino', 'Barracks', 'Hotknife', 'Trailer 1', 
											'Previon', 'Coach', 'Cabbie', 'Stallion', 'Rumpo', 'RC Bandit', 'Romero', 'Packer', 'Monster', 'Admiral', 'Squalo', 'Seasparrow', 'Pizzaboy', 
											'Tram', 'Trailer 2', 'Turismo', 'Speeder', 'Reefer', 'Tropic', 'Flatbed', 'Yankee', 'Caddy', 'Solair', 'Berkley\'s RC Van', 'Skimmer', 'PCJ-600',
											'Faggio', 'Freeway', 'RC Baron', 'RC Raider', 'Glendale', 'Oceanic', 'Sanchez', 'Sparrow', 'Patriot', 'Quad', 'Coastguard', 'Dinghy', 'Hermes',
											'Sabre', 'Rustler', 'ZR-350', 'Walton', 'Regina', 'Comet', 'BMX', 'Burrito', 'Camper', 'Marquis', 'Baggage', 'Dozer', 'Maverick', 'News Chopper',
											'Rancher', 'FBI Rancher', 'Virgo', 'Greenwood', 'Jetmax', 'Hotring', 'Sandking', 'Blista Compact', 'Police Maverick', 'Boxville', 'Benson', 'Mesa',
											'RC Goblin', 'Hotring Racer A', 'Hotring Racer B', 'Bloodring Banger', 'Rancher', 'Super GT', 'Elegant', 'Journey', 'Bike', 'Mountain Bike',
											'Beagle', 'Cropdust', 'Stunt', 'Tanker', 'Roadtrain', 'Nebula', 'Majestic', 'Buccaneer', 'Shamal', 'Hydra', 'FCR-900', 'NRG-500', 'HPV1000',
											'Cement Truck', 'Tow Truck', 'Fortune', 'Cadrona', 'FBI Truck', 'Willard', 'Forklift', 'Tractor', 'Combine', 'Feltzer', 'Remington', 'Slamvan',
											'Blade', 'Freight', 'Streak', 'Vortex', 'Vincent', 'Bullet', 'Clover', 'Sadler', 'Firetruck LA',  'Hustler', 'Intruder', 'Primo', 'Cargobob',
											'Tampa', 'Sunrise', 'Merit', 'Utility', 'Nevada', 'Yosemite', 'Windsor', 'Monster A', 'Monster B', 'Uranus', 'Jester', 'Sultan', 'Stratum', 'Elegy',
											'Raindance', 'RC Tiger', 'Flash', 'Tahoma', 'Savanna', 'Bandito', 'Freight Flat', 'Streak Carriage', 'Kart', 'Mower', 'Duneride', 'Sweeper',
											'Broadway', 'Tornado', 'AT-400', 'DFT-30', 'Huntley', 'Stafford', 'BF-400', 'Newsvan', 'Tug', 'Trailer 3', 'Emperor', 'Wayfarer', 'Euros', 'Hotdog',
											'Club', 'Freight Carriage', 'Trailer 3', 'Andromada', 'Dodo', 'RC Cam', 'Launch', 'Police Car (LSPD)', 'Police Car (SFPD)', 'Police Car (LVPD)',
											'Police Ranger', 'Picador', 'S.W.A.T. Van', 'Alpha', 'Phoenix', 'Glendale', 'Sadler', 'Luggage Trailer A', 'Luggage Trailer B',  'Stair Trailer',
											'Boxville', 'Farm Plow', 'Utility Trailer'
										);
		private $objectCount = 0;
		private $vehicleCount = 0;
		private $toPrepend = '';
		private $modelCount;
		
		
		/**
		*
		* Sets the object format variable.
		*
		* @version 0.1
		* @access public
		*
		* @param string $objectFormat The custom format we will use to output the converted objects.
		* @return n/a
		*/
		public function setObjectFormat( $objectFormat )
		{
			$this->objectFormat = stripslashes( $objectFormat );
			//LUA arrays start with 1 for some reason, so adapt the count to work with this.
			if( $objectFormat == 'createObject({model},{x},{y},{z},{rx},{ry},{rz}){comment}' )
			{
				++$this->objectCount;
			}
		}
	
		
		/**
		*
		* Sets the vehicle format variable.
		*
		* @version 0.1
		* @access public
		*
		* @param string $vehicleFormat The custom format we will use to output the converted vehicles.
		* @return n/a
		*/
		public function setVehicleFormat( $vehicleFormat )
		{
			$this->vehicleFormat = stripslashes( $vehicleFormat );
			//LUA arrays start with 1 for some reason, so adapt the count to work with this.
			if( $vehicleFormat == 'createVehicle({model},{x},{y},{z},{rx},{ry},{r},{dd}){comment}' )
			{
				++$this->vehicleCount;
			}
		}
		
		
		/**
		*
		* Sets the converting options array.
		*
		* @version 0.1
		* @access public
		*
		* @param array $convertOptions The array containing the options.
		* @return n/a
		*/
		public function setConvertOptions( $convertOptions )
		{
			$this->convertOptions = $convertOptions;
		}
		
		
		/**
		*
		* Executes to the object conversion function or vehicle conversion function based on what the line contains before returning the finished conversion.
		*
		* @version 0.1
		* @access public
		*
		* @param array $paramAssocArray The assoc array containing the parameters.
		* @return string The converted object or vehicle line.
		*/
		public function convertLine( $paramAssocArray )
		{
			if( $paramAssocArray == false )
			{
				//This line does not need to be converted.
				return '';	
			}
			//Does this array contain a object or vehicle?
			if( isset( $paramAssocArray[ 'isObject' ] ) )
			{
				//Contains an object
				return $this->convertObjectLine( $paramAssocArray );
			}
			//Contains a vehicle
			return $this->convertVehicleLine( $paramAssocArray );
		}
		
		
		/**
		*
		* Converts an object assoc array into the completed conversion.
		*
		* @version 0.1
		* @access private
		*
		* @param array $paramAssocArray The assoc array containing the parameters.
		* @return string The converted object line.
		*/
		private function convertObjectLine( $paramAssocArray )
		{
			//Getting the object format.
			$objectFormat = $this->objectFormat;
			//Completing $paramAssocArray.
			$paramAssocArray = $this->completeObjectInputArray( $paramAssocArray );
			
			$objectFormat = str_replace( '{x}', sprintf('%01.7F', $paramAssocArray[ 'x' ] ), $objectFormat );
			$objectFormat = str_replace( '{y}', sprintf('%01.7F', $paramAssocArray[ 'y' ] ), $objectFormat );
			$objectFormat = str_replace( '{z}', sprintf('%01.7F', $paramAssocArray[ 'z' ] ), $objectFormat );
			$objectFormat = str_replace( '{rx}', sprintf('%01.7F', $paramAssocArray[ 'rx' ] ), $objectFormat );
			$objectFormat = str_replace( '{ry}', sprintf('%01.7F', $paramAssocArray[ 'ry' ] ), $objectFormat );
			$objectFormat = str_replace( '{rz}', sprintf('%01.7F', $paramAssocArray[ 'rz' ] ), $objectFormat );
			$objectFormat = str_replace( '{model}', $paramAssocArray[ 'model' ], $objectFormat );
			$objectFormat = str_replace( '{pid}', $paramAssocArray[ 'pid' ], $objectFormat );
			$objectFormat = str_replace( '{int}', $paramAssocArray[ 'int' ], $objectFormat );
			$objectFormat = str_replace( '{dd}', $paramAssocArray[ 'dd' ], $objectFormat );
			$objectFormat = str_replace( '{comment}', $paramAssocArray[ 'comment' ], $objectFormat );
			$objectFormat = str_replace( '{vw}', $paramAssocArray[ 'vw' ], $objectFormat );
			$objectFormat = str_replace( '{id}', $this->objectCount, $objectFormat );
			//Iterating the object counter.
			++$this->objectCount;
			//Adding any content to prepend and the array.
			$objectFormat = $this->toPrepend . $paramAssocArray[ 'array' ] . $objectFormat;
			//Getting an object for quality control.
			if( empty( $GLOBALS[ 'outputObjectLine' ] ) )
			{
				$GLOBALS[ 'outputObjectLine' ] = $objectFormat;
			}
			return $objectFormat;
		}
		
		
		/**
		*
		* Converts a vehicle assoc array into the completed conversion.
		*
		* @version 0.3
		* @access private
		*
		* @param array $paramAssocArray The assoc array containing the parameters.
		* @return string The converted vehicle line.
		*/
		private function convertVehicleLine( $paramAssocArray )
		{
			//Getting the vehicle format.
			$vehicleFormat = $this->vehicleFormat;
			//Completing $paramAssocArray.
			$paramAssocArray = $this->completeVehicleInputArray( $paramAssocArray );
			
			$vehicleFormat = str_replace( '{x}', sprintf('%01.7F', $paramAssocArray[ 'x' ] ), $vehicleFormat );
			$vehicleFormat = str_replace( '{y}', sprintf('%01.7F', $paramAssocArray[ 'y' ] ), $vehicleFormat );
			$vehicleFormat = str_replace( '{z}', sprintf('%01.7F', $paramAssocArray[ 'z' ] ), $vehicleFormat );
			$vehicleFormat = str_replace( '{r}', sprintf('%01.7F', $paramAssocArray[ 'r' ] ), $vehicleFormat );
			$vehicleFormat = str_replace( '{c1}', $paramAssocArray[ 'c1' ], $vehicleFormat );
			$vehicleFormat = str_replace( '{c2}', $paramAssocArray[ 'c2' ], $vehicleFormat );
			$vehicleFormat = str_replace( '{model}', $paramAssocArray[ 'model' ], $vehicleFormat );
			$vehicleFormat = str_replace( '{respawn}', $paramAssocArray[ 'respawn' ], $vehicleFormat );
			$vehicleFormat = str_replace( '{comment}', $paramAssocArray[ 'comment' ], $vehicleFormat );
			$vehicleFormat = str_replace( '{id}', $this->vehicleCount, $vehicleFormat );
			//Unused parameters for MTA 1.0's createVehicle
			$vehicleFormat = str_replace( '{rx}', '0.0000000', $vehicleFormat );
			$vehicleFormat = str_replace( '{ry}', '0.0000000', $vehicleFormat );
			$vehicleFormat = str_replace( '{dd}', '"CFFS"', $vehicleFormat );
			//Iterating the vehicle counter.
			++$this->vehicleCount;
			//Counting models
			if( !isset( $this->modelCount[ ( int ) $paramAssocArray[ 'model' ] ] ) )
			{
				$this->modelCount[ ( int ) $paramAssocArray[ 'model' ] ] = true;
			}
			//Adding any content to prepend and thr array.
			$vehicleFormat = $this->toPrepend . $paramAssocArray[ 'array' ] . $vehicleFormat;
			//Getting a vehicle for quality control.
			if( empty( $GLOBALS[ 'outputVehicleLine' ] ) )
			{
				$GLOBALS[ 'outputVehicleLine' ] = $vehicleFormat;
			}
			return $vehicleFormat;
		}
		
		
		/**
		*
		* Making sure that all of the $paramAssocArray indexes are filled out properly in tune with the user's settings.
		*
		* @version 0.1
		* @access private
		*
		* @param array $paramAssocArray The assoc array containing the parameters.
		* @return array The complete $paramAssocArray
		*/
		private function completeObjectInputArray( $paramAssocArray )
		{
			//Setting up the 'dd' index properly.
			$paramAssocArray[ 'dd' ] = @$this->ifEmptyReplace( $paramAssocArray[ 'dd' ], 250 );
			if( ( $drawDistance = $this->convertOptions[ 'DRAW_DISTANCE' ] ) == 'No change' )
			{
				$drawDistance = $paramAssocArray[ 'dd' ];
			}
			$paramAssocArray[ 'dd' ] = $drawDistance;
			//Setting up the 'comment' index properly.
			$comment = '';
			$paramAssocArray[ 'comment' ] = @$this->ifEmptyReplace( $paramAssocArray[ 'comment' ], '' );
			if( $this->convertOptions[ 'COMMENT_BEHAVIOUR' ] == 'Yes' )
			{
				$comment = str_replace( array( '//', '--', '/*', '*/', '--[[', '--]]' ), '', trim( $paramAssocArray[ 'comment' ] ) );
				if( $this->objectFormat == 'createObject({model},{x},{y},{z},{rx},{ry},{rz}){comment}' )
				{
					//Set to LUA comment style.
					$comment = ' --' . $comment;
				}
				else if( $this->objectFormat != '<object name="{comment}"><position>{x} {y} {z}</position><rotation>{rx} {ry} {rz}</rotation><model>{model}</model></object>' &&
						$this->objectFormat != '<object id="{comment}" model="{model}" posX="{x}" posY="{y}" posZ="{z}" rotX="{rx}" rotY="{ry}" rotZ="{rz}" dimension="{vw}" interior="{int}" />' )
				{
					//Set to PAWN comment style by default.
					$comment = ' //' . $comment;	
				}
				else
				{
					//If the comment is empty, fill it with something.
					if( empty( $comment ) )
					{
						$comment = 'convertFFS (' . $this->objectCount . ')';
					}
				}
			}
			$paramAssocArray[ 'comment' ] = $comment;
			//Setting up the 'pid' index properly.
			$paramAssocArray[ 'pid' ] = @$this->ifEmptyReplace( $paramAssocArray[ 'pid' ], -1 );
			//Setting up the 'int' index properly.
			$paramAssocArray[ 'int' ] = @$this->ifEmptyReplace( $paramAssocArray[ 'int' ], 0 );
			//Setting up the 'vw' index properly.
			$paramAssocArray[ 'vw' ] = @$this->ifEmptyReplace( $paramAssocArray[ 'vw' ], 0 );
			//Setting up the 'model' index properly.
			$paramAssocArray[ 'model' ] = @$this->ifEmptyReplace( $paramAssocArray[ 'model' ], 1337 );
			//Setting up the 'x' index properly.
			$paramAssocArray[ 'x' ] = @$this->ifEmptyReplace( $paramAssocArray[ 'x' ], '0.0' );
			//Setting up the 'y' index properly.
			$paramAssocArray[ 'y' ] = @$this->ifEmptyReplace( $paramAssocArray[ 'y' ], '0.0' );
			//Setting up the 'z' index properly.
			$paramAssocArray[ 'z' ] = @$this->ifEmptyReplace( $paramAssocArray[ 'z' ], '0.0' );
			//Setting up the 'rx' index properly.
			$paramAssocArray[ 'rx' ] = @$this->ifEmptyReplace( $paramAssocArray[ 'rx' ], '0.0' );
			//Setting up the 'ry' index properly.
			$paramAssocArray[ 'ry' ] = @$this->ifEmptyReplace( $paramAssocArray[ 'ry' ], '0.0' );
			//Setting up the 'rz' index properly.
			$paramAssocArray[ 'rz' ] = @$this->ifEmptyReplace( $paramAssocArray[ 'rz' ], '0.0' );
			//Setting up the 'array' index properly.
			if( ( $objectArray = $this->convertOptions[ 'OBJECT_ARRAY' ] ) == 'No' )
			{
				$objectArray = '';
			}
			$paramAssocArray[ 'array' ] = str_replace( '[]', '[' . $this->objectCount . '] = ', $objectArray );
			//Done!
			return $paramAssocArray;
		}
		
		
		/**
		*
		* Making sure that all of the $paramAssocArray indexes are filled out properly in tune with the user's settings.
		*
		* @version 0.1
		* @access private
		*
		* @param array $paramAssocArray The assoc array containing the parameters.
		* @return array The complete $paramAssocArray
		*/
		private function completeVehicleInputArray( $paramAssocArray )
		{
			//Setting up the 'c1' index properly.
			$paramAssocArray[ 'c1' ] = @$this->ifEmptyReplace( $paramAssocArray[ 'c1' ], -1 );
			if( ( $vehicleColour = $this->convertOptions[ 'VEHICLE_COLOUR_1' ] ) == 'No change' )
			{
				$vehicleColour = $paramAssocArray[ 'c1' ];
			}
			$paramAssocArray[ 'c1' ] = $vehicleColour;
			//Setting up the 'c2' index properly.
			$paramAssocArray[ 'c2' ] = @$this->ifEmptyReplace( $paramAssocArray[ 'c2' ], -1 );
			if( ( $vehicleColour = $this->convertOptions[ 'VEHICLE_COLOUR_2' ] ) == 'No change' )
			{
				$vehicleColour = $paramAssocArray[ 'c2' ];
			}
			$paramAssocArray[ 'c2' ] = $vehicleColour;
			//Setting up the 'respawn' index properly.
			$paramAssocArray[ 'respawn' ] = @$this->ifEmptyReplace( $paramAssocArray[ 'respawn' ], '15' );
			if( ( $respawnTime = $this->convertOptions[ 'VEHICLE_RESPAWN_TIME' ] ) == 'No change' )
			{
				$respawnTime = $paramAssocArray[ 'respawn' ];
			}
			$paramAssocArray[ 'respawn' ] = $respawnTime;
			//Setting up the 'model' index properly.
			$paramAssocArray[ 'model' ] = @$this->ifEmptyReplace( $paramAssocArray[ 'model' ], 406 );
			//Setting up the 'comment' index properly.
			$comment = '';
			if( $this->convertOptions[ 'COMMENT_BEHAVIOUR' ] == 'Yes' )
			{
				$commentArrayIndex = $paramAssocArray[ 'model' ] - 399;
				if( !isset( $this->vehicleNames[ $commentArrayIndex ] ) )
				{
					$commentArrayIndex = 0;
				}
				$comment = $this->vehicleNames[ $commentArrayIndex ];
				if( $this->vehicleFormat == 'createObject({model},{x},{y},{z},{rx},{ry},{rz}){comment}' )
				{
					//Set to LUA comment style.
					$comment = ' --' . $comment;	
				}
				else if( $this->vehicleFormat != '<spawnpoint name="{comment}"><vehicle>{model}</vehicle><position>{x} {y} {z}</position><rotation>{r}</rotation></spawnpoint>' &&
						$this->vehicleFormat != '<vehicle model="{model}" posX="{x}" posY="{y}" posZ="{z}" rotX="{rx}" rotY="{ry}" rotZ="{r}" color="{c1},{c2}" />' )
				{
					//Set to PAWN comment style by default.
					$comment = ' //' . $comment;	
				}
			}
			$paramAssocArray[ 'comment' ] = $comment;
			//Setting up the 'x' index properly.
			//Setting up the 'x' index properly.
			$paramAssocArray[ 'x' ] = @$this->ifEmptyReplace( $paramAssocArray[ 'x' ], '0.0' );
			//Setting up the 'y' index properly.
			$paramAssocArray[ 'y' ] = @$this->ifEmptyReplace( $paramAssocArray[ 'y' ], '0.0' );
			//Setting up the 'z' index properly.
			$paramAssocArray[ 'z' ] = @$this->ifEmptyReplace( $paramAssocArray[ 'z' ], '0.0' );
			//Setting up the 'rx' index properly.
			$paramAssocArray[ 'r' ] = @$this->ifEmptyReplace( $paramAssocArray[ 'r' ], '0.0' );
			//Setting up the 'array' index properly.
			if( ( $vehicleArray = $this->convertOptions[ 'VEHICLE_ARRAY' ] ) == 'No' )
			{
				$vehicleArray = '';
			}
			$paramAssocArray[ 'array' ] = str_replace( '[]', '[' . $this->vehicleCount . '] = ', $vehicleArray );
			//Done!
			return $paramAssocArray;
		}
		
		
		/**
		*
		* Returns details such as object conversions, vehicle conversions and number of vehicle models.
		*
		* @version 0.1
		* @access public
		*
		* @return string The string with the information to echo.
		*/		
		public function returnConversionData( $conversionTime )
		{
			switch( rand( 0, 5 ) )
			{
				case 0 :
				{
					$timeCountText = 'In the time this conversion took to finish a hummingbird could have flapped it\'s wings ' . round( ( $conversionTime / 0.04 ), 2 ) . ' times!';
					break;
				}
				case 1 :
				{
					$timeCountText = 'In the time this conversion took to finish light could have travelled around the world ' . round( ( $conversionTime / 0.1336 ), 2 ) . ' times!';
					break;				
				}
				case 2 :
				{
					$timeCountText = 'In the time this conversion took to finish ' . round( ( $conversionTime / 1.2096 ), 2 ) . ' micro-fortnights have passed!';
					break;
				}
				case 3 :
				{
					$timeCountText = 'convertFFS converted your input in ' . round( $conversionTime, 2 ) . ' seconds - Chuck Norris could have done it in ' . 
					round( $conversionTime / 63, 4 ) . ' seconds!';
					break;
				}
				default :
				{
					$timeCountText = 'In the time this conversion took to finish the US national debt has risen by about $' . number_format( 43981.48 * $conversionTime, 2 ) . '!';
					break;
				}
			}
			$commentStart = '/*';
			$commentEnd = '*/';
			if( $this->objectFormat == '<object id="{comment}" model="{model}" posX="{x}" posY="{y}" posZ="{z}" rotX="{rx}" rotY="{ry}" rotZ="{rz}" dimension="{vw}" interior="{int}" />' ||
				$this->vehicleFormat == '<vehicle model="{model}" posX="{x}" posY="{y}" posZ="{z}" rotX="{rx}" rotY="{ry}" rotZ="{r}" color="{c1},{c2}" />' ||
				$this->objectFormat == '<object name="{comment}"><position>{x} {y} {z}</position><rotation>{rx} {ry} {rz}</rotation><model>{model}</model></object>' ||
				$this->vehicleFormat == '<spawnpoint name="{comment}"><vehicle>{model}</vehicle><position>{x} {y} {z}</position><rotation>{r}</rotation></spawnpoint>' )
			{
				$commentStart = '<!--';
				$commentEnd = '-->';
			}
			if( $this->objectFormat == 'createObject({model},{x},{y},{z},{rx},{ry},{rz}){comment}' )
			{
				$commentStart = '--[[';
				$commentEnd = '--]]';
			}
			return 	"\r\n" . $this->toPrepend . $commentStart . "\r\n" .
					$this->toPrepend . 'Objects converted: ' . $this->objectCount . "\r\n" .
					$this->toPrepend . 'Vehicles converted: ' . $this->vehicleCount . "\r\n" .
					$this->toPrepend . 'Vehicle models found: ' . count( $this->modelCount ) . "\r\n" .
					$this->toPrepend . '----------------------' . "\r\n" . 
					$this->toPrepend . $timeCountText . "\r\n" . 
					$this->toPrepend . $commentEnd . "\r\n";
		}
		
		
		/**
		*
		* Adds any required content designed to go above any objects and vehicles.
		*
		* @version 0.1
		* @access public
		*
		* @return string The string to echo what is required.
		*/
		public function additionsTop( )
		{
			if( $this->objectFormat == '<object id="{comment}" model="{model}" posX="{x}" posY="{y}" posZ="{z}" rotX="{rx}" rotY="{ry}" rotZ="{rz}" dimension="{vw}" interior="{int}" />' ||
				$this->vehicleFormat == '<vehicle model="{model}" posX="{x}" posY="{y}" posZ="{z}" rotX="{rx}" rotY="{ry}" rotZ="{r}" color="{c1},{c2}" />' )
			{
				$this->toPrepend = "\t";
				return '<map edf:definitions="editor_main">' . "\r\n" . 
					   "\t" . '<meta>' . "\r\n" . 
					   "\t\t" . '<info author=\'convertFFS.com\' version=\'1.0\' name=\'convertFFS map file\' description=\'Converted by convertFFS\' type=\'map\' />' . "\r\n" . 
					   "\t" . '</meta>' . "\r\n";
			}
			if( $this->objectFormat == '<object name="{comment}"><position>{x} {y} {z}</position><rotation>{rz} {ry} {rx}</rotation><model>{model}</model></object>' ||
				$this->vehicleFormat == '<spawnpoint name="{comment}"><vehicle>{model}</vehicle><position>{x} {y} {z}</position><rotation>{r}</rotation></spawnpoint>' )
			{
				$this->toPrepend = "\t";
				return '<map mod="race" version="1.0">' . "\r\n" .
					   "\t" . '<meta>' . "\r\n" . 
					   "\t\t" . '<author>convertFFS.com</author>' . "\r\n" . 
					   "\t" . '</meta>' . "\r\n" .
					   "\t" . '<options>' . "\r\n" . 
					   "\t\t" . '<respawn>timelimit</respawn>' . "\r\n" .
					   "\t" . '</options>' . "\r\n";
			}
			if( $this->convertOptions[ 'ADD_TO_SAMP_SCRIPT' ] == 'Gamemode' )
			{
				$this->toPrepend = "\t";
				return @file_get_contents( 'http://www.convertffs.com/files/gamemode_top.txt' );
			}
			if( $this->convertOptions[ 'ADD_TO_SAMP_SCRIPT' ] == 'Filterscript' )
			{
				$this->toPrepend = "\t";
				return @file_get_contents( 'http://www.convertffs.com/files/filterscript_top.txt' );
			}
			return '';
		}


		/**
		*
		* Adds any required content designed to go below any objects and vehicles.
		*
		* @version 0.1
		* @access public
		*
		* @return string The string to echo what is required.
		*/
		public function additionsBottom( )
		{
			if( $this->objectFormat == '<object id="{comment}" model="{model}" posX="{x}" posY="{y}" posZ="{z}" rotX="{rx}" rotY="{ry}" rotZ="{rz}" dimension="{vw}" interior="{int}" />' ||
				$this->vehicleFormat == '<vehicle model="{model}" posX="{x}" posY="{y}" posZ="{z}" rotX="{rx}" rotY="{ry}" rotZ="{r}" color="{c1},{c2}" />' ||
				$this->objectFormat == '<object name="{comment}"><position>{x} {y} {z}</position><rotation>{rx} {ry} {rz}</rotation><model>{model}</model></object>' ||
				$this->vehicleFormat == '<spawnpoint name="{comment}"><vehicle>{model}</vehicle><position>{x} {y} {z}</position><rotation>{r}</rotation></spawnpoint>' )
			{
				return '</map>';
			}
			if( $this->convertOptions[ 'ADD_TO_SAMP_SCRIPT' ] == 'Gamemode' )
			{
				return @file_get_contents( 'http://www.convertffs.com/files/gamemode_bottom.txt' );
			}
			if( $this->convertOptions[ 'ADD_TO_SAMP_SCRIPT' ] == 'Filterscript' )
			{
				return @file_get_contents( 'http://www.convertffs.com/files/filterscript_bottom.txt' );
			}
			return '';
		}


		/**
		*
		* Checks if specified string is empty, and if so replaces it with the value defined.
		*
		* @version 0.1
		* @access private
		*
		* @return string The fixed string
		*/
		private function ifEmptyReplace( $string, $replacement )
		{
			if( empty( $string) )
			{
				$string = $replacement;
			}
			return $string;
		}
	}
?>
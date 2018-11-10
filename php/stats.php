<?php
	/*
	*
	* convertFFS.com
	*
	* This class logs and manages statistics and conversion data.
	*
	*/
	
	
	class Stats
	{
		
		
		/**
		*
		* Construct function.
		*
		* @version 0.1
		* @access private
		*/
		function __constructor( )
		{
			//Setting the timezone to UK time
			date_default_timezone_set( 'Europe/London' );
		}
		
		
		/**
		*
		* Adds the conversion to the stats.
		*
		* @version 0.1
		* @access public
		*
		* @param string $inputObjectFormat The input format for objects
		* @param string $inputVehicleFormat The input format for vehicles
		* @param string $outputObjectFormat The output format for objects
		* @param string $outputVehicleFormat The output format for vehicles
		* @param int $convertCount The number of converted objects and vehicles
		* @return n/a
		*/
		public function addToStats( $inputObjectFormat, $inputVehicleFormat, $outputObjectFormat, $outputVehicleFormat, $convertCount )
		{/*
			//Opening a link to the MySQL database.
			$sql = new mysqli( '217.18.70.250', 'killerch_cffs', 'iy1-_-cR', 'killerch_cffs' );
			//Checking if the connection was actually made.
			if( mysqli_connect_error( ) )
			{
				die( '~ERROR~' );
			}
			//Sanitizing input, kids!
			$inputObjectFormat = $sql->real_escape_string( $inputObjectFormat );
			$outputObjectFormat = $sql->real_escape_string( $outputObjectFormat );
			$inputVehicleFormat = $sql->real_escape_string( $inputVehicleFormat );
			$outputVehicleFormat = $sql->real_escape_string( $outputVehicleFormat );
			//Processing the day count.
			if( $result = $sql->query( 'SELECT day, count FROM count ORDER BY day DESC LIMIT 1' ) )
			{
				$fetchedObject = $result->fetch_object( );
				//Is the latest record from the same day?
				if( $fetchedObject->day == date( 'yz' ) )
				{
					//Yep, so we update it!
					$sql->query( 'UPDATE count SET count = \'' . ( $convertCount + $fetchedObject->count ) . '\' WHERE day = \'' . $fetchedObject->day . '\' LIMIT 1' );
				}
				else
				{
					//Nope, so we create a new record.
					$sql->query( 'INSERT INTO count (day, count) VALUES (\'' . date( 'yz' ) . '\', \'' . $convertCount . '\')' );
				}
			}
			//Processing the week count.
			if( $result = $sql->query( 'SELECT week, count FROM weekCount ORDER BY week DESC LIMIT 1' ) )
			{
				$fetchedObject = $result->fetch_object( );
				//Is the latest record from the same week?
				if( $fetchedObject->week == date( 'yW' ) )
				{
					//Yep, so we update it!
					$sql->query( 'UPDATE weekCount SET count = \'' . ( $convertCount + $fetchedObject->count ) . '\' WHERE week = \'' . $fetchedObject->week . '\' LIMIT 1' );
				}
				else
				{
					//Nope, so we create a new record.
					$sql->query( 'INSERT INTO weekCount (week, count) VALUES (\'' . date( 'yW' ) . '\', \'' . $convertCount . '\')' );
				}
			}
			//Processing the total count.
			if( $result = $sql->query( 'SELECT count FROM totalCount LIMIT 1' ) )
			{
				$fetchedObject = $result->fetch_object( );
				//Updating the total count.
				$sql->query( 'UPDATE totalCount SET count = \'' . ( $convertCount + $fetchedObject->count ) . '\' LIMIT 1' );
			}
			//Inserting this conversion into the log table.
			$sql->query( 'INSERT INTO logs (timestamp, objectInput, vehicleInput, objectOutput, vehicleOutput, count, hostName)
						  VALUES (\'' . date( 'D M j Y G:i:s T' ) . '\', \'' . $inputObjectFormat . '\', \'' . $inputVehicleFormat . '\',
						  \'' . $outputObjectFormat . '\', \'' . $outputVehicleFormat . '\', \'' . $convertCount . '\',\'' . gethostbyaddr( $_SERVER[ 'REMOTE_ADDR' ] ) . '\')' );
			$sql->close( );*/
		}
		
		
		/**
		*
		* Returns the current numbers of conversions.
		*
		* @version 0.1
		* @access public
		*
		* @return array $countArray An assoc array containing the day, week and total count values.
		*/
		public function fetchStats( )
		{/*
			//Opening a link to the MySQL database.
			$sql = new mysqli( '217.18.70.250', 'killerch_cffs', 'iy1-_-cR', 'killerch_cffs' );
			//Checking if the connection was actually made.
			if( mysqli_connect_error( ) )
			{
				die( '~ERROR~' );
			}
			//Getting the day count.
			if( $result = $sql->query( 'SELECT count FROM count ORDER BY day DESC LIMIT 1' ) )
			{
				$fetchedObject = $result->fetch_object( );
				//Adding the day count to the array.
				$countArray[ 'day' ] = $fetchedObject->count;
			}
			//Getting the week count.
			if( $result = $sql->query( 'SELECT count FROM weekCount ORDER BY week DESC LIMIT 1' ) )
			{
				$fetchedObject = $result->fetch_object( );
				//Adding the week count to the array.
				$countArray[ 'week' ] = $fetchedObject->count;
			}
			//Getting the total count.
			if( $result = $sql->query( 'SELECT count FROM totalCount LIMIT 1' ) )
			{
				$fetchedObject = $result->fetch_object( );
				//Adding the week count to the array.
				$countArray[ 'total' ] = $fetchedObject->count;
			}
			//Checking if the day count has been set, if not we set it to zero.
			if( !isset( $countArray[ 'day' ] ) )
			{
				$countArray[ 'day' ] = 0;	
			}
			//Checking if the week count has been set, if not we set it to zero.
			if( !isset( $countArray[ 'week' ] ) )
			{
				$countArray[ 'week' ] = 0;	
			}
			//Checking if the total count has been set, if not we set it to zero.
			if( !isset( $countArray[ 'total' ] ) )
			{
				$countArray[ 'total' ] = 0;	
			}
			$sql->close( );
			//Getting the average conversions per minute
			$startTime = mktime( 0, 0, 0, 6, 1, 2009 );
			$currTime = time( );
			$numberOfMinutes = ( $currTime - $startTime ) / 60;
			$countArray[ 'average' ] = $countArray[ 'total' ] / $numberOfMinutes;
			//Returning the assoc array.
			return $countArray;*/
			return array
			(
				'day' => '1337',
				'week' => '1337',
				'total' => '13371337',
				'average' => '1337'
			);
		}
		
		
		/**
		*
		* Adds extended conversion data into the qualityControl table.
		*
		* @version 0.1
		* @access public
		*
		* @param string $inputObjectLine The first object before converting
		* @param string $outputObjectLine The first object after converting
		* @param string $inputVehicleLine The first vehicle before converting
		* @param string $outputVehicleLine The first vehicle after converting
		* @param string $inputObjectFormat The input format for objects
		* @param string $inputVehicleFormat The input format for vehicles
		* @param string $outputObjectFormat The output format for objects
		* @param string $outputVehicleFormat The output format for vehicles
		* @return n/a
		*/
		public function addToQualityControl( $inputObjectLine, $outputObjectLine, $inputVehicleLine, $outputVehicleLine, $inputObjectFormat, $inputVehicleFormat, $outputObjectFormat, $outputVehicleFormat )
		{/*
			//Opening a link to the MySQL database.
			$sql = new mysqli( '217.18.70.250', 'killerch_cffs', 'iy1-_-cR', 'killerch_cffs' );
			//Checking if the connection was actually made.
			if( mysqli_connect_error( ) )
			{
				die( '~ERROR~' );
			}
			
			//Sanitizing input, kids!
			$inputObjectLine = $sql->real_escape_string( $inputObjectLine );
			$outputObjectLine = $sql->real_escape_string( $outputObjectLine );
			$inputVehicleLine = $sql->real_escape_string( $inputVehicleLine );
			$outputVehicleLine = $sql->real_escape_string( $outputVehicleLine );
			$inputObjectFormat = $sql->real_escape_string( $inputObjectFormat );
			$outputObjectFormat = $sql->real_escape_string( $outputObjectFormat );
			$inputVehicleFormat = $sql->real_escape_string( $inputVehicleFormat );
			$outputVehicleFormat = $sql->real_escape_string( $outputVehicleFormat );
			
			$timestamp = date( 'D M j Y G:i:s T' );
			$hostName = gethostbyaddr( $_SERVER[ 'REMOTE_ADDR' ] );
			
			$sql->query( "INSERT INTO qualityControl (objectBefore, objectAfter, vehicleBefore, vehicleAfter, objectInput, objectOutput, vehicleInput, vehicleOutput, timestamp, hostName)
						  VALUES ('$inputObjectLine', '$outputObjectLine', '$inputVehicleLine', '$outputVehicleLine', '$inputObjectFormat', '$outputObjectFormat', '$inputVehicleFormat',
						  '$outputVehicleFormat', '$timestamp', '$hostName');" );
			$sql->close( );	*/
		}

		public function removeQualityControlData( )
		{/*
			//Opening a link to the MySQL database.
			$sql = new mysqli( '217.18.70.250', 'killerch_cffs', 'iy1-_-cR', 'killerch_cffs' );
			//Checking if the connection was actually made.
			if( mysqli_connect_error( ) )
			{
				die( '~ERROR~' );
			}

			$hostName = gethostbyaddr( $_SERVER[ 'REMOTE_ADDR' ] );

			$sql->query( "DELETE FROM qualityControl WHERE hostName='$hostName'" );
						  			
			$sql->close( );	*/	
		}
	}
?>
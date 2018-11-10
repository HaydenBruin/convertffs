<?php
	/*
	*
	* convertFFS.com
	*
	* This class manages PHP and convertFFS generated errors.
	*
	*/
	class ErrorHandler
	{
		
		
		/**
		*
		* Construct function.
		*
		* @version 0.1
		* @access private
		*/
		function __construct( )
		{
			//Setting the error handler to our class
			set_error_handler( array( $this, 'phpHandle' ) );
			//Setting the timezone to UK time
			date_default_timezone_set( 'Europe/London' );
		}
	
	
		/**
		*
		* Acts as the default error handler for PHP errors.
		*
		* @version 0.1
		* @access public
		* 
		* @param int $errorType Sent by PHP
		* @param string $errorString Sent by PHP
		* @param string $errorFile Sent by PHP
		* @param int $errorLine Sent by PHP
		* @return bool Always true
		*/
		public function phpHandle( $errorType, $errorString, $errorFile, $errorLine )
		{
			//Which type of error this this?
			switch ( $errorType )
			{
				//Notice
				case E_NOTICE :
				case E_USER_NOTICE :
					$errorType = 'Notice';
					break;
				//Warning
				case E_WARNING :
				case E_USER_WARNING :
					$errorType = 'Warning';
					break;
				//Error
				case E_ERROR :
				case E_USER_ERROR :
					$errorType = 'Fatal Error';
					break;
				//No idea!
				default :
					$errorType = 'Unknown';
					break;
			}
			//Send a PHP style error message to the error handler
			$this->handle( $errorType.': '.$errorString.' in '.$errorFile.' on line '.$errorLine );
			return true;
		}
		
		
		/**
		*
		* Takes user, and PHP generated errors and handles them in the correct manner.
		*
		* @version 0.1
		* @access public
		* 
		* @param string $errorMessage The error message
		* @return n/a
		*/
		public function handle( $errorMessage )
		{
			if( error_reporting( ) == 0 )
			{
				//@ sign used!
				return;
			}
			//Does the error message start with a '~'? If not, it is an error caused by PHP.
			if( $errorMessage[ 0 ] != 'FUCKYOUSERVERFFSMAKINGMEDOSTUFF' )
			{
				//Getting the scripts filename.
				$errorFilename = $_SERVER[ 'PHP_SELF' ];
				//Getting the date.
				$errorDate = date( 'D M j Y G:i:s T' );
				//Getting the IP of the user who experienced this error.
				$errorIP = $_SERVER[ 'REMOTE_ADDR' ];
				//Getting the user's browser agent.
				$errorUserAgent = $_SERVER[ 'HTTP_USER_AGENT' ];
				//Get whatever is in $_POST
				$post = print_r( $_POST, true );
				//Send kc an E-Mail so he knows about this.
				mail( 'liam.clay@googlemail.com',
					  'convertFFS - Error in '.$errorFilename,
					  "Sup,\n\n$errorFilename has suffered an error.\n\n$errorMessage\n\nOccurred: $errorDate\nIP: $errorIP\nUser-Agent: $errorUserAgent\n\nBai!\n\n\nPOST contents:\n\n$post" );
				//Set the error message to the default so it displays gracefully for the user.
				$errorMessage = '~ERROR~';
			}
			//Echo the exception message and end script execution.
			die( $errorMessage );
		}
	} 
?>
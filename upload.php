<?php
	/*
	*
	* convertFFS.com
	*
	* Gets file from AJAX file upload system, and returns the file contents or an error code.
	*
	*/
	
	
	//Including and then loading the error handling class.
	require_once( 'php/errorHandler.php' );
	$errorHandler = new ErrorHandler( );

	//Checking if it is just someone dicking around on upload.php instead of actually uploading.
	if( !count( $_FILES ) )
	{
		header( "Location: tsk.html" );
		die( );
	}
	//Setting the content type to plain text to prevent some odd HTML rendering engine behaviour.
	header( 'Content-type: text/plain' );
	
	//Lets see if the file is bigger than 40mb
	if( $_FILES[ 'userfile' ][ 'size' ] > 40000000 )
	{
		$errorHandler->handle( '~SIZE~' );
	}
	//Separating the file extension from the file name.
	$uploadedFileExtension = pathinfo( $_FILES[ 'userfile' ][ 'name' ] );
	$uploadedFileFilename = $uploadedFileExtension[ 'filename' ];
	$uploadedFileExtension = $uploadedFileExtension[ 'extension' ];
	//Checking if the file extension is supported.
	$allowedExtensionArray = array( 'txt', 'pwn', 'pawn', 'map', 'ini', 'cfg', 'xml', 'html', 'htm', 'csv' );
	if( !in_array( $uploadedFileExtension, $allowedExtensionArray ) )
	{
		$errorHandler->handle( '~UNSUPPORTED~' );
	}
	if( $_FILES[ 'userfile' ][ 'error' ] > 0)
	{
		$errorHandler->handle( '~ERROR~' );
	}
	if( empty( $uploadedFileFilename ) )
	{
		$errorHandler->handle( '~ERROR~' );
	}
	if( empty( $_FILES[ 'userfile' ][ 'tmp_name' ] ) )
	{
		$errorHandler->handle( '~ERROR~' );
	}

	//All checks complete, lets echo the file contents!
	echo @file_get_contents( $_FILES[ 'userfile' ][ 'tmp_name' ] );
?>

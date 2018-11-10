<?php
	/**
	*
	* convertFFS.com
	*
	* This uses the Stats class to display the statistics for the user.
	*
	*/
	
	//Include the Stats class
	require_once( 'php/stats.php' );
	//Load the stats class
	$stats = new Stats( );
	//Fetch the stats.
	$fetchedStats = $stats->fetchStats( );
	//Echo the fetched stats.
	echo number_format( $fetchedStats[ 'day' ] ) . '|' . number_format( $fetchedStats[ 'week' ] ) . '|' . number_format( $fetchedStats[ 'total' ] ) . '|' . ( int )$fetchedStats[ 'average' ];
	//Fin.
?>
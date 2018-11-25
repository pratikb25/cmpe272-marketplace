<?php
	/* Original values
	$DBHOST = "localhost:3306";
	$DBUSER = "nikhilnl_prouser";
	$DBPWD = "prouser";
	$DBNAME = "nikhilnl_projectdatabase";*/
	$DBHOST = "localhost:3306";
	$DBUSER = "nikhilnl_prouser";
	$DBPWD = "prouser";
	$DBNAME = "nikhilnl_projectdatabase";

	function open_db_conn() {
		$conn =  mysqli_connect($DBHOST, 
								$DBUSER, 
								$DBPWD, 
								$DBNAME);

		if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
    		return NULL;
		} 
		return $conn;
	}

	function close_db_conn($conn){
		// Close MySQL connection
		mysqli_close($conn);
	}

?>
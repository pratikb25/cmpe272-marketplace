<?php
	// Include global functions
	include('./globals.php');

	function add_to_cart() {
		// Open new connection
		$conn = open_db_conn();

		// Get parameters from HTTP POST
		$userid = $_POST['userid'];
		$prodID = $_POST['prodID'];
		$prodCat = $_POST['prodCat'];
		$qty = $_POST['qty'];

		$query = "select * from cart where prodID = ".$prodID." and prodCat = ".$prodCat." and userid = ".
			$userid." and isordered = FALSE";
		
		$result = mysqli_query($conn, $query);

		if(mysqli_num_rows($result) == 0) {
			// No earlier record available. Create new record in the 'cart' table
			$query = "insert into cart(prodID, prodCat, userid, qty, isordered) values(".$prodID.", ".$prodCat.", ".$userid.", ".$qty.", FALSE)";
		}
		else {
			$query = "update cart set qty = ".$qty." where prodID = ".$prodID." and prodCat = ".$prodCat." and userid = ".$userid." and isordered = FALSE" ;
		}

		// Execute the query
		mysqli_query($conn, $query);

		// Close MySQL connection
		close_db_conn($conn);
	}

	function remove_from_cart() {
		// Open new connection
		$conn = open_db_conn();

		// Get parameters from HTTP POST
		$prodID = $_POST['prodID'];
		$prodCat = $_POST['prodCat'];
		$userid = $_POST['userid'];

		$query = "delete from cart where prodID = ".$prodID." and prodCat = ".$prodCat." and userid = ".
			$userid." and isordered = FALSE";

		// Execute the query
		mysqli_query($conn, $query);

		// Close MySQL connection
		close_db_conn($conn);	
	}

	function place_order() {
		// Open new connection
		$conn = open_db_conn();

		// Get parameters from HTTP POST
		$prodID = $_POST['prodID'];
		$prodCat = $_POST['prodCat'];
		$userid = $_POST['userid'];
		$qty = $_POST['qty'];

		$query = "select * from cart where prodID = ".$prodID." and prodCat = ".$prodCat." and userid = ".
			$userid." and isordered = FALSE";
		
		$result = mysqli_query($conn, $query);

		if(mysqli_num_rows($result) == 0) {
			// No earlier record available. Create new record in the 'cart' table
			$query = "insert into cart((prodID, prodCat, userid, qty, isordered)) values(".$prodID.", ".$prodCat.", ".$userid.", ".$qty.", TRUE)";
		}
		else {
			$query = "update cart set qty = ".$qty." and isordered = True where prodID = ".$prodID." and prodCat = ".$prodCat." and userid = ".$userid." and isordered = FALSE" ;
		}

		// Execute the query
		mysqli_query($conn, $query);

		// Close MySQL connection
		close_db_conn($conn);
	}

	function get_cart() {
		// Open new connection
		$conn = open_db_conn();

		// Get parameters from HTTP POST
		$prodID = $_GET['prodID'];
		$prodCat = $_GET['prodCat'];
		$userid = $_GET['userid'];

		$query = "select * from cart where prodID = ".$prodID." and prodCat = ".$prodCat." and userid = ".
			$userid." and isordered = FALSE";

		$result = mysqli_query($conn, $query);

		$items = array();

		while ($row = mysqli_fetch_array($result)) {
			array_push($items, array(
				"prodID"=>$row['prodID'],
				"prodCat"=>$row['prodCat'],
				"userid"=>$row['userid'],
				"qty"=>$row['qty'],
				"isordered"=>$row['isordered']
				));
		}

		if(mysqli_num_rows($result) > 0) {
			print(json_encode($items));
		}

		// Close MySQL connection
		close_db_conn($conn);
	}
?>
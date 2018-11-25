<?php 

$conn =  mysqli_connect("pratikbhandarkar2580740.ipagemysql.com", "pratikb", "welcome","testdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$query = "SELECT * from products";

$result = mysqli_query($conn, $query);

$count = mysqli_num_rows($result);

$products = array();

while($row = mysqli_fetch_array($result)) {
	array_push($products, array(
            "prodID"=>$row['prodID'],
            "prodName"=>$row['prodName'],
            "prodDesc"=>$row['LastName'],
            "prodPrice"=>$row['prodPrice'],
            "prodImg"=>$row['prodImg'],
	    "prodCat"=>"1",
	    "prodCatName"=>"Homes"
	));
}

if($count > 0) {
	print(json_encode($products));
} 
else {
	print("No products Found");
}

// Close MySQL connection
mysqli_close($conn);

?>

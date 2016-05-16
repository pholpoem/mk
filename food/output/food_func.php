<?php
function Connect() {
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "mk_db";
	
	$conn = new mysqli ( $servername, $username, $password, $dbname );
	mysqli_set_charset ( $conn, "utf8" );
	
	if ($conn->connect_error) {
		die ( "Connection failed: " . $conn->connect_error );
	}
	return $conn;
}
function Newfood($foodName,$description,$price,$image,$cat_id){
	$conn = Connect ();
	
	$sql = "INSERT INTO food (food_id,foodName,description,price,image,cat_id) VALUES (0,?,?,?,?,?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ssisi", $foodName,$description,$price,$image,$cat_id);
	
	if ($stmt->execute() === TRUE) {
		header("location:index.php");
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$stmt->close ();
	$conn->close ();
}
function updatefood($food_id,$foodName,$description,$price,$image,$cat_id) {
	$conn = Connect ();
	
	$sql = "UPDATE food SET foodName = ?,description = ?,price = ?,image = ?,cat_id = ? WHERE food_id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ssisii", $foodName,$description,$price,$image,$cat_id,$food_id);
	
	if ($stmt->execute() === TRUE) {
		header ( "location:index.php" );
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$stmt->close ();
	$conn->close ();
}
function getAllfood() {
	$conn = Connect ();
	
	$sql = "SELECT * FROM `food` ";
	$result = $conn->query($sql);
	
	$food = array ();
	if($result->num_rows > 0)
	{
		while ($row = $result->fetch_assoc () ) {
			$food_row = array (
										"food_id" =>  $row ['food_id'],
										"foodName" =>  $row ['foodName'],
										"description" =>  $row ['description'],
										"price" =>  $row ['price'],
										"image" =>  $row ['image'],
										"cat_id" =>  $row ['cat_id']
										);
				array_push ( $food, $food_row );
		}
	} else {
		echo "0 result";
		}
	$conn->close ();
	return $food;
}
function getfoodByfood_id($food_id) {
	$conn = Connect ();
	
	$sql = "SELECT * FROM food WHERE food_id = ?";
	
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $food_id);
	$stmt->execute();
	$stmt ->bind_result($food_id,$foodName,$description,$price,$image,$cat_id);
	
	$food = array ();
	while ( $stmt->fetch () ) {
		$food_row = array (
										"food_id" => $food_id,
										"foodName" => $foodName,
										"description" => $description,
										"price" => $price,
										"image" => $image,
										"cat_id" => $cat_id
										);
		array_push ( $food, $food_row );
		}
	$conn->close ();
	return $food;
}

function deletefood($food_id) {
	$conn = Connect ();
	$sql = "DELETE FROM food WHERE food_id= ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i",$food_id);
	
	if ($stmt->execute() === TRUE) {
		echo "<h3 style='color:red'>ลบข้อมูลเรียบร้อยแล้ว</h3>";
		//header ( "location:index.php" );
	} else {
		echo "Error deleting record: " . $conn->error;
	}
	$stmt->close ();
	$conn->close ();
}

function searchfood($name_search,$column_name_search) {
	$conn = Connect ();
	
	$sql = "SELECT * FROM `food` WHERE ".$column_name_search." LIKE ?";
	
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $name_search);
	$stmt->execute();
	$stmt ->bind_result($food_id,$foodName,$description,$price,$image,$cat_id);
	
	$food = array ();
	while ( $stmt->fetch () ) {
		$food_row = array (
										"food_id" => $food_id,
										"foodName" => $foodName,
										"description" => $description,
										"price" => $price,
										"image" => $image,
										"cat_id" => $cat_id
										);
			array_push ( $food, $food_row );
		}
		$stmt->close ();
	$conn->close ();
	return $food;
}
?>
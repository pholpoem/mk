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
function Newcategory($catName){
	$conn = Connect ();
	
	$sql = "INSERT INTO category (cat_id,catName) VALUES (0,?,?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $catName);
	
	if ($stmt->execute() === TRUE) {
		header("location:index.php");
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$stmt->close ();
	$conn->close ();
}
function updatecategory($cat_id,$catName) {
	$conn = Connect ();
	
	$sql = "UPDATE category SET catName = ? WHERE cat_id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("si", $catName,$cat_id);
	
	if ($stmt->execute() === TRUE) {
		header ( "location:index.php" );
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$stmt->close ();
	$conn->close ();
}
function getAllcategory() {
	$conn = Connect ();
	
	$sql = "SELECT * FROM `category` ";
	$result = $conn->query($sql);
	
	$category = array ();
	if($result->num_rows > 0)
	{
		while ($row = $result->fetch_assoc () ) {
			$category_row = array (
										"cat_id" =>  $row ['cat_id'],
										"catName" =>  $row ['catName']
										);
				array_push ( $category, $category_row );
		}
	} else {
		echo "0 result";
		}
	$conn->close ();
	return $category;
}
function getcategoryBycat_id($cat_id) {
	$conn = Connect ();
	
	$sql = "SELECT * FROM category WHERE cat_id = ?";
	
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $cat_id);
	$stmt->execute();
	$stmt ->bind_result($cat_id,$catName);
	
	$category = array ();
	while ( $stmt->fetch () ) {
		$category_row = array (
										"cat_id" => $cat_id,
										"catName" => $catName
										);
		array_push ( $category, $category_row );
		}
	$conn->close ();
	return $category;
}

function deletecategory($cat_id) {
	$conn = Connect ();
	$sql = "DELETE FROM category WHERE cat_id= ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i",$cat_id);
	
	if ($stmt->execute() === TRUE) {
		echo "<h3 style='color:red'>ลบข้อมูลเรียบร้อยแล้ว</h3>";
		//header ( "location:index.php" );
	} else {
		echo "Error deleting record: " . $conn->error;
	}
	$stmt->close ();
	$conn->close ();
}

function searchcategory($name_search) {
	$conn = Connect ();
	
	$sql = "SELECT * FROM `category` WHERE `name` LIKE ?";
	echo $sql;
	
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $name_search);
	$stmt->execute();
	$stmt ->bind_result($cat_id,$catName);
	
	$category = array ();
	while ( $stmt->fetch () ) {
		$category_row = array (
										"cat_id" => $cat_id,
										"catName" => $catName
										);
			array_push ( $category, $category_row );
		}
		$stmt->close ();
	$conn->close ();
	return $category;
}
?>
<?php
function Connect_order() {
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
function Neworder($table_no,$status){
	$conn = Connect_order ();
	
	$sql = "INSERT INTO order (table_no,status) VALUES (?,?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ss", $table_no, $status);
	
	if ($stmt->execute() === TRUE) {
		//header("location:index.php");
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$stmt->close ();
	$conn->close ();
}

function updateorder($order_id,$table_no,$status,$date_time) {
	$conn = Connect_order ();
	
	$sql = "UPDATE order SET table_no = ?,status = ?,date_time = ? WHERE order_id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sssi", $table_no,$status,$date_time,$order_id);
	
	if ($stmt->execute() === TRUE) {
		header ( "location:index.php" );
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$stmt->close ();
	$conn->close ();
}
function getAllorder() {
	$conn = Connect_order ();
	
	$sql = "SELECT * FROM `orders` ";
	$result = $conn->query($sql);
	
	$order = array ();
	if($result->num_rows > 0)
	{
		while ($row = $result->fetch_assoc () ) {
			$order_row = array (
										"order_id" =>  $row ['order_id'],
										"table_no" =>  $row ['table_no'],
										"status" =>  $row ['status'],
										"date_time" =>  $row ['date_time']
										);
				array_push ( $order, $order_row );
		}
	} else {
		echo "0 result";
		}
	$conn->close ();
	return $order;
}
function getorderByorder_id($order_id) {
	$conn = Connect_order ();
	
	$sql = "SELECT * FROM orders WHERE order_id = ?";
	
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $order_id);
	$stmt->execute();
	$stmt ->bind_result($order_id,$table_no,$status,$date_time);
	
	$order = array ();
	while ( $stmt->fetch () ) {
		$order_row = array (
			"order_id" => $order_id,
			"table_no" => $table_no,
			"status" => $status,
			"date_time" => $date_time
										);
		array_push ( $order, $order_row );
		}
	$conn->close ();
	return $order;
}

function deleteorder($order_id) {
	$conn = Connect_order ();
	$sql = "DELETE FROM order WHERE order_id= ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i",$order_id);
	
	if ($stmt->execute() === TRUE) {
		echo "<h3 style='color:red'>ลบข้อมูลเรียบร้อยแล้ว</h3>";
		//header ( "location:index.php" );
	} else {
		echo "Error deleting record: " . $conn->error;
	}
	$stmt->close ();
	$conn->close ();
}

function searchorder($name_search) {
	$conn = Connect_order ();
	
	$sql = "SELECT * FROM `order` WHERE `name` LIKE ?";
	echo $sql;
	
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $name_search);
	$stmt->execute();
	$stmt ->bind_result($order_id,$table_no,$status,$date_time);
	
	$order = array ();
	while ( $stmt->fetch () ) {
		$order_row = array (
										"order_id" => $order_id,
										"table_no" => $table_no,
										"status" => $status,
										"date_time" => $date_time
										);
			array_push ( $order, $order_row );
		}
		$stmt->close ();
	$conn->close ();
	return $order;
}

function search_openorder($table_no) {
	$conn = Connect ();
	
	$sql = "SELECT * FROM `order` WHERE `table_no` LIKE ? AND `status`= 'open' ORDER BY order_id DESC";
			
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $table_no);
	$stmt->execute();
	$stmt->bind_result($order_id,$table_no,$status,$date_time);
	
	$order = array ();
	while ( $stmt->fetch () ) {
		$order_row = array (
			"order_id" => $order_id,
			"table_no" => $table_no,
			"status" => $status,
			"date_time" => $date_time
		);
		array_push ( $order, $order_row );
	}
	$stmt->close ();
	$conn->close ();
	return $order;
}
?>
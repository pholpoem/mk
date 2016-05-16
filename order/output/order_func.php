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
function Neworders($table_no,$status){
	$conn = Connect_order ();
	
	$sql = "INSERT INTO orders (table_no,status) VALUES (?,?)";
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

function updateorders($order_id,$status) {
	$conn = Connect_order ();
	
	$sql = "UPDATE orders SET status = ? WHERE order_id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("si",$status,$order_id);
	
	if ($stmt->execute() === TRUE) {
		header ( "location:index.php" );
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$stmt->close ();
	$conn->close ();
}
function getAllorders() {
	$conn = Connect_order ();
	
	$sql = "SELECT * FROM `orders` ";
	$result = $conn->query($sql);
	
	$orders = array ();
	if($result->num_rows > 0)
	{
		while ($row = $result->fetch_assoc () ) {
			$orders_row = array (
										"order_id" =>  $row ['order_id'],
										"table_no" =>  $row ['table_no'],
										"status" =>  $row ['status'],
										"date_time" =>  $row ['date_time']
										);
				array_push ( $orders, $orders_row );
		}
	} else {
		echo "0 result";
		}
	$conn->close ();
	return $orders;
}
function getordersByorder_id($order_id) {
	$conn = Connect_order ();
	
	$sql = "SELECT * FROM orders WHERE order_id = ?";
	
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $order_id);
	$stmt->execute();
	$stmt ->bind_result($order_id,$table_no,$status,$date_time);
	
	$orders = array ();
	while ( $stmt->fetch () ) {
		$orders_row = array (
										"order_id" => $order_id,
										"table_no" => $table_no,
										"status" => $status,
										"date_time" => $date_time
										);
		array_push ( $orders, $orders_row );
		}
	$conn->close ();
	return $orders;
}

function deleteorders($order_id) {
	$conn = Connect_order ();
	$sql = "DELETE FROM orders WHERE order_id= ?";
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

function searchorders($name_search) {
	$conn = Connect_order ();
	
	$sql = "SELECT * FROM `orders` WHERE `name` LIKE ?";
	echo $sql;
	
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $name_search);
	$stmt->execute();
	$stmt ->bind_result($order_id,$table_no,$status,$date_time);
	
	$orders = array ();
	while ( $stmt->fetch () ) {
		$orders_row = array (
										"order_id" => $order_id,
										"table_no" => $table_no,
										"status" => $status,
										"date_time" => $date_time
										);
			array_push ( $orders, $orders_row );
		}
		$stmt->close ();
	$conn->close ();
	return $orders;
}

function search_openorders($table_no) {
	$conn = Connect ();
	
	$sql = "SELECT * FROM `orders` WHERE `table_no` LIKE ? AND `status`= 'open' ORDER BY order_id DESC";
			
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $table_no);
	$stmt->execute();
	$stmt->bind_result($order_id,$table_no,$status,$date_time);
	
	$orders = array ();
	while ( $stmt->fetch () ) {
		$orders_row = array (
			"order_id" => $order_id,
			"table_no" => $table_no,
			"status" => $status,
			"date_time" => $date_time
		);
		array_push ( $orders, $orders_row );
	}
	$stmt->close ();
	$conn->close ();
	return $orders;
}
?>
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
function Neworders_detail($food_id,$order_id,$qty,$status){
	$conn = Connect ();
	
	$sql = "INSERT INTO order_detail (food_id,order_id,qty,status) VALUES (?,?,?,?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("iiis", $food_id,$order_id,$qty,$status);
	
	if ($stmt->execute() === TRUE) {
		header("location:index.php");
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$stmt->close ();
	$conn->close ();
}
function updateorder_detail($detail_id,$status) {
	$conn = Connect ();
	
	$sql = "UPDATE order_detail SET status = ? WHERE detail_id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("si", $status,$detail_id);
	echo $sql;
	if ($stmt->execute() === TRUE) {
		//header ( "location:index.php" );
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$stmt->close ();
	$conn->close ();
}
function getAllorders_detail() {
	$conn = Connect ();
	
	$sql = "SELECT * FROM `orders_detail` ";
	$result = $conn->query($sql);
	
	$orders_detail = array ();
	if($result->num_rows > 0)
	{
		while ($row = $result->fetch_assoc () ) {
			$orders_detail_row = array (
										"detail_id" =>  $row ['detail_id'],
										"food_id" =>  $row ['food_id'],
										"order_id" =>  $row ['order_id'],
										"qty" =>  $row ['qty'],
										"status" =>  $row ['status'],
										"date_time" =>  $row ['date_time']
										);
				array_push ( $orders_detail, $orders_detail_row );
		}
	} else {
		echo "0 result";
		}
	$conn->close ();
	return $orders_detail;
}

function getorder_detail_id_status($order_id,$status) {
	$conn = Connect ();
	
	$sql = "SELECT * FROM order_detail INNER JOIN food AS f ON f.food_id = order_detail.food_id WHERE order_id = ?";

	$count_status = count($status);
	if($count_status > 0){
		$sql = $sql." AND ( ";
		
		for($i = 0; $i < $count_status; $i++){
			$sql = $sql." status = '".$status[$i]."' ";
			
			if($i < $count_status - 1){
				$sql = $sql." OR ";
			}
		}
		$sql = $sql." ) ";
	}
	$sql = $sql." ORDER BY date_time ASC";
	//echo $sql;
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $order_id);
	$stmt->execute();
	$stmt ->bind_result($detail_id,$food_id,$order_id,$qty,$status,$date_time,$food_id_x,$foodName,$description,$price,$image,$cat_id);
	
	$orders_detail = array ();
	while ( $stmt->fetch () ) {
		$orders_detail_row = array (
			"detail_id" => $detail_id,
			"food_id" => $food_id,
			"order_id" => $order_id,
			"qty" => $qty,
			"status" => $status,
			"date_time" => $date_time,
										
			"food_id" => $food_id_x,
			"foodName" => $foodName,
			"description" => $description,
			"price" => $price,
			"image" => $image,
			"cat_id" => $cat_id
		);
		array_push ( $orders_detail, $orders_detail_row );
		}
	$conn->close ();
	return $orders_detail;
}

function getorder_detailByid($detail_id) {
	$conn = Connect ();
	
	$sql = "SELECT * FROM order_detail WHERE detail_id = ?";

	//echo $sql;
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $detail_id);
	$stmt->execute();
	$stmt ->bind_result($detail_id,$food_id,$order_id,$qty,$status,$date_time);
	
	$orders_detail = array ();
	while ( $stmt->fetch () ) {
		$orders_detail_row = array (
			"detail_id" => $detail_id,
			"food_id" => $food_id,
			"order_id" => $order_id,
			"qty" => $qty,
			"status" => $status,
			"date_time" => $date_time,
		);
		array_push ( $orders_detail, $orders_detail_row );
		}
	$conn->close ();
	return $orders_detail;
}

function deleteorders_detail($detail_id) {
	$conn = Connect ();
	$sql = "DELETE FROM orders_detail WHERE detail_id= ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i",$detail_id);
	
	if ($stmt->execute() === TRUE) {
		echo "<h3 style='color:red'>ลบข้อมูลเรียบร้อยแล้ว</h3>";
		//header ( "location:index.php" );
	} else {
		echo "Error deleting record: " . $conn->error;
	}
	$stmt->close ();
	$conn->close ();
}

function searchorders_detail($name_search) {
	$conn = Connect ();
	
	$sql = "SELECT * FROM `orders_detail` WHERE `name` LIKE ?";
	echo $sql;
	
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $name_search);
	$stmt->execute();
	$stmt ->bind_result($detail_id,$food_id,$order_id,$qty,$status,$date_time);
	
	$orders_detail = array ();
	while ( $stmt->fetch () ) {
		$orders_detail_row = array (
										"detail_id" => $detail_id,
										"food_id" => $food_id,
										"order_id" => $order_id,
										"qty" => $qty,
										"status" => $status,
										"date_time" => $date_time
										);
			array_push ( $orders_detail, $orders_detail_row );
		}
		$stmt->close ();
	$conn->close ();
	return $orders_detail;
}
?>
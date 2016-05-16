<?php
require_once ("order_func.php");
$order = getAllorder();

if (count ( $order ) > 0) {
	echo "<table class='table table-striped'>";
	echo "<tr>";
	$keys = array_keys ( $order [0] );
	for($i = 0; $i < count ( $keys ); $i ++) {
		$key = $keys [$i];
		echo "<th>" . $key . "</th>";
	}
	echo "<th>แก้ไข</th>";
	echo "<th>ลบ</th>";
	echo "<th>รายละเอียด</th>";
	echo "<th>ปิดออเดอร์</th>";
	echo "<th>ยกเลิกออเดอร์</th>";
	echo "</tr>";
	for($i = 0; $i < count ( $order ); $i ++) {
		echo "<tr>";
		for($j = 0; $j < count ( $keys ); $j ++) {
			$key = $keys [$j];
			echo "<td>" . $order [$i] [$key] . "</td>";
		}
		$order_id = $order[$i] ['order_id'];
		echo "<td><button onclick = 'edit(".$order_id.")' class='btn btn-warning'>Edit</button></td>";
		echo "<td><button onclick = 'confirm_delete(".$order_id.")' class='btn btn-danger'>Delete</button></td>";
		echo "<td><button onclick = 'show_detail(".$order_id.")' class='btn btn-danger'>Detail</button></td>";
		echo "<td><button onclick = 'close_order(".$order_id.")' class='btn btn-danger'>Close</button></td>";
		echo "<td><button onclick = 'cancel_order(".$order_id.")' class='btn btn-danger'>Cancel</button></td>";
		echo "</tr>";
	}
	echo "</table>";
}
?>
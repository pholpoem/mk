<?php
require_once ("food_func.php");
$food = getAllfood();

if (count ( $food ) > 0) {
	echo "<table class='table table-striped'>";
	echo "<tr>";
	$keys = array_keys ( $food [0] );
	for($i = 0; $i < count ( $keys ); $i ++) {
		$key = $keys [$i];
		echo "<th>" . $key . "</th>";
	}
	echo "<th>Edit</th>";
	echo "<th>Delete</th>";
	echo "</tr>";
	for($i = 0; $i < count ( $food ); $i ++) {
		echo "<tr>";
		for($j = 0; $j < count ( $keys ); $j ++) {
			$key = $keys [$j];
			echo "<td>" . $food [$i] [$key] . "</td>";
		}
		$food_id = $food[$i] ['food_id'];
		echo "<td><button onclick = 'edit(".$food_id.")' class='btn btn-warning'>Edit</button></td>";
		echo "<td><button onclick = 'confirm_delete(".$food_id.")' class='btn btn-danger'>Delete</button></td>";
		echo "</tr>";
	}
	echo "</table>";
}
?>
<?php
require_once ("{{TABLE NAME}}_func.php");
${{TABLE NAME}} = getAll{{TABLE NAME}}();

if (count ( ${{TABLE NAME}} ) > 0) {
	echo "<table class='table table-striped'>";
	echo "<tr>";
	$keys = array_keys ( ${{TABLE NAME}} [0] );
	for($i = 0; $i < count ( $keys ); $i ++) {
		$key = $keys [$i];
		echo "<th>" . $key . "</th>";
	}
	echo "<th>Edit</th>";
	echo "<th>Delete</th>";
	echo "</tr>";
	for($i = 0; $i < count ( ${{TABLE NAME}} ); $i ++) {
		echo "<tr>";
		for($j = 0; $j < count ( $keys ); $j ++) {
			$key = $keys [$j];
			echo "<td>" . ${{TABLE NAME}} [$i] [$key] . "</td>";
		}
		$id = ${{TABLE NAME}}[$i] ['id'];
		echo "<td><button onclick = 'edit(".$id.")' class='btn btn-warning'>Edit</button></td>";
		echo "<td><button onclick = 'confirm_delete(".$id.")' class='btn btn-danger'>Delete</button></td>";
		echo "</tr>";
	}
	echo "</table>";
}
?>
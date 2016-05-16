<?php
	//error_reporting ( error_reporting () & ~ E_NOTICE );
	require_once('../order_detail/output/order_detail_func.php');
	$order_id = $_GET['order_id'];
	$status = array();
	$detail = getorder_detail_id_status($order_id,$status);
	$count = count($detail);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="../css/mk.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="../js/jquery-2.2.0.js"></script>
<script type="text/javascript" src="js/func.js"></script>
</head>
<body>
<div class = "main">

	<table class='table table-striped'>
		<?php
		if($count > 0){
			for($i = 0; $i < $count; $i++) {
				//$detail_id = $detail[$i]['detail_id'];
				echo "<tr>";
				echo 	"<td>";
				echo 	$detail[$i]['detail_id'];
				echo 	"</td>";
				echo 	"<td>";
				echo 	$detail[$i]['order_id'];
				echo 	"</td>";
				echo 	"<td>";
				echo 	$detail[$i]['food_id'];
				echo 	"</td>";
				echo 	"<td>";
				echo 	$detail[$i]['foodName'];
				echo 	"</td>";
				echo 	"<td>";
				echo 	$detail[$i]['image'];
				echo 	"</td>";
				echo 	"<td>";
				echo 	$detail[$i]['price'];
				echo 	"</td>";
				echo 	"<td>";
				echo 	$detail[$i]['status'];
				echo 	"</td>";
				echo 	"<td>";
				echo 	$detail[$i]['cat_id'];
				echo 	"</td>";
				
				echo "<td><button onclick = 'served(".$detail[$i]['detail_id'].")' class='btn btn-warning'>Served</button></td>";
				echo "<td><button onclick = 'cancel(".$detail[$i]['detail_id'].")' class='btn btn-danger'>Cancel</button></td>";
				echo "</tr>";
			}
		}else{
			echo "0 row";
		}
		
		?>
	</table>
</div>
</body>
</html>
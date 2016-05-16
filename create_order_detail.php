<?php
require_once('mk_func.php');
$food_id = $_POST['food_id'];
$order_id = $_POST['order_id'];
orders_food($food_id,$order_id);
?>
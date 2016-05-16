<?php
require_once ("orders_func.php");
$order_id = $_GET ['order_id'];
deleteorders ( $order_id );
?>

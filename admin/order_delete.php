<?php
require_once ("order_func.php");
$order_id = $_GET ['order_id'];
deleteorder ( $order_id );
?>

<?php
require_once('mk_func.php');
$table_id = $_POST['table_no'];
$order_json = json_encode(createTable($table_id));
echo $order_json;
?>
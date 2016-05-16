<?php
require_once ("food_func.php");
$cat_id = $_GET['cat_id'];
$data = searchfood($cat_id,"cat_id");
echo json_encode($data);
?>
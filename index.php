<html lang="en">
<head>
   <meta charset="utf-8">
   <title>MK</title>
   <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
   <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
   <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
   <link href="css/mk.css" rel="stylesheet" type="text/css">
   <script src="jquery-2.1.3.min.js"></script>
   <script src="jquery-ui/jquery-ui.js"></script>
   <script src="js/js.inc.js"></script>
</head>
<body>

<div class="container-fluid" style="margin:0px;padding:0px;">
 <div class="popup-bg">
 	<div class="popup">
    <h1>Welcome to MK</h1>
    <div class="form-group">
    	<label for="table_no">โต๊ะที่ : </label>
    	<input class="form-control" type="text" placeholder="หมายเลขโต๊ะ" id="table_number">
        <div id="popup_number" style=" color:#F00; display:none;">กรุณาใส่ตัวเลขเท่านั้น</div>
	</div>
    <button class="btn btn-default" id="open_table">Submit</button>
    </div>
 </div>
 </div>
 
<div id="tabs">
  <ul id="category_tab">
  	<li><a href = "#orders_list" >รายการอาหารที่สั่ง</a></li>
  </ul>
  <div id="orders_list">
  <h2>รายการอาหารที่รอยืนยัน</h2><br/>

<div class="wait_confirm table-responsive">
	<table class="table table-bordered table-striped">
		<tbody id = "wait_confirm_table">
            <tr>
                <th>order_id</th>
                <th>qty</th>
                <th>status</th>
                <th>foodName</th>
                <th>description</th>
                <th>price</th>
                <th>image</th>
                <th>ยืนยัน</th>
            </tr>
        </tbody>
	</table>
 </div>
<br/>
<br/>
<h2>รายการอาหารที่ยืนยัน</h2>
<br/>

<div class="confirmed table-responsive">
	<table class="table table-bordered table-striped">
		<tbody id = "confirm_table">
            <tr>
                <th>order_id</th>
                <th>qty</th>
                <th>status</th>
                <th>foodName</th>
                <th>description</th>
                <th>price</th>
                <th>image</th>
            </tr>
        </tbody>
	</table>
  </div>
  
</div>
 
</div>
 
</body>
</html>
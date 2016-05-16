function loadTable(){
	$("#table").load("order_table.php", function(){});
}
	
function confirm_delete(order_id) {
	var del_confirm = confirm("คุณต้องการลบ Id " + order_id + " นี้จริงๆหรือไม่?");
	 if(del_confirm == true)
	 {
		$("#data").load("orders_delete.php?id="+order_id, function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success")
			{
				loadTable();
			}
			else if(statusTxt == "error")
			{
				alert("Error: " + xhr.status + ": " + xhr.statusText);
			}
		});
	}else{
		}
}

function edit(order_id){
	window.location.href = "order_insert_form.php?action=edit&order_id="+order_id;
}

function show_detail(order_id){
	window.location.href = "order_detail.php?order_id="+order_id;
}

function served(detail_id){
	window.location.href = "served_order.php?detail_id="+detail_id;
}

function cancel(detail_id){
	window.location.href = "cancel_order.php?detail_id="+detail_id;
}

function close_order(order_id){
	window.location.href = "close_order.php?order_id="+order_id;
}

function cancel_order(order_id){
	window.location.href = "cancel.php?order_id="+order_id;
}
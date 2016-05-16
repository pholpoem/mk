function loadTable(){
	$("#table").load("orders_detail_table.php", function(){});
}
	
function confirm_delete(id) {
	var del_confirm = confirm("คุณต้องการลบ Id " + id + " นี้จริงๆหรือไม่?");
	 if(del_confirm == true)
	 {
		$("#data").load("orders_detail_delete.php?id="+id, function(responseTxt, statusTxt, xhr){
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

function edit(id){
	window.location.href = "orders_detail_insert_form.php?action=edit&detail_id="+id;
	}
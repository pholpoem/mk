function loadTable(){
	$("#table").load("food_table.php", function(){});
}
	
function confirm_delete(id) {
	var del_confirm = confirm("คุณต้องการลบ Id " + id + " นี้จริงๆหรือไม่?");
	 if(del_confirm == true)
	 {
		$("#data").load("food_delete.php?id="+id, function(responseTxt, statusTxt, xhr){
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
	window.location.href = "food_insert_form.php?action=edit&food_id="+id;
	}
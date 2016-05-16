function loadTable(){
	$("#table").load("category_table.php", function(){});
}
	
function confirm_delete(id) {
	var del_confirm = confirm("คุณต้องการลบ Id " + id + " นี้จริงๆหรือไม่?");
	 if(del_confirm == true)
	 {
		$("#data").load("category_delete.php?id="+id, function(responseTxt, statusTxt, xhr){
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
	window.location.href = "category_insert_form.php?action=edit&id="+id;
	}
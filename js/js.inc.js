var categories ;
var all_foods = new Array();
var count ;
var order_now;
var OrderDetailWaitConfirm; //เก็บข้อมูล OrderDetail ที่กำลังรอ confirm
var OrderDetailConfirm;
///////////////POP UP////////////////
function showPopup(){
	$(".popup-bg").css("visibility","visible");	
	$(".popup").css("visibility","visible");
}

function closePopup(){
	$(".popup-bg").css("visibility","hidden");	
	$(".popup").css("visibility","hidden");
}
///////////////POP UP////////////////

///////////////////ORDER DETAIL//////////////
function orderDetail(){
	setTimeout(
		function(){
			$(function(){
                getOrderDetailToShow_wait_confirm();
				getOrderDetailToShow_confirmed();
            });
        }, 1000);
		refreshAuto();
}

function refreshAuto(){
	setInterval(
		function(){
			getOrderDetailToShow_wait_confirm();
			getOrderDetailToShow_confirmed();
		}, 3000);
}

function orderFood(food_id_x){
	$.post( "create_order_detail.php",
	{
		food_id: food_id_x,
        order_id: order_now[0].order_id }).done(function( data ) {
			getOrderDetailToShow_wait_confirm();
		});
}

function getOrderDetailToShow_wait_confirm(){

    $.post( "getOrderDetail_byId.php",
	{
		status:"wait_confirm" ,
        order_id: order_now[0].order_id }).done(function( data ) {
			showOrderDetailWaitConfirm(data);
    });
}

function getOrderDetailToShow_confirmed(){

    $.post( "getOrderDetail_byId.php",
	{
		status:"confirmed|served" ,
        order_id: order_now[0].order_id }).done(function( data ) {
			showOrderDetailConfirmed(data);
    });
}

function confirmOrderDetail(detail_id){

    $.post( "confirm_order_detail.php",
	{
        detail_id: detail_id }).done(function( data ) {
               getOrderDetailToShow_wait_confirm();
			   getOrderDetailToShow_confirmed();
    });
}

function showOrderDetailWaitConfirm(data)
      {
          OrderDetailWaitConfirm = JSON.parse(data);
          var template = " <tr> \
			<td>      \
               {{[[--order_id--]]}}  \
               </td>  \
               <td>   \
               {{[[--qty--]]}}   \
               </td> \
               <td>   \
               {{[[--status--]]}}   \
               </td>  \
               <td>   \
               {{[[--foodName--]]}}   \
               </td>  \
               <td>   \
               {{[[--description--]]}}   \
               </td>    \
               <td>      \
               {{[[--price--]]}}   \
               </td>     \
               <td>   \
               <img src='{{[[--image--]]}}' class='img-rounded' width='100px'/>  \
               </td>  \
               <td>   \
               <button id = 'food_confirm_{{[[--detail_id--]]}}'  order-detail-id= '{{[[--detail_id--]]}}' >confirm</button>   \
               </td>   \
			</tr> \
			";

          $("#wait_confirm_table").empty();
         for(var i = 0 ; i < OrderDetailWaitConfirm.length ; i ++)
         {
            var row_now = template;
			row_now = row_now.replace("{{[[--detail_id--]]}}",OrderDetailWaitConfirm[i].detail_id);
			row_now = row_now.replace("{{[[--detail_id--]]}}",OrderDetailWaitConfirm[i].detail_id);
            row_now = row_now.replace("{{[[--order_id--]]}}",OrderDetailWaitConfirm[i].order_id);

            row_now = row_now.replace("{{[[--qty--]]}}",OrderDetailWaitConfirm[i].qty);
            row_now = row_now.replace("{{[[--status--]]}}",OrderDetailWaitConfirm[i].status);
            row_now = row_now.replace("{{[[--foodName--]]}}",OrderDetailWaitConfirm[i].foodName);
            row_now = row_now.replace("{{[[--description--]]}}",OrderDetailWaitConfirm[i].description);
            row_now = row_now.replace("{{[[--price--]]}}",OrderDetailWaitConfirm[i].price);
            row_now = row_now.replace("{{[[--image--]]}}",OrderDetailWaitConfirm[i].image);
            $("#wait_confirm_table").append(row_now);

            //add event to confirm button
            $("#food_confirm_"+OrderDetailWaitConfirm[i].detail_id).click(
               function foodconfirmBtn()
               {

                  var OrderDetailID = $(this).attr('order-detail-id');
                  confirmOrderDetail(OrderDetailID);
               });
            
         }
          //$("#wait_confirm_table")
}

function showOrderDetailConfirmed(data)
      {
          OrderDetailConfirm = JSON.parse(data);
          var template = " <tr> \
			<td>      \
               {{[[--order_id--]]}}  \
               </td>  \
               <td>   \
               {{[[--qty--]]}}   \
               </td> \
               <td>   \
               {{[[--status--]]}}   \
               </td>  \
               <td>   \
               {{[[--foodName--]]}}   \
               </td>  \
               <td>   \
               {{[[--description--]]}}   \
               </td>    \
               <td>      \
               {{[[--price--]]}}   \
               </td>     \
               <td>   \
               <img src='{{[[--image--]]}}' class='img-rounded' width='100px'/>  \
               </td>  \
			</tr> \
			";

          $("#confirm_table").empty();
         for(var i = 0 ; i < OrderDetailConfirm.length ; i ++)
         {
            var row_now = template;
			
            row_now = row_now.replace("{{[[--order_id--]]}}",OrderDetailConfirm[i].order_id);
            row_now = row_now.replace("{{[[--qty--]]}}",OrderDetailConfirm[i].qty);
            row_now = row_now.replace("{{[[--status--]]}}",OrderDetailConfirm[i].status);
            row_now = row_now.replace("{{[[--foodName--]]}}",OrderDetailConfirm[i].foodName);
            row_now = row_now.replace("{{[[--description--]]}}",OrderDetailConfirm[i].description);
            row_now = row_now.replace("{{[[--price--]]}}",OrderDetailConfirm[i].price);
            row_now = row_now.replace("{{[[--image--]]}}",OrderDetailConfirm[i].image);
            $("#confirm_table").append(row_now);

         }
}
/////////////////////////////////////////////
function addListenerFoodtile(id)
{
	var id_x = "#food_tile_id_"+id;
         $(id_x).css('cursor','pointer');


         $( id_x ).off();

         $(id_x).mouseover(function(){
            $(this).css("background-color","#aaa");
         });

         $(id_x).mouseout(function(){
           $(this).css("background-color","#FC6");
         });

         $(id_x).mousedown(function(){
           $(this).css("background-color","#aaf");
         });

         $(id_x).mouseup(function(){
           $(this).css("background-color","#aaa");
         });

         $(id_x).click(function(){            
            var food_id_x =  $(this).attr('food_id');
            orderFood(food_id_x);
		});
}
   
   function loadCategory()
   {
      $.get("category/output/ajax_getAllCategory.php", function(data, status){
         var categorys = JSON.parse(data);
         categories = categorys;
         for(var i = 0 ; i < categorys.length ; i ++)
         {
            var x = "<li><a href='#food_category_"+categorys[i].cat_id+"'>"+categorys[i].catName+"</a></li>";
            $("#category_tab").append(x);

            var y = "<div id='food_category_"+categorys[i].cat_id+"'>    \
                        <div class='row' style='height:auto; padding-bottom:15px;'>       \
                        </div>     \
                     </div>";
            $("#tabs").append(y);
         }

         loadFood();
      });
   }

   function loadFood()
   {
      count = 0;
      for(var i = 0 ; i < categories.length ; i ++)
      {
         $.ajax({
                 url: "food/output/ajax_getAllFood.php?cat_id="+categories[i].cat_id,
                 context: (i+1)
               }).done(function(data) {
                     var foods =  JSON.parse(data);
					 all_foods.push(foods);
                     for(var j =0 ; j < foods.length ; j ++)
                     {
						 //foods[j].image
                        var template_food 
								= "<div id='food_tile_id_{{[[--ID--]]}}' class='food_tile col-md-2 img-rounded' food_id='{{[[--ID--]]}}'>    \
                                    <img src='{{[[--IMAGE_PATH--]]}}' width = '150'/>   \
									<div class = 'headline'>{{[[--NAME--]]}}</div> \
									<div class = 'description'>{{[[--DESCRIPTION--]]}} \
									</div> \
                                 </div>";
						
						var food = template_food;
						food = food.replace("{{[[--ID--]]}}",foods[j].food_id);
						food = food.replace("{{[[--ID--]]}}",foods[j].food_id);
						food = food.replace("{{[[--NAME--]]}}",foods[j].foodName );
						food = food.replace("{{[[--DESCRIPTION--]]}}",foods[j].description );
						food = food.replace("{{[[--IMAGE_PATH--]]}}",foods[j].image);
						
                        $("#food_category_"+categories[this-1].cat_id + ">div").append(food);
						addListenerFoodtile(foods[j].food_id)
                     }

                     count ++;
                     $(function() {
                        $( "#tabs" ).tabs();
                     });
                     
               });
      }

      setTimeout(
            function()
            { 
               $(function()
               {
                        $( "#tabs" ).tabs();
               });
            }, 3000);
   }
   $( document ).ready(function() {
         loadCategory();
		 showPopup();
		 
		 $("#open_table").click(function(){
			 var table_no_x = $("#table_number").val();
			 if(!isNaN(parseInt(table_no_x))){
				 
				 }else{
					 $("#popup_number").show();
					 return;
				 }
				 ///////////////SEND HTTP POST//////////////////
			  $.post( "create_order.php", { table_no: table_no_x}).done(function( data ) {
				  order_now = JSON.parse(data);
				  var c  = " order_id : " + order_now[0].order_id +
                                 " , table_no : " + order_now[0].table_no +
                                 " , status : " + order_now[0].status +
                                 " , date_time : " + order_now[0].date_time ;
				  $("#order_now").html(c);
				  closePopup();
				  orderDetail();
				  });
			 });
			 
   });
// $("btn_form").click
// (
// 	function()
// 	{ 
// 		var id = $(this).data('id');
// 		var zn = $(this).data('zn');
		
// 		$("b_pl_"+id).type = 'submit';
// 		$("form_"+id).submit();
// 		$("b_pl_"+id).type = 'image';
		
// 		 alert(id);
		
// 		// $.post('/resources/views/ap.php', {'id': id}, function(){
			
// 		// 	$('form-'+id).submit();
			
// 		// });
// 	}	

// );
// --------------------------------------------------------------------------------------------
$(".books-block-img").click
(
	function()
	{
		var url = $(this).data('url');
		var href = '#open_modal_result';
		
		//alert(url);
		if(url!="")
		{
			location.assign(url);
		}
		else
		{
			location.assign(href);//запуск модального окна
			$("#mess").text("Для выполнения этой операции необходимо пройти авторизацию!");
			$("#link").html("<a href='#open_modal_login'>Авторизация</a>");
		}			
	}

);
// --------------------------------------------------------------------------------------------
$(".ap-block-center-cap h4").click
(
	function()
	{
		// alert("!!!");
		if(event.ctrlKey)
		{
			alert("!!!!");
		} 
	}

);
// --------------------------------------------------------------------------------------------

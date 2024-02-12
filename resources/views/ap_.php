<?
	 session_start();

	//Пользовательские функции----------------------
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/functions.php";
    //Обработка форм----------------------
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/form_data.php";

    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/filter.php";    
	   
?>
<!DOCTYPE html>
<html lang="ru">

	<head>
	  <meta charset="UTF-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 
	  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	  <title>Административная панель</title>

	  <link rel="stylesheet" href="/public/css/ap.css" type="text/css">
	  <link rel="stylesheet" href="/public/css/styles.css" type="text/css">
	  <link rel="stylesheet" href="/public/css/modal__dialogs.css" type="text/css">

	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

	</head>

	<body>

		<div class="ap">
			
			<div class="ap-caption border">			
				<h2>Административная панель</h2>
			</div>

			<div class="ap-block border">
				
				<div class="ap-block-left border">
					<ul>
						<li><a href="/"> Главная</a></li>						
						<hr>
						<?
						$arr_ = get_data_tables();      
				      if ($arr_ <> null)
				      {
				        	foreach ($arr_ as $key_ => $val_)
			        		{
					          $id = $val_['id'];
					          $name_ru = $val_['name_ru'];
					          
					          $href = "/resources/views/ap.php?n=".$id;
								?>
								<li><a href="<? echo $href; ?>"><? echo $name_ru; ?></a></li>
								<?
							}
						}
						?>
					</ul>
				
				</div>

				<div class="ap-block-center border" style="text-align: left;">

					<?
					include "$_SERVER[DOCUMENT_ROOT]/resources/includes/table.php";
					?>					
					
				</div>

				<div class="ap-block-right border">
					<ul>
						<!-- <li><a href="/"> Главная</a></li>						
						<hr> -->
						<?
						// $arr_ = get_data_tables();      
				      // if ($arr_ <> null)
				      // {
				      //   	foreach ($arr_ as $key_ => $val_)
			        	// 	{
					   //        $name_en = $val_['name_en'];
					   //        $name_ru = $val_['name_ru'];
					          
					   //        $href = "/resources/views/ap.php?table=".$name_en;
						// 		?>
								<!-- <li><a href="<? echo $href; ?>"><? echo $name_ru; ?></a></li> -->
								  <?
						// 	}
						// }
						?>						
					</ul>
				
				</div>
				
			</div>

		</div>

		<!-- Модальные окна -->
       <?php include "$_SERVER[DOCUMENT_ROOT]/resources/includes/modal__dialogs.php" ?>

		<script src="/public/js/scripts.js"></script>
		 
	  <script> if (window.history.replaceState) {window.history.replaceState(null, null, window.location.href);}</script>
		        
    </body>

</html>

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
					<!-- <h4>Таблицы</h4> -->
					<ul>
						<li><a href="/"> Главная</a></li>
						<li></li>
						<li><b>Таблицы:</b></li>
						<li><a href="/resources/views/ap.php?table=1">Книги</a></li>
						<li><a href="/resources/views/ap.php?table=2">Авторы</a></li>
						<li><a href="/resources/views/ap.php?table=3">Жанры</a></li>
						<li><a href="/resources/views/ap.php?table=4">Пользователи</a></li>
						<li><a href="/resources/views/ap.php?table=5">Статусы</a></li>						
					</ul>
				
				</div>

				<div class="ap-block-right border" style="text-align: left;">

					<?
					if(!empty($_GET['table']))
					{
						$table = $_GET['table'];

						if($table == 1)
						{						
							include "$_SERVER[DOCUMENT_ROOT]/resources/includes/table1.php";
						}

						if($table == 2)
						{						
							include "$_SERVER[DOCUMENT_ROOT]/resources/includes/table2.php";
						}

						if($table == 3)
						{						
							include "$_SERVER[DOCUMENT_ROOT]/resources/includes/table3.php";
						}

						if($table == 4)
						{						
							include "$_SERVER[DOCUMENT_ROOT]/resources/includes/table4.php";
						}

						if($table == 5)
						{						
							include "$_SERVER[DOCUMENT_ROOT]/resources/includes/table5.php";
						}
					}
					else
					{
						include "$_SERVER[DOCUMENT_ROOT]/resources/includes/table1.php";
					}
					?>
				</div>
				
			</div>

		</div>

		<!-- Модальные окна -->
       <?php include "$_SERVER[DOCUMENT_ROOT]/resources/includes/modal__dialogs.php" ?>

		<script src="/public/js/scripts.js"></script>
		 
	  <script> if (window.history.replaceState) {window.history.replaceState(null, null, window.location.href);}</script>
		        
    </body>

</html>

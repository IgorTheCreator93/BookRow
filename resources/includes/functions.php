<?

function get_db_books($g_id)
{
	include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
	if ($g_id == 0)
	 {
		$sql =  "SELECT *	FROM `books`";
		$query = $db->prepare($sql);
		$query->execute([]);
		$arr = $query->fetchAll(PDO::FETCH_ASSOC); //многомерный массив)

		if ($arr)
		{
			return $arr;
		}      
	}
	else
	{
		$sql =  "SELECT *	FROM `books` WHERE `genre` = ?";
		$query = $db->prepare($sql);
		$query->execute([(integer)$g_id]);
		$arr = $query->fetchAll(PDO::FETCH_ASSOC); //многомерный массив)

		if ($arr)
		{
			return $arr;
		} 
		else
		{
			return null;
		} 
	}
    
}
//----------------------------------------
//------------------------------------------
function get_db_authors($author_id)
{
  include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
  
  $sql =  "
  SELECT `name`
  FROM `authors`
  WHERE `id` = ?
  ";        
  $query = $db->prepare($sql);
  $query->execute([(integer)$author_id]);
  $arr = $query->fetch(PDO::FETCH_ASSOC);//данные одной строки (одномерный массив)
  
  if($arr)
  {
	  return $arr['name'];
  }
  else
  {
	  return null;
  }      
}
//-----------------------------------------------------------------------
 //-----------------------------------------------------------------------
 
function get_data_user_stat($email)///Получим Статус пользователя по его логину ($email)
  {
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
    
    $sql = "
    SELECT `email`
    FROM `users`
    WHERE `email` = ?
    ";        
    $query = $db->prepare($sql);
    $query->execute([$email]);
    $arr = $query->fetch(PDO::FETCH_ASSOC);//данные одной строки (одномерный массив)
    if($arr)
    {    
      $sql = "
      SELECT `status`
      FROM `users`
      WHERE `email` = ?
      ";        
      $query = $db->prepare($sql);
      $query->execute([$email]);
      $arr = $query->fetch(PDO::FETCH_ASSOC);//данные одной строки (одномерный массив)
      return $arr['status']; 
    }   
  }

  //-----------------------------------------------------------------------
  function get_data_user_ban($email)///Получим Бан пользователя (1/0) по его логину ($email)
  {
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
    
    $sql = "
    SELECT `email`
    FROM `users`
    WHERE `email` = ?
    ";        
    $query = $db->prepare($sql);
    $query->execute([$email]);
    $arr = $query->fetch(PDO::FETCH_ASSOC);//данные одной строки (одномерный массив)
    if($arr)
    {    
      $sql = "
      SELECT `ban`
      FROM `users`
      WHERE `email` = ?
      ";        
      $query = $db->prepare($sql);
      $query->execute([$email]);
      $arr = $query->fetch(PDO::FETCH_ASSOC);//данные одной строки (одномерный массив)
      return $arr['ban']; 
    }   
  }
  //-----------------------------------------------------------------------
  function get_us_name($email)//Получим имя пользователя по его логину ($email)
  {
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
    
    $sql = "
    SELECT `email`
    FROM `users`
    WHERE `email` = ?
    ";        
    $query = $db->prepare($sql);
    $query->execute([$email]);
    $arr = $query->fetch(PDO::FETCH_ASSOC);//данные одной строки (одномерный массив)
    if($arr)
    {    
      $sql = "
      SELECT `name`
      FROM `users`
      WHERE `email` = ?
      ";        
      $query = $db->prepare($sql);
      $query->execute([$email]);
      $arr = $query->fetch(PDO::FETCH_ASSOC);//данные одной строки (одномерный массив)
      return $arr['name']; 
    }   
  }

  //-----------------------------------------------------------------------

function save_data_user($reg_name, $reg_email, $reg_pass)//Проверка логина и пароля
{
  include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
  
  $sql = "
  SELECT `email`
  FROM `users`
  WHERE `email` = ?
  ";        
  $query = $db->prepare($sql);
  $query->execute([$reg_email]);
  $arr = $query->fetch(PDO::FETCH_ASSOC);//данные одной строки (одномерный массив)
  if($arr)
  {    
	  return 1;
  }
  else
  {
  	$reg_pass = password_hash($reg_pass,PASSWORD_DEFAULT);

  	$sql = "
    INSERT INTO `users`(`name`, `email`, `pass`)
  	VALUES(?, ?, ?)";
  	$query = $db->prepare($sql);
  	$query->execute([$reg_name, $reg_email, $reg_pass]);

	  return 2;
  } 
}

//-------------------------------------------------------------
function get_data_user_pass($log_email, $log_pass)//Проверка логина и пароля
{
  include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
  
  $sql = "
  SELECT `pass`
  FROM `users`
  WHERE `email` = ?
  ";
  $query = $db->prepare($sql);    
  $query->execute([$log_email]);
  $arr = $query->fetch(PDO::FETCH_ASSOC); //данные одной строки (одномерный массив)

  if (!empty($arr))
  {
    if (password_verify($log_pass, $arr['pass'])) //Сравниваем пароли (в дешифрованном виде)
    {
      return 1;
    }
    else
    {
      return 2;
    }
  }
  else
  {
    return 3;
  }
}
//-------------------------------------------------------------
//-------------------------------------------------------------
function search_content($search)                    
  {
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";

    $sql = "
    SELECT `books`.`id`,`books`.`name`, `books`.`img`, `books`.`author`
    FROM `books`, `authors`
    WHERE (`books`.`author` = `authors`.`id`) and (`books`.`name` LIKE ? or `books`.`descr` LIKE ? or `authors`.`name` LIKE ?)
    ";
    $query = $db->prepare($sql);
    $query->execute(["%$search%", "%$search%", "%$search%"]);
    $arr = $query->fetchAll(PDO::FETCH_ASSOC);
    
    return $arr;
  }
  //-------------------------------------------------------

  function get_db_books_id($id)
  {
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
    
    $sql =  "
    SELECT *
    FROM `books`
    WHERE `id` = ?
    ";        
    $query = $db->prepare($sql);
    $query->execute([$id]);
   
    $arr = $query->fetch(PDO::FETCH_ASSOC);//данные одной строки (одномерный массив)
    
    if($arr)
    {
  	  return $arr;
    }
    else
    {
  	  return null;
    } 
  }
  //------------------------------------------------------------------

  function get_db_genres($genre_id)
  {
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
    
    $sql =  "
    SELECT `name`
    FROM `genres`
    WHERE id = ?
    ";        
    $query = $db->prepare($sql);
    $query->execute([$genre_id]);
    $arr = $query->fetch(PDO::FETCH_ASSOC);//данные одной строки (одномерный массив)
    
    if($arr)
    {
  	  return $arr['name'];
    }
    else
    {
  	  return null;
    }      
  }
  //-----------------------------------------------------------------------
  //-----------------------------------------------------------------------
  function get_db_table_all($table)//
  {
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";

    if(!empty($table))
    {
      $sql =  "SELECT * FROM ".$table." ORDER BY `id`";

      $query = $db->prepare($sql);    
      $query->execute([]);
      $arr = $query->fetchAll(PDO::FETCH_ASSOC);//многомерный массив)
      
      if($arr)
      {
        return $arr;
      }
      else
      {
        return null;
      }
    }
    else
    {
      return null;
    }
  }
  //----------------------------------------  
  //----------------------------------------
  function save_str_db_table($table, $arr) //Создадим новую строку таблицы $table и сохраним в неё данные ($arr - массив)
  {
    array_shift($arr);//удаляем первый элемент массива (id) с перестройкой индексов (нумерация элементов от нуля)
    
    if((!empty($table))and(!in_array("", $arr)))
    {
      include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
      
      $in = "INSERT INTO `".$table."` (";//Начальные значения фрагмента строки запроса ($sql)
      $va = " VALUES (";//Начальные значения фрагмента строки запроса ($sql)
      $i = 0;
      foreach ($arr as $key => $val)
      {
        $in = $in."`".$key."`, ";//формируем фрагмент строки запроса ($sql)
        $va = $va."?, ";//формируем фрагмент строки запроса ($sql)
        
        //if (is_numeric($val)or(empty($val))){$ex[$i] = intval($val);}else{$ex[$i] = $val;}//цифровым и пустым значениям присваиваем целочисленный тип (intval) 
        $ex[$i] = $val;
        $i++;//Счётчик
      }
      
      $in = substr($in, 0, -2).")";//удаляем из строки последние 2 символа (запятая и пробел)
      $va = substr($va, 0, -2).")";//удаляем из строки последние 2 символа (запятая и пробел)
      
      //ALTER TABLE `таблица` AUTO_INCREMENT = 0;

      $sql = $in.$va; //Сцепляем между собой фрагменты строки запроса ($sql)
      $query = $db->prepare($sql);
      $query->execute($ex);//Подставляем значения массива (параметры) в запрос 
    }
  }
  //-----------------------------------------------------------------------
  function upd_db_table($table, $arr) //Изменим данные ($arr - массив) таблицы $table по конкретному id
  {
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";

    if((!empty($table))and(!in_array("", $arr)))//Если $table - не пустое значение и $arr - не пустой массив, тогда...
    {
      include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";//$_SERVER[DOCUMENT_ROOT] - директория корня сайта
      
      $upd = "UPDATE `".$table."` ";//Начальные значения 1 фрагмента строки запроса ($sql)
      $set = "SET ";//фНачальные значения 2 фрагмента строки запроса ($sql)
      $i = 0;
      $key_0 = "";
      foreach ($arr as $key => $val)
      {
        if($i == 0){$key_0 = $key;}else{$set = $set."`".$key."` = ?, ";} //если 1 элемент массива, то запоминаем его ключ (id), иначе формируем 2 фрагмент строки запроса ($sql) без id, так как id на понадобится в конце (в условии)
        
        //if (is_numeric($val)or(empty($val))){$ex[$i] = intval($val);}else{$ex[$i] = $val;}//цифровым и пустым значениям присваиваем целочисленный тип (intval) 
        $ex[$i] = $val;
        $i++;//Счётчик
      }

      $whe = " WHERE `".$key_0."` = ?";//формируем 3 фрагмент строки запроса ($sql)

      $set = substr($set, 0, -2);//удаляем из строки последние 2 символа (запятая и пробел)
      
      $sql = $upd.$set.$whe; //Сцепляем между собой фрагменты строки запроса ($sql)
      
      $id = $ex[0];//Запоминаем первый элемент массива (id)
      array_shift($ex);//Удаляем первый элемент (id) из массива с перестройкой индексов (нумерация элементов от нуля)
      array_push($ex, $id);//Добавляем сохранённое значение (id) в конец массива $ex
      //var_dump($ex);     
      $query = $db->prepare($sql);
      $query->execute($ex);//Подставляем значения массива (параметры) в запрос      
    }
  }
  //-----------------------------------------------------------------------
  function del_str_db_table($table, $_id) //Удалим строку таблицы $table по конкретному $_id 
  {
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";

    $sql = "DELETE FROM `".$table."` WHERE id = ?";
    $query = $db->prepare($sql);
    $query->execute([(integer)$_id]);
  }
  //-----------------------------------------------------------------------
  //-----------------------------------------------------------------------
  
  function columns_table($table)
  {
    $db = new PDO('mysql:host=localhost;dbname=INFORMATION_SCHEMA', 'root', '') or die('Ошибка соединения с БД');
    
    $sql =  "
    SELECT `COLUMN_NAME`, `COLUMN_COMMENT`, `DATA_TYPE`, `CHARACTER_MAXIMUM_LENGTH`
    FROM `columns`
    WHERE `table_SCHEMA` = ? and `TABLE_NAME` = ?
    ORDER BY `ORDINAL_POSITION`
    ";
    
    $query = $db->prepare($sql);
    $query->execute(["BookRow", $table]);
    $arr = $query->fetchAll(PDO::FETCH_ASSOC);
    if($arr)
    {
      return $arr;
    }
    else
    {
      return null;
    }
  }

  //-----------------------------------------------------------------------

  function get_data_tables()
  {
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
    
    $sql =  "
    SELECT * FROM `tables` ORDER BY `sort`
    ";
    
    $query = $db->prepare($sql);
    $query->execute([]);
    $arr = $query->fetchAll(PDO::FETCH_ASSOC);
    
    if($arr)
    {
      return $arr;
    }
    else
    {
      return null;
    }
  }

  //-----------------------------------------------------------------------

  function get_data_table($id)
  {
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
    
    $sql =  "
    SELECT * FROM `tables` WHERE `id`= ?
    ";
    
    $query = $db->prepare($sql);
    $query->execute([$id]);
    $arr = $query->fetchAll(PDO::FETCH_ASSOC);
    
    if($arr)
    {
      return $arr;
    }
    else
    {
      return null;
    }
  }
//-----------------------------------------------------------------------
  ?>
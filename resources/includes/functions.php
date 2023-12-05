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
		else
		{
			return null;
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
function get_db_books_all()//
  {
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";

    $sql =  "SELECT * FROM `books`";

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

//----------------------------------------
function get_db_authors_all()//
  {
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
   
    $sql =  "SELECT * FROM `authors`";

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
  

//----------------------------------------
function get_db_genres_all()//
  {
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
   
    $sql =  "SELECT * FROM `genres`";

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

//----------------------------------------
function get_db_users_all()//
  {
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
   
    $sql =  "SELECT * FROM `users`";

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
  
  //----------------------------------------
function get_db_status_all()//
  {
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
   
    $sql =  "SELECT * FROM `status`";

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

//-------------------------------------------------------------
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

function get_db_books_id($n)
{
  include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
  
  $sql =  "
  SELECT *
  FROM `books`
  WHERE `id` = ?
  ";        
  $query = $db->prepare($sql);
  $query->execute([$n]);
  $arr = array(7);
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
  function upd_db_books($_id, $b_name, $b_descr, $b_img, $b_year, $b_author, $b_genre)//Изменить данные в в строке таблицы Books
  {
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";

    $sql = "
    UPDATE `books`
    SET `name` = ?, `descr` = ?, `img` = ?, `year` = ?, `author` = ?, `genre` = ?
    WHERE `id` = ?
    ";
    $query = $db->prepare($sql);
    $query->execute([$b_name, $b_descr, $b_img, (integer)$b_year, (integer)$b_author, (integer)$b_genre, (integer)$_id]);
  }
  //-----------------------------------------------------------------------
  function del_str_db_books($_id)//удалить строку из таблицы books
  {    
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
    
    $sql = "
    DELETE FROM `books`
    WHERE id = ?
    ";
    $query = $db->prepare($sql);
     $query->execute([(integer)$_id]);
  }

  //-----------------------------------------------------------------------
  function save_str_db_books($b_name, $b_descr, $b_img, $b_year, $b_author, $b_genre)//Сохранить новую строку в таблице books
  {    
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
  
      $sql = "
      INSERT INTO `books`(`name`, `descr`, `img`, `year`, `author`, `genre`)
      VALUES(?, ?, ?, ?, ?, ?)";
      
      $query = $db->prepare($sql);
      $query->execute([$b_name, $b_descr, $b_img, (integer)$b_year, (integer)$b_author, (integer)$b_genre]);      
  }
  //-----------------------------------------------------------------------
  //-----------------------------------------------------------------------
  function upd_db_authors($_id, $a_name)//Изменить данные в в строке таблицы authors
  {
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";

    $sql = "
    UPDATE `authors`
    SET `name` = ?
    WHERE `id` = ?
    ";
    $query = $db->prepare($sql);
    $query->execute([$a_name, (integer)$_id]);
  }
  //-----------------------------------------------------------------------
  function del_str_db_authors($_id)//удалить строку из таблицы authors
  {    
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
    
    $sql = "
    DELETE FROM `authors`
    WHERE `id` = ?
    ";
    $query = $db->prepare($sql);
     $query->execute([(integer)$_id]);
  }

  //-----------------------------------------------------------------------
  function save_str_db_authors($a_name)//Сохранить новую строку в таблице authors
  {    
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
  
      $sql = "
      INSERT INTO `authors`(`name`)
      VALUES(?)";
      
      $query = $db->prepare($sql);
      $query->execute([$a_name]);
  }
  //-----------------------------------------------------------------------
  //-----------------------------------------------------------------------
  
  function upd_db_genres($_id, $g_name)//Изменить данные в в строке таблицы genres
  {
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
    
    $sql = "
    UPDATE `genres`
    SET `name`= ?
    WHERE `id` = ?
    ";

    $query = $db->prepare($sql);
    $query->execute([$g_name, (integer)$_id]);
  }
  //-----------------------------------------------------------------------
  function del_str_db_genres($_id)//удалить строку из таблицы genres
  {    
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
    
    $sql = "
    DELETE FROM `genres`
    WHERE `id` = ?
    ";
    $query = $db->prepare($sql);
     $query->execute([(integer)$_id]);
  }

  //-----------------------------------------------------------------------
  function save_str_db_genres($g_name)//Сохранить новую строку в таблице genres
  {    
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
  
      $sql = "
      INSERT INTO `genres`(`name`)
      VALUES(?)";
      
      $query = $db->prepare($sql);
      $query->execute([$g_name]);      
  }
  //-----------------------------------------------------------------------
  //-----------------------------------------------------------------------
  function upd_db_users($_id, $u_name,$u_email,$u_pass,$u_status,$u_ban)//Изменить данные в в строке таблицы users
  {
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";

    $sql = "
    UPDATE `users`
    SET `name` = ?, `email` = ?, `pass` = ?, `status` = ?, `ban` = ?
    WHERE `id` = ?
    ";
    $query = $db->prepare($sql);
    $query->execute([$u_name, $u_email, $u_pass, (integer)$u_status, (integer)$u_ban, (integer)$_id]);
  }
  //-----------------------------------------------------------------------
  function del_str_db_users($_id)//удалить строку из таблицы users
  {    
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
    
    $sql = "
    DELETE FROM `users`
    WHERE `id` = ?
    ";
    $query = $db->prepare($sql);
     $query->execute([(integer)$_id]);
  }

  //-----------------------------------------------------------------------
  function save_str_db_users($u_name, $u_email, $u_pass, $u_stat, $u_ban)//Сохранить новую строку в таблице users
  {    
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
    
      $sql = "
      INSERT INTO `users`(`name`, `email`, `pass`, `status`, `ban`)
      -- WHERE id = ?
      VALUES(?, ?, ?, ?, ?)";
      // echo "!!!";
      $query = $db->prepare($sql);
      $query->execute([$u_name, $u_email, $u_pass, (integer)$u_stat, (integer)$u_ban]);      
  }
  //-----------------------------------------------------------------------
  //-----------------------------------------------------------------------
  
  function upd_db_status($_id, $s_name)//Изменить данные в в строке таблицы status
  {
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
    
    $sql = "
    UPDATE `status`
    SET `name`= ?
    WHERE `id` = ?
    ";

    $query = $db->prepare($sql);
    $query->execute([$s_name, (integer)$_id]);
  }
  //-----------------------------------------------------------------------
  function del_str_db_status($_id)//удалить строку из таблицы status
  {    
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
    
    $sql = "
    DELETE FROM `status`
    WHERE `id` = ?
    ";
    $query = $db->prepare($sql);
     $query->execute([(integer)$_id]);
  }

  //-----------------------------------------------------------------------
  function save_str_db_status($s_name)//Сохранить новую строку в таблице status
  {    
    include "$_SERVER[DOCUMENT_ROOT]/resources/includes/db.php";
  
      $sql = "
      INSERT INTO `status`(`name`)
      VALUES(?)";
      
      $query = $db->prepare($sql);
      $query->execute([$s_name]);
  }
  //-----------------------------------------------------------------------
  //-----------------------------------------------------------------------
function get_data_user_stat($email)//
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
function get_data_user_ban($email)//
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
function get_us_name($email)
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

?>
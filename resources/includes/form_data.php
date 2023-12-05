<?
if(!empty($_POST['text_search']))
{
  $search = trim($_POST['text_search']);
}
else
{
  $search = "";
}
//----------------------------
if(!empty($_POST['reg-btn']))
{
     $reg_name = trim($_POST['reg-name']);
     $reg_email = trim($_POST['reg-email']);
     $reg_pass = trim($_POST['reg-pass']);
     $reg_pass_rep = trim($_POST['reg-pass-rep']);

    //  echo $reg_name."|". $reg_email."|".$reg_pass."|". $reg_pass_rep;
    if($reg_pass == $reg_pass_rep)
    {
      $m = save_data_user($reg_name, $reg_email, $reg_pass);

      if($m == 2)
      {        
        $mess = "Вы успешно зарегистрированы!";
        $link = "<a href='#open_modal_login'>Авторизация</a>";
      }
      else
      {
        $_SESSION['reg_name'] = $reg_name;
        $_SESSION['reg_email'] = "";
        $mess = "Пользователь с таким E-mail<br>уже существует в нашей базе!<br>Повторите попытку<br>с новым E-mail";
        $link = "<a href='#open_modal_registr'>Регистрация</a>";                    
      }
    }
    else
    {
      $_SESSION['reg_name'] = $reg_name;
      $_SESSION['reg_email'] = $reg_email;
      $mess = "Пароли не совпадают! Повторите попытку";        
      $link = "<a href='#open_modal_registr'>Регистрация</a>";        
    }
}
//--------------------------------------------------------------

  //Обработка нажатия кнопки модального окна open_modal_login
  if(!empty($_POST['log-btn']))
    {
      $log_email = trim($_POST['log-email']);
      $log_pass = trim($_POST['log-pass']);

      
      $m = get_data_user_pass($log_email, $log_pass);//Проверка данных
    //   echo $m;
      if($m == 0)
      {
        $_SESSION['log_email'] = "";
        $_SESSION['log_pass'] = "";
        $_SESSION['log_stat'] = "";
                    
        $mess = "Что-то пошло не так! Повторите попытку позже";
        $link = "<a href='#open_modal_registr'>Авторизация</a>";
      }

      if($m == 1)
      {
        $log_stat = get_data_user_stat($log_email);

        $_SESSION['log_email'] = $log_email;
        $_SESSION['log_pass'] = $log_pass;
        $_SESSION['log_stat'] = $log_stat;

        $mess = "Вы успешно авторизованы!";

        if($log_stat==1)
        {
           $link = "<a href='/resources/views/ap.php'>Административная панель</a>";
        }
        else
        {
          $link = "<a href='/'>Главная страница</a>";
        }

        $log_ban = get_data_user_ban($log_email);
        if($log_ban==1)
        {
           $mess = "Ваш аккаунт заблокирован!";
           $link = "<a href='/'>Главная страница</a>";
           $_SESSION['log_email'] = "";
           $_SESSION['log_pass'] = "";
           $_SESSION['log_stat'] = "";
        }        
      }

      if($m == 2)
      {
        $_SESSION['log_email'] = $log_email;
        $_SESSION['log_pass'] = "";
                    
        $mess = "Пароль введён не верно!";
        $link = "<a href='#open_modal_login'>Авторизация</a>";
      }

      if($m == 3)
      {
        $_SESSION['log_email'] = "";
        $_SESSION['log_pass'] = "";
                    
        $mess = "Пользователь с таким логином<br>не существует! Повторите попытку";
        $link = "<a href='#open_modal_login'>Авторизация</a>";
      }
    }
// ------------------------------------------------
// Таблица "Books"
if(!empty($_GET['id_1']) and ($_GET['id_1']<>"Нов. >"))
    {
      $_id = $_GET['id_1'];
      $_b_pl = "b_pl_".$_id;

      //Изменить строку в таблице "Books"
      if(!empty($_POST[$_b_pl]))
      {        
        $b_name = substr(htmlspecialchars(trim($_POST["b_name_".$_id])), 0, 100);
        $b_descr = substr(htmlspecialchars(trim($_POST["b_descr_".$_id])), 0, 3000);
        $b_img = substr(htmlspecialchars(trim($_POST["b_img_".$_id])), 0, 100);
        $b_year = substr(htmlspecialchars(trim($_POST["b_year_".$_id])), 0, 5);
        $b_author = substr(htmlspecialchars(trim($_POST["b_author_".$_id])), 0, 5);
        $b_genre = substr(htmlspecialchars(trim($_POST["b_genre_".$_id])), 0, 5);

        upd_db_books($_id, $b_name, $b_descr, $b_img, $b_year, $b_author, $b_genre);
      }

      //Удалить строку в таблице "Books"
      $_b_mn = "b_mn_".$_id;

      if(!empty($_POST[$_b_mn]))
      {
        del_str_db_books($_id);
      }
    }
    else
    {  
      $_id = 0;
      $_b_pl = "b_pl_".$_id;
      
      //Сохранить новую строку в таблице "Books"
      if(!empty($_POST[$_b_pl]))
      {          
        $b_name = substr(htmlspecialchars(trim($_POST["b_name_".$_id])), 0, 100);
        $b_descr = substr(htmlspecialchars(trim($_POST["b_descr_".$_id])), 0, 3000);
        $b_img = substr(htmlspecialchars(trim($_POST["b_img_".$_id])), 0, 100);
        $b_year = substr(htmlspecialchars(trim($_POST["b_year_".$_id])), 0, 5);
        $b_author = substr(htmlspecialchars(trim($_POST["b_author_".$_id])), 0, 5);
        $b_genre = substr(htmlspecialchars(trim($_POST["b_genre_".$_id])), 0, 5);

        save_str_db_books($b_name, $b_descr, $b_img, $b_year, $b_author, $b_genre);
      }      
    }
// ------------------------------------------------
// Таблица "Authors"
if(!empty($_GET['id_2']) and ($_GET['id_2']<>"Нов. >"))
    {
      $_id = $_GET['id_2'];
      $_a_pl = "a_pl_".$_id;

      //Изменить строку в таблице "Authors"
      if(!empty($_POST[$_a_pl]))
      {        
        $a_name = substr(htmlspecialchars(trim($_POST["a_name_".$_id])), 0, 100);
        
        upd_db_authors($_id, $a_name);
      }

      //Удалить строку в таблице "Authors"
      $_a_mn = "a_mn_".$_id;

      if(!empty($_POST[$_a_mn]))
      {
        del_str_db_authors($_id);
      }
    }
    else
    {  
      $_id = 0;
      $_a_pl = "a_pl_".$_id;
      
      //Сохранить новую строку в таблице "Authors";
      if(!empty($_POST[$_a_pl]))
      {          
        $a_name = substr(htmlspecialchars(trim($_POST["a_name_".$_id])), 0, 100);
        
        save_str_db_authors($a_name);
      }      
    }
// ------------------------------------------------
// Таблица "Genre"
if(!empty($_GET['id_3']) and ($_GET['id_3']<>"Нов. >"))
    {
      $_id = $_GET['id_3'];
      $_g_pl = "g_pl_".$_id;

      //Изменить строку в таблице "Genre"
      if(!empty($_POST[$_g_pl]))
      {        
        $g_name = substr(htmlspecialchars(trim($_POST["g_name_".$_id])), 0, 100);
        
        upd_db_genres($_id, $g_name);
      }

      //Удалить строку в таблице "Genre"
      $_g_mn = "g_mn_".$_id;

      if(!empty($_POST[$_g_mn]))
      {
        del_str_db_genres($_id);
      }
    }
    else
    {  
      $_id = 0;
      $_g_pl = "g_pl_".$_id;
      
      //Сохранить новую строку в таблице "Genre"
      if(!empty($_POST[$_g_pl]))
      {          
        $g_name = substr(htmlspecialchars(trim($_POST["g_name_".$_id])), 0, 100);
        
        save_str_db_genres($g_name);
      }      
    }

// ------------------------------------------------
// Таблица "Users"
if(!empty($_GET['id_4']) and ($_GET['id_4']<>"Нов. >"))
    {
      $_id = $_GET['id_4'];
      $_u_pl = "u_pl_".$_id;

      //Изменить строку в таблице "Users"
      if(!empty($_POST[$_u_pl]))
      {        
        $u_name = substr(htmlspecialchars(trim($_POST["u_name_".$_id])), 0, 100);
        $u_log = substr(htmlspecialchars(trim($_POST["u_log_".$_id])), 0, 100);
        $u_pass = substr(htmlspecialchars(trim($_POST["u_pass_".$_id])), 0, 100);
        $u_stat = substr(htmlspecialchars(trim($_POST["u_stat_".$_id])), 0, 5);
        $u_ban = substr(htmlspecialchars(trim($_POST["u_ban_".$_id])), 0, 5);
                
        upd_db_users($_id, $u_name, $u_log, $u_pass, $u_stat, $u_ban);
      }

      //Удалить строку в таблице "Users"
      $_u_mn = "u_mn_".$_id;

      if(!empty($_POST[$_u_mn]))
      {
        del_str_db_users($_id);
      }
    }
    else
    {  
      $_id = 0;
      $_u_pl = "u_pl_".$_id;
      
      //Сохранить новую строку в таблице "Users"
      if(!empty($_POST[$_u_pl]))
      {          
        $u_name = substr(htmlspecialchars(trim($_POST["u_name_".$_id])), 0, 100);
        $u_log = substr(htmlspecialchars(trim($_POST["u_log_".$_id])), 0, 100);
        $u_pass = substr(htmlspecialchars(trim($_POST["u_pass_".$_id])), 0, 100);
        $u_stat = substr(htmlspecialchars(trim($_POST["u_stat_".$_id])), 0, 5);
        $u_ban = substr(htmlspecialchars(trim($_POST["u_ban_".$_id])), 0, 5);
        
        save_str_db_users($u_name, $u_log, $u_pass, $u_stat, $u_ban);
      }      
    }
    // ------------------------------------------------
    // Таблица "Status"
    if(!empty($_GET['id_5']) and ($_GET['id_5']<>"Нов. >"))
    {
      $_id = $_GET['id_5'];
      $_s_pl = "s_pl_".$_id;

      //Изменить строку в таблице "Status"
      if(!empty($_POST[$_s_pl]))
      {        
        $s_name = substr(htmlspecialchars(trim($_POST["s_name_".$_id])), 0, 100);
        
        upd_db_status($_id, $s_name);
      }

      //Удалить строку в таблице "Status"
      $_s_mn = "s_mn_".$_id;

      if(!empty($_POST[$_s_mn]))
      {
        del_str_db_status($_id);
      }
    }
    else
    {  
      $_id = 0;
      $_s_pl = "s_pl_".$_id;
      
      //Сохранить новую строку в таблице "Status"
      if(!empty($_POST[$_s_pl]))
      {          
        $s_name = substr(htmlspecialchars(trim($_POST["s_name_".$_id])), 0, 100);
        
        save_str_db_status($s_name);
      }      
    }


?>
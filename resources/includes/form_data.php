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
 // ------------------------------------------------
  // Обработка форм таблиц административной панели
  if(!empty($_GET['table'])and(!empty($_GET['num_str'])))
  {
    $table = $_GET['table'];
    $num = $_GET['num_str'];
    
    //Изменить строку в таблице
    if(!empty($_POST[$_GET['table']."_pl_".$num]))
    { 
      $arr_ = columns_table($table);      
      if ($arr_ <> null)
      {
        foreach ($arr_ as $key_ => $val_)
        {
          $col_name = $val_['COLUMN_NAME'];
          $col_type = $val_['DATA_TYPE'];
          
          ${$col_name} = htmlspecialchars(trim($_POST[$table."_".$col_name."_".$num]));
          ${$col_name} = urldecode(${$col_name});
          
          if($col_type=="int"){$arr[$col_name] = (int)${$col_name};}else{$arr[$col_name] = ${$col_name};}
        }
        
        if($_GET['count']==$_GET['num_str'])        
        {
          save_str_db_table($table, $arr);
        }
        else
        {
          upd_db_table($table, $arr);
        }
      }
    }

    //Удалить строку в таблице 
    if(!empty($_POST[$_GET['table']."_mn_".$num]))
    {
        $_id = substr(htmlspecialchars(trim($_POST[$table."_id_".$num])), 0, 10);

        //del_str_db_books($_id);
        del_str_db_table($table, (int)$_id); 
    }    
  }

  // ------------------------------------------------

  ?>
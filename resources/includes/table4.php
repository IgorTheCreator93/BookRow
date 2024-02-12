		
	<div class="ap-block-right-cap border">					
		<h4>Таблицa "Пользователи" ("Users")"</h4>
	</div>

	<?
	$arr_1 = [["id" => "Код", "name" => "Ф.И.О.", "email" => "Логин", "pass" => "Пароль", "status" => "Статус", "ban" => "Бан"]];
	$arr_2 = get_db_users_all();
	$arr_3 = array_merge($arr_1, $arr_2);
	$arr_4 = [["id" => "0", "name" => "", "email" => "", "pass" => "", "status" => "", "ban" => ""]];
	$arr = array_merge($arr_3, $arr_4);
	
	$count = count($arr);
	if($arr <> null)
		{ 
			$n = 1;
			foreach ($arr as $key=>$val)
			{
			  	$_id = $val['id'];
			  	$u_id = "u_id_".$_id;		                 			                 	
		      $name = $val['name'];
		      $u_name = "u_name_".$_id;
		      $log = $val['email'];
		      $u_log = "u_log_".$_id;
		      $pass = $val['pass'];
		      $u_pass = "u_pass_".$_id;
				$stat = $val['status'];
		      $u_stat = "u_stat_".$_id;
		      $ban = $val['ban'];
		      $u_ban = "u_ban_".$_id;
		      $u_pl = "u_pl_".$_id;
		      $u_mn = "u_mn_".$_id;
		      $form_id = "form_4_".$_id;
		      $action="/resources/views/ap.php?table=4&id_4=".$_id;
		      $mess = "";
		      $link = "";

		      if($n==1)
		      {
		      	$hl = "hl";
		      	$type="text";
		      	$val_pl = "Сохр.";
		      	$val_mn = "Уд.";
		      }
		      else
		      {
		      	$hl = "";
		      	$type="submit";
		      	$val_pl = "   +   ";
		      	$val_mn = "   -   ";
		      }

		       if($n==$count){$hl_ = "hl_"; $_id = "Нов. >";}else{$hl_ = "";}
			  	?>
				<form class="border" id="<? echo $form_id; ?>" action="<? echo $action; ?>" method="post">
				
					<div class="form-block border">
						<input name="<? echo $u_id; ?>" type="text" class="w-5 key <? echo $hl; ?>" value="<? echo $_id; ?>" disabled>
						<input name="<? echo $u_name; ?>" type="text" class="w-15 key <? echo $hl; ?> <? echo $hl_; ?>" value="<? echo $name; ?>">
						<input name="<? echo $u_log; ?>" type="text" class="w-10 key <? echo $hl; ?> <? echo $hl_; ?>" value="<? echo $log; ?>">
						<input name="<? echo $u_pass; ?>" type="text" class="w-15 key <? echo $hl; ?> <? echo $hl_; ?>" value="<? echo $pass; ?>">
						<input name="<? echo $u_stat; ?>" type="text" class="w-5 key <? echo $hl; ?> <? echo $hl_; ?>" value="<? echo $stat; ?>">
						<input name="<? echo $u_ban; ?>" type="text" class="w-5 key <? echo $hl; ?> <? echo $hl_; ?>" value="<? echo $ban; ?>">
						<input name="<? echo $u_pl; ?>" id="<? echo $u_pl; ?>" type="<? echo $type; ?>" class="btn_form w-5 key <? echo $hl; ?>" data-id="<? echo $_id; ?>" data-zn="plus" src="/public/img/icon/save5.jpg" width="25" height="25" value="<? echo $val_pl; ?>" alt="Сохранить строку" readonly>
						<input name="<? echo $u_mn; ?>" id="<? echo $u_mn; ?>" type="<? echo $type; ?>" class="btn_form w-5 key <? echo $hl; ?>" data-id="<? echo $_id; ?>" data-zn="minus" src="/public/img/icon/del4.jpg" width="25" height="25" value="<? echo $val_mn; ?>" alt="Удалить строку" readonly>
					</div>

				</form>
				<?
				$n++;
			}
		}
		?>

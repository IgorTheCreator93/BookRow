		
	<div class="ap-block-right-cap border">					
		<h4>Таблицa "Жанры" ("Genres")"</h4>
	</div>

	<?
	$arr_1 = [["id" => "Код", "name" => "Автор"]];
	$arr_2 = get_db_genres_all();
	$arr_3 = array_merge($arr_1, $arr_2);
	$arr_4 = [["id" => "0", "name" => ""]];
	$arr = array_merge($arr_3, $arr_4);

	$count = count($arr);
	if($arr <> null)
		{ 
			$n = 1;
			foreach ($arr as $key=>$val)
			{
			  	$_id = $val['id'];
			  	$g_id = "g_id_".$_id;		                 			                 	
		      $name = $val['name'];
		      $g_name = "g_name_".$_id;
		      $g_pl = "g_pl_".$_id;
		      $g_mn = "g_mn_".$_id;
		      $form_id = "form_3_".$_id;
		      $action="/resources/views/ap.php?table=3&id_3=".$_id;
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
						<input name="<? echo $g_id; ?>" type="text" class="w-5 key <? echo $hl; ?>" value="<? echo $_id; ?>" disabled>
						<input name="<? echo $g_name; ?>" type="text" class="w-15 key <? echo $hl; ?> <? echo $hl_; ?>" value="<? echo $name; ?>">
						<input name="<? echo $g_pl; ?>" id="<? echo $a_pl; ?>" type="<? echo $type; ?>" class="btn_form w-5 key <? echo $hl; ?>" data-id="<? echo $_id; ?>" data-zn="plus" src="/public/img/icon/save5.jpg" width="25" height="25" value="<? echo $val_pl; ?>" alt="Сохранить строку" readonly>
						<input name="<? echo $g_mn; ?>" id="<? echo $a_mn; ?>" type="<? echo $type; ?>" class="btn_form w-5 key <? echo $hl; ?>" data-id="<? echo $_id; ?>" data-zn="minus" src="/public/img/icon/del4.jpg" width="25" height="25" value="<? echo $val_mn; ?>" alt="Удалить строку" readonly>
					</div>

				</form>
				<?
				$n++;
				}
			}
			?>

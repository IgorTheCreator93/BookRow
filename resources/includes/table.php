		<?
		if(!empty($_GET['num'])){$num = $_GET['num'];}else{$num = 2;}
		$arr = get_data_table($num);    
    if ($arr <> null)
    {
      	foreach ($arr as $key => $val)
    		{
          $id = $val['id'];
          $table = $val['name_en'];
          $table_ru = $val['name_ru'];
        }
     }		
		?>

		<div class="ap-block-center-cap border">
			<h4>Таблицa: <? echo $table_ru." (".$table.")"; ?></h4>
		</div>

		<div class="ap-block-center-tab border">	

			<?
			$arr_ = columns_table($table);
			
	    if ($arr_ <> null)
	    {
	        foreach ($arr_ as $key_ => $val_)
	        {
	          $arr_1[$val_['COLUMN_NAME']] = explode(":", $val_['COLUMN_COMMENT'])[0];
	          if($key_==0){$arr_4[$val_['COLUMN_NAME']] = 0;}else{$arr_4[$val_['COLUMN_NAME']] = "";}
	        }                                   
	    }
	    else
	    {
	    	unset($arr_1);
	    	unset($arr_4);
	    }

			$arr_2 = get_db_table_all($table);
			$arr_3 = array_merge([$arr_1], $arr_2);
			$arr = array_merge($arr_3, [$arr_4]);
			
			$count = count($arr);
			if($arr <> null)
			{ 
	   		$n = 1;
	   		$hl_0 = "";
	       foreach ($arr as $key=>$val)
	       {
	         	if($n==1)
	          {
	          	$hl_1 = "hl_1";
	          	$type="text";
	          	$val_pl = "Сохр.";
	          	$val_mn = "Уд.";
	          }
	          else
	          {
	          	$hl_1 = "";
	          	$type="submit";
	          	$val_pl = "   +   ";
	          	$val_mn = "   -   ";
	          }
	          // $mess = "";
	          // $link = "";
	          $form_id = "form_".$table."_".$n;
	          $action="/resources/views/ap.php?num=".$num."&table=".$table."&num_str=".$n."&count=".$count;

	          $width = "w-5";
	         ?>
					<form class="border" id="<? echo $form_id; ?>" action="<? echo $action; ?>" method="post">
						
							<div class="form-block border">
								<?
								
								foreach ($arr_ as $key_=>$val_)
	       				{
	       					$col_name = $val_['COLUMN_NAME'];//Получем название колонки таблицы (англ.)
	       					
	       					$col_com_ = $val_['COLUMN_COMMENT'];//Получаем комментарий к колонке таблицы (рус.)
			       			$arr_col_com = explode(":", $col_com_);//Преобразуем комментарий в массив (разделитель - ":") 
			       			$count_col_com = count($arr_col_com);//Определяем количество элементов в массиве
			       			$col_com = $arr_col_com[0];//Получаем первый элемент массива (русское название колонки)
			       			
			       			if(!empty($arr_col_com[1])){$wid_col = $arr_col_com[1]; $width = "w-".$wid_col;}//Получаем второй элемент массива (ширина колонки)
			       			if(!empty($arr_col_com[2])){$tab_link = $arr_col_com[2];}//Получаем третий элемент массива (ссылка на таблицу)
			       		

			       			if($col_name=="id"){$_id = $val[$col_name];}//Запоминаем значение колонки id в переменную $_id
			       			
			       			if($n==1){$value = $col_com; $hl_1="hl_1";}else{$value = urldecode(htmlspecialchars(trim($val[$col_name]))); $hl_1="";}//Первая строка таблицы содержит заголовки, а остальные строки (кроме 1) содержат значения таблицы
			       			
			       			if(($col_name=="id")and($n<>1)){$hl_1="hl_2";}//Вся колонка "id" не доступна для редактирования ("disabled")

			       			if($n==$count){if($col_name=="id"){$value = "+"; $hl_0="";}else{$hl_0="hl_0";}}//Последняя строка //Колонка "id" в последней строке (с номером $count) выглядит, как "Нов. >" (вместо цифр) и без обводки. Все остальные колонки с обводкой.
									
									?>
									<input name="<? echo $table."_".$col_name."_".$n; ?>" id="<? echo $table."_".$col_name."_".$n; ?>" type="text" class="<? echo $width; ?> <? echo $hl_1; ?> <? echo $hl_0; ?>" value="<? echo $value; ?>">
									<?
								}
								?>
								<input name="<? echo $table."_pl_".$n; ?>" id="<? echo $table."_pl_".$n; ?>" type="<? echo $type; ?>" class="btn_form w-5 <? echo $hl_1; ?>" data-id="<? echo $_id; ?>" data-zn="plus" value="<? echo $val_pl; ?>" alt="Сохранить строку" readonly>
								<input name="<? echo $table."_mn_".$n; ?>" id="<? echo $table."_mn_".$n; ?>" type="<? echo $type; ?>" class="btn_form w-5 <? echo $hl_1; ?>" data-id="<? echo $_id; ?>" data-zn="minus" value="<? echo $val_mn; ?>" alt="Удалить строку" readonly>
								<div class="space">....</div>
							</div>

					</form>
				 <?
							
				 $n++;
					}
				}
			?>
		</div>
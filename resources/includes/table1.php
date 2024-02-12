
		<div class="ap-block-right-cap border">					
			<h4>Таблицa "Книги" ("Books")"</h4>
		</div>

		<?
		$arr_1 = [["id" => "Код", "name" => "Книга", "descr" => "Описание", "img" => "Картинка", "year" => "Год", "author" => "Автор", "genre" => "Жанр"]];
		$arr_2 = get_db_books_all();
		$arr_3 = array_merge($arr_1, $arr_2);
		$arr_4 = [["id" => "0", "name" => "", "descr" => "", "img" => "", "year" => "", "author" => "", "genre" => ""]];
		$arr = array_merge($arr_3, $arr_4);
		
		$count = count($arr);
		if($arr <> null)
			{ 
     		$n = 1;
         foreach ($arr as $key=>$val)
         {
           	$_id = $val['id'];
           	$b_id = "b_id_".$_id;		                 			                 	
            $name = $val['name'];
            $b_name = "b_name_".$_id;
            $descr = $val['descr'];
            $b_descr = "b_descr_".$_id;
            $img = $val['img'];
            $b_img = "b_img_".$_id;
            $year = $val['year'];
            $b_year = "b_year_".$_id;
            $author_id = $val['author'];
            $author = get_db_authors($author_id);
            $b_author = "b_author_".$_id;
            $genre = $val['genre'];
            $b_genre = "b_genre_".$_id;
            $b_pl = "b_pl_".$_id;
            $b_mn = "b_mn_".$_id;
            $form_id = "form_1_".$_id;
            $action="/resources/views/ap.php?table=1&id_1=".$_id;
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
							<input name="<? echo $b_id; ?>" type="text" class="w-5 key <? echo $hl; ?>" value="<? echo $_id; ?>" disabled>
							<input name="<? echo $b_name; ?>" type="text" class="w-15 key <? echo $hl; ?> <? echo $hl_; ?>" value="<? echo $name; ?>">
							<input name="<? echo $b_descr; ?>" id="<? echo $b_descr; ?>" type="text" class="w-25 key <? echo $hl; ?> <? echo $hl_; ?>" value="<? echo $descr; ?>">
							<input name="<? echo $b_img; ?>" id="<? echo $b_img; ?>" type="text" class="w-15 key <? echo $hl; ?> <? echo $hl_; ?>" value="<? echo $img; ?>">
							<input name="<? echo $b_year; ?>" id="<? echo $b_year; ?>" type="text" class="w-5 key <? echo $hl; ?> <? echo $hl_; ?>" value="<? echo $year; ?>">
							<input name="<? echo $b_author; ?>" id="<? echo $b_author; ?>" type="text" class="w-5 key <? echo $hl; ?> <? echo $hl_; ?>" value="<? echo $author_id; ?>">
							<input name="<? echo $b_genre; ?>" id="<? echo $b_genre; ?>" type="text" class="w-5 key <? echo $hl; ?> <? echo $hl_; ?>" value="<? echo $genre; ?>">
							<input name="<? echo $b_pl; ?>" id="<? echo $b_pl; ?>" type="<? echo $type; ?>" class="btn_form w-5 key <? echo $hl; ?>" data-id="<? echo $_id; ?>" data-zn="plus" src="/public/img/icon/save5.jpg" width="25" height="25" value="<? echo $val_pl; ?>" alt="Сохранить строку" readonly>
							<input name="<? echo $b_mn; ?>" id="<? echo $b_mn; ?>" type="<? echo $type; ?>" class="btn_form w-5 key <? echo $hl; ?>" data-id="<? echo $_id; ?>" data-zn="minus" src="/public/img/icon/del4.jpg" width="25" height="25" value="<? echo $val_mn; ?>" alt="Удалить строку" readonly>
						</div>

				</form>					
			<?
			$n++;
			}
		}
		?>
	
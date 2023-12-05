<div class="catalogs border">

     <ul>
        <li class="border">Каталог</li>
        <li class="border"><a href="/?id=0">Все</a></li>
        <li class="border"><a href="/?id=1">Бизнес</a></li>
        <li class="border"><a href="/?id=2">Наука</a></li>
        <li class="border"><a href="/?id=3">Художественные</a></li>
        <li class="border"><a href="/?id=4">Психология</a></li>
        <li class="border"><a href="/?id=5">Биография</a></li>
    </ul>

</div>

<div class="books border"> 
    <?
    if(!empty($search))
    {
        $arr = search_content($search);
    }
    else
    {
        $arr = get_db_books($g_id);
    }                

    if($arr <> null)
    {
        foreach ($arr as $key=>$val)
        {
            $_id_ = $val['id'];
            $name = $val['name'];
            $img = $val['img'];
            
            if (!empty($_SESSION['log_email']))
            {
                $url = "/resources/views/desc.php?n=".$_id_;
            }
            else
            {
                $url = "";
            }
            
            $author_id = $val['author'];
            $author = get_db_authors($author_id);
            ?>    
            <div class="books-block border">
                
                <div class="books-block-content border">
                    <img class="books-block-img" src="<? echo $img; ?>" alt="" data-url="<? echo $url; ?>">
                </div>

                <div class="books-block-content">
                    <h3>
                        <? echo $name; ?>
                    </h3>
                    <p>
                        <? echo $author; ?>
                    </p>
                </div>

            </div>
        <?      
        }
    }
    ?>
 </div>
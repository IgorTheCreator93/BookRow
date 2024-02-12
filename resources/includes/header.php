<div class="header border">
    <div class="logo border">
        <div class="logo-img border">
            <a href="/"><img src="/public/img/logo.jpg" alt=""></a>
        </div>
        <div class="logo-text border">
        <a href="/"> BookRow</a>
        </div>
    </div>
    <div class="search border">

        <form class="border" id="form_search" action="/" method="post">

            <div class="search-content border">
                <input type="search" name="text_search" id="text_search" minlength="3" maxlength="100" size="100" placeholder="Найти книгу ..." required autofocus>
                <a onclick="document.getElementById('form_search').submit();" href="#">
                    <img class="border" src="/public/img/lupa_.png" alt="">
                </a>
            </div>

        </form>
    </div>
    <? $us_name = get_us_name($_SESSION['log_email']); ?>
    <div class="auth border">
        <a href="#open_modal_login"><img src="/public/img/Group 73.png" alt=""></a>
        <a href=""><? echo $us_name; ?></a>
    </div>
</div>
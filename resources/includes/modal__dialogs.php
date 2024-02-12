
<!-- МОДАЛЬНОЕ ОКНО Форма авторизации --------------------------------->

<div id="open_modal_login" class="modalDialog">
		<div style="border-radius: 5%;">
			<a href="#close" id="log_close" title="Закрыть" class="close"><span>x</span></a>

			<div class="modal-caption">

				<a class="" href="#open_modal_login">Авторизация</a>

				<a class="" href="#open_modal_registr">Регистрация</a>

			</div>

			<div class="modal_body">

				<form id="auth-form" action="#open_modal_result" method="post">
					
					<div class="auth-form">
						<label for="log-email">E-mail:</label>
						<input name="log-email" id="log-email" type="text" value="<? echo $_SESSION['log_email']; ?>"required autofocus>
					</div>
						
					<div class="auth-form">
						<label for="log-pass">Пароль:</label>
						<input name="log-pass" id="log-pass" type="password" required>
					</div>

					<div class="auth-form">
						<input name="log-btn" id="log-btn" type="submit" data-n="" class="auth-btn" value="Войти">
					</div>						
						
				</form>

			</div>
	 </div>
</div>

<!-- МОДАЛЬНОЕ ОКНО Форма регистрации --------------------------------->

<div id="open_modal_registr" class="modalDialog">
		<div style="border-radius: 5%;">
			<a href="#close" id="log_close" title="Закрыть" class="close"><span>x</span></a>

			<div class="modal-caption">

				<a class="" href="#open_modal_login">Авторизация</a>

				<a class="" href="#open_modal_registr">Регистрация</a>

			</div>

			<div class="modal_body">

				<form id="auth-form" action="#open_modal_result" method="post">
					
					<div class="auth-form">
						<label for="reg-name">Имя:</label>
						<input name="reg-name" id="reg-name" type="text" value="<? echo $_SESSION['reg_name']; ?>" required autofocus>
					</div>

					<div class="auth-form">
						<label for="reg-email">E-mail:</label>
						<input name="reg-email" id="reg-email" type="email" value="<? echo $_SESSION['reg_email']; ?>" required>
					</div>
						
					<div class="auth-form">
						<label for="reg-pass">Пароль:</label>
						<input name="reg-pass" id="reg-pass" type="password" required>
					</div>

					<div class="auth-form">
						<label for="reg-pass-rep">Повторить пароль:</label>
						<input name="reg-pass-rep" id="reg-pass-rep" type="password" required>
					</div>

					<div class="auth-form">
						<input name="reg-btn" id="reg-btn" type="submit" data-n="" class="auth-btn" value="Войти">
					</div>
						
				</form>

			</div>
	 </div>
</div>


<!-- Результат -->
<?
if(!isset($mess)){$mess="";}
if(!isset($link)){$link="";}
?>
<div id="open_modal_result" class="modalDialog">
    <div style="width: 350px; border-radius: 5%;">
      <a href="#close" id="log_close" title="Закрыть" class="close"><span>x</span></a>

      <div class="modal_body">

        <h4 id="mess"><? echo $mess ?></h4>

        <h4 id="link" style="font-size: 16px; margin-left: auto; margin-right: auto;"><? echo $link; ?></h4>

      </div>
   </div>
</div>

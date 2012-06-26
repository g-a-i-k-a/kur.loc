<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Мероприятия</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<!-- Stylesheets -->
	<link rel="stylesheet" href="/template/css/reset.css" />
	<link rel="stylesheet" href="/template/css/styles.css" />
	
	<!-- Scripts -->
	<script type="text/javascript" src="/template/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript"  src="/template/js/contact.js"></script>
	<script type="text/javascript"  src="/template/js/reg.js"></script>
	<script type="text/javascript"  src="/template/js/auth.js"></script>


</head>

<body>

	<div id="wrapper" class="container_12 clearfix">
	<div class="grid_12">
	
	<? if ($_COOKIE['auth_code']) { ?>
	<div id="profile_link">
		<a href="/profile/">Личный кабинет</a>
	</div>
	<? } 
	
	else { ?>
	
	<form action='/auth/' method='post' id='auth_form'>
		<div id="login_field">
		  <label for="login">Логин</label>
		  <input type='text' name='login' id='login' />
		  <p id='login_error' class='error'>Введите логин</p>
		</div>
		<div id="pw_field">
		  <label for="pw">Пароль</label>
		  <input type="password" name='pw' id='pw' />
		  <p id='pw_error' class='error'>Введите пароль</p>
		</div>
		<input type='submit' class="button" id="auth_send" value='Войти' />
		<a href="/registration/" class="button">Регистрация</a> 
		<p id='auth_fail' class='error'>Такого пользователя не существует</p>
	</form> 
	<div id="profile_link" style="display: none;">
		<a href="/profile/">Личный кабинет</a>
	</div>

	<? } ?>
	
	</div>

		<!-- Text Logo -->
		<h1 id="logo" class="grid_4"><a href="/">Мероприятия</a></h1>
		<!-- Navigation Menu -->
		<ul id="navigation" class="grid_8">
			<li><a href="/exhibition/" <? if($_SERVER['REQUEST_URI'] == '/exhibition/') echo "class='current'";?>><span class="meta">На что посмотреть?</span><br />Выставки</a></li>
			<li><a href="/cinema/" <? if($_SERVER['REQUEST_URI'] == '/cinema/') echo "class='current'";?>><span class="meta">Что показывают в кино?</span><br />Киносеансы</a></li>
			<li><a href="/concert/" <? if($_SERVER['REQUEST_URI'] == '/concert/') echo "class='current'";?>><span class="meta">Что послушать?</span><br />Концерты</a></li>
		</ul>
			
		<div class="hr grid_12 clearfix">&nbsp;</div>
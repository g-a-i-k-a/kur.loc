<?php

function html_list_event($event) {
?>
			<div class="post">
				<h3 class="title"><a href="/event.php?id=<?=$event['id']?>"><?=$event['name']?></a></h3>
				<p class="sub">&bull; <?=$event['date']?> &bull; <?=$event['place']?> </p>
				<div class="hr dotted clearfix">&nbsp;</div>
				<p><?=$event['description']?></p>
				<p class="clearfix"><a href="/event.php?id=<?=$event['id']?>" class="button right">Купить билет</a></p>
			</div>
			<div class="hr clearfix">&nbsp;</div>
<?
}

function html_event($event) {
?>
			<div class="post">
				<h3 class="title"><?=$event['name']?></h3>
				<div class="hr dotted clearfix">&nbsp;</div>
				<p class="sub"><?=$event['date']?> </p>
				<p class="sub"><?=$event['place']?> </p>
				<p class="sub"><?=$event['adr']?> </p>
				<p><?=$event['description']?></p>
			</div>
			<div class="hr clearfix">&nbsp;</div>
<?
}

function html_ticket($ticket){
?> 
<tr>
	<td><?=$ticket['sector']?></td>
	<td><?=$ticket['row']?></td>
	<td><?=$ticket['seat']?></td>
	<td><?=$ticket['price']?></td>
	<td><input type="checkbox" name="<?=$ticket['id']?>"></td>
</tr>
<?

}

function html_reg() {
?>
<h2 class="grid_12 caption clearfix">Регистрация</span></h2>
<div class="hr grid_12 clearfix">&nbsp;</div>

<div class="grid_8" style="width:980px">
<p id='reg_success' class='success'>Спасибо! Регистрация прошла успешно.</p>
<form action='' method='post' id='reg_form'>
	<ul>						
	  <li class="clearfix"> 
	  	<label for="login">Логин</label>
	  	<input type='text' name='login' id='login' />
	  	<div class="clear"></div>
	  	<p id='login_error' class='error'>Введите логин</p>
	  </li> 
	  <li class="clearfix"> 
	  	<label for="pw1">Пароль</label>
	  	<input type='password' name='pw1' id='pw1' />
	  	<div class="clear"></div>
	  	<p id='pw1_error' class='error'>Введите пароль</p>
	  </li>
	  <li class="clearfix"> 
	  	<label for="pw1">Повторите пароль</label>
	  	<input type='password' name='pw2' id='pw2' />
	  	<div class="clear"></div>
	  	<p id='pw2_error' class='error'>Пароли не совпадают</p>
	  </li>
	  <li class="clearfix"> 
	  	<label for="fio">ФИО</label>
	  	<input type='text' name='fio' id='fio' />
	  	<div class="clear"></div>
	  	<p id='fio_error' class='error'>Введите ФИО</p>
	  </li> 
	  <li class="clearfix"> 
	  	<label for="adr">Адрес</label>
	  	<textarea name='adr' id='adr' rows="30" cols="30"></textarea>
	  	<div class="clear"></div>
	  	<p id='adr_error' class='error'>Введите адрес</p>
	  </li> 
	  <li class="clearfix">
		<p id='reg_fail' class='error'>Возникли проблемы при регистрации. Попробуйте позже.</p>
	  <div id="button">
	  <input type='submit' class="button" id="reg_send" value='Зарегистрироваться' />
	  </div>
	  </li> 
	</ul> 
</form>  					
</div>

<?
}



function post_get($param) {
	if ( empty($_GET) && empty($_POST) ) return false;  
  if ($param) {
    return array_key_exists($param, $_GET) ? $_GET[$param] : (array_key_exists($param, $_POST) ? $_POST[$param] : "");
  }
  else return array_merge($_POST, $_GET);
}


function standardize_path_to_file($path) {
	return rtrim(standardize_path_to_folder($path), '/');
}

function standardize_path_to_folder($path) {
	$path = str_replace('\\', '/', $path);
	while(!(strpos($path, '//') === false)) {
		$path = str_replace('//', '/', $path);
	}
	return rtrim($path, '/') . '/';
}	


function is_windows() {
	return ( (strstr(strtolower(PHP_OS), 'win') && PHP_SHLIB_SUFFIX != 'so') ? true : false);
}


function write_log($message, $time = true) {
	$message_time = "";
	if ($time) {
		$message_time = date("H:i:s d.m.Y").' ';
		if (substr($message, -1) != '.') $message = $message.'.';
	}
	$result_str = PHP_EOL.$message_time.$message;
	
	file_put_contents("log.txt", $result_str, FILE_APPEND);
} 


function nc_func_enabled ($function) {
  $function = strtolower(trim($function));
  if ($function == '') return false;
  $dis_functions = array();
  $dis_functions = explode(",",@ini_get("disable_functions"));
  if ( !empty($dis_functions) ) $dis_functions = array_map('trim',array_map('strtolower', $dis_functions));
	if ( function_exists($function) && is_callable($function) && !in_array($function, $dis_functions) ) return true;
	else return false;
}

function clear_dir($directory) {
	$files = double_array_shift(scandir($directory));
	foreach ($files as $file) {
		$file = $directory . '/' . $file;
		if (is_dir($file)) clear_dir($file);
		else @unlink($file);
	}
	@rmdir($directory);
}
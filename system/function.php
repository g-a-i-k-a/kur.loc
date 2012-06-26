<?php

function html_order() {
	require_once("db.php");
	$db = Db::get_object();

?>
		<div class="hr clearfix">&nbsp;</div>
		<div class="catagory_1 clearfix">
<?
$user_id = (is_admin() ? 0 : get_user_data());

$data_arr = get_order_data();

if ($data_arr) {
	foreach ($data_arr as $data) {
	  html_order_row($data);
	}
}


		
?>		
		</div>
<?

}


function get_order_data($user_id = 0) {
	require_once("db.php");
	$db = Db::get_object();
	$q_where = ($user_id ? "WHERE `user_id`= ".$user_id : "");

	$order_data = $db->get_results("SELECT `ticket` FROM `order` ".$q_where, ARRAY_A);

	if (empty($order_data)) return false;
	else {
		foreach ($order_data as $k => $v) {
			$order_data[$k] = unserialize($order_data[$k]['ticket']);
		}
	}
							
	return $order_data;														
}



function html_order_row($data) {
?>
<div class="grid_3 textright" >
	<span class="meta"><?=$data['edate']?></span>
	<h4 class="title "><?=$data['ename']?></h4>
	<div class="hr clearfix dotted">&nbsp;</div>
</div>
<div class="grid_9">
	<dl class="history">
  	<dt>Билет:</dt>
  	<dt>Цена:</dt>
   	<dd><?=($data['price'] ? $data['price']." руб." : "бесплатно")?></dd>
		<div class="clearfix"></div>
   	<dt>Статус:</dt>
   	<dd><?=$data['status']?></dd>
	</dl>
</div>
<div class="clearfix">&nbsp;</div>
<?
}

function html_ticket_row($data){

}


function html_profile() {
?>
		<div class="hr clearfix">&nbsp;</div>
		<div class="catagory_1 clearfix">
<?
if (is_admin()) {
	$data_arr = get_user_data_all();
	if (empty($data_arr)) {
	return false;
	}
	foreach ($data_arr as $data) {
	  html_profile_row($data);
	}
}

else {
	$data = get_user_data();
	html_profile_row($data);
}
		
?>		
		</div>
<?

}

function html_profile_row ($data) {
?>
<div class="grid_3 textright" >
	<span class="meta"><?=$data['login']?></span>
	<h4 class="title "><?=$data['fio']?></h4>
	<div class="hr clearfix dotted">&nbsp;</div>
</div>
<div class="grid_9">
	<p><?=$data['address']?></p>
</div>
<div class="clearfix">&nbsp;</div>
<?
}

function is_admin() {
	$data = get_user_data();
	if($data['role'])
		return true;
	else return false;	
}

function get_user_data($item = "") {
	require_once("db.php");
	$db = Db::get_object();
	$data = $db->get_row("SELECT `id`,`role`,`login`,`fio`, `address` FROM user WHERE MD5(`login`)='".$_COOKIE['auth_code']."'", ARRAY_A); 
	if (array_key_exists($item, $data)){
		return $data[$item];
	}
	else {
		return $data;
	}
}

function get_user_data_all() {
	require_once("db.php");
	$db = Db::get_object();
	return $db->get_results("SELECT `id`,`role`,`login`,`fio`, `address` FROM user", ARRAY_A);
}

function html_profile_nav(){
?>
<ul id="profile_nav">
		<li><a href="/profile/" <? if($_SERVER['REQUEST_URI'] == '/profile/') echo "class='current'";?>>Профиль</a></li>
		<li><a href="/order/" <? if($_SERVER['REQUEST_URI'] == '/order/') echo "class='current'";?>>Заказы</a></li>
</ul>
<?
}

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
	<td><?=$ticket['price']?></td>
	<td><input type="checkbox" name="ticket<?=$ticket['id']?>" value="<?=$ticket['id']?>"></td>
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
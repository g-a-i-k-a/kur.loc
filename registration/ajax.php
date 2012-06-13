<?php
$ROOT_FOLDER = join(strstr(__FILE__, "/") ? "/" : "\\", array_slice(preg_split("/[\/\\\]+/", __FILE__), 0, -2)).( strstr(__FILE__, "/") ? "/" : "\\" );
include($ROOT_FOLDER."/config.php");
require_once($ROOT_FOLDER."/system/index.php");
	
//include_once($HEADER);

$login = $db->escape(post_get('login'));
$pw = $db->escape(post_get('pw'));
$pw1 = $db->escape(post_get('pw1'));
$fio = $db->escape(post_get('fio'));
$adr = $db->escape(post_get('adr'));

if ($db->get_var("SELECT `id` FROM `user` WHERE `login` = '".$login."'")) {
	$error = "Такой логин уже используется";
}

if ($error) {
	echo 'fail';
}
else {
	$db->query("INSERT INTO `user` (`login`, `password`, `fio`, `address`) VALUES ('".$login."', MD5('".$pw."'), '".$fio."', '".$adr."')");
	echo "success";
}




//include_once($FOOTER);
?>
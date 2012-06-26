<?php
$ROOT_FOLDER = join(strstr(__FILE__, "/") ? "/" : "\\", array_slice(preg_split("/[\/\\\]+/", __FILE__), 0, -2)).( strstr(__FILE__, "/") ? "/" : "\\" );
include($ROOT_FOLDER."/config.php");
require_once($ROOT_FOLDER."/system/index.php");
	
$login = $db->escape(post_get('login'));
$pw = $db->escape(post_get('pw'));

$id = $db->get_var("SELECT `id` FROM `user` WHERE `login` = '".$login."' AND `password` = MD5('".$pw."')");
if ($id) {
	setcookie('auth_code',MD5($login),time()+60*60*24*7,'/','.kur.loc',0);
	echo "success";
}
else "error";

?>
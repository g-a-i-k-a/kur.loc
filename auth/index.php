<?php
$ROOT_FOLDER = join(strstr(__FILE__, "/") ? "/" : "\\", array_slice(preg_split("/[\/\\\]+/", __FILE__), 0, -2)).( strstr(__FILE__, "/") ? "/" : "\\" );
include($ROOT_FOLDER."/config.php");
require_once($ROOT_FOLDER."/system/index.php");
	
include_once($HEADER);

$login = $db->escape(post_get('login'));
$pw = $db->escape(post_get('pw'));

if (!($login && $pw)) {
	$error = "<div>Введены не все данные</div>";
}
/*
if ($error) {
	echo $error;
	html_reg();
}
else {
	if ($login && $pw && $pw1 && $fio && $adr) {
		$db->query("INSERT INTO `user` (`login`, `password`, `fio`, `address`) VALUES ('".$login."', MD5('".$pw."'), '".$fio."', '".$adr."')");
		echo "Регистрация прошла успешно";
	}
	else {
		html_reg();
	}
}*/




include_once($FOOTER);
?>
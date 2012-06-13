<?php
$ROOT_FOLDER = join(strstr(__FILE__, "/") ? "/" : "\\", array_slice(preg_split("/[\/\\\]+/", __FILE__), 0, -2)).( strstr(__FILE__, "/") ? "/" : "\\" );
include($ROOT_FOLDER."/config.php");
require_once($ROOT_FOLDER."/system/index.php");
	
include_once($HEADER);

html_reg();

include_once($FOOTER);
?>
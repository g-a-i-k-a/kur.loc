<?php
$ROOT_FOLDER = join(strstr(__FILE__, "/") ? "/" : "\\", array_slice(preg_split("/[\/\\\]+/", __FILE__), 0, -2)).( strstr(__FILE__, "/") ? "/" : "\\" );
include($ROOT_FOLDER."/config.php");
require_once($ROOT_FOLDER."/system/index.php");

include_once($HEADER);

?>

<h2 class="grid_12 caption clearfix">Как заказать и получить билеты через наш сервис</h2>

<div class="hr grid_12 clearfix">&nbsp;</div>

<!-- Column 1 /Content -->
<div class="grid_8" style="width:980px">
						
</div>
<?
include_once($FOOTER);
?>
<?php
$ROOT_FOLDER = join(strstr(__FILE__, "/") ? "/" : "\\", array_slice(preg_split("/[\/\\\]+/", __FILE__), 0, -1)).( strstr(__FILE__, "/") ? "/" : "\\" );
include($ROOT_FOLDER."/config.php");
require_once($ROOT_FOLDER."/system/index.php");

include_once($HEADER);

$event_id = $db->escape(post_get('id'));
$event_data = $db->get_row("SELECT `e`.`date`, `e`.`name`, `e`.`description`,
																`p`.`name` as `place`, `p`.`address` as `adr` 
																FROM `event` as `e`
																LEFT JOIN `place` as `p` ON `p`.`id` = `e`.`place_id`
																WHERE `e`.`id` = ".$event_id, ARRAY_A);
																
html_event($event_data);

$tickets = $db->get_results("SELECT `t`.`id`, `t`.`sector`, `t`.`row`,`t`.`seat`, `t`.`price`
														FROM `ticket_".$event_id."` as `t`
														WHERE `t`.`status` = 0", ARRAY_A);

if (!empty($tickets)) {
	?>
	<form action="" method="post">
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<th>Сектор</th>
			<th>Ряд</th>
			<th>Место</th>
			<th>Цена</th>
			<th>Выбрать</th>
		</tr>
	<?
	foreach ($tickets as $ticket) {
		html_ticket($ticket);
	}
	?>
	</table>
	<div class="hr clearfix">&nbsp;</div>
	<p class="clearfix"><input type="submit" class="button right" value="Купить билет"/></p>
	</form>
	<?
}



include_once($FOOTER);
?>
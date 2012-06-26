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

$tickets = $db->get_results("SELECT `t`.`id`, `t`.`seat`, `t`.`price`
														FROM `ticket` as `t`
														WHERE `t`.`status` = 0 AND `t`.`event_id` = ".$event_id, ARRAY_A);

if (!empty($tickets) && get_user_data()) {
	?>
	<script type="text/javascript"  src="/template/js/order.js"></script>
	<form action="/order/add.php" method="post" id="order_form">
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
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
	<p id="check_error" class="error">Выберите хоть 1 билет для заказа</p>
	<input type="hidden" name="event" value="<?=$event_id?>"/>
	<p id="order_fail" class="error">Произошла ошибка при добавлении заказа. Попробуйте позже.</p>
	<p class="clearfix"><input type="submit" class="button right" id="order_send" value="Купить билет"/></p>
	</form>
	<p id="order_success" style="display: none;">Билеты заказаны и ожидают подтверждения. Вы можете следить за статусом заказа на <a href="/order/">этой странице</a>.</p>

	<?
}

else {
if (get_user_data()) {
	?>
		<p>К сожалению, на данный момент доступных билетов нет.</p>

	<?
	}
	else {
	?>
		<p>К сожалению, покупка билетов доступна только авторизованным пользователям.</p>

	<?

	}
}


include_once($FOOTER);
?>
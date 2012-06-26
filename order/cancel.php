<?php
$ROOT_FOLDER = join(strstr(__FILE__, "/") ? "/" : "\\", array_slice(preg_split("/[\/\\\]+/", __FILE__), 0, -2)).( strstr(__FILE__, "/") ? "/" : "\\" );
include($ROOT_FOLDER."/config.php");
require_once($ROOT_FOLDER."/system/index.php");
	
$order_id = $db->escape(post_get('order'));

if(!$order_id) {
	echo "fail";
	exit;
}

$query_status = "UPDATE `order` SET `status_id` = 6 WHERE `id` = ".$order_id;

$order_data = $db->get_var("SELECT `o`.`ticket`
  															FROM `order` as `o`
  															WHERE `o`.`id` = ".$order_id);															
$data = unserialize($order_data);

$ticket_arr = $data['tickets'];
$query_tickets = "UPDATE `ticket` SET `status` = 0 WHERE `id` IN (".join(", ", $ticket_arr).")";
																				
if($db->query($query_status) && $db->query($query_tickets)) {
	echo "success";
}

?>
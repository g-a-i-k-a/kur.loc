<?php
$ROOT_FOLDER = join(strstr(__FILE__, "/") ? "/" : "\\", array_slice(preg_split("/[\/\\\]+/", __FILE__), 0, -2)).( strstr(__FILE__, "/") ? "/" : "\\" );
include($ROOT_FOLDER."/config.php");
require_once($ROOT_FOLDER."/system/index.php");
	
$event_id = $db->escape(post_get('event'));
$user_id = get_user_data('id');

if(empty($_POST) || !$event_id) {
	echo "fail";
	exit;
}

$tickets = array();
$q = "";
foreach ($_POST as $k => $v) {
	if (preg_match("/\bticket([0-9])+/", $k) ){
		$tickets[] = $v;
	}
}
$tickets_str = join(", ", $tickets);

$query_status = "UPDATE `ticket` SET `status` = 1 WHERE `id` IN (".$tickets_str.") AND `event_id` = ".$event_id;

$query_order_arr = array();
$query_order_arr['event'] = $event_id;
$query_order_arr['tickets'] = $tickets;

$query_order = "INSERT INTO `order` VALUES ('',".$user_id.", '".serialize($query_order_arr)."', 1)";

if($db->query($query_status) && $db->query($query_order)) {
	echo "success";
}

?>
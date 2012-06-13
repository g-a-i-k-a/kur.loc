<?php
$ROOT_FOLDER = join(strstr(__FILE__, "/") ? "/" : "\\", array_slice(preg_split("/[\/\\\]+/", __FILE__), 0, -2)).( strstr(__FILE__, "/") ? "/" : "\\" );
include($ROOT_FOLDER."/config.php");
require_once($ROOT_FOLDER."/system/index.php");

include_once($HEADER);

?>

<h2 class="grid_12 caption clearfix">Список предстоящих <span>концертов</span></h2>
<div class="hr grid_12 clearfix">&nbsp;</div>

<div class="grid_8" style="width:980px">

<?
$events = $db->get_results("SELECT `e`.`id`, `e`.`date`, `e`.`name`, `e`.`description`,
  													`p`.`name` as `place` 
  													FROM `event` as `e`
  													LEFT JOIN `place` as `p` ON `p`.`id` = `e`.`place_id`
  													WHERE `e`.`type_id` = 1", ARRAY_A);
if(!empty($events)) {
  foreach ($events as $event) {
  	html_list_event($event);
  }
}
else echo "<p class='clearfix'>Нет предстоящих мероприятий</p>";

?>						
</div>
<?
include_once($FOOTER);
?>
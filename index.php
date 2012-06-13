<?php

$ROOT_FOLDER = join(strstr(__FILE__, "/") ? "/" : "\\", array_slice(preg_split("/[\/\\\]+/", __FILE__), 0, -1)).( strstr(__FILE__, "/") ? "/" : "\\" );
include($ROOT_FOLDER."/config.php");
require_once($ROOT_FOLDER."/system/index.php");

include_once($HEADER);

?>
<div class="clear"></div>
			
		<!-- Caption Line -->
		<h2 class="grid_12 caption clearfix">Добро пожаловать! Это онлайн система покупки билетов на культурные мероприятия - самый удобный способ попасть на <u>концерт</u>, <u>выставку</u> или в <u>кино</u>!</h2>
		
		<div class="hr grid_12 clearfix quicknavhr">&nbsp;</div>
		<div id="quicknav" class="grid_12">
			<a class="quicknavgrid_3 quicknav alpha" href="/concert/">
					<h4 class="title ">Концерты</h4>
					<p>Найдите кого послушать этим вечером</p>
					<p style="text-align:center;"><img alt="" src="/template/images/Device-CDR-icon.png" /></p>
				
			</a>
			<a class="quicknavgrid_3 quicknav" href="/cinema/">
					<h4 class="title ">Киносеансы</h4>
					<p>На какой фильм пойдём с друзьями?</p>
					<p style="text-align:center;"><img alt="" src="/template/images/iMovie-icon.png" /></p>
				
			</a>
			<a class="quicknavgrid_3 quicknav" href="/exhibition/">
					<h4 class="title ">Выставки</h4>
					<p>Что нового в искусстве?</p>
					<p style="text-align:center;"><img alt="" src="/template/images/iPhoto-icon.png" /></p>
				
			</a>
			<a class="quicknavgrid_3 quicknav" href="#">
					<h4 class="title ">Twitter</h4>
					<p>Мы в твиттере!</p>
					<p style="text-align:center;"><img alt="" src="/template/images/hungry_bird.png" /></p>
			</a>
		</div>

<?
include_once($FOOTER);
?>
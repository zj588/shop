<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php switch($date): case "1": ?>星期一<?php break;?>
	<?php case "2": ?>星期二<?php break;?>
	<?php case "3": ?>星期三<?php break;?>
	<?php case "4": ?>星期四<?php break;?>
	<?php case "5": ?>星期五<?php break;?>
	<?php case "6": ?>星期六<?php break;?>
	<?php case "7": ?>星期七<?php break; endswitch;?>
</body>
</html>
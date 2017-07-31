<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<!-- <?php if(is_array($arr)): $i = 0; $__LIST__ = array_slice($arr,1,2,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i; echo ($v); ?><br><?php endforeach; endif; else: echo "" ;endif; ?> -->

	<!-- <?php if(is_array($arr)): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i; if(($mod) == "1"): echo ($v); endif; endforeach; endif; else: echo "" ;endif; ?> -->

	<?php if(is_array($arr)): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i; echo ($i); ?>:<?php echo ($v); ?><br><?php endforeach; endif; else: echo "" ;endif; ?>
</body>
</html>
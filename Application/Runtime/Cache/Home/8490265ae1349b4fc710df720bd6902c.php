<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<!-- <?php if(is_array($arr)): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo ($i); ?>:<?php echo ($vo); ?><br><?php endforeach; endif; else: echo "" ;endif; ?> -->

	<!-- <?php if(is_array($arr)): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($mod) == "1"): echo ($vo); endif; endforeach; endif; else: echo "" ;endif; ?> -->

	<!-- <?php echo 'hello'; ?> -->
	
	<!-- 函数的使用 -->
	<!-- <?php echo (substr(strtoupper($str),0,3)); ?> -->

	/index.php/Home/Test

	<?php echo ((isset($str) && ($str !== ""))?($str):'这家伙很懒，什么都没留下。。。'); ?>
</body>
</html>
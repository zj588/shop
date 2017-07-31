<?php
ob_start();
echo '小明';
$name = ob_get_contents();

ob_flush();
echo '很黄很暴力';
$content = ob_get_contents();

ob_end_clean();

echo $name;
echo $content;
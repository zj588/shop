<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <link href="/Public/Admin/css/admin.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <table cellspacing=0 cellpadding=0 width="100%" 
               background="/Public/Admin/img/header_bg.jpg" border=0>
            <tr height=56>
                <td width=260><img height=56 src="/Public/Admin/img/header_left.jpg" 
                                   width=260></td>
                <td style="font-weight: bold; color: #fff; padding-top: 20px" 
                    align=middle>当前用户：<?php echo (session('username')); ?> &nbsp;&nbsp; <a style="color: #fff" 
                                                        href="" 
                                                        target=main>修改口令</a> &nbsp;&nbsp; <a style="color: #fff" class="logout" href="javascript:void(0);" target="_top">退出系统</a> 
                </td>
                <td align=right width=268><img height=56 
                                               src="/Public/Admin/img/header_right.jpg" width=268></td></tr></table>
        <table cellspacing=0 cellpadding=0 width="100%" border=0>
            <tr bgcolor=#1c5db6 height=4>
                <td></td>
            </tr>
        </table>

        <script src="/Public/Common/jquery-1.7.2.min.js"></script>
        <script>
            $(function () {
                $('.logout').click(function () {
                    if (confirm('确认退出登录吗？')) {
                        window.parent.location.href = '<?php echo U("login/logout");?>';
                    }
                });
            });
        </script>
    </body>
</html>
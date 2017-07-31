<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>增加角色</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Public/Admin//css/mine.css" type="text/css" rel="stylesheet">
    </head>

    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：角色管理-》添加角色信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="javascript:void(0);" onclick="history.go(-1);">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
            <form action="" method="post" >
            <table border="1" width="100%" class="table_a">
                <tr>
                    <td>角色名称</td>
                    <td><input type="text" name="role_name" /></td>
                </tr>
                
                
                <tr>
                    <td>角色状态</td>
                    <td>
                        <select name="status">
                            <option value='1'>启用</option>
                            <option value='0'>禁用</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>角色描述</td>
                    <td>
                        <textarea name="role_description" id="content_box"></textarea>
                    </td>
                </tr>
               
                
                
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="添加">
                    </td>
                </tr>  
            </table>
            </form>
        </div>

        <!-- 配置文件 -->
        <script type="text/javascript" src="/Public/Common/ueditor/ueditor.config.js"></script>
        <!-- 编辑器源码文件 -->
        <script type="text/javascript" src="/Public/Common/ueditor/ueditor.all.js"></script>
        <!-- 实例化编辑器 -->
        <script type="text/javascript">
            UE.getEditor('content_box', {
                initialFrameWidth: '600',
                initialFrameHeight: '250',
            });
        </script>
    </body>
</html>
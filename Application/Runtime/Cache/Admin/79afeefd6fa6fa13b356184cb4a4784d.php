<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>修改后台菜单</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet">
        
    </head>

    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：系统管理-》修改菜单</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="<?php echo U('menulist');?>">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
            <form action="" method="post" enctype="multipart/form-data" >
            <input type="text" name="id" value="<?php echo ($menuData["id"]); ?>" />
            <table border="1" width="100%" class="table_a">
                <tr>
                    <td>菜单名称</td>
                    <td><input type="text" name="menu_name" value="<?php echo ($menuData["menu_name"]); ?>" /></td>
                </tr>
               
                <tr>
                    <td>菜单级别</td>
                    <td>
                        <select name="pid">

                            <option value="0">顶级菜单</option>
                            <?php if(is_array($data)): foreach($data as $key=>$d): ?><option <?php echo ($d['id'] == $menuData['pid'] ? 'selected' : ''); ?> value="<?php echo ($d["id"]); ?>"><?php echo (str_repeat('&nbsp;&nbsp;',$d["level"])); echo ($d["menu_name"]); ?></option><?php endforeach; endif; ?>
                           
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>访问权限</td>
                    <td><input type="text" name="menu_url" value="<?php echo ($menuData["menu_url"]); ?>" /></td>
                </tr>
                 
                <tr>
                    <td>是否显示</td>
                    <td><input type="radio" value="1" <?php echo ($menuData['is_show'] == 1 ? 'checked' : ''); ?> name="is_show">是<input type="radio" value="0" <?php echo ($menuData['is_show'] == 0 ? 'checked' : ''); ?> name="is_show">否</td>
                </tr>
               
                
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="修改">
                    </td>
                </tr>  
            </table>
            </form>
        </div>
    </body>
   
  
</html>
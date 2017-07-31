<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>权限列表</title>

        <link href="/Public/Admin//css/mine.css" type="text/css" rel="stylesheet" />
         <script src="/Public/Common/jquery-1.7.2.min.js" type="text/javascript"></script>
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：角色管理-》权限列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo U('rolelist');?>">【返回角色管理】</a>
                </span>
            </span>
        </div>
        <div></div>
      
        <div style="font-size: 13px; margin: 10px 5px;">
        <form action="<?php echo U('accessedit');?>" method="post" name='access'>
            <input type="hidden" name="role_id" value="<?php echo ($roleInfo["id"]); ?>" />
            <table id="menu_list" class="table_a" border="1" width="100%">
                <tbody>
                      <tr>
                        <td>当前角色：</td>
                         <td>
                           <?php echo ($roleInfo["role_name"]); ?>
                         </td>
                       
                    </tr>
                    
                    <?php if(is_array($menuTree)): foreach($menuTree as $key=>$m): ?><tr >
                        <td><input <?php if(in_array($m['id'], $accessArr)): ?>checked<?php endif; ?> value="<?php echo ($m["id"]); ?>" name="menu_id[]" class="checkpart"  type="checkbox" ><?php echo ($m["menu_name"]); ?></td>
                         <td>
                        <?php if(is_array($m['_child'])): foreach($m['_child'] as $key=>$mm): ?><div style="width:100px;float:left;"><input class="checkpart2 checkpart_<?php echo ($m['id']); ?>" <?php if(in_array($mm['id'], $accessArr)): ?>checked<?php endif; ?> value="<?php echo ($mm["id"]); ?>" name="menu_id[]" type="checkbox"/><?php echo ($mm["menu_name"]); ?> >> </div>
                             <?php if(is_array($mm['_child'])): foreach($mm['_child'] as $key=>$mmm): ?><div style="width:100px;float:left;"><input class="checkpart2 checkpart_<?php echo ($m['id']); ?>" <?php if(in_array($mmm['id'], $accessArr)): ?>checked<?php endif; ?> value="<?php echo ($mmm["id"]); ?>" name="menu_id[]" type="checkbox"/><?php echo ($mmm["menu_name"]); ?></div><?php endforeach; endif; ?>
                             <br /><?php endforeach; endif; ?>
                         </td>
                    </tr><?php endforeach; endif; ?>

                </tbody>
            </table>
            <table class="table_a" border="1" width="100%">
                <tbody>
                     <tr >
                        <td  style="text-align: center;"><input class="checkall" type="checkbox" /> 全选/反选</td>
                        <td>&nbsp; <input type="submit" name="保存"/>
                         </td>
                       
                    </tr>
                </tbody>
            </table>
            </form>
        </div>

        <script>
            $(function () {
                $('.checkpart').click(function () {
                    var id = $(this).val();
                    // alert(id);
                    $('.checkpart_' + id).attr('checked', $(this).is(':checked'));
                });
            });
        </script>
        
    </body>
   
   
</html>
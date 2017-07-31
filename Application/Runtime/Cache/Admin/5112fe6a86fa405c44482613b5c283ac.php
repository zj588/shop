<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>角色列表</title>

        <link href="/Public/Admin//css/mine.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：角色管理-》角色列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo U('roleadd');?>">【添加角色】</a>
                </span>
            </span>
        </div>
        <div></div>
      
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td>
                        <td>角色名称</td>
                        <td>启用</td>
                      
                        <td style="text-align: center;" colspan="3">操作</td>
                    </tr>

                    <?php if(is_array($data)): foreach($data as $key=>$role_data): ?><tr id="product1">
                        <td><?php echo ($role_data["id"]); ?></td>
                        <td><a href="#"><?php echo ($role_data["role_name"]); ?></a></td>
                        <td><a href="#"><?php echo (getMenuStatus($role_data["status"])); ?></a></td>
                        <td><a href="<?php echo U('accesslist', 'role_id='.$role_data[id]);?>">权限管理</a></td>
                        <td><a href="<?php echo U('roleedit', 'id='.$role_data[id]);?>">修改</a></td>
                        <td><a href="javascript:void(0);" data-id="<?php echo ($role_data["id"]); ?>" data-name="<?php echo ($role_data["role_name"]); ?>" class="del">删除</a></td>
                    </tr><?php endforeach; endif; ?>
                  
                  
                    <tr>
                        <td colspan="20" style="text-align: center;">
                            [1]
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <script src="/Public/Common/jquery-1.7.2.min.js" type="text/javascript"></script>
        <script>
            $(function () {
                $('.del').click(function () {
                    var id = $(this).attr('data-id');
                    var name = $(this).attr('data-name');

                    if (confirm('确认删除【'+name+'】？')) {
                        location.href = '/index.php/Admin/System/roledel/id/' + id;
                    }
                });
            });
        </script>
    </body>
   
   
</html>
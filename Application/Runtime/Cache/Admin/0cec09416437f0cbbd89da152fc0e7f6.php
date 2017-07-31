<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>属性列表</title>

        <link href="/Public/Admin//css/mine.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：商品管理-》属性列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo U('add');?>">【添加属性】</a>
                </span>
            </span>
        </div>
        <div></div>
      
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td>
                        <td>属性名称</td>
                        <td>所属类型</td>
                        <td>属性值的类型</td>
               <td>可选值列表</td>
                      
                        <td align="center" colspan="2">操作</td>
                    </tr>

                   <?php if(is_array($datas)): foreach($datas as $key=>$d): ?><tr>
                        <td><?php echo ($d["id"]); ?></td>
                        <td><?php echo ($d["attr_name"]); ?></td>
                        <td><?php echo ($d["cate_name"]); ?></td>
                        <td><?php echo (getAttrType($d["attr_type"])); ?></td>
                        <td><?php echo ($d["attr_val"]); ?></td>
                        
                        <td><a href="<?php echo U('edit', 'id='.$d[id]);?>">修改</a></td>
                        <td><a href="javascript:void(0);" data-id="<?php echo ($d["id"]); ?>" class="del">删除</a></td>
                    </tr><?php endforeach; endif; ?>
                  
                  
                  
                    <tr>
                        <td colspan="20" style="text-align: center;">
                            [1]
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <script src="/Public/Common/jquery-1.7.2.min.js"></script>
        <script>
            $(function () {
                $('.del').click(function () {
                    var id = $(this).attr('data-id');
                    
                    if (confirm('确认删除？')) {
                        location.href = '/index.php/Admin/Attribute/del/id/' + id;
                    }
                });
            });
        </script>
    </body>
   
</html>
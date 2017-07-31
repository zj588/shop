<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>相册列表</title>

        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：相册管理-》<?php echo ($goods["goods_name"]); ?>的相册列表</span>
              
            </span>
        </div>
        <div></div>
        
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td>
                        <td>大图</td>
                        <td>缩略图</td>
                        <td align="center">操作</td>
                    </tr>
                    <?php if(is_array($goodsPhoto)): foreach($goodsPhoto as $key=>$photo): ?><tr >
                        <td><?php echo ($photo["id"]); ?></td>
                        <td><img src="/Public/Upload/<?php echo ($photo["pic_path"]); ?>" width="60"></td>
                        <td><img src="/Public/Upload/<?php echo ($photo["pic_thumb_path"]); ?>" width="40"></td>
                   
                        <td><a href="javascript:void(0);" data-id="<?php echo ($photo["id"]); ?>" class="pic_del">删除</a></td>
                    </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
         <form action="/index.php/Admin/Goods/pic/id/1.html" method="post" enctype="multipart/form-data" >
         <input type="hidden" name="goods_id" value="<?php echo ($goods["id"]); ?>" />
         <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
             
                    <tr style="font-weight: bold;">
                        <td>选择图片<a href="javascript:void(0);" id='add'>[+]</a></td>
                       
                    </tr>
                  <tbody id="img_files">
                    <tr>
                        <td><input type="file" name='image[]'/></td>
                    </tr>
                </tbody>

            </table>
             <input type="submit" value="确认保存">
         </div>
         </form>

         <script src="/Public/Common/jquery-1.7.2.min.js"></script>
         <script>
             $(function () {
                $('#add').click(function () {
                    $('<tr><td><input type="file" name="image[]"/><span class="del" style="cursor: pointer;">[-]</span></td></tr>').appendTo('#img_files');
                });

                $('.del').live('click', function () {
                    $(this).parents('tr').remove();
                });

                $('.pic_del').click(function () {
                    var id = $(this).attr('data-id');
                    var _this = $(this);
                    $.ajax({
                        url: '/index.php/Admin/Goods/picdel',
                        type: 'post',
                        data: {'pic_id': id},
                        dataType: 'json',
                        success: function (data) {
                            console.log(data);
                            if (data.status == 1) {
                                _this.parents('tr').remove();
                            }
                        },
                        error: function () {
                            alert('服务器繁忙，请稍候在试....');
                        }
                    });
                });
             });
         </script>
    </body>
</html>
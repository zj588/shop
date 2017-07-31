<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>会员列表</title>

        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：商品管理-》商品列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo U('add');?>">【添加商品】</a>
                </span>
            </span>
        </div>
        <div></div>
        
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td>
                        <td>商品名称</td>
                         <td>分类</td>
                         <td>品牌</td>
                        <td>库存</td>
                        <td>价格</td>
                        <td>描述</td>
                        <td>缩略图</td>
                       
                        <td>创建时间</td>
                        <td align="center" colspan="4">操作</td>
                    </tr>
                    <?php if(is_array($goodsList)): foreach($goodsList as $key=>$goods): ?><tr>
                        <td><?php echo ($goods["id"]); ?></td>
                        <td><a href="<?php echo U('home/goods/detail', 'id='.$goods[id]);?>" target="_blank"><?php echo ($goods["goods_name"]); ?></a></td>
                        <td><?php echo ($goods["category_id"]); ?></td>
                        <td><?php echo ($goods["brand_id"]); ?></td>
                        <td><?php echo ($goods["goods_count"]); ?></td>
                        <td><?php echo ($goods["goods_price"]); ?></td>
                        <td><?php echo ($goods["goods_description"]); ?></td>
                        <td><img src="/Public/Upload/<?php echo ($goods["goods_thumb_pic"]); ?>"></td>
                        <td><?php echo (date('Y-m-d H:i:s', $goods["goods_addtime"])); ?></td>
                        <td><a href="<?php echo U('pic', 'id='.$goods[id]);?>" target="_balnk">相册管理</a></td>
                        <td><a href="<?php echo U('edit', 'id='.$goods[id]);?>">修改</a></td>
                        <td><a href="javascript:void(0);" class="del" data-id="<?php echo ($goods["id"]); ?>">删除</a></td>
                        <td><a href="javascript:void(0);" class="xiajia" data-id="<?php echo ($goods["id"]); ?>"><?php echo (getGoodsStatus($goods["goods_status"])); ?></a></td>
                    </tr><?php endforeach; endif; ?>
                    <tr>
                        <td colspan="20" style="text-align: center;">
                            <?php echo ($page); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <script src="/Public/Common/jquery-1.7.2.min.js"></script>
        <script>
            $(function () {
                $('.xiajia').click(function () {
                    var _this = $(this);
                    var id = $(this).attr('data-id');
                    var text = $(this).text();

                    //发送ajax请求
                    $.ajax({
                        url: '/index.php/Admin/Goods/xiajia',
                        type: 'post',
                        data: {'id': id},
                        dataType: 'json',
                        success: function (data) {
                            console.log(data);
                            if (data.status == 1) {
                                _this.text(text == '上架中' ? '已下架' : '上架中');
                            }
                        },
                        error: function () {
                            alert('服务器繁忙，请稍候在试....');
                        }
                    });
                });

                $('.del').click(function () {
                    var _this = $(this);
                    var id = $(this).attr('data-id');

                    $.post('/index.php/Admin/Goods/del', {'id': id}, function (data) {
                        console.log(data);
                        if (data.status == 1) {
                            _this.parents('tr').remove();
                        }
                    }, 'json');
                });
            });
        </script>
    </body>
</html>
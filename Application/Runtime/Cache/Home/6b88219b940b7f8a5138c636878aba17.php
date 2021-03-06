<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="Generator" content="YONGDA v1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="Keywords" content="YONGDA商城" />
        <meta name="Description" content="YONGDA商城" />
        
        <title>YONGDA商城 - Powered by YongDa</title>
        
        <link href="/Public/Home/css/style.css" rel="stylesheet" type="text/css" />
        
    </head>

    <body>
    	<div class="block clearfix" style="position: relative; height: 98px;">
            <a href="<?php echo U('index/index');?>" name="top"><img class="logo" src="/Public/Home/images/logo.gif"></a>

            <div id="topNav" class="clearfix">
                <div style="float: left;"> 
                    <font id="ECS_MEMBERZONE">
                        <div id="append_parent"></div>
                        欢迎光临本店&nbsp;
                        <?php if(session('?uid')): ?><span> <?php echo (session('user_name')); ?></span>
                        <a href="<?php echo U('login/logout');?>">退出</a>
                        <?php else: ?>
                        <a href="<?php echo U('login/login');?>"> 登录</a>
                        <a href="<?php echo U('user/reg');?>">注册</a><?php endif; ?>
                    </font>
                </div>
                <div style="float: right;">
                    <a target="_blank" href="<?php echo U('cart/showlist');?>">查看购物车</a>
                    |
                    <a href="#">选购中心</a>
                    |
                    <a href="#">标签云</a>
                    |
                    <a href="#">报价单</a>
                </div>
            </div>
            <div id="mainNav" class="clearfix">
                <a href="#" class="cur">首页<span></span></a>
                <a href="#">GSM手机<span></span></a>
                <a href="#">双模手机<span></span></a>
                <a href="#">手机配件<span></span></a>
                <a href="#">优惠活动<span></span></a>
                <a href="#">留言板<span></span></a>
            </div>
        </div>

        <div class="header_bg">
            <div style="float: left; font-size: 14px; color:white; padding-left: 15px;">
            </div>  

            <form id="searchForm" method="get" action="#">
                <input name="keywords" id="keyword" type="text" />
                <input name="imageField" value=" " class="go" style="cursor: pointer; background: url('/Public/Home/images/sousuo.gif') no-repeat scroll 0% 0% transparent; width: 39px; height: 20px; border: medium none; float: left; margin-right: 15px; vertical-align: middle;" type="submit" />

            </form>
        </div>
        <div class="blank5"></div>
        <div class="header_bg_b">
            <div class="f_l" style="padding-left: 10px;">
                <img src="/Public/Home/images/biao6.gif" />
                    北京市区，现在下单(截至次日00:30已出库)，<b>明天上午(9-14点)</b>送达 <b>免运费火热进行中！</b>
            </div>
            <div class="f_r" style="padding-right: 10px;">
                <img style="vertical-align: middle;" src="/Public/Home/images/biao3.gif">
                    <span class="cart" id="ECS_CARTINFO">
                        <a href="#" title="查看购物车">您的购物车中有 0 件商品，总计金额 ￥0.00元。</a></span>
                    <a href="#"><img style="vertical-align: middle;" src="/Public/Home/images/biao7.gif"></a>

            </div>
        </div>
        
    	        <style type="text/css">
            table {border:1px solid #dddddd; border-collapse: collapse; width:99%; margin:auto;}
            td {border:1px solid #dddddd;}
            #consignee_addr {width:450px;}
        </style>

        <div class="block box">
            <div class="blank"></div>
            <div id="ur_here">
                当前位置: <a href="#">首页</a> <code>&gt;</code> 购物流程 
            </div>
        </div>
        <div class="blank"></div>

        <div class="blank"></div>
        <div class="block">
            <div class="flowBox">
                <h6><span>商品列表</span></h6>
                <form id="cart_form" method="post">
                    <input type="text" name="cart_goods" value='<?php echo ($cart_goods); ?>'>
                    <table cellpadding="5" cellspacing="1">
                        <tbody><tr>
                                <th>商品名称</th>
                                <th>属性</th>
                                <th>市场价</th>
                                <th>本店价</th>
                                <th>库存</th>
                                <th>购买数量</th>
                                <th>小计</th>
                                <th>操作</th>
                            </tr>
                            <?php if(is_array($cartDatas)): foreach($cartDatas as $key=>$c): ?><tr>
                                <td align="center">
                                    <a href="#" target="_blank"><img style="width: 80px; height: 80px;" src="/Public/Upload/<?php echo ($c["goods_pic"]); ?>" title="<?php echo ($c["goods_name"]); ?>" /></a><br />
                                    <a href="#" target="_blank" class="f6"><?php echo ($c["goods_name"]); ?></a>
                                    <input type="hidden" name="goods_id[]" value="<?php echo ($c["goods_id"]); ?>">
                                </td>
                                <td>
                                    <?php if(is_array($c['goods_attr'])): foreach($c['goods_attr'] as $key=>$cc): echo ($key); ?>:<?php echo ($cc); ?> <br /><?php endforeach; endif; ?>
                                </td>
                                <td align="right">￥<?php echo ($c["goods_mprice"]); ?>元</td>
                                <td align="right">￥<span class="price"><?php echo ($c["goods_price"]); ?></span>元</td>
                                <td align="right"><span class="goods_count"><?php echo ($c["goods_count"]); ?></span></td>
                                <td align="right">
                                    <a href="javascript:void(0);" data-id="<?php echo ($c["goods_id"]); ?>" class="cart_minus">[-]</a>
                                    <input name="goods_number[43]" id="goods_number_43" value="<?php echo ($c["cart_count"]); ?>" size="4" class="inputBg" style="text-align: center;" type="text" />
                                    <a href="javascript:void(0);" data-id="<?php echo ($c["goods_id"]); ?>" class="cart_plus">[+]</a>
                                </td>
                                <td align="right">￥<span class="subtotal"><?php echo ($c['goods_price'] * $c['cart_count']); ?></span>元</td>
                                <td align="center">
                                    <a href="javascript:void(0);" data-id="<?php echo ($c["goods_id"]); ?>" class="cart_del">删除</a>
                                </td>
                            </tr><?php endforeach; endif; ?>
                        </tbody></table>

                    <script type="text/javascript" src="/Public/Common/jquery-1.8.2.min.js"></script>
                    <script>
                        $(function () {
                            //删除购物车商品
                            $('.cart_del').click(function () {
                                var goods_id = $(this).attr('data-id');
                                var _this = $(this);
                                // alert(goods_id);
                                $.post('<?php echo U("del");?>', {'goods_id': goods_id}, function (data) {
                                    if (data.status == 1) {
                                        _this.parents('tr').remove();
                                        alert(data.msg);
                                    } else {
                                        alert(data.msg);
                                    }
                                }, 'json');

                                // $(this).parents('tr').remove();
                            });

                            //减少商品数量
                            $('.cart_minus').click(function () {
                                var inputbox = $(this).next();
                                var count = inputbox.val();
                                // alert(count);
                                if (count > 1) {
                                    count--;
                                }
                                inputbox.val(count);

                                //单价
                                var price = parseFloat($(this).parents('tr').find('.price').text());
                                //小计
                                var subtotal = price * count;
                                $(this).parents('tr').find('.subtotal').text(subtotal);

                                //总价
                                getTotalPrice();

                                //发送ajax请求，修改数据库
                                var goods_id = $(this).attr('data-id');
                                var data = {
                                    'goods_id': goods_id,
                                    'cart_count': count
                                }
                                $.post('/index.php/Home/Cart/edit', data, function (data) {}, 'json');
                            });

                            //增加商品数量
                            $('.cart_plus').click(function () {
                                var inputbox = $(this).prev();
                                //购物车数量
                                var count = parseInt(inputbox.val());
                                //商品库存
                                var goods_count = parseInt($(this).parents('tr').find('.goods_count').text());
                                // console.log(goods_count);
                                if (count < goods_count) {
                                    count++;
                                }
                                inputbox.val(count);

                                //单价
                                var price = parseFloat($(this).parents('tr').find('.price').text());
                                // alert(price);
                                //小计
                                var subtotal = price * count;
                                $(this).parents('tr').find('.subtotal').text(subtotal);

                                //总价
                                getTotalPrice();

                                //发送ajax请求，修改数据库
                                var goods_id = $(this).attr('data-id');
                                var data = {
                                    'goods_id': goods_id,
                                    'cart_count': count
                                }
                                $.post('/index.php/Home/Cart/edit', data, function (data) {}, 'json');
                            });
                        });
                    </script>
                    <table cellpadding="5" cellspacing="1">
                        <tbody><tr>
                                <td>
                                    购物金额总计 ￥ <span id="totalPrice" style="color: orange; font-weight: bold; font-size: 20px;"><?php echo ($totalP); ?></span> 元              </td>
                                <script>
                                    function getTotalPrice() {
                                        var totalP = 0;
                                        $('.subtotal').each(function () {
                                            totalP += parseFloat($(this).text());
                                        });
                                        totalP = totalP.toFixed(2);
                                        $('#totalPrice').text(totalP);
                                    }
                                </script>
                                <td align="right">
                                    <input value="清空购物车" id="delAll" class="bnt_blue_1"  type="button" />
                                    <script>
                                        $(function () {
                                            $('#delAll').click(function () {
                                                $.post('<?php echo U("cart/delAll");?>', '', function (data) {
                                                    // console.log(data);
                                                    if (data.status == 1) {
                                                        $('.cart_del').parents('tr').remove();
                                                        $('#totalPrice').text(0);
                                                    }
                                                }, 'json')
                                            });
                                        });
                                    </script>
                                    <!-- <input name="submit" class="bnt_blue_1" value="更新购物车" type="button" /> -->
                                </td>
                            </tr>
                        </tbody></table>
                    <input name="step" value="update_cart" type="hidden" />
                </form>
                <table cellpadding="5" cellspacing="0" width="99%">
                    <tbody><tr>
                            <td><a href="<?php echo U('index/index');?>"><img src="/Public/Home/images/continue.gif" alt="continue" /></a></td>
                            <td align="right"><a id="checkout" href="javascript:void(0);"><img src="/Public/Home/images/checkout.gif" alt="checkout" /></a></td>
                        </tr>
                        <script src="/Public/Home/layer/layer.js"></script>
                        <script>
                            $(function () {
                                //购买操作
                                $('#checkout').click(function () {

                                    <?php if(session('?uid')): ?>$('#cart_form').attr('action', '<?php echo U("order/show");?>');
                                        $('#cart_form').submit();
                                    <?php else: ?>
                                        layer.open({
                                            type: 1,
                                            skin: 'layui-layer-rim', //加上边框
                                            title: '登录窗口',
                                            fix: false,
                                            maxmin: false,
                                            shadeClose: true,
                                            area: ['400px', '250px'],
                                            content: '<form action="" method="post" id="login_form"><table align="left" border="0" cellpadding="3" cellspacing="5" width="100%"><tbody><tr><td align="right" width="15%">用户名</td><td width="85%"><input name="user_name" size="25" class="inputBg" type="text"></td></tr><tr><td align="right">密码</td><td><input name="user_pwd" size="15" class="inputBg" type="password"></td></tr><tr><td colspan="2"></td></tr><tr><td>&nbsp;</td><td align="left"><input  value="" onclick="login_submit()" class="us_Submit" type="button" /></td></tr><tr><td></td><td><a href="#" class="f3">注册邮件找回密码</a></td></tr></tbody></table></form>',
                                            end: function(){
                                              layer.tips('Hi', '#about', {tips: 1})
                                            }
                                        });<?php endif; ?>
                                });
                            });

                            function login_submit() {
                                var user_name = $('input[name=user_name]').val();
                                var user_pwd = $('input[name=user_pwd]').val();

                                $.post('<?php echo U("login/login");?>', {'user_name': user_name, 'user_pwd': user_pwd}, function (data) {
                                    if (data.status == 1) {
                                        $('#cart_form').attr('action', '<?php echo U("order/show");?>');
                                        $('#cart_form').submit();
                                    } else {
                                        layer.msg(data.info);
                                    }
                                }, 'json');
                            }
                        </script>
                    </tbody></table>
            </div>
            <div class="blank"></div>
            <div class="blank5"></div>
        </div>

        

    	<div class="blank"></div>
        <div class="block">
            <a href="#" target="_blank" title="YONGDA商城"><img alt="YONGDA商城" src="/Public/Home/images/di.jpg"></a>
            <div class="blank"></div>
        </div>
        <div class="block">
            <div class="box">
                <div class="helpTitBg" style="clear: both;">
                    <dl>
                        <dt><a href="#" title="新手上路 ">新手上路 </a></dt>
                        <dd><a href="#" title="售后流程">售后流程</a></dd>
                        <dd><a href="#" title="购物流程">购物流程</a></dd>
                        <dd><a href="#" title="订购方式">订购方式</a></dd>
                    </dl>
                    <dl>
                        <dt><a href="#" title="手机常识 ">手机常识 </a></dt>
                        <dd><a href="#" title="如何分辨原装电池">如何分辨原装电池</a></dd>
                        <dd><a href="#" title="如何分辨水货手机 ">如何分辨水货手机</a></dd>
                        <dd><a href="#" title="如何享受全国联保">如何享受全国联保</a></dd>
                    </dl>
                    <dl>
                        <dt><a href="#" title="配送与支付 ">配送与支付 </a></dt>
                        <dd><a href="#" title="货到付款区域">货到付款区域</a></dd>
                        <dd><a href="#" title="配送支付智能查询 ">配送支付智能查询</a></dd>
                        <dd><a href="#" title="支付方式说明">支付方式说明</a></dd>
                    </dl>
                    <dl>
                        <dt><a href="#" title="会员中心">会员中心</a></dt>
                        <dd><a href="#" title="资金管理">资金管理</a></dd>
                        <dd><a href="#" title="我的收藏">我的收藏</a></dd>
                        <dd><a href="#" title="我的订单">我的订单</a></dd>
                    </dl>
                    <dl>
                        <dt><a href="#" title="服务保证 ">服务保证 </a></dt>
                        <dd><a href="#" title="退换货原则">退换货原则</a></dd>
                        <dd><a href="#" title="售后服务保证 ">售后服务保证</a></dd>
                        <dd><a href="#" title="产品质量保证 ">产品质量保证</a></dd>
                    </dl>
                    <dl>
                        <dt><a href="#" title="联系我们 ">联系我们 </a></dt>
                        <dd><a href="#" title="网站故障报告">网站故障报告</a></dd>
                        <dd><a href="#" title="选机咨询 ">选机咨询</a></dd>
                        <dd><a href="#" title="投诉与建议 ">投诉与建议</a></dd>
                    </dl>
                </div>
            </div>


        </div>
        <div class="blank"></div>
        <div id="bottomNav" class="box block">
            <div class="box_1">
                <div class="links clearfix"> 
                    <a href="#" target="_blank" title="YONGDA商城"><img src="/Public/Home/images/ecmoban.gif" alt="YONGDA商城" border="0"></a>

                    <a href="#" target="_blank" title="YONGDA 网上商店管理系统">
                        <img src="/Public/Home/images/yongda_logo.gif" alt="YONGDA 网上商店管理系统" border="0" />
                    </a>


                    [<a href="#" target="_blank" title="免费申请网店">免费申请网店</a>]
                    [<a href="#" target="_blank" title="免费开独立网店">免费开独立网店</a>]


                    [<a href="#" target="_blank" title="免费开独立网店">yongda商城</a>]
                </div>
            </div>
        </div>
        <div class="blank"></div>
        <div id="bottomNav" class="box block">
            <div class="bNavList clearfix">
                <a href="#">免责条款</a>
                |
                <a href="#">隐私保护</a>
                |
                <a href="#">咨询热点</a>
                |
                <a href="#">联系我们</a>
                |
                <a href="#">Powered&nbsp;by&nbsp;<strong><span style="color: rgb(51, 102, 255);">YongDa</span></strong></a>
                |
                <a href="#">批发方案</a>
                |
                <a href="#">配送方式</a>

            </div>
        </div>

        <div id="footer">
            <div class="text">
                © 2005-2012 YONGDA 版权所有，并保留所有权利。<br />
            </div>
        </div>
    </body>

</html>
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
            <form action="/index.php/Home/Order/add" method="post" name="theForm" id="theForm" >
                <input type="text" name="form_goods_data" value='<?php echo ($form_goods_data); ?>'>
                <div class="flowBox">
                    <h6><span>商品列表</span><a href="#" class="f6">修改</a></h6>
                    <table cellpadding="5" cellspacing="1" width="99%">
                        <tbody>
                            <tr>
                                <th>商品名称</th>
                                <th>属性</th>
                                <th>市场价</th>
                                <th>本店价</th>
                                <th>购买数量</th>
                                <th>小计</th>
                            </tr>
                            
                            <?php if(is_array($order_goods_datas)): foreach($order_goods_datas as $key=>$o): ?><tr>
                                <td>
                                    <a href="#" target="_blank" class="f6"><?php echo ($o["goods_name"]); ?></a>
                                </td>

                                <td>
                                    <?php if(is_array($o["goods_attr"])): foreach($o["goods_attr"] as $key=>$oo): echo ($key); ?>:<?php echo ($oo); ?> <br /><?php endforeach; endif; ?>
                                </td>
                                <td align="right">￥<?php echo ($o["goods_mprice"]); ?>元</td>
                                <td align="right">￥<?php echo ($o["goods_price"]); ?>元</td>
                                <td align="right"><?php echo ($o["cart_count"]); ?></td>
                                <td align="right">￥<span class="subtotal"><?php echo ($o["subtotal"]); ?></span>元</td>
                            </tr><?php endforeach; endif; ?>

                            <tr>
                                <td colspan="7">
                                    购物金额小计 ￥ <span id="totalP" style="color: orange; font-size: 20px;"><?php echo ($totalP); ?></span> 元              </td>
                            </tr>
                        </tbody></table>

                </div>
                <div class="blank"></div>
                <div class="flowBox">
                    <h6><span>收货人信息</span></h6>
                    <table cellpadding="5" cellspacing="1" width="99%">
                        <tbody>
						    <?php if(is_array($addr_data)): foreach($addr_data as $key=>$a): ?><tr>
                                <td><input type="radio" name="addr_id" value="<?php echo ($a["id"]); ?>"></td>
                                <td><?php echo ($a["addr_name"]); ?> <?php echo ($a["addr_address"]); ?> <?php echo ($a["addr_phone"]); ?></td>
                            </tr><?php endforeach; endif; ?>
                            
                           
                        </tbody></table>
                </div>
              <div class="blank"></div>
                <div class="flowBox">
                    <h6><span>配送方式</span></h6>
                    <table id="shippingTable" cellpadding="5" cellspacing="1" width="99%">
                        <tbody><tr>
                                <th width="5%">&nbsp;</th>
                                <th width="25%">名称</th>
                                <th>订购描述</th>
                                <th width="15%">费用</th>
                                <th width="15%">免费额度</th>
                                <th width="15%">保价费用</th>
                            </tr>
                            <tr>
                                <td valign="top"><input name="order_send" value="1"  type="radio" />
                                </td>
                                <td valign="top"><strong>申通快递</strong></td>
                                <td valign="top">江、浙、沪地区首重为15元/KG，其他地区18元/KG， 续重均为5-6元/KG， 云南地区为8元</td>
                                <td align="right" valign="top">￥0.00元</td>
                                <td align="right" valign="top">￥0.00元</td>
                                <td align="right" valign="top">不支持保价</td>
                            </tr>
                            <tr>
                                <td valign="top"><input name="order_send" value="2"  type="radio" />
                                </td>
                                <td valign="top"><strong>圆通快递</strong></td>
                                <td valign="top">配送的运费是固定的</td>
                                <td align="right" valign="top">￥0.00元</td>
                                <td align="right" valign="top">￥0.00元</td>
                                <td align="right" valign="top">不支持保价</td>
                            </tr>
                            
                        </tbody></table>
                </div> 
                <div class="blank"></div>
                <div class="flowBox">
                    <h6><span>支付方式</span></h6>
                    <table id="paymentTable" cellpadding="5" cellspacing="1" width="99%">
                        <tbody><tr>
                                <th width="5%">&nbsp;</th>
                                <th width="20%">名称</th>
                                <th>订购描述</th>
                                <th width="15%">手续费</th>
                            </tr>

                            <tr>
                                <td valign="top"><input name="order_pay_type" value="1" iscod="0" type="radio" /></td>
                                <td valign="top"><strong>余额支付</strong></td>
                                <td valign="top">使用帐户余额支付。只有会员才能使用，通过设置信用额度，可以透支。</td>
                                <td align="right" valign="top">￥0.00元</td>
                            </tr>
							 <tr>
                                <td valign="top"><input name="order_pay_type" value="2" iscod="0" type="radio" /></td>
                                <td valign="top"><strong>支付宝支付</strong></td>
                                <td valign="top">在线支付</td>
                                <td align="right" valign="top">￥0.00元</td>
                            </tr>

                         
                           
                        </tbody></table>
                </div>
                <div class="blank"></div>
               
                <div class="blank"></div>
                <div class="flowBox">
                    <h6><span>费用总计</span></h6>
                    <div id="ECS_ORDERTOTAL">
                        <table cellpadding="5" cellspacing="1" width="99%">
                            <tbody>
                                <tr>
                                    <td align="right">
                                        商品总价: <font class="f4_b">￥5010.00元</font>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"> 应付款金额: <font class="f4_b">￥5010.00元</font>
                                    </td>
                                </tr>
                            </tbody></table>
                    </div>           <div style="margin: 8px auto;">
                        <input src="/Public/Home/images/bnt_subOrder.gif" type="image" />
                        <input name="step" value="done" type="hidden" />
                    </div>
                </div>
            </form>
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
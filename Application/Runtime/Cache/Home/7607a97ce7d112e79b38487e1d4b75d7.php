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
                        <?php if(session('?uid')): ?><a href="<?php echo U('ucenter/center');?>"> <span style="color: orange;"><?php echo (session('user_name')); ?></span></a>
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
                    <?php echo (session('ip')); ?>，现在下单(截至次日00:30已出库)，<b>明天上午(9-14点)</b>送达 <b>免运费火热进行中！</b>
            </div>
            <div class="f_r" style="padding-right: 10px;">
                <img style="vertical-align: middle;" src="/Public/Home/images/biao3.gif">
                    <span class="cart" id="ECS_CARTINFO">
                        <a href="#" title="查看购物车">您的购物车中有 0 件商品，总计金额 ￥0.00元。</a></span>
                    <a href="#"><img style="vertical-align: middle;" src="/Public/Home/images/biao7.gif"></a>

            </div>
        </div>
        
    	

        <div class="block box">
            <div class="blank"></div>
            <div id="ur_here">
                当前位置: <a href="#">首页</a> <code>&gt;</code> 用户中心 
            </div>
        </div>
        
        <div class="blank"></div>
        <div class="blank"></div>
        
        <div class="block clearfix">
            <div class="AreaL">
                <div class="box">
                    <div class="box_1">
                        <div class="userCenterBox">
                            <div class="userMenu">
                                <a href="<?php echo U('ucenter/center');?>"><img src="/Public/Home/images/u1.gif" alt="" /> 欢迎页</a>
                                <a href="#"><img src="/Public/Home/images/u2.gif" alt="" /> 用户信息</a>
                                <a href="<?php echo U('ucenter/order');?>" class="curs"><img src="/Public/Home/images/u3.gif" alt="" /> 我的订单</a>
                                <a href="<?php echo U('ucenter/address');?>"><img src="/Public/Home/images/u4.gif" alt="" /> 收货地址</a>
                                <a href="#"><img src="/Public/Home/images/u5.gif" alt="" /> 我的收藏</a>
                                <a href="#"><img src="/Public/Home/images/u6.gif" alt="" /> 我的留言</a>
                                <a href="#"><img src="/Public/Home/images/u7.gif" alt="" /> 我的标签</a>
                                <a href="#"><img src="/Public/Home/images/u8.gif" alt="" /> 缺货登记</a>
                                <a href="#"><img src="/Public/Home/images/u9.gif" alt="" /> 我的红包</a>
                                <a href="#"><img src="/Public/Home/images/u10.gif" alt="" /> 我的推荐</a>
                                <a href="#"><img src="/Public/Home/images/u11.gif" alt="" /> 我的评论</a>
                                <!--<a href="user.php?act=group_buy">我的团购</a>-->
                                <a href="#"><img src="/Public/Home/images/u12.gif" alt="" /> 跟踪包裹</a>
                                <a href="#"><img src="/Public/Home/images/u13.gif" alt="" /> 资金管理</a>
                                <a href="#" style="background: none repeat scroll 0% 0% transparent; text-align: right; margin-right: 10px;"><img src="/Public/Home/images/bnt_sign.gif" alt="" /></a>
                            </div>      </div>
                    </div>
                </div>
            </div>

            <div class="AreaR">
                <div class="box">
                    <div class="box_1">
                        <div class="userCenterBox boxCenterList clearfix" style="">
                            <h5><span>我的订单</span></h5>
                            <div class="blank"></div>
                            <table cellpadding="5" cellspacing="1">
                                <tbody><tr align="center">
                                        <td>订单号</td>
                                        <td>下单时间</td>
                                        <td>订单总金额</td>
                                        <td>订单状态</td>
                                        <td>操作</td>
                                    </tr>
                                    <?php if(is_array($orderDatas)): foreach($orderDatas as $key=>$o): ?><tr>
                                        <td align="center"><a href="./user.php?act=order_detail&amp;order_id=20" class="f6"><?php echo ($o["order_number"]); ?></a></td>
                                        <td align="center"><?php echo (date("Y-m-d H:i:s", $o["order_addtime"])); ?></td>
                                        <td align="right">￥<?php echo ($o["order_price"]); ?>元</td>
                                        <td align="center"><?php echo (getOrderStatus($o["order_status"])); ?></td>
                                        <td align="center"><font class="f6"><a href="#" >取消订单</a></font></td>
                                    </tr><?php endforeach; endif; ?>
                                </tbody></table>
                            <div class="blank5"></div>

                            <form action="/user.php" method="get">

                                <div id="pager" class="pagebar">
                                    <span class="f_l " style="margin-right: 10px;">总计 <b><?php echo ($orderTotal); ?></b>  个记录</span>

                                </div>

                            </form>
                            <div class="blank5"></div>
                            <!-- <h5><span>合并订单</span></h5>
                            <div class="blank"></div>
                            <form action="#" method="post">
                                <table cellpadding="5" cellspacing="1">
                                    <tbody>
                                        <tr>
                                            <td align="right" width="22%">主订单:</td>
                                            <td align="left" width="12%"><select name="to_order">
                                                    <option selected="selected" value="0">请选择...</option>

                                                    <option value="2012100649488">2012100649488</option>
                                                </select></td>
                                            <td align="right" width="19%">从订单:</td>
                                            <td align="left" width="11%"><select name="from_order">
                                                    <option selected="selected" value="0">请选择...</option>

                                                    <option value="2012100649488">2012100649488</option>
                                                </select></td>
                                            <td width="36%">&nbsp;<input name="act" value="merge_order" type="hidden" />
                                                <input name="Submit" class="bnt_blue_1" style="border: medium none;" value="合并订单" type="submit" /></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td colspan="4" align="left">订单合并是在发货前将相同状态的订单合并成一新的订单。<br />收货地址，送货方式等以主定单为准。</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="blank"></div>
        <div class="blank"></div>
        

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
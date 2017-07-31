<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>修改商品</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet">
    </head>

    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：商品管理-》修改商品信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="javascript:void(0);" onclick="history.go(-1);">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
            <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="id" value="<?php echo ($goodsInfo["id"]); ?>" />
            <table border="1" width="100%" class="table_a">
                <tr>
                    <td>商品名称</td>
                    <td><input type="text" name="goods_name" value="<?php echo ($goodsInfo["goods_name"]); ?>" /></td>
                </tr>
                <tr>
                    <td>商品分类</td>
                    <td>
                        <select name="category_id">
                            <option value="0">请选择</option>
                            <?php if(is_array($categoryTree)): foreach($categoryTree as $key=>$category): ?><option value="<?php echo ($category["id"]); ?>" <?php echo ($category['id'] == $goodsInfo['category_id'] ? 'selected' : ''); ?>><?php echo (str_repeat('&nbsp;&nbsp;', $category["level"])); echo ($category["category_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>商品品牌</td>
                    <td>
                        <select name="brand_id">
                            <option value="0" disabled>请选择</option>
                            <?php if(is_array($brandList)): foreach($brandList as $key=>$brand): ?><option value="<?php echo ($brand["id"]); ?>" <?php echo ($brand['id'] == $goodsInfo['brand_id'] ? 'selected' : ''); ?>><?php echo ($brand["brand_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>商品价格</td>
                    <td><input type="text" name="goods_price" value="<?php echo ($goodsInfo["goods_price"]); ?>" /></td>
                </tr>
                <tr>
                    <td>商品图片</td>
                    <td><input type="file" name="f_goods_image"/></td>
                </tr>
                 <tr>
                    <td>商品数量</td>
                    <td><input type="text" name="goods_count" value="<?php echo ($goodsInfo["goods_count"]); ?>" /></td>
                </tr>
                <tr>
                    <td>商品排序</td>
                    <td><input type="text" name="goods_sort" value="<?php echo ($goodsInfo["goods_sort"]); ?>" /></td>
                </tr>
                <tr>
                    <td>商品详细描述</td>
                    <td>
                        <textarea name="goods_description" id="content_box"><?php echo ($goodsInfo["goods_description"]); ?></textarea>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="修改">
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
                initialFrameHeight: '300',
            });
        </script>
    </body>
</html>
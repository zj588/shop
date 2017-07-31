<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>添加商品</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet">
        <script src="/Public/Common/jquery-1.7.2.min.js"></script>
        <script>
            $(function () {
                $('select[name=cate_id]').change(function () {
                    //将上一次选中生成的属性行删除
                    $('.attrTr').remove();

                    var cate_id = $(this).val();
                    var _this = $(this);
                    // alert(cate_id);
                    //发送ajax请求
                    $.post("<?php echo U('Attribute/getAttr');?>", {'cate_id':cate_id}, function (data) {
                        // console.log(data);
                        $.each(data, function (key, item) {
                            var str = '';
                            if (item.attr_type == 1) {
                                // alert(1);
                                var attrArr = item.attr_val.split(',');
                                //将下拉框的属性值遍历
                                var input = '';
                                for (var i = 0; i < attrArr.length; i++) {
                                    input += '<input type="checkbox" name="goods_attr['+item.id+'][]" value="'+attrArr[i]+'">' + attrArr[i];
                                }
                                str = '<tr class="attrTr"><td>'+item.attr_name+'</td><td>'+input+'</td></tr>';
                            } else {
                                str = '<tr class="attrTr"><td>'+item.attr_name+'</td><td><input type="text" name="goods_attr['+item.id+'][]"></td></tr>';
                            }

                            //将属性追加到商品分类后面
                            _this.parents('tr').after(str);
                        });
                    }, 'json');
                });
            });
        </script>
    </head>

    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：商品管理-》添加商品信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="javascript:void(0);" onclick="history.go(-1);">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
            <form action="" method="post" enctype="multipart/form-data">
            <table border="1" width="100%" class="table_a">
                <tr>
                    <td>商品名称</td>
                    <td><input type="text" name="goods_name" /></td>
                </tr>
                <tr>
                    <td>商品分类</td>
                    <td>
                        <select name="category_id">
                            <option value="0">请选择</option>
                            <?php if(is_array($categoryTree)): foreach($categoryTree as $key=>$category): ?><option value="<?php echo ($category["id"]); ?>"><?php echo (str_repeat('&nbsp;&nbsp;', $category["level"])); echo ($category["category_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>商品品牌</td>
                    <td>
                        <select name="brand_id">
                            <option value="0" disabled selected>请选择</option>
                            <?php if(is_array($brandList)): foreach($brandList as $key=>$brand): ?><option value="<?php echo ($brand["id"]); ?>"><?php echo ($brand["brand_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>商品类型</td>
                    <td>
                        <select name="cate_id">
                            <option value="0">请选择</option>
                            <?php if(is_array($cate)): foreach($cate as $key=>$c): ?><option value="<?php echo ($c["id"]); ?>"><?php echo ($c["cate_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>商品价格</td>
                    <td><input type="text" name="goods_price" /></td>
                </tr>
                <tr>
                    <td>商品图片</td>
                    <td><input type="file" name="f_goods_image" /></td>
                </tr>
                 <tr>
                    <td>商品数量</td>
                    <td><input type="text" name="goods_count" /></td>
                </tr>
                <tr>
                    <td>商品排序</td>
                    <td><input type="text" name="goods_sort" /></td>
                </tr>
                <tr>
                    <td>商品详细描述</td>
                    <td>
                        <textarea name="goods_description" id="content_box"></textarea>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="添加">
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
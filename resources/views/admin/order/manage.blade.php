@extends("admin.base")
@section("main")

<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">产品管理</a> &raquo; 管理
</div>
<!--面包屑导航 结束-->

<!--结果页快捷搜索框 开始-->
<div class="search_wrap">
    <form action="" method="post">
        <table class="search_tab">
            <tr>
                <th width="120">选择类型:</th>
                <td>
                    <select onchange="javascript:location.href=this.value;">
                        <option value="">全部</option>
                        <option value="http://www.baidu.com">百度</option>
                        <option value="http://www.sina.com">新浪</option>
                    </select>
                </td>
                <th width="70">关键字:</th>
                <td><input type="text" name="keywords" placeholder="关键字"></td>
                <td><input type="submit" class="btn btn-primary" name="sub" value="查询"></td>
            </tr>
        </table>
    </form>
</div>
<!--结果页快捷搜索框 结束-->

<!--搜索结果页面 列表 开始-->
<form action="#" method="post">
    <div class="result_wrap">
        <div class="result_title">
            <h3>快捷操作</h3>
        </div>
        <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="#"><i class="fa fa-plus"></i>新增产品</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc" width="5%"><input type="checkbox" name=""></th>
                    <th class="tc">排序</th>
                    <th class="tc">订单ID</th>
                    <th>订购人</th>
                    <th>总价格</th>
                    <th>状态</th>
                    <th>更新时间</th>
                    <th>备注</th>
                    <th>操作</th>
                </tr>
                <tr>
                    <td class="tc"><input type="checkbox" name="id[]" value="59"></td>
                    <td class="tc">
                        <input type="text" name="ord[]" value="0">
                    </td>
                    <td class="tc">12345759</td>
                    <td>
                        <a href="#">张三</a>
                    </td>
                    <td>1000元</td>
                    <td>待付款</td>
                    <td>2017-11-22 21:11:01</td>
                    <td>多买多优惠</td>
                    <td>
                        <a href="/admin/order/1/edit">修改</a>
                        <a href="#"  onclick="return confirm('删除后无法恢复，你确定要删除吗？');">删除</a>
                    </td>
                </tr>

                <tr>
                    <td class="tc"><input type="checkbox" name="id[]" value="59"></td>
                    <td class="tc">
                        <input type="text" name="ord[]" value="0">
                    </td>
                    <td class="tc">5915471</td>
                    <td>
                        <a href="#">李四</a>
                    </td>
                    <td>2000元</td>
                    <td>待付款</td>
                    <td>2017-11-22 21:11:01</td>
                    <td>多买多优惠</td>
                    <td>
                        <a href="/admin/order/1/edit">修改</a>
                        <a href="#">删除</a>
                    </td>
                </tr>

                <tr>
                    <td class="tc"><input type="checkbox" name="id[]" value="59"></td>
                    <td class="tc">
                        <input type="text" name="ord[]" value="0">
                    </td>
                    <td class="tc">54585519</td>
                    <td>
                        <a href="#">王五</a>
                    </td>
                    <td>3000元</td>
                    <td>待付款</td>
                    <td>2017-11-22 21:11:01</td>
                    <td>多买多优惠</td>
                    <td>
                        <a href="/admin/order/1/edit">修改</a>
                        <a href="#">删除</a>
                    </td>
                </tr>
            </table>


            <div class="page_nav">
                <div>
                    <a class="first" href="/wysls/index.php/Admin/Tag/index/p/1.html">第一页</a>
                    <a class="prev" href="/wysls/index.php/Admin/Tag/index/p/7.html">上一页</a>
                    <a class="num" href="/wysls/index.php/Admin/Tag/index/p/6.html">6</a>
                    <a class="num" href="/wysls/index.php/Admin/Tag/index/p/7.html">7</a>
                    <span class="current">8</span>
                    <a class="num" href="/wysls/index.php/Admin/Tag/index/p/9.html">9</a>
                    <a class="num" href="/wysls/index.php/Admin/Tag/index/p/10.html">10</a>
                    <a class="next" href="/wysls/index.php/Admin/Tag/index/p/9.html">下一页</a>
                    <a class="end" href="/wysls/index.php/Admin/Tag/index/p/11.html">最后一页</a>
                    <span class="rows">11 条记录</span>
                </div>
            </div>



            <div class="page_list">
                <ul>
                    <li class="disabled"><a href="#">&laquo;</a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">&raquo;</a></li>
                </ul>
            </div>
        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->
@endsection
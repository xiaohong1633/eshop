<!--具体某个商品的详细信息，接收参数id-->
<style>
    .am-form-group{
        height:35px;
    }
</style>
<ol class="am-breadcrumb am-breadcrumb-slash">
    <li><a href="#"><h1>商品</h1></a></li>
    <li><a href="#">详细</a></li>
</ol>
<form class="am-form am-form-horizontal">
    <div class="am-form-group" style="height:80px;">
        <label class="am-form-label am-u-sm-2">名字:</label>
        <div class="am-u-sm-4 am-u-end">
            <input type="text" disabled placeholder="名字" />
        </div>
        <label class="am-form-label am-u-sm-2">图片:</label>
        <div class="am-u-sm-4">
            <img class="am-radius am-img-thumbnail" src="../res/images/pro.PNG" />
        </div>
    </div>
    <div class="am-form-group">
        <label class="am-form-label am-u-sm-2">类别:</label>
        <div class="am-u-sm-4">
            <div class="am-g am-g-collapse">
                <div class="am-u-sm-6 am-text-left">
                    <select name="product_detail_category" disabled>
                        <option>类别1</option>
                        <option>类别2</option>
                        <option>类别3</option>
                    </select>
                </div>
                <div class="am-u-sm-6">
                    <select name="product_detail_childCatgory" disabled>
                        <option>子类别1</option>
                        <option>子类别2</option>
                    </select>
                </div>
            </div>
        </div>
        <label class="am-form-label am-u-sm-2">标签:</label>
        <div class="am-u-sm-4">
            <input type="text" disabled placeholder="标签" />
        </div>
    </div>
    <!--<div class="am-form-group">
        <label class="am-form-label am-u-sm-2">标签:</label>
        <div class="am-u-sm-4">
            <input type="text" disabled placeholder="标签" />
        </div>
    </div>-->
    <div class="am-form-group">
        <label class="am-form-label am-u-sm-2">原价:</label>
        <div class="am-u-sm-4">
            <input type="text" disabled placeholder="原价" />
        </div>
        <label class="am-form-label am-u-sm-2">现价:</label>
        <div class="am-u-sm-4">
            <input type="text" disabled placeholder="现价" />
        </div>
    </div>
    <!--<div class="am-form-group">
        <label class="am-form-label am-u-sm-2">现价:</label>
        <div class="am-u-sm-4">
            <input type="text" disabled placeholder="现价" />
        </div>
    </div>-->
    <div class="am-form-group">
        <label class="am-form-label am-u-sm-2">已卖出:</label>
        <div class="am-u-sm-4">
            <input type="text" disabled placeholder="已卖出" />
        </div>
        <label class="am-form-label am-u-sm-2">剩余:</label>
        <div class="am-u-sm-4">
            <input type="text" disabled placeholder="剩余" />
        </div>
    </div>
    <!--<div class="am-form-group">
        <label class="am-form-label am-u-sm-2">剩余:</label>
        <div class="am-u-sm-4">
            <input type="text" disabled placeholder="剩余" />
        </div>
    </div>-->
    <div class="am-form-group">
        <label class="am-form-label am-u-sm-2">保存方法:</label>
        <div class="am-u-sm-4">
            <input type="text" disabled placeholder="保存方法" />
        </div>
        <label class="am-form-label am-u-sm-2">产地:</label>
        <div class="am-u-sm-4">
            <input type="text" disabled placeholder="产地" />
        </div>
    </div>
    <!--<div class="am-form-group">
        <label class="am-form-label am-u-sm-2">产地:</label>
        <div class="am-u-sm-4">
            <input type="text" disabled placeholder="产地" />
        </div>
    </div>-->
    <div class="am-form-group">
        <label class="am-form-label am-u-sm-2">规格:</label>
        <div class="am-u-sm-4">
            <input type="text" disabled placeholder="规格" />
        </div>
        <label class="am-form-label am-u-sm-2">品牌:</label>
        <div class="am-u-sm-4">
            <input type="text" disabled placeholder="品牌" />
        </div>
    </div>
    <!--<div class="am-form-group">
        <label class="am-form-label am-u-sm-2">品牌:</label>
        <div class="am-u-sm-4">
            <input type="text" disabled placeholder="品牌" />
        </div>
    </div>-->
    <div class="am-form-group">
        <label class="am-form-label am-u-sm-2">保质期:</label>
        <div class="am-u-sm-4">
            <input type="text" disabled placeholder="保质期" />
        </div>
        <label class="am-form-label am-u-sm-2">等级:</label>
        <div class="am-u-sm-4">
            <input type="text" disabled placeholder="等级" />
        </div>
    </div>
    <!--<div class="am-form-group">
        <label class="am-form-label am-u-sm-2">等级:</label>
        <div class="am-u-sm-4">
            <input type="text" disabled placeholder="等级" />
        </div>
    </div>-->
    <div class="am-form-group">
        <label class="am-form-label am-u-sm-2">禁忌:</label>
        <div class="am-u-sm-4 am-u-end">
            <input type="text" disabled placeholder="禁忌" />
        </div>
        <label class="am-form-label am-u-sm-2">活动:</label>
        <div class="am-u-sm-4">
            <label><input type="checkbox" />是否打折</label>
            <label><input type="checkbox" />是否促销</label>
            <label><input type="checkbox" />是否包邮</label>
        </div>
    </div>
    <!--<div class="am-form-group">
        <label class="am-form-label am-u-sm-2">活动:</label>
        <div class="am-u-sm-10">
            <label><input type="checkbox" />是否打折</label>
            <label><input type="checkbox" />是否促销</label>
            <label><input type="checkbox" />是否包邮</label>
        </div>
    </div>-->
    <div class="am-form-group">
        <!--<div class="am-btn-group am-u-sm-4 am-u-sm-offset-5" >-->
        <button id="pro_detail_edit" class="am-btn am-btn-default am-u-sm-offset-5 am-u-sm-1">编辑</button>
        <button id="pro_detail_cancel" class="am-btn am-btn-default am-u-sm-offset-1 am-u-sm-1 am-u-end">返回</button>
        <!--</div>-->
    </div>
</form>
<script>
    $("#pro_detail_edit").click(function () {
        //跳转到编辑页面
    })
    $("#pro_detail_cancel").click(function () {
        //跳转到商品列别页面
    })
</script>
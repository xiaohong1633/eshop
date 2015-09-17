<html>
<head>
    <meta charset="utf-8" />
    <title>用户信息</title>
    <link rel="stylesheet" href="../res/AmazeUI/css/amazeui.min.css" />
    <!--[if lt IE 9]>
    <script src="../res/jquery-1.11.3.min.js"></script>
    <script src="../res/AmazeUI/js/amazeui.ie8polyfill.min.js"></script>
    <![endif]-->
    <!--[if (gte IE 9)|!(IE)]><!-->
    <script src="../res/jquery-2.1.4.min.js"></script>
    <!--<![endif]-->
    <script src="../res/jquery.cookie.js"></script>
    <script src="../res/AmazeUI/js/amazeui.min.js"></script>
    <script type="text/javascript" src="../res/table/table.js"></script>
    <style>
        #user_info_left {
            width: 150px;
            float: left;
        }

        #user_info_main {
            margin-left: 153px;
        }

        .am-form-group {
            height: 40px;
        }
    </style>
</head>
<body>
    <?php
    require("../include/head.inc");
    ?>
    <div class="user_info_content am-cf">
        <div id="user_info_left">
            <ul class="am-nav">
                <li><a href="#user_info_basic">基本信息</a></li>
                <li><a href="#user_info_address">收货地址</a></li>
                <li><a href="#user_info_orders">历史订单</a></li>
                <li><a href="#user_info_message">我的留言</a></li>
                <li><a href="#user_info_question">密保问题</a></li>
                <li><a href="#user_info_account">账户信息</a></li>
            </ul>
        </div>
        <div id="user_info_main">
            <div id="user_info_basic" class="user_info_tabs">
                <ol class="am-breadcrumb am-breadcrumb-slash">
                    <li>用户信息</li>
                    <li>基本信息</li>
                </ol>
                <div class="am-form am-form-horizontal">
                    <div class="am-form-group">
                        <label class="am-u-sm-2 am-form-label">登录名：</label>
                        <div class="am-u-sm-4 am-u-end">
                            <input type="text" value="用户名" />
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label class="am-u-sm-2 am-form-label">昵称：</label>
                        <div class="am-u-sm-4 am-u-end">
                            <input type="text" value="昵称" />
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label class="am-u-sm-2 am-form-label">性别：</label>
                        <div class="am-u-sm-4 am-u-end">
                            <select name="sex">
                                <option value="boy">男</option>
                                <option value="girl">女</option>
                            </select>
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label class="am-u-sm-2 am-form-label">邮箱：</label>
                        <div class="am-u-sm-4 am-u-end">
                            <input type="email" value="邮箱" />
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label class="am-u-sm-2 am-form-label">电话：</label>
                        <div class="am-u-sm-4 am-u-end">
                            <input type="text" value="电话" />
                        </div>
                    </div>
                    <div class="am-form-group">
                        <div class="am-u-sm-offset-3 am-u-end">
                            <button class="am-btn am-btn-primary">保存</button>
                            <button class="am-btn am-btn-primary">取消</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="user_info_address" class="user_info_tabs">
                <ol class="am-breadcrumb am-breadcrumb-slash">
                    <li>用户信息</li>
                    <li>收货地址</li>
                </ol>
                <div class="am-btn-toolbar" style="height:50px">
                    <div class="am-btn-group">
                        <button class="am-btn am-btn-default">
                            <span class="am-icon-plus">新增</span>
                        </button>
                        <button class="am-btn am-btn-default">
                            <span class="am-icon-minus">删除</span>
                        </button>
                    </div>
                </div>
                <!--<div id="user_info_addressTable">-->
                <table class="am-table am-table-bordered">
                    <thead>
                        <tr>
                            <th>序号</th>
                            <th>收货人</th>
                            <th>地址</th>
                            <th>联系电话</th>
                            <th>是否默认</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>小张</td>
                            <td>天海路天海小区1单元201</td>
                            <td>123456678901</td>
                            <td>是</td>
                            <td>
                                <a href="#">编辑</a>
                                <a href="#">设为默认</a>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>小张</td>
                            <td>天海路天海小区1单元201</td>
                            <td>123456678901</td>
                            <td>是</td>
                            <td>
                                <a href="#">编辑</a>
                                <a href="#">设为默认</a>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>小张</td>
                            <td>天海路天海小区1单元201</td>
                            <td>123456678901</td>
                            <td>是</td>
                            <td>
                                <a href="#">编辑</a>
                                <a href="#">设为默认</a>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>小张</td>
                            <td>天海路天海小区1单元201</td>
                            <td>123456678901</td>
                            <td>是</td>
                            <td>
                                <a href="#">编辑</a>
                                <a href="#">设为默认</a>
                            </td>
                        <tr>
                            <td>1</td>
                            <td>小张</td>
                            <td>天海路天海小区1单元201</td>
                            <td>123456678901</td>
                            <td>是</td>
                            <td>
                                <a href="#">编辑</a>
                                <a href="#">设为默认</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!--</div>-->
            </div>
            <div id="user_info_account" class="user_info_tabs">
                <ol class="am-breadcrumb am-breadcrumb-slash">
                    <li>用户信息</li>
                    <li>账户信息</li>
                </ol>

                <div class="am-tab-panel am-active" id="tab_password">
                    <div class="am-form am-form-horizontal">
                        <div class="am-form-group">
                            <label class="am-u-sm-2 am-form-label">原密码:</label>
                            <div class="am-u-sm-4 am-u-end">
                                <input type="password" />
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-sm-2 am-form-label">新密码:</label>
                            <div class="am-u-sm-4 am-u-end">
                                <input type="password" />
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-sm-2 am-form-label">确认新密码:</label>
                            <div class="am-u-sm-4 am-u-end">
                                <input type="password" />
                            </div>
                        </div>
                        <div class="am-form-group">
                            <div class="am-u-sm-offset-3 am-u-end">
                                <button class="am-btn am-btn-primary">修改</button>
                                <button class="am-btn am-btn-primarty">取消</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div id="user_info_orders" class="user_info_tabs">
                <ol class="am-breadcrumb am-breadcrumb-slash">
                    <li>用户信息</li>
                    <li>历史订单</li>
                </ol>

                <table class="am-table am-table-bordered">
                    <thead>
                        <tr>
                            <th>订单号</th>
                            <th>订单信息</th>
                            <th>收货人</th>
                            <th>订单金额</th>
                            <th>
                                <select name="status">
                                    <option>未付款</option>
                                    <option>已付款</option>
                                    <option>已收货</option>
                                    <option>已取消</option>
                                </select>
                            </th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>20150713120912121</td>
                            <td>牦牛肉,藏红花</td>
                            <td>小张</td>
                            <td>200(货到付款)</td>
                            <td>已收货</td>
                            <td>
                                <a href="#">查看详细</a>
                                <a href="#">评论商品</a>
                            </td>
                        </tr>
                        <tr>
                            <td>20150713120912121</td>
                            <td>牦牛肉,藏红花</td>
                            <td>小张</td>
                            <td>200(货到付款)</td>
                            <td>已收货</td>
                            <td>
                                <a href="#">查看详细</a>
                                <a href="#">评论商品</a>
                            </td>
                        </tr>
                        <tr>
                            <td>20150713120912121</td>
                            <td>牦牛肉,藏红花</td>
                            <td>小张</td>
                            <td>200(货到付款)</td>
                            <td>已收货</td>
                            <td>
                                <a href="#">查看详细</a>
                                <a href="#">评论商品</a>
                            </td>
                        </tr>
                        <tr>
                            <td>20150713120912121</td>
                            <td>牦牛肉,藏红花</td>
                            <td>小张</td>
                            <td>200(货到付款)</td>
                            <td>已收货</td>
                            <td>
                                <a href="#">查看详细</a>
                                <a href="#">评论商品</a>
                            </td>
                        </tr>
                        <tr>
                            <td>20150713120912121</td>
                            <td>牦牛肉,藏红花</td>
                            <td>小张</td>
                            <td>200(货到付款)</td>
                            <td>已收货</td>
                            <td>
                                <a href="#">查看详细</a>
                                <a href="#">评论商品</a>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
            <div id="user_info_message" class="user_info_tabs">
                <ol class="am-breadcrumb am-breadcrumb-slash">
                    <li>用户信息</li>
                    <li>我的评论</li>
                </ol>
                <ul class="am-comments-list">
                    <li class="am-comment" style="height:100px">
                        <a href="#">
                            <img src="../tx/1.PNG" class="am-comment-avatar" width="48" height="48" />
                        </a>
                        <div class="am-comment-main">
                            <header class="am-comment-hd">
                                <div class="am-comment-meta">
                                    用户名 在 2015-07-13 12:12:12 写道
                                </div>
                            </header>
                            <div class="am-comment-bd">
                                这是我买的第一个牦牛，牛角很大，叫声很优美，32个赞
                            </div>
                        </div>
                    </li>
                    <li class="am-comment" style="height:100px">
                        <a href="#">
                            <img src="../tx/1.PNG" class="am-comment-avatar" width="48" height="48" />
                        </a>
                        <div class="am-comment-main">
                            <header class="am-commnet-hd">
                                <div class="am-comment-meata">
                                    管理员 在 2015-07-14 13:13:13 回复道
                                </div>
                            </header>
                            <div class="am-comment-bd">
                                谢谢您的评价，本店的牦牛质量刚刚的
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div id="user_info_question" class="user_info_tabs">
                <ol class="am-breadcrumb am-breadcrumb-slash">
                    <li>用户信息</li>
                    <li>密保问题</li>
                </ol>
                    <div class="am-form am-form-horizontal">
                        <div class="am-form-group">
                            <label class="am-u-sm-2 am-form-label">原来的密保问题</label>
                            <div class="am-u-sm-4 am-u-end">
                                <select>
                                    <option>问题1</option>
                                    <option>问题2</option>
                                    <option>问题3</option>
                                </select>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-sm-2 am-form-label">原来的密保答案</label>
                            <div class="am-u-sm-4 am-u-end">
                                <input type="text" />
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-sm-2 am-form-label">新的密保问题</label>
                            <div class="am-u-sm-4 am-u-end">
                                <select>
                                    <option>问题1</option>
                                    <option>问题2</option>
                                    <option>问题3</option>
                                </select>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-sm-2 am-form-label">新的密保问题</label>
                            <div class="am-u-sm-4 am-u-end">
                                <input type="text" />
                            </div>
                        </div>
                        <div class="am-form-group">
                            <div class="am-u-sm-offset-3 am-u-end">
                                <button class="am-btn am-btn-primary">修改</button>
                                <button class="am-btn am-btn-primarty">取消</button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <?php
    require("../include/tail.inc");
    ?>
    <script>
        //tab分内容的切换
        function showTab($tab) {
            $(".user_info_tabs").hide();
            $tab.show();
        }
        $(".am-nav a").click(function () {

            showTab($($(this).attr("href")));
            //alert('hi');
        })
        showTab($("#user_info_basic"));
        //收货表格的初始化
        var head = ["id", "联系人", "收获地址", "联系电话", "是否默认"];
        var field = ["id,", "person", "address", "phone", "isDefault"];
        data = null;
        //$("#user_info_addressTable").table(head, field, data);
    </script>
</body>
</html>
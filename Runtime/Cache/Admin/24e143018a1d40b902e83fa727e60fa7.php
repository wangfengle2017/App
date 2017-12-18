<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>爱德拉管理中心</title>
    <link rel="shortcut icon" href="/Public/Index/Images/favicon.ico" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link href="/Public/Admin/assets/css/bootstrap.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .pointer{
            cursor: pointer;
        }
        .mt{
            margin-top: 10px;
        }
        body{
            font-family: 'Microsoft YaHei';
            background: #fff;
            min-width:1300px;
            *+width:100%;
            _width:1300px;

        }
        header{
            border-bottom: 1px solid #428BCA;
        }
        header ul li{
            margin: 0 10px;
        }
        .fl{
            float: left;
        }
        input{
            autocomplete:off;
        }
    </style>
</head>

<body>

<section id="container" >
    <!-- **********************************************************************************************************************************************************
    TOP BAR CONTENT & NOTIFICATIONS
    *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header>
        <ul class="nav nav-pills">
            <li id="sy" class="active" style="margin-left: 40px;">
                <a href="<?php echo U('index/index');?>">首页</a>
            </li>
            <li id="yonghu" style="margin-left: 15px;">
                <a href="<?php echo U('user/index');?>">用户中心</a>
            </li>
            <li id="pic-con" style="margin-left: 15px;">
                <a href="<?php echo U('pic/index');?>">图片管理</a>
            </li>
            <li id="sb-con" style="margin-left: 15px;">
                <a href="<?php echo U('equip/index');?>">设备管理</a>
            </li>
            <li id="user" class="dropdown navbar-right" style="margin-right: 10px;">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-user"></i><?php echo (session('admin_user')); ?><span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo U('administrator/administrator');?>">用户设置</a></li>
                    <li><a href="<?php echo U('administrator/index');?>">管理员设置</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?php echo U('login/loginOut');?>">退出</a></li>
                </ul>
            </li>
            <li class="navbar-right">
                <div id="clock" style="color: #000;text-align: right;font-size:20px;line-height: 35px;">

                </div>
            </li>
        </ul>
    </header>
    <!--header end-->
    <!--main content start-->
    
    <style>
        table tr th,td{
            text-align: center;
        }
        .pages a,
        .pages span {
            display: inline-block;
            padding: 2px 5px;
            margin: 0 1px;
            border: 1px solid #f0f0f0;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }

        .pages a,
        .pages li {
            display: inline-block;
            list-style: none;
            text-decoration: none;
            color: #58A0D3;
        }

        .pages a.first,
        .pages a.prev,
        .pages a.next,
        .pages a.end {
            margin: 0;
        }

        .pages a:hover {
            border-color: #50A8E6;
        }

        .pages span.current {
            background: #50A8E6;
            color: #FFF;
            font-weight: 700;
            border-color: #50A8E6;
        }
        pre{font-family:'微软雅黑'}
    </style>
    <div id="main">
        <ul class="nav nav-tabs" style="margin: 20px 20px 0;">
            <li role="presentation"><a href="<?php echo U('user/index');?>">用户信息</a></li>
            <li role="presentation"><a href="<?php echo U('user/paycheck');?>">充值记录</a></li>
            <li role="presentation" class="active"><a href="<?php echo U('user/consume');?>">消费记录</a></li>
        </ul>
        <div class="col-lg-12">
            <div class="col-lg-12" style="margin: 40px 0 20px;">
                <form class="form-inline" action="<?php echo U('user/consume');?>" method="post">
                    <div class="form-group">
                        <label for="key">关键字：</label>
                        <input type="text" class="form-control" id="key" autocomplete="off" name="key" placeholder="请输入用户名（账号）">
                    </div>
                    <button type="submit" class="btn btn-default">搜索</button>
                </form>
            </div>
            <div class="col-lg-12 mt">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>用户名</th>
                        <th>消费内容</th>
                        <th>消费金额</th>
                        <th>消费时间</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr id="tr-<?php echo ($vo["id"]); ?>">
                            <td><?php echo ($vo["user"]); ?></td>
                            <td><?php echo ($vo["content"]); ?></td>
                            <td><?php echo ($vo["money"]); ?></td>
                            <td><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></td>
                        </tr><?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-12">
                <div class="pages" style="margin-top: 20px;margin-left:45%;">
                    <?php echo ($pageinfo); ?>
                </div>
            </div>
        </div>
    </div>
    <script src="/Public/Admin/Js/jquery-1.8.3.min.js"></script>
    <!--删除-->
    <script>
        function doDel(id){
            if(confirm('删除后无法恢复，是否删除？')){
                $.ajax({
                    url:'<?php echo U('user/del');?>',
                    type:'post',
                    async:false,
                    data:{id:id},
                    dataType:'json',
                    success:function(data){
                        if(data){
                            $('#tr-'+id).remove();
                        }
                    },
                    error:function(){

                    }
                })
            }
        }
    </script>
    <script>
        $('#yonghu').addClass('active').siblings().removeClass('active');
    </script>

    <!--main content end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="/Public/Admin/assets/js/jquery.js"></script>
<script src="/Public/Admin/assets/js/jquery-1.8.3.min.js"></script>
<script src="/Public/Admin/assets/js/bootstrap.min.js"></script>
<script>
    function showTime()
    {
        var myDate = new Date();
        var year = myDate.getFullYear();
        var month = myDate.getMonth()+1;
        var date = myDate.getDate();
        var hour = myDate.getHours();
        var minute = myDate.getMinutes();
        var second = myDate.getSeconds();
        var day = myDate.getDay();
        if(second < 10){
            second = '0'+second;
        }
        if(month < 10){
            month = '0'+month;
        }
        if(date < 10){
            date = '0'+date;
        }
        if(hour < 10){
            hour = '0'+hour;
        }
        if(minute < 10){
            minute = '0'+minute;
        }
        switch(day){
            case 0:
                day = '星期日';
                break;
            case 1:
                day = '星期一';
                break;
            case 2:
                day = '星期二';
                break;
            case 3:
                day = '星期三';
                break;
            case 4:
                day = '星期四';
                break;
            case 5:
                day = '星期五';
                break;
            case 6:
                day = '星期六';
                break;
        }
        var info = '<span style="font-family: 微软雅黑;">'+hour+'<span id="second">:</span>'+minute+'</span><span style="font-size:10px;font-family: 微软雅黑;">'+day+' '+month+'-'+date+'</span>';
        $('#clock').html(info);
        $("#second").fadeToggle(1000,function(){
            showTime();
        });
    }
    $(function(){
        showTime();
    });
</script>

</body>
</html>
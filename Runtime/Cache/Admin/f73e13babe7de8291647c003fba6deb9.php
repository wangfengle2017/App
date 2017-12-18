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
    
    <ul class="nav nav-tabs" style="margin: 20px 50px;">
        <li>
            <a style="cursor: pointer">修改密码</a>
        </li>
    </ul>
    <!--edit start-->
    <div style="margin: 20px 60px;">
        <div id="edit" class="row" style="border-right: 1px solid #ddd;">
            <div style="background: #fff;margin-top:60px;">
                <form id="editform" class="form-horizontal" method="post">
                    <input type="hidden" class="form-control" name="ename" value="<?php echo (session('admin_user')); ?>">
                    <div class="form-group">
                        <label class="col-sm-4" style="text-align: right;font-size: 20px;">新密码</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="epassword">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4" style="text-align: right;font-size: 20px;">确认密码</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="erepassword">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12" style="text-align: center;padding: 10px;">
                            <button onclick="onEdit()" class="btn btn-success" style="padding: 8px 30px;font-size: 18px;">修改</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--edit end-->
    <div id="msg" style="background: #51DA07;color: #fff;position:absolute;top: 120px;left:45%;display: none;">
        <span id="msg-content" style="font-size: 14px;padding: 10px"></span>
    </div>
    <script src="/Public/Admin/Js/jquery-1.8.3.min.js"></script>
    <!--修改信息-->
    <script>
        function onEdit()
        {
            if($('input[name="erepassword"]').val() != $('input[name="epassword"]').val()){
                $('#msg-content').html('亲，两次密码不一致');
                $('#msg').css('display','block');
                return false;
            }else{
                $('#editform').attr('action','<?php echo U('administrator/adupdate');?>').submit();
            }
            return false;
        }
    </script>
    <!--删除-->
    <script>
        $('#user').addClass('active').siblings().removeClass('active');
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
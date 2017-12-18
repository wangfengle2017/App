<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title id="mytitle"></title>
    <!--<link rel="shortcut icon" href="/Public/Index/Images/favicon.ico" type="image/x-icon">-->
    <!-- Bootstrap core CSS -->
    <!--<link href="/Public/Admin/assets/css/bootstrap.css" rel="stylesheet">-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <!--<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>-->
    <!--<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>-->
    <![endif]-->
    <style>
        body{
            margin: 0 auto;
            max-width: 980px;
            font-family: 'Microsoft YaHei';
            background: #fff;
            *+width:100%;
            _width:980px;
            /*width:980px;*/

        }
        .fl{
            float: left;
        }
        input{
            autocomplete:off;
        }
        img{
            border:none;
        }
        *{
            margin: 0;
            padding:0;
        }
        a{
            text-decoration: none;
        }
        .pointer{
            cursor: pointer;
        }
    </style>
</head>

<body>

<section id="container" >
    <!--header start-->
    <header>
    </header>
    <!--header end-->
    <!--main content start-->
    
    <style>
        .annu{
            display: inline-block;
            padding: 10px 50px;
            background: #0D98E6;
            margin: 15px;
            border-radius:6px;
            color: #fff;
            font-family: '微软雅黑', 'MicrosoftYaHei';
        }
        .inp{
            height: 40px;
            width: 40%;
            border-radius: 7px;
            font-size: 18px;
            font-family: '微软雅黑', 'MicrosoftYaHei';
        }
    </style>
    <!--<section class="container">-->
    <div>
        <!--banner-->
        <div>
            <img src="/Public/Upload/Pic/<?php echo ($pic["banner"]); ?>" alt="" style="width: 100%;">
        </div>
        <!--banner end-->
        <!--content-->
        <div style="margin: 20px 0;">
            <div style="text-align: center;">
                <span style="color:#0D98E6;font-size: 18px;font-family: '微软雅黑', 'MicrosoftYaHei';"><?php echo (cookie('user')); ?></span>
                <input type="hidden" id="user" value="<?php echo (cookie('user')); ?>">
            </div>
            <div style="text-align: center;margin-top: 30px;">
                <img src="/Public/Index/Images/yeicon.jpg" alt="" width="20"><span style="color:#0D98E6;font-size: 18px;font-family: '微软雅黑', 'MicrosoftYaHei';margin-left: 2px;">我的余额：<span id="money"><?php echo ($list["ye"]); ?></span>元</span>
            </div>
            <div style="text-align: center;margin-top: 30px;">
                <span>请选择洗车时间:</span>
                <input type="radio" name="washtime" value="5" checked/><span>5分钟</span>
                <input type="radio" name="washtime" value="10"/><span>10分钟</span>
                <input type="radio" name="washtime" value="15"/><span>15分钟</span>
                <input type="radio" name="washtime" value="20"/><span>20分钟</span>
            </div>
            <input type="hidden" name="member" id="member" value="<?php echo (cookie('user')); ?>">
            <div id="kaisuo">
                <div style="margin: 10px 0;text-align: center;">
                    <input class="inp" id="key" type="text" name="key" autocomplete="off" placeholder="请输入设备号" onkeyup="value=value.replace(/[^\d]/g,'')" maxlength="10" value="<?php echo ($washStatus["eq_nu"]); ?>" <?php echo ($washStatus?'disabled':''); ?>>
                </div>
                <div style="margin: 10px 0;text-align: center;" id="openwash">
                    <button id="submit" class="annu pointer" <?php echo ($washStatus?'disabled':''); ?>>点击开锁并计时</button>
                </div>
            </div>
            <div id="wash" style="display:none;">
                <div style="margin: 10px 0;text-align: center;" id="wash_msg">
                    
                </div>
                <div style="margin: 10px 0;text-align: center;">
                    <button id="guansuo" class="annu pointer">点击关锁并结算</button>
                </div>
            </div>
        </div>
        <!--content end-->
        <!--logo-->
        <div style="width: 70%;margin-left: 15%;margin-top: 50px;">
            <img src="/Public/Upload/Pic/<?php echo ($pic["dlogo"]); ?>" alt="" style="width: 100%;">
        </div>
        <!--logo end-->
    </div>
    <!--</section>-->
    <script src="/Public/Admin/Js/jquery-1.8.3.min.js"></script>
    <script>
        function member_status()
        {

        }
        $(function(){
            $.ajax({
                url:'<?php echo U('ws/member_status');?>',
                type:'post',
                async:false,
                data:{user:$('#user').val()},
                dataType:'json',
                success:function(data){
                    if(data.status == 'ok'){
                        $('#wash_msg').html(data.msg);
                        $('#wash').css('display','block');
                        $('#kaisuo').css('display','none;');
                        $('#money').html(data.money);
                        $('#submit').attr('disabled','disabled');
                            $('#key').attr('disabled','disabled');
                    }
                },
                error:function(){
                    alert('网络错误');
                }
            });
            var status = setInterval(function(){
                $.ajax({
                    url:'<?php echo U('ws/member_status');?>',
                    type:'post',
                    async:false,
                    data:{user:$('#user').val()},
                    dataType:'json',
                    success:function(data){
                        if(data.status == 'ok'){
                            $('#wash_msg').html(data.msg);
                            $('#wash').css('display','block');
                            $('#kaisuo').css('display','none;');
                            $('#money').html(data.money);
                            $('#submit').attr('disabled','disabled');
                            $('#key').attr('disabled','disabled');
                        }else{
                            $('#wash_msg').html(data.msg);
                            setTimeout(function(){
                                $('#wash').css('display','none');
                                $('#kaisuo').css('display','block;');
                                $('#money').html(data.money);
                                $('#submit').removeAttr('disabled');
                                $('#key').removeAttr('disabled');
                        },3000)
                            
                            // clearInterval(status);
                        }
                    },
                    error:function(){
                        alert('网络错误');
                    }
                });
            },2000);
        })
        $('#submit').click(function()
        {
            var key = $('#key').val();
            var time = $('input[name="washtime"]:checked').val();
            var money = $('#money').html();
            if(money-time<0){
                alert('金额不足请充值');
            }else{
            if(key == ''){
                alert('请输入设备号');
            }else{
                $.ajax({
                    url:'<?php echo U('ws/member_wash');?>',
                    type:'post',
                    async:false,
                    data:{user:$('#user').val(),key:key,time:time,money:money},
                    dataType:'json',
                    success:function(data){
                        if(data.status == 'ok'){
                            $('#wash_msg').html(data.msg);
                            $('#money').html(data.money);
                            $('#wash').css('display','block');
                            $('#kaisuo').css('display','none;');
                            $('#submit').attr('disabled','disabled');
                            $('#key').attr('disabled','disabled');
                        }else{
                            alert(data.msg);
                        }
                    },
                    error:function(){
                        alert('网络错误');
                    }
                });
            }
            }
        })
        $('#guansuo').click(function(){
            $.ajax({
                    url:'<?php echo U('ws/member_stop');?>',
                    type:'post',
                    async:false,
                    data:{user:$('#user').val()},
                    dataType:'json',
                    success:function(data){
                        if(data.code){
                            $('#wash_msg').html(data.msg);
                            $('#money').html(data.money);
                            $('#wash').css('display','block');
                            $('#kaisuo').css('display','none;');
                            $('#submit').removeAttr('disabled');
                            $('#key').removeAttr('disabled');
                        }else{
                            alert(data.msg);
                        }
                    },
                    error:function(){
                        alert('网络错误');
                    }
                });
        });
    </script>
    <script>
        $('#mytitle').html('大连爱德拉自助洗车-个人中心');
    </script>

    <!--main content end-->
</section>
<!-- js placed at the end of the document so the pages load faster -->
<!--<script src="/Public/Admin/assets/js/jquery.js"></script>-->
<script src="/Public/Admin/assets/js/jquery-1.8.3.min.js"></script>
<!--<script src="/Public/Admin/assets/js/bootstrap.min.js"></script>-->
</body>
</html>
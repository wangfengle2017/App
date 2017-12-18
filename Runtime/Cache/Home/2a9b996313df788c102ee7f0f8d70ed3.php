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
        }
        .inp{
            height:35px;
            width: 200px;
            font-size: 18px;
            font-family: '微软雅黑', 'MicrosoftYaHei';
            border-radius: 7px;
            text-align: center;
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
            </div>
            <div style="text-align: center;margin-top: 30px;">
                <img src="/Public/Index/Images/yeicon.jpg" alt="" width="20"><span style="color:#0D98E6;font-size: 18px;font-family: '微软雅黑', 'MicrosoftYaHei';margin-left: 2px;">我的余额：<span><?php echo ($list["ye"]); ?></span>元</span>
            </div>
            <div style="margin-top: 20px">
                <form action="<?php echo U('user/order');?>" method="post">
                    <div style="margin: 10px 0;text-align: center;">
                        <span style="font-size: 18px;font-family: '微软雅黑', 'MicrosoftYaHei';margin-right: 10px;">充值金额：</span><input type="text" class="inp" name="price" placeholder="请输入充值金额" autocomplete="off" required="required">
                    </div>
                    <div style="margin: 10px 0;text-align: center;">
                        <span style="font-size: 18px;font-family: '微软雅黑', 'MicrosoftYaHei';margin-right: 8px;">支付方式：</span><input type="radio" name="cate" value="微信支付" checked><span style="font-size: 18px;font-family: '微软雅黑', 'MicrosoftYaHei';">微信支付</span>
                        <input type="radio" name="cate" value="支付宝支付" style="margin-left: 10px;"><span style="font-size: 18px;font-family: '微软雅黑', 'MicrosoftYaHei';">支付宝支付</span>
                    </div>
                    <div style="margin: 10px 0;text-align: center;">
                        <button type="submit" class="annu pointer">确认充值</button>
                    </div>
                </form>
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
        $('#mytitle').html('大连爱德拉自助洗车-充值中心');
    </script>

    <!--main content end-->
</section>
<!-- js placed at the end of the document so the pages load faster -->
<!--<script src="/Public/Admin/assets/js/jquery.js"></script>-->
<script src="/Public/Admin/assets/js/jquery-1.8.3.min.js"></script>
<!--<script src="/Public/Admin/assets/js/bootstrap.min.js"></script>-->
</body>
</html>
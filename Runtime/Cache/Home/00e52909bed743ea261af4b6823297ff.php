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
        .logo{
            width: 31.4%;
            float: left;
            margin-top: 3%;
            /*margin-bottom: 2%;*/
            margin-left: 1%;
        }
        #header{
            overflow: hidden;
        }
        #rexian{
            float: right;
            font-size: 0.5em;
            font-family: "微软雅黑";
            color: #80040b;
            margin-top: 4%;
            margin-right: 1%;
        }
        .annu{
            display: inline-block;
            padding: 10px 50px;
            background: #0D98E6;
            margin: 15px;
            border-radius:6px;
            color: #fff;
        }
    </style>
    <!--<section class="container">-->
        <div style="text-align: center;">
            <div id="header">
                <div class="logo">
                    <img src="/Public/Upload/Pic/<?php echo ($pic["xlogo"]); ?>" alt="" width="100%">
                </div>
                <div id="rexian">全国招商热线：400-050-2016</div>
            </div>
            <!--banner-->
            <div style="width: 100%;margin-top: 10px;">
                <img src="/Public/Upload/Pic/<?php echo ($pic["banner"]); ?>" alt="" style="width: 100%;">
            </div>
            <!--banner end-->
            <!--content-->
            <div style="margin: 10px 0;text-align: center;">
                <a href="<?php echo U('login/zc');?>" class="btn pointer">
                    <div class="annu ">注册</div>
                </a>
                <a href="<?php echo U('login/index');?>" class="btn pointer">
                    <div class="annu">登录</div>
                </a>
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
        $('#mytitle').html('大连爱德拉自助洗车-首页');
    </script>

    <!--main content end-->
</section>
<!-- js placed at the end of the document so the pages load faster -->
<!--<script src="/Public/Admin/assets/js/jquery.js"></script>-->
<script src="/Public/Admin/assets/js/jquery-1.8.3.min.js"></script>
<!--<script src="/Public/Admin/assets/js/bootstrap.min.js"></script>-->
</body>
</html>
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
        <div class="col-lg-12">
            <div class="col-lg-12" style="margin: 40px 0 20px;">
                <div class="col-lg-8">
                    <form class="form-inline" action="<?php echo U('pic/index');?>" method="get">
                        <div class="form-group">
                            <label for="key">关键字：</label>
                            <input type="text" class="form-control" id="key" name="key" placeholder="请输入分类名称" autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-default">搜索</button>
                    </form>
                </div>
                <div class="col-lg-4" style="text-align: right;">
                    <button class="btn btn-success" onclick="$('#addpic').css('display','block')"><i class="glyphicon glyphicon-plus"></i>添加图片</button>
                </div>
            </div>
            <div class="col-lg-12 mt">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="col-lg-6">图片</th>
                        <th>所属分类</th>
                        <th class="col-lg-1">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr id="tr-<?php echo ($vo["id"]); ?>">
                            <td><img src="/Public/Upload/Pic/<?php echo ($vo["pic"]); ?>" height="20"></td>
                            <td><?php echo ($vo["name"]); ?></td>
                            <td><i class="glyphicon glyphicon-pencil pointer" onclick="$('#editpic').css('display','block');$('#ytu').attr('src','/Public/Upload/Pic/<?php echo ($vo["pic"]); ?>');$('#yid').val('<?php echo ($vo["id"]); ?>');$('#ypic').val('<?php echo ($vo["pic"]); ?>');$('#ycate').val('<?php echo ($vo["cate"]); ?>')"></i>丨<i class="glyphicon glyphicon-trash pointer" onclick="doDel('<?php echo ($vo["id"]); ?>','<?php echo ($vo["pic"]); ?>')"></i></td>
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
    <div id="addpic" style="display:none;background: #efefef;max-height: 600px;width: 60%;overflow-y:auto;position: fixed;left:20%;top:10%">
        <div class="col-lg-12" style="text-align: center;padding: 10px 0;background: #ccc;">
            <span style="font-size: 18px;">添加图片</span>
        </div>
        <div class="col-lg-12 mt">
            <form class="form-horizontal" action="<?php echo U('pic/insert');?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-sm-2 control-label">图片</label>
                    <div class="col-sm-10">
                        <span onclick="$('#fpic').click()" class="btn btn-default">上传图片</span>
                        <div id="preview">
                            <img id="imghead" width=100% height=auto src="" style="border: none">
                        </div>
                        <div style="display: none;">
                            <input id="fpic" type="file" onchange="previewImage(this,'imghead','preview')" name="pic" required="required"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">所属分类</label>
                    <div class="col-sm-8">
                        <select id="cate" name="cate" class="form-control">
                            <?php if(is_array($cate)): foreach($cate as $key=>$vo): ?><option value="<?php echo ($vo["cate"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-4">
                        <button type="submit" class="btn btn-success">提交</button>
                        <a class="btn btn-default" onclick="$('#addpic').css('display','none')">关闭</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="editpic" style="display:none;background: #efefef;max-height: 600px;width: 60%;overflow-y:auto;position: fixed;left:20%;top:10%">
        <div class="col-lg-12" style="text-align: center;padding: 10px 0;background: #ccc;">
            <span style="font-size: 18px;">更换图片</span>
        </div>
        <div class="col-lg-12 mt">
            <form class="form-horizontal" action="<?php echo U('pic/update');?>" method="post" enctype="multipart/form-data">
                <input type="hidden" id="yid" name="yid">
                <input type="hidden" id="ypic" name="ypic">
                <input type="hidden" id="ycate" name="ycate">
                <div class="form-group">
                    <label class="col-sm-2 control-label">原图片</label>
                    <div class="col-sm-10">
                        <img id="ytu" width=100% height=auto src="" style="border: none">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">新图片</label>
                    <div class="col-sm-10">
                        <span onclick="$('#xpic').click()" class="btn btn-default">上传图片</span>
                        <div id="xinpre">
                            <img id="ximg" width=100% height=auto src="" style="border: none">
                        </div>
                        <div style="display: none;">
                            <input id="xpic" type="file" onchange="previewImage(this,'ximg','xinpre')" name="pic" required="required"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-4">
                        <button type="submit" class="btn btn-success">提交</button>
                        <a class="btn btn-default" onclick="$('#editpic').css('display','none')">关闭</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="/Public/Admin/Js/jquery-1.8.3.min.js"></script>
    <!--删除-->
    <script>
        function doDel(id,pic){
            if(confirm('删除后无法恢复，是否删除？')){
                $.ajax({
                    url:'<?php echo U('pic/del');?>',
                    type:'post',
                    async:false,
                    data:{id:id,pic:pic},
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
    <script type="text/javascript">
        //图片上传预览    IE是用了滤镜。
        function previewImage(file,name,kuang)
        {
            var MAXWIDTH  = 260;
            var MAXHEIGHT = 180;
            var div = document.getElementById(kuang);
            if (file.files && file.files[0])
            {
                div.innerHTML ='<img id='+name+'>';
                var img = document.getElementById(name);
                img.onload = function(){
                    var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
                    img.width  =  rect.width;
                    img.height =  rect.height;
//                 img.style.marginLeft = rect.left+'px';
                    img.style.marginTop = rect.top+'px';
                }
                var reader = new FileReader();
                reader.onload = function(evt){img.src = evt.target.result;}
                reader.readAsDataURL(file.files[0]);
            }
            else //兼容IE
            {
                var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
                file.select();
                var src = document.selection.createRange().text;
                div.innerHTML = '<img id='+name+'>';
                var img = document.getElementById(name);
                img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
                var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
                status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
                div.innerHTML = "<div id=divhead style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;"+sFilter+src+"\"'></div>";
            }
        }
        function clacImgZoomParam( maxWidth, maxHeight, width, height ){
            var param = {top:0, left:0, width:width, height:height};
            if( width>maxWidth || height>maxHeight )
            {
                rateWidth = width / maxWidth;
                rateHeight = height / maxHeight;

                if( rateWidth > rateHeight )
                {
                    param.width =  maxWidth;
                    param.height = Math.round(height / rateWidth);
                }else
                {
                    param.width = Math.round(width / rateHeight);
                    param.height = maxHeight;
                }
            }
            param.left = Math.round((maxWidth - param.width) / 2);
            param.top = Math.round((maxHeight - param.height) / 2);
            return param;
        }
    </script>
    <script>
        $('#pic-con').addClass('active').siblings().removeClass('active');
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
<?php
function randomkeys($length)
{
    $pattern = '1234567890123456789012345678901234567890123456789012345678';    //字符池,可任意修改
    $key = '';
    for($i=0;$i<$length;$i++)
    {
        $key .= $pattern{mt_rand(0,35)};    //生成php随机数
    }
    return $key;
}

function rstr($str){


    print($str);
    exit();
}

function sendnote($mobtel,$msg){
    $comid= "3088"; //企业ID
    $username= "renyifei"; //用户名
    $userpwd= "ae6e4jw3"; //密码
    $smsnumber= "10690"; //所用平台
    $url = "http://jiekou.56dxw.com/sms/HttpInterfaceMore.aspx?comid=$comid&username=$username&userpwd=$userpwd&handtel=$mobtel&sendcontent=$msg&sendtime=&smsnumber=$smsnumber";
    $string = file_get_contents($url);
    return  rstr($string);
}

function getClientIP()
{
    global $ip;
    if (getenv("HTTP_CLIENT_IP"))
        $ip = getenv("HTTP_CLIENT_IP");
    else if(getenv("HTTP_X_FORWARDED_FOR"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if(getenv("REMOTE_ADDR"))
        $ip = getenv("REMOTE_ADDR");
    else $ip = "Unknow";
    return $ip;
}

function eqlog($eq_nu,$content,$cate)
{
    $array=array(
        'eq_nu'=>$eq_nu,
        'content'=>$content,
        'cate'=>$cate,
        'time'=>time()
        );
    M('eq_log')->add($array);
}
function userlog($user,$content,$money)
{
    $array=array(
        'user'=>$user,
        'content'=>$content,
        'money'=>$money,
        'time'=>time()
        );
    M('user_log')->add($array);
}
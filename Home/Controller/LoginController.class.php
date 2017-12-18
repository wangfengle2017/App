<?php
namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller
{
    public function zc()
    {
        $m = M('pic');
        $res = [];
        $res['xlogo'] = $m -> where('cate = "zcxlogo"') -> getField('pic');
        $res['dlogo'] = $m -> where('cate = "zcdlogo"') -> getField('pic');
        $res['banner'] = $m -> where('cate = "zcbanner"') -> getField('pic');
        $this -> assign('pic',$res);
        $this -> display();

    }

    public function index()
    {
        $m = M('pic');
        $res = [];
        $res['xlogo'] = $m -> where('cate = "dlxlogo"') -> getField('pic');
        $res['dlogo'] = $m -> where('cate = "dldlogo"') -> getField('pic');
        $res['banner'] = $m -> where('cate = "dlbanner"') -> getField('pic');
        $this -> assign('pic',$res);
        $this -> display();

    }

    public function dologin()
    {
        if($_SESSION["code"] == $_POST['yzm']){
            if($_POST['action'] == 'zc'){
                $tel = $_POST['tel'];
                $m = M('user');
                $res = $m -> where('name = "'.$tel.'"') -> find();
                if($res){
                    $msg  = -1;
                }else{
                    $data = [];
                    $data['name'] = $tel;
                    $result = $m -> data($data) -> add();
                    if($result){
                        $msg = $result;
//                        $_SESSION['user'] = $data['name'];
                        cookie('user',$data['name'],36000);
                    }else{
                        $msg = 0;
                    }
                }
            }else{
                $tel = $_POST['tel'];
                $m = M('user');
                $res = $m -> where('name = "'.$tel.'"') -> find();
                if($res){
//                    $_SESSION['user'] = $tel;
                    cookie('user',$tel,36000);
                    $msg = $res;
                }else{
                    $msg  = -1;
                }
            }
        }else{
            $msg = -2;
        }
        echo json_encode($msg);
    }

    public function sms()
    {
        $_SESSION["code"]=randomkeys(6);
        $handtel =$_POST["tel"];
        $msg="您的手机验证码是:".$_SESSION["code"]."有效时间15分钟【爱德拉自助洗车】";
        !$handtel && die('手机号必填');
        !$msg && die('发生内容必填');
        echo sendnote($_POST["tel"],urlencode(mb_convert_encoding($msg, 'gbk' ,'utf-8')));
    }
}
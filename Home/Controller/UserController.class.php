<?php
namespace Home\Controller;
use Think\Controller;

class UserController extends Controller
{
    public function index()
    {
        if(cookie('user') == null){
            $this -> error('您还没有登录，请登录',U('login/index'));
        }else{
            unset($_SESSION['code']);
            $m = M('pic');
            $res = [];
            $res['dlogo'] = $m -> where('cate = "zydlogo"') -> getField('pic');
            $res['banner'] = $m -> where('cate = "zybanner"') -> getField('pic');
            $this -> assign('pic',$res);
            $m = M('user');
            $res = $m -> where('name = "'.cookie('user').'"') -> find();
            $this -> assign('list',$res);
            $this -> display();
        }
    }

    public function cz()
    {
        $m = M('pic');
        $res = [];
        $res['dlogo'] = $m -> where('cate = "zydlogo"') -> getField('pic');
        $res['banner'] = $m -> where('cate = "zybanner"') -> getField('pic');
        $this -> assign('pic',$res);
        $m = M('user');
        $res = $m -> where('name = "'.cookie('user').'"') -> find();
        $this -> assign('list',$res);
        $this -> display();
    }

    public function xc()
    {
        $m = M('pic');
        $res = [];
        $res['dlogo'] = $m -> where('cate = "zydlogo"') -> getField('pic');
        $res['banner'] = $m -> where('cate = "zybanner"') -> getField('pic');
        $this -> assign('pic',$res);
        $m = M('user');
        $res = $m -> where('name = "'.cookie('user').'"') -> find();
        $this -> assign('list',$res);
        $res = M('socket')->where(array('member'=>cookie('user'),'status'=>array('neq',2)))->order('id desc')->find();
        if($res){
            $this -> assign('washStatus',$res);
        }
        $this -> display();
    }

    public function order()
    {
        if($_POST['cate'] == '微信支付'){
//            $dougherty = M('dougherty')->find(I('post.dougherty_id'));
            $_POST['uname'] = cookie('user');
//            $_POST['passive_user_id'] = $dougherty['dougherty_user_id'];
//            $_POST['order_money'] = $dougherty['dougherty_worth'];
            $_POST['create_time'] = date('Y-m-d H:i:s');
            if($_POST['price'] == 0){
                $_POST['price'] = 0.01;
            }
            $out_trade_no = time().rand(1000,9999);
//            $_POST['passive_date'] = I('post.pickdate').' '.I('post.picktime');
            $_POST['out_trade_no'] = $out_trade_no;
            $res = M('order')->add(I('post.'));
            if($res){
                $url=U('Pay/pay',array('bespeak_id'=>$res));
                // 前往支付
                redirect($url);
            }else{
                $this->error('支付失败');
//                echo '<script>alert("预约失败!")</script>';
            }
        }else{
            $this->error('该支付方式未开放');
//            '<meta charset="utf-8"><script>alert("该支付方式未开放!")</script>';
        }
    }
}
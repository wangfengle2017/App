<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller
{
    public function index()
    {
        $this->display();
    }
    public function doLogin()
    {
        $data = M('administrator');
        $name = $_POST['username'];

        $pwd  = md5($_POST['password']);
        $res  = $data -> where( 'name ="'.$name.'" and password = "'.$pwd.'"') -> find();
        if($res){
            if($res['state'] == 0){
                $this -> error('账号锁定，无法登录',U('login/index'));
            }else{
                $_SESSION['admin_user'] = $name;
                $_SESSION['admin_role'] = $res['role'];
//                $_SESSION['admin_node'] = $res['node'];
//                getlog($_SESSION['admin_user'],'登录','登录');
                $this->redirect("Index/index");
            }
        }else {
            $this -> error('用户名或密码错误',U('login/index'));
        }

    }
    public function loginOut()
    {
        unset($_SESSION['admin_user']);
        $this->redirect("Index/index");
    }
}
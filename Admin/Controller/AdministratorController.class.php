<?php
namespace Admin\Controller;
class AdministratorController extends CommonController
{
    //显示账户管理页面
    public function index()
    {
        if($_SESSION['admin_role'] != 0){
            $this -> error('亲，您不是超级管理员！');
        }else{
            $m = M('administrator');
            $res = $m -> order('id desc') -> select();
            $this -> assign('list',$res);
            $this -> display();
        }
    }
    //添加管理员
    public function insert()
    {
        $data = [];
        $data['name'] = $_POST['name'];
        $data['password'] = md5($_POST['password']);
        $m = M('administrator');
        $result = $m -> where('name = "'.$data['name'].'"') -> find();
        if($result){
            $this -> error('亲，用户名已存在。请重新输入');
        }else{
            $res = $m -> data($data) -> add();
            if($res){
                $this -> success('创建成功');
            }else{
                $this -> error('亲，创建失败请重试');
            }
        }
    }
    //修改信息
    public function update()
    {
        $data = [];
        $name = I('ename');
        if($_POST['epassword'] != ''){
            $data['password'] = md5($_POST['epassword']);
            $m = M('administrator');
            $res = $m -> where('name = "'.$name.'"') -> setField($data);
            if($res){
                if($name == $_SESSION['admin_user']){
                    $this -> success('修改成功',U('login/loginOut'));
                }else{
                    $this -> success('修改成功');
                }

            }else{
                $this -> error('修改失败');
            }
        }else{
            $this -> error('密码不能为空');
        }
    }
    //删除管理员
    public function del()
    {
        $id = $_POST['id'];
        $m = M('administrator');
        $res = $m -> where('id ="'.$id.'"') -> delete();
        echo json_encode($res);
    }
    //显示用户管理页面
    public function administrator()
    {
        $m = M('administrator');
        $name = $_SESSION['admin_user'];
        $res = $m -> where('name = "'.$name.'"') -> find();
        $this -> assign('list',$res);
        $this -> display();

    }
    public function adupdate()
    {
        $data = [];
        $name = I('ename');
        if($_POST['epassword'] != ''){
            $data['password'] = md5($_POST['epassword']);
            $m = M('administrator');
            $res = $m -> where('name = "'.$name.'"') -> setField($data);
            if($res){
                if($name == $_SESSION['admin_user']){
                    $this -> success('修改成功',U('login/loginOut'));
                }else{
                    $this -> success('修改成功');
                }

            }else{
                $this -> error('修改失败');
            }
        }else{
            $this -> error('密码不能为空');
        }
    }
}
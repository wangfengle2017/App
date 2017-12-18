<?php
//设备管理模块控制器
namespace Admin\Controller;
class EquipController extends CommonController
{
    public function index()
    {
        $data = M('equip');
        if (I('key') != '') {
            // 存在搜索条件时执行此区间
            // 组合查询条件
            $map['eq_nu'] = array('LIKE', '%'.I('key').'%');
            $countRes = $data -> where($map) -> count();
            $page = new \Think\Page($countRes,15);
            // 将查询条件加入url参数中，如果有多个查询条件则可以遍历I()，对 $page -> parameter 进行赋值
            $page -> parameter['eq_nu'] = urlencode(I('key'));
            // 获取结果集
            $dataList = $data -> limit($page -> firstRow.','.$page -> listRows) -> where($map) -> order('id desc') -> select();
        } else {
            // 不存在搜索条件时执行此区间
            $countRes = $data -> count();
            $page = new \Think\Page($countRes,15);
            // 获取结果集
            $dataList = $data -> limit($page -> firstRow.','.$page -> listRows) -> order('id desc') -> select();
        }
        $page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('last', '末页');
        $page->setConfig('first', '首页');
        $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $page->lastSuffix = false;//最后一页不显示为总页数
        $show  = $page -> show();
        // 分配变量到前台，执行遍历
        $this -> assign('list',$dataList);
        $this -> assign('pageinfo',$show);
        $this -> display();
    }

    public function insert()
    {
        $data = [];
        $data['eq_nu'] = $_POST['nu'];
        $data['eq_addres'] = $_POST['addres'];
        $data['eq_name'] = $_POST['name'];
        $data['eq_time'] = date('Y-m-d H:i:s');
        $res = M('equip') -> add($data);
        if($res){
            $this -> success('添加成功');
        }else{
            $this -> error('添加失败');
        }
    }

    public function update()
    {
        $data = [];
        $data['eq_nu'] = $_POST['enu'];
        $data['eq_addres'] = $_POST['eaddres'];
        $data['eq_name'] = $_POST['ename'];
        $data['eq_time'] = date('Y-m-d H:i:s');
        $res = M('equip') -> where('id = '.$_POST['eid']) -> save($data);
        if($res){
            $this -> success('修改成功');
        }else{
            $this -> error('修改失败');
        }
    }

    public function del()
    {
        $id = $_POST['id'];
        $res = M('equip') -> where('id = '.$id) -> delete();
        echo json_encode($res);
    }

    public function use_equip()
    {
        $data = M('eq_log');
        if (I('key') != '') {
            // 存在搜索条件时执行此区间
            // 组合查询条件
            $map['eq_nu'] = array('LIKE', '%'.I('key').'%');
            $map['cate']='0';
            $countRes = $data -> where($map) -> count();
            $page = new \Think\Page($countRes,15);
            // 将查询条件加入url参数中，如果有多个查询条件则可以遍历I()，对 $page -> parameter 进行赋值
            $page -> parameter['eq_nu'] = urlencode(I('key'));
            // 获取结果集
            $dataList = $data -> limit($page -> firstRow.','.$page -> listRows) -> where($map) -> order('id desc') -> select();
        } else {
            // 不存在搜索条件时执行此区间
            $countRes = $data ->where(array('cate'=>'0'))-> count();
            $page = new \Think\Page($countRes,15);
            // 获取结果集
            $dataList = $data ->where(array('cate'=>'0')) -> limit($page -> firstRow.','.$page -> listRows) -> order('id desc') -> select();
        }
        $page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('last', '末页');
        $page->setConfig('first', '首页');
        $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $page->lastSuffix = false;//最后一页不显示为总页数
        $show  = $page -> show();
        // 分配变量到前台，执行遍历
        $this -> assign('list',$dataList);
        $this -> assign('pageinfo',$show);
        $this -> display();
    }
    public function equip_log()
    {
        $data = M('eq_log');
        if (I('key') != '') {
            // 存在搜索条件时执行此区间
            // 组合查询条件
            $map['eq_nu'] = array('LIKE', '%'.I('key').'%');
            $map['cate']='1';
            $countRes = $data -> where($map) -> count();
            $page = new \Think\Page($countRes,15);
            // 将查询条件加入url参数中，如果有多个查询条件则可以遍历I()，对 $page -> parameter 进行赋值
            $page -> parameter['eq_nu'] = urlencode(I('key'));
            // 获取结果集
            $dataList = $data -> limit($page -> firstRow.','.$page -> listRows) -> where($map) -> order('id desc') -> select();
        } else {
            // 不存在搜索条件时执行此区间
            $countRes = $data ->where(array('cate'=>'1'))-> count();
            $page = new \Think\Page($countRes,15);
            // 获取结果集
            $dataList = $data ->where(array('cate'=>'1')) -> limit($page -> firstRow.','.$page -> listRows) -> order('id desc') -> select();
        }
        $page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('last', '末页');
        $page->setConfig('first', '首页');
        $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $page->lastSuffix = false;//最后一页不显示为总页数
        $show  = $page -> show();
        // 分配变量到前台，执行遍历
        $this -> assign('list',$dataList);
        $this -> assign('pageinfo',$show);
        $this -> display();
    }
}
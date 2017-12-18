<?php
namespace Admin\Controller;
class UserController extends CommonController
{
    public function index()
    {
        $data = M('user');
        if (I('key') != '') {
            // 存在搜索条件时执行此区间
            // 组合查询条件
            $map['name'] = array('LIKE', '%'.I('key').'%');
            $countRes = $data -> where($map) -> count();
            $page = new \Think\Page($countRes,15);
            // 将查询条件加入url参数中，如果有多个查询条件则可以遍历I()，对 $page -> parameter 进行赋值
            $page -> parameter['name'] = urlencode(I('key'));
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

    public function paycheck()
    {
        $data = M('order');
        if (I('key') != '') {
            // 存在搜索条件时执行此区间
            // 组合查询条件
            $map['uname'] = array('LIKE', '%'.I('key').'%');
            $countRes = $data -> where($map) -> count();
            $page = new \Think\Page($countRes,15);
            // 将查询条件加入url参数中，如果有多个查询条件则可以遍历I()，对 $page -> parameter 进行赋值
            $page -> parameter['uname'] = urlencode(I('key'));
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

    public function consume()
    {
        $data = M('user_log');
        if (I('key') != '') {
            // 存在搜索条件时执行此区间
            // 组合查询条件
            $map['user'] = array('LIKE', '%'.I('key').'%');
            $countRes = $data -> where($map) -> count();
            $page = new \Think\Page($countRes,15);
            // 将查询条件加入url参数中，如果有多个查询条件则可以遍历I()，对 $page -> parameter 进行赋值
            $page -> parameter['user'] = urlencode(I('key'));
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

    public function deal()
    {
        if(I('cate') == 'order'){
            $id = I('id');
            $res = M('order') -> where('id = '.$id) -> delete();
        }
        echo json_encode($res);
    }
}
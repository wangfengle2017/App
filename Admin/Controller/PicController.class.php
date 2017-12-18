<?php
namespace Admin\Controller;
class PicController extends CommonController
{
    public function index()
    {
        $data = M('pic');
        if (I('key') != '') {
            // 存在搜索条件时执行此区间
            // 组合查询条件
            $map['name'] = array('LIKE', '%'.I('key').'%');
            $countRes = $data -> where($map) -> count();
            $page = new \Think\Page($countRes,15);
            // 将查询条件加入url参数中，如果有多个查询条件则可以遍历I()，对 $page -> parameter 进行赋值
            $page -> parameter['name'] = urlencode(I('key'));
            // 获取结果集
            $dataList = $data -> limit($page -> firstRow.','.$page -> listRows) -> where($map) -> order('cate asc') -> select();
        } else {
            // 不存在搜索条件时执行此区间
            $countRes = $data -> count();
            $page = new \Think\Page($countRes,15);
            // 获取结果集
            $dataList = $data -> limit($page -> firstRow.','.$page -> listRows) -> order('cate asc') -> select();
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
        $mod = M('pic_cate');
        $res = $mod -> select();
        $this -> assign('cate',$res);
        $this -> display();
    }

    public function insert()
    {
        $m = M('pic');
        $data = [];
        $res = $m -> where('cate = "'.$_POST['cate'].'"') -> find();
        if($res){
            $this -> error('该分类已有图片，请重试');
        }else{
            $mod = M('pic_cate');
            $cate = $mod -> where('cate = "'.$_POST['cate'].'"') -> find();
            $data['name'] = $cate['name'];
            $config = array(
                'maxSize'    =>    10*1024*1024,
                'rootPath'   =>    'Public/',
                'savePath'   =>    '/Upload/Pic/',
                'saveName'   =>    $_POST['cate'].'_'.mt_rand(1000,9999),
                'autoSub'    =>    false,
                'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
            );
            $upload = new \Think\Upload($config);
            $info = $upload -> upload();
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功 获取上传文件信息
                foreach($info as $file){
                    $data['cate'] = $_POST['cate'];
                    $data['pic'] = $file['savename'];
                    $result = $m -> data($data) -> add();
                    if($result){
                        $this -> success('添加成功',U('pic/index'));
                    }else{
                        $this -> error('添加失败');
                    }
                }
            }
        }
    }

    public function update()
    {
        $m = M('pic');
        $config = array(
            'maxSize'    =>    10*1024*1024,
            'rootPath'   =>    'Public/',
            'savePath'   =>    '/Upload/Pic/',
            'saveName'   =>    $_POST['ycate'].'_'.mt_rand(1000,9999),
            'autoSub'    =>    false,
            'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
        );
        $upload = new \Think\Upload($config);
        $info = $upload -> upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功 获取上传文件信息
            foreach($info as $file){
                $pic = $file['savename'];
                $result = $m -> where('id = "'.$_POST['yid'].'"') -> setField('pic',$pic);
                if($result){
                    unlink('Public/Upload/Pic/'.$_POST['ypic']);
                    $this -> success('更换成功',U('pic/index'));
                }else{
                    $this -> error('更换失败');
                }
            }
        }

    }

    public function del()
    {
        $id = $_POST['id'];
        $m = M('pic');
        $res = $m -> where('id = "'.$id.'"') -> delete();
        if($res){
            unlink('Public/Upload/Pic/'.$_POST['pic']);
            $this -> success('删除成功',U('pic/index'));
        }else{
            $this -> error('删除失败');
        }
    }
}
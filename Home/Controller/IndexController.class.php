<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        if(cookie('user') == null){
            $m = M('pic');
            $res = [];
            $res['xlogo'] = $m -> where('cate = "syxlogo"') -> getField('pic');
            $res['dlogo'] = $m -> where('cate = "sydlogo"') -> getField('pic');
            $res['banner'] = $m -> where('cate = "sybanner"') -> getField('pic');
            $this -> assign('pic',$res);
            $this->display();
        }else{
            $this -> redirect('user/index');
        }
    }
}
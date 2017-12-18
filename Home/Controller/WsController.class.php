<?php
namespace Home\Controller;
use Think\Controller;
class WsController extends Controller
{

    public function member_status()
    {
        $res = M('socket') -> where(array('member'=>I('user'))) -> order('time desc') -> find();
        if($res){
            if($res['num']-5>0&&$res['status']!=2){
                M('equip')->where(array('eq_nu'=>$res['eq_nu']))->save(array('run_status'=>1,'status'=>0));
                eqlog($res['eq_nu'],'设备'.$res['eq_nu'].'洗车请求五次无相应，认为该设备故障断开连接',1);
                 $memberData = M('user')->where(array('name'=>cookie('user')))->find();
                 $price = $memberData['ye']+$res['washtime']/60;
                 M('user') -> where(array('name'=>cookie('user'))) -> setField('ye',$price);
                 M('socket') -> where(array('id'=>$res['id']))  -> setField('status',2);
                 userlog(cookie('user'),'设备故障返回金钱',$res['washtime']/60);
                $result = array(
                    'status' => 'no',
                    'msg' => '设备出现故障，请换台机器,金钱已返还',
                );
            }else{
                $nowtime = time();
                $totaltime = $res['time']+$res['washtime'];
                if($nowtime > $totaltime && $res['status'] != 2){
                    $save = array(
                            'status' => 2,
                            'type' => 1
                        );
                    M('socket') -> where(array('id'=>$res['id']))  -> save($save);
                    $result = array(
                        'status' => 'no',
                        'msg' => '洗车已结束，欢迎下次再来'
                    );
                    M('equip')->where(array('eq_nu'=>$res['eq_nu']))->save(array('status'=>0));
                }else{
                    if($res['status'] == 0){
                        $result = array(
                            'status' => 'ok',
                            'msg' => '正在链接设备中，请稍后'
                        );
                    }elseif($res['status'] == 1){
                        $result = array(
                            'status' => 'ok',
                            'msg' => '正在洗车中'
                        );
                    }else{
                        $result = array(
                            'status' => 'no',
                            'msg' => '洗车已结束，欢迎下次再来'
                        );
                        M('equip')->where(array('eq_nu'=>$res['eq_nu']))->save(array('status'=>0));
                    }
                }
                 
            }
        }else{
            $result = array(
                'status' => 'err',
                'msg' => '没有洗车记录'
            );
        }
        $memberData = M('user')->where(array('name'=>cookie('user')))->find();
        $result['money'] = $memberData['ye'];
        echo json_encode($result);
    }

    public function member_wash()
    {
        $key = (int)I('key');
        $time = I('time');
        $money = I('money');
        if($time-$money>0){
            $time = (int)$money;
        }
        $user = I('user');
        $socket = M('socket') -> where(array('member'=>I('user'))) -> order('time desc') -> find();
        if($socket){
            if($socket['status'] != 2){
                $result = array(
                    'status' => 'no',
                    'msg' => '请勿重复开锁'
                );
                echo json_encode($result);exit;
            }
        }
        $res = M('equip') -> where(array('eq_nu'=>$key))->find();
        if($res){
            if($res['run_status'] == 0 && $res['status'] == 0){
                $data = array(
                    'member' => $user,
                    'eq_nu' => $key,
                    'client_id' => $res['client_id'],
                    'time' => time(),
                    'washtime' => $time*60,
                    'status' => 0
                );
                $re = M('socket') -> add($data);
                if($re){
                    eqlog($key,'用户'.I('user').'开启设备'.$key.'洗车,预计洗车时间'.$time.'分钟',0);
                    $memberData = M('user')->where(array('name'=>cookie('user')))->find();
                    $price = $memberData['ye']-$time;
                    M('user') -> where(array('name'=>cookie('user'))) -> setField('ye',$price);
                    userlog(cookie('user'),'开启设备花费金钱',$time);
                    $result = array(
                        'status' => 'ok',
                        'msg' => '正在链接设备中，请耐心等待',
                        'money'=>$price 
                    );
                }else{
                    $result = array(
                        'status' => 'no',
                        'msg' => '链接设备失败，请重试'
                    );
                }
            }else{
                $result = array(
                    'status' => 'no',
                    'msg' => '设备正在使用中，或设备故障'
                );
            }
        }else{
            $result = array(
                'status' => 'no',
                'msg' => '设备号错误'
            );
        }
        echo json_encode($result);
    }
    public function member_stop()
    {
        $user = I('user');
        $res = M('socket')->where(array('member'=>$user,'status'=>array('neq',2)))->order('time desc')->find();
        if($res){
            $array=array(
                    'status'=>2,
                    'type'=>1
                );
            M('socket')->where(array('member'=>$user,'status'=>array('neq',2)))->save($array);
            $time=($res['washtime']-$res['water'])/60;
            $memberData = M('user')->where(array('name'=>cookie('user')))->find();
            $price = $memberData['ye']+$time;
            M('user') -> where(array('name'=>cookie('user'))) -> setField('ye',$price);
            userlog(cookie('user'),'主动停止设备返回金钱',$time);
            $result=array(
                'code'=>1,
                'msg'=>'停止洗车成功，10S内机器停止，剩余金钱已返回',
                'money'=>$price
            );
        }else{
            $result=array(
                'code'=>0,
                'msg'=>'停止洗车出错，没有找到相关洗车记录'
            );
        }
        echo json_encode($result);
    }
    public function tcp()
    {
        $type = I('cmd');
        switch($type){
            case 'heart':
                $eq_nu = I('id');
                $res = M('equip') -> where(array('eq_nu'=>$eq_nu))->find();
                if($res){
                    $array=array(
                        'id'=>$res['id'],
                        'client_id'=>I('client_id'),
                        'run_status'=>0,
                        'hearttime'=>time(),
                        );
                    if($res['run_status'] == 1){
                        $array['status'] = 0;
                    }
                    M('equip')->save($array);
                    M('socket')->where(array('status'=>array('neq','2'),'eq_nu'=>$eq_nu))->setField('client_id',I('client_id'));
                    $data = array(
                        "cmd"=>"heart",
                        "vision"=>I('vision'),
                        "res" =>'ok'
                    );
                }else{
                    $arr = array(
                            'eq_nu'=>$eq_nu,
                            'client_id'=>I('client_id'),
                            'hearttime' => time(),
                            'time'=>time()
                        );
                    M('equip')->add($arr);
                    $data = array(
                        "cmd" => "heart",
                        "id" => $eq_nu,
                        "res" => "ok"
                    );
                }
                break;
            // case 'creat':
            //     $data = array(
            //         'client_id'=>I('client_id'),
            //         'time' => time()
            //     );
            //     $id = M('equip') -> add($data);
            //     if($id){
            //         $data = array(
            //             "cmd" => "creat",
            //             "id" => $id,
            //             "res" => "ok"
            //         );
            //     }else{
            //         $data = array(
            //             "cmd" => "creat",
            //             "id" => 0,
            //             "res" => "设备连接socket失败"
            //         );
            //     }
            //     break;
            case 'washtime':
                $eq_nu =I('id');
                $r = M('socket') -> where(array('eq_nu'=>$eq_nu,'status'=>'1'))->order('id desc')->find();
                if(I('time')-$r['washtime']>0){
                    M('socket') -> where(array('eq_nu'=>$eq_nu,'status'=>'1'))->order('id desc')->setField('status',2);
                    $array=array(
                        'run_status'=>1,
                        'status'=>0
                        );
                    M('equip')->where(array('eq_nu'=>$eq_nu))->save($array);
                    eqlog($eq_nu,'设备'.$eq_nu.'洗车时间超时，服务器认为该设备故障，故强制停止洗车',1);
                    $data = array(
                        "cmd" => "stopwash",
                        'time' => $r['washtime'],
                        'id'=>$eq_nu
                    );
                    break;
                }
                $save = array(
                    'water' => I('time')
                );
                if(I('washstate') == 'washing'){
                    $status = 1;
                }else{
                    $status = 1;
                    $save['status']=2;
                     M('equip')->where(array('eq_nu'=>$eq_nu))->save(array('status'=>0));
                }
                $res = M('socket') -> where(array('eq_nu'=>$eq_nu,'status'=>$status))->save($save);
                if($res){
                    $data = array(
                        "cmd" => "washtime",
                        'res' => "ok"
                    );
                }else{
                    $data = array(
                        "cmd" => "washtime",
                        'res' => "fail"
                    );
                }
                break;
            case 'sysstate':
                $eq_nu = I('id');
                $err =I('err');
                $equip = M('equip') -> where(array('eq_nu'=>$eq_nu)) -> getField('run_status');
                if($err == 'no'){
                    if($equip != 0){
                        M('equip') -> where(array('eq_nu'=>$eq_nu)) -> setField('run_status',0);
                    }
                }else{
                    M('equip') -> where(array('eq_nu'=>$eq_nu)) -> setField('run_status',1);
                }
                $data = array(
                    "cmd" => "sysstate",
                    'res' => "ok"
                );
                break;
            case 'close':
                $client_id = I('client_id');
                M('equip') -> where(array('client_id'=>$client_id)) -> setField('socket',1);
                break;
            case 'startwash':
                if(I('res') == 'ok'){
                    $res = M('socket') -> where(array('eq_nu'=>I('id'),'status'=>0)) -> setField('status',1);
                    M('equip') -> where(array('eq_nu'=>I('id'))) -> setField('status',1);
                    $data = array(
                        "cmd" => "startwash",
                        'res' => "ok"
                    );
                }else{
                    M('equip') -> where(array('eq_nu'=>I('id'))) -> setField('run_status',1);
                    $data = array(
                        "cmd" => "startwash",
                        'res' => "fail"
                    );
                }
                break;
        }
        echo  json_encode($data);
    }

    public function ajax_wash()
    {
        $res = M('socket') -> where(array('num'=>array('lt','6'),'status'=>array('neq',2))) -> select();
       if($res){
           foreach($res as $k => $v){
                if($v['status']==0){
                    $result[$k]['client_id'] = $v['client_id'];
                   $result[$k]['id'] = $v['eq_nu'];
                   $result[$k]['cmd'] = "startwash";
                   $result[$k]['time'] =$v['washtime'];
                   M('socket') -> where(array('id'=>$v['id'])) -> setInc('num');
               }elseif($v['status']==1&&$v['water']-$v['washtime']>=0){
                    $result[$k]['client_id'] = $v['client_id'];
                    $result[$k]['id'] = $v['eq_nu'];
                    $result[$k]['cmd'] = "stopwash";
                    $result[$k]['time'] =$v['water'];
                    M('socket') -> where(array('id'=>$v['id'])) -> setField('status',2);
                    M('equip')->where(array('eq_nu'=>$v['eq_nu']))->save(array('status'=>0));
               }elseif($v['status']==2&&$v['type']==1){
                    $result[$k]['client_id'] = $v['client_id'];
                    $result[$k]['id'] = $v['eq_nu'];
                    $result[$k]['cmd'] = "stopwash";
                    $result[$k]['time'] =$v['water'];
                    M('socket') -> where(array('id'=>$v['id'])) -> setField('type',0);
                    M('equip')->where(array('eq_nu'=>$v['eq_nu']))->save(array('status'=>0));
               }else{
                    $result [0]['id']=0;
               }
               
           }
       }else{
            $result [0]['id']=0;
       }
       $res1 = M('socket') -> where(array('status'=>2,'type'=>1)) -> select();
       if($res1){
            foreach ($res1 as $k => $v) {
                $arr = array(
                        'client_id'=>$v['client_id'],
                        'id'=>$v['eq_nu'],
                        'cmd'=>"stopwash",
                        'time'=>$v['water']
                    );
                array_push($result,$arr);
                M('socket') -> where(array('id'=>$v['id'])) -> setField('type',0);
                M('equip')->where(array('eq_nu'=>$v['eq_nu']))->save(array('status'=>0));
            }
       }
        echo  json_encode($result);
    }
    public function ajax_heart()
    {
        if(I('post.')){
            $time = time();
            $time = $time-600;
            $res = M('equip')->where(array('hearttime'=>array('lt',$time),'run_status'=>0))->select();
            foreach($res as $k => $v){
                M('equip')->where(array('id'=>$v['id']))->save(array('run_status'=>1,'status'=>0));
                eqlog($v['eq_nu'],'设备'.$v['eq_nu'].'心跳超时，默认该设备已掉线',1);
            }
            $msg = 'heart';
            echo json_encode($msg);
        }else{
            $this -> display();
        }
        
    }
}
<?php
namespace Home\Controller;
use Think\Controller;
header("Content-Type:text/html; charset=utf-8");
class PayController extends Controller {
    public function pay()
    {
             // 导入微信支付sdk
        Vendor('Weixinpay.Weixinpay');
        $wxpay=new \Weixinpay();
        // 获取jssdk需要用到的数据
        $data=$wxpay->getParameters();
        // 将数据分配到前台页面

        $assign=array(
            'data'=>json_encode($data)
            );
        $this->assign($assign);
        $this->display();
//        'default/pay'
    }

    /**
     * notify_url接收页面
     */
    public function notify(){
        // 导入微信支付sdk
        Vendor('Weixinpay.Weixinpay');
        $wxpay=new \Weixinpay();
        $result=$wxpay->notify();
//        dump($result);die;
        if ($result) {
            file_put_contents('./1.txt',$result);
            $id = $result['out_trade_no'];
            $res = M('order')->where('out_trade_no = '.$id)->save(['state'=>1]);
            $order = M('order')->where('out_trade_no = '.$id)->find();
            $m = M('user') -> where('name = '.$order['uname']) -> find();
            $m  = $m['ye'] + $order['price'];
            M('user') -> where('name = '.$order['uname']) -> save(['ye'=>$m]);

////            添加账单
//            $data = [
//                'income_user_id'=>$order['passive_user_id'],
//                'expend_user_id'=>$order['user_id'],
//                'totail'=> $order['order_money'],
//                'createtime'=>date('Y-m-d H:i:s'),
//                'remark'=>'创客预约',
//                'out_trade_no'=> $id
//            ];
//            M('bill')->add($data);
//            sendMessageTo($order['passive_user_id'],'【预约】您有新的预约消息','您有新的预约订单,请点击<a href="'.U("imarker/contactme").'">预约信息</a>进行处理。');
            // 验证成功 修改数据库的订单状态等 $result['out_trade_no']为订单id
            // 返回状态给微信服务器
            return '<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';
        }
    }

}
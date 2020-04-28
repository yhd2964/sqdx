<?php
namespace  app\api\controller;

use app\api\Model\Classify;
use app\api\Model\MarketingMethods;

use think\Controller;

class Index extends Controller{
    //获取首页数据
    public function getIndexData(){
           //所有产品分类
            $classify = new Classify();
            $classify = $classify->getAllClassify();

            //所有市场营销方式
            $methods = new MarketingMethods();
            $methods = $methods->getALlMethods();

            $indexData = ['status'=>'success',
                'data'=>array(
                    'classify'=>$classify,//产品分类
                    'methods'=>$methods,
                )
            ];
            return json($indexData);
    }

    //根据code获取openid
    function getOpenidByCode(){
        $code = isset($_POST['code'])?$_POST['code']:'';
        if (empty($code)){
            $data = ['status'=>'error','msg'=>'缺少参数code'];
            return json($data) ;
        }else{
            $appid = '';
            $appSerect = '';
            $url="https://api.weixin.qq.com/sns/jscode2session?appid=".$appid."&secret=".$appSerect."&js_code=".$code."&grant_type=authorization_code";
            $weixin=file_get_contents($url);//通过code换取网页授权access_token
            $jsondecode=json_decode($weixin); //对JSON格式的字符串进行编码
            $array = get_object_vars($jsondecode);//转换成数组
            file_put_contents('3.txt', $array);
            $openid = $array["openid"];
            $data = ['status' => 'success', 'openid' => $openid];
            return json($data);
        }

    }
}

?>
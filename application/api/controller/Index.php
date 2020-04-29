<?php
namespace  app\api\controller;

use app\api\Model\Classify;
use app\api\Model\MarketingMethods;
use app\api\Model\User;

use app\common\controller\httpCurl;

use think\console\command\make\Model;
use think\Controller;
use think\Request;

class Index extends Controller{
    //增加新用户
    public function addNewUser(Request $request){
        $param = $request->param();
        //获取微信基本信息
        $nickName = $param['nickName'];//微信昵称
        $sex = $param['sex'];//性别
        $photo = $param['photo'];//头像
        $WXCountry = $param['WXCountry'];//所在国家
        $WXCity = $param['WXCity'];//所在城市
        $WXProvince = $param['WXProvince'];//所在省份
        $code = $param['code'];//code
        //获取微信小程序的appid和appsecret
        $APPID = '';
        $SECRET = '';
        $JSCODE = $code;
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$APPID.'&secret='.$SECRET.'&js_code='.$JSCODE.'&grant_type=authorization_code';
        $wxjson = httpCurl::get($url);
        $wxdata = json_decode($wxjson);

        $openid = $wxdata->openid;
        //$unionid = $wxdata->unionid;

        //检测用户是否存在
        $member = new User();
        $count = $member->getUserInfoByOpenid($openid);
        if (!$count){//不存在
            $user = new Model('vshop_user');
            $user->wxid = $openid;
           // $user->unionid = $unionid; //添加  unionid
            $user->username=$nickName;
            $user->country = $WXCountry;
            $user->city = $WXCity;
            $user->province = $WXProvince;
            $user->create_time = date('Y-m-d H:i:s');
            $user->session_key=$wxdata->session_key;
            $rs = $user->save();
        }else{
            $vshop_member = new User();
            $res= $vshop_member
                ->find(array('wxid'=>$openid));
           // $res->unionid = $unionid; //添加  unionid
            $res->agent =1;
            $res->session_key=$wxdata->session_key;

            // 如果前端传来的用户信息不是空的在更新数据库
            if (isset($nickName) && isset($sex) && isset($photo) && $nickName!='' ){
                if($res->username != $nickName){
                        $res->username = $nickName;
                }
            }
            $res->save();
        }

        $UserInfo = array(
            "Id"=>$member->id,
            "UserName"=>'',
            "NickName"=>$member->nickName,
            "photo"=>$member->headimgurl,
            'WeiXinOpenId'=>$openid,
            "Sex"=>$member->sex,
            'IsNewUser'=>0,
            'session_key'=>$member->session_key
        );

        $dataList = array(
            'UserInfo'=>$UserInfo,
        );

        //返回数据
        $arr = array(
            'status'=>0,
            'msg'=>'ok',
            'data'=>$dataList
        );

    }

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
                    //其他需要的数据
                )
            ];
            return json($indexData);
    }

    //根据code获取openid，方便
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
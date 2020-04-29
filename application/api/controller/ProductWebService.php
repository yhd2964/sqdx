<?php
namespace app\api\controller;

use app\api\Model\Product;

use think\console\command\make\Model;
use think\Controller;
use think\Request;

class ProductWebService extends Controller{
    //获取商品详情
    public function getProductDetail(Request $request){
        //获取参数
        $param = $request->param();
        $productId = $param['productId'];

        //查询结果
        $model = new Product();
        $result = $model ->where(array('id'=>$productId))->find();

        //返回数据
        //return $result;
    }

    //商品列表， 搜索列表
    public function getAllSearchProductList(){
        $pageIndex = isset($_POST['pageIndex'])?$_POST['pageIndex']:1;//默认请求第一页数据
        $productName = isset($_POST['productName'])?$_POST['productName']:'';
        $pageSize = isset($_POST['pageSize'])?$_POST['pageSize']:10;//每页条数
        $lim = 	$pageSize*($pageIndex-1).','.$pageSize; //计算分页
        $where = array();
        if(trim($productName)){
            $where['name@~'] = $productName;
        }

        $m = new Model('vshop_product_list');
        $res = $m->field('id,name,pic,price')->where($where)
            ->limit($lim)
            ->list_all();
        $dataList = array();

        $i = 0;
        foreach($res as $_v){
            $dataList[$i]['id'] = $_v->id;
            $dataList[$i]['ProductPic'] = $_v->pic;
            $dataList[$i]['name'] = $_v->name;
            $dataList[$i]['price'] = $_v->lowest;
            $i++;
        }

        //返回数据
        $arr = array(
            'status' => 0,
            'msg' => 'ok',
            'data' => $dataList
        );
        return json($arr);
    }

}
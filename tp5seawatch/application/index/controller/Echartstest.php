<?php 
namespace app\index\controller;
use think\facade\Request;
use think\Controller;
use think\Db;
// use app\index\model\Nav;
header('content-type:text/html; charset=utf-8');

class Echartstest extends Common
{
	public function index(){


$title="测试标题";

$datas = [
	['name'=>'邮件营销','type'=>'line','stack'=>'总量','data'=>[120, 132, 101, 134, 90, 230, 210]],
	['name'=>'联盟广告','type'=>'line','stack'=>'总量','data'=>[220, 182, 191, 234, 290, 330, 310]],
	['name'=>'视频广告','type'=>'line','stack'=>'总量','data'=>[150, 232, 201, 154, 190, 330, 410]],
	['name'=>'直接访问','type'=>'line','stack'=>'总量','data'=>[320, 332, 301, 334, 390, 330, 320]],
	['name'=>'搜索引擎','type'=>'line','stack'=>'总量','data'=>[820, 932, 901, 934, 1290, 1330, 1320]],
];

// echo '<pre>';
// print_r($data);  //自己打印数组看清楚结构
// echo '<pre>';
// pre($datas);
$data = json_encode($datas); 

// pre($data);
 //PHP的数组转换成了你需要的json数据
$data=[
	'data'=>$data,
];
// pre($data);
// echo $data; //自己输出json数据看清楚是不是你要的json数据结构
// 
$this->assign($data);

return view('echartstest/echartstest');
}
}


// exit;


 ?>

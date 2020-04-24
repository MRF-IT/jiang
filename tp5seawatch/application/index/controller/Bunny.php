<?php 
namespace app\index\controller;
use think\facade\Request;
use think\Controller;
use think\Db;
// use app\index\model\Nav;

class Bunny extends Common
{
	public function index(){

		$data=[];
		$data['name']='zhanagsan';
		$data['age']=30;
		$data['sex']='nan';


		return success($data,'qingqiucg');

	}

}


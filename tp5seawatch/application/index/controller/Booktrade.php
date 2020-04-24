<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\facade\Request;
// use app\index\model\Nav;

class Booktrade extends Common
{
    public function index()
    {

      $list=Db::name('booktrade')->order('bookid desc')->paginate(15,false,['query'=>request()->param()]);
     
      $page=$list->render();
      $data=[

        'list'=>$list,
        
        'page'=>$page,
      ];

    $this->assign($data);

    	// 加载视图
        // return $this->fetch();  //方法
        return view('booktrade/booktrade'); //助手函数
    }

    
}

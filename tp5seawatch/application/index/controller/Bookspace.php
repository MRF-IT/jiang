<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\facade\Request;
// use app\index\model\Nav;

class Bookspace extends Common
{
    public function index()
    {

      $list=Db::name('bookspace')->order('bookid desc')->paginate(15,false,['query'=>request()->param()]);
      $sumtue=Db::name('bookspace')->sum('booktue'); 
      $total=$list->total();
      $page=$list->render();
      $data=[

        'list'=>$list,
        'sumtue'=>$sumtue,
        'total'=>$total,
        'page'=>$page,
      ];
return  success($data,'请求成功！');
    // $this->assign($data);

    // 	// 加载视图
    //     // return $this->fetch();  //方法
    //     return view('bookspace/bookspace'); //助手函数
    }

    
}

<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\facade\Request;
// use app\index\model\Nav;

class Trade extends Common
{
    public function index()
    {

      $list=Db::name('trade')->order('tradeid desc')->column('clerk');
      $tradeid=Db::name('trade')->order('tradeid desc')->column('tradeid');
      $tradelist=Db::name('trade')->order('tradeid desc')->paginate(15,false,['query'=>request()->param()]);
       $sumtue=Db::name('trade')->sum('teu'); 
      $total=$tradelist->total();
     
 
       
      // $listaddr=Db::name('addressbook')->order('addrid desc')->select();
    
         for($i=0;$i<count($list);$i++){    
             
             $list[$i]=preg_replace('#\ .*#','',$list[$i]);
             
            }
$listaddr=[];
       for($i=0;$i<count($list);$i++){

      $listaddr[]=Db::name('addressbook')->where('englishname','=',$list[$i])->column('name,nowdepart,nowmember');
      
        
    }
    
  $listaddress=[];
     foreach($listaddr as $value){  
        foreach($value as $v){  
             $listaddress[]=$v;  
        }  
    }

    // $listaddr = array_reduce($listaddr, 'array_merge', array());

        // $listaddr=array_values($listaddr);
        // pre($listaddress);
       
   $nowdepart = Db::name('trade')->column('nowdepart');
     
   if( $nowdepart[1]==''){

  
    for($i=0;$i<count($listaddress);$i++){
        
         $boolnowdepart=Db::name('trade')->where('tradeid','=',$tradeid[$i])->setField('nowdepart',$listaddress[$i]['nowdepart']);
         $boolnowmember=Db::name('trade')->where('tradeid','=',$tradeid[$i])->setField('nowmember',$listaddress[$i]['nowmember']);
        
       }
 }
      $page=$tradelist->render();
      $data=[

        'tradelist'=>$tradelist,
        'listaddr'=>$listaddr,
        'sumtue'=>$sumtue,
        'total'=>$total,
       
        'page'=>$page,
      ];
       

    $this->assign($data);

    	// 加载视图
        // return $this->fetch();  //方法
        return view('trade/trade'); //助手函数
    }

    
}

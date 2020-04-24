<?php 
namespace app\index\controller;
use think\facade\Request;
use think\Controller;
use think\Db;
// use app\index\model\Nav;

class Search extends Common
{
 public function index(){
    session_start();
foreach($_POST as $k=>$v){
    $_SESSION[$k]=$v;
  }

  $startday=input('param.startday','');

  $endday=input('param.endday','');


  $sday=strtotime($startday);
  

  $eday=strtotime($endday);
  // $bool=Db::name('bookspace')->where('bookdate','between time',[$sday,$eday])->delete();
  // if($bool){
  //    $this->success('删除成功!','index/search/index','',1);
  // }

  $bookdate=input('param.bookdate','');

  
    // echo $bookdate;

  $bookship=input('param.bookship','');
    // echo $bookship;



  $bookdepart=input('param.bookdepart','');
    // $starttime1=input('param.starttime','');
    // $starttime2=strtotime($starttime1);
    // $starttime=date('Y/m/d',$starttime2);

    // $closetime1=input('param.closetime','');
    // $closetime2=strtotime($closetime1);
    // $closetime=date('Y/m/d',$closetime2);

   // pre($bookdepart);

  $bookside=input('param.bookside','');


  if(!empty($bookship)&&!empty($bookdepart)&&!empty($startday)&&!empty($endday)&&!empty($bookside)){
   $list=Db::name('bookspace')->whereLike('bookdepart',"%".$bookdepart."%")->whereLike('bookship',"%".$bookship."%")->whereLike('bookside',"%".$bookside."%")->where('bookdate','between time',[$sday,$eday])->order('bookid desc')->paginate(15,false,['query'=>request()->param()]);  
   $sumtue=Db::name('bookspace')->whereLike('bookdepart',"%".$bookdepart."%")->whereLike('bookship',"%".$bookship."%")->whereLike('bookside',"%".$bookside."%")->where('bookdate','between time',[$sday,$eday])->sum('booktue');  

   $total=$list->total();






 }else if(!empty($startday)&&!empty($endday)&&!empty($bookship)&&!empty($bookside)){

   $list=Db::name('bookspace')->whereLike('bookship',"%".$bookship."%")->whereLike('bookside',"%".$bookside."%")->where('bookdate','between time',[$sday,$eday])->order('bookid desc')->paginate(15,false,['query'=>request()->param()]);
   $sumtue=Db::name('bookspace')->whereLike('bookship',"%".$bookship."%")->whereLike('bookside',"%".$bookside."%")->where('bookdate','between time',[$sday,$eday])->sum('booktue');  
   
    $total=$list->total();



 }else if(!empty($startday)&&!empty($endday)&&!empty($bookdepart)&&!empty($bookside)){
   $list=Db::name('bookspace')->where('bookdate','between time',[$sday,$eday])->whereLike('bookdepart',"%".$bookdepart."%")->whereLike('bookside',"%".$bookside."%")->order('bookid desc')->paginate(15,false,['query'=>request()->param()]); 
   $sumtue=Db::name('bookspace')->where('bookdate','between time',[$sday,$eday])->whereLike('bookdepart',"%".$bookdepart."%")->whereLike('bookside',"%".$bookside."%")->sum('booktue');  
   
   $total=$list->total();


 }else if(!empty($bookship)&&!empty($bookdepart)&&!empty($bookside)){
   $list=Db::name('bookspace')->whereLike('bookdepart',"%".$bookdepart."%")->whereLike('bookship',"%".$bookship."%")->whereLike('bookside',"%".$bookside."%")->order('bookid desc')->paginate(15,false,['query'=>request()->param()]); 
   $sumtue=Db::name('bookspace')->whereLike('bookdepart',"%".$bookdepart."%")->whereLike('bookship',"%".$bookship."%")->whereLike('bookside',"%".$bookside."%")->sum('booktue');  
   
   $total=$list->total();


 }else if(!empty($bookship)&&!empty($bookdepart)&&!empty($startday)&&!empty($endday)){
   $list=Db::name('bookspace')->whereLike('bookdepart',"%".$bookdepart."%")->whereLike('bookship',"%".$bookship."%")->where('bookdate','between time',[$sday,$eday])->order('bookid desc')->paginate(15,false,['query'=>request()->param()]); 
   $sumtue=Db::name('bookspace')->whereLike('bookdepart',"%".$bookdepart."%")->whereLike('bookship',"%".$bookship."%")->where('bookdate','between time',[$sday,$eday])->sum('booktue');  
   
    $total=$list->total();

 }else if(!empty($startday)&&!empty($endday)&&!empty($bookside)){

  $list=Db::name('bookspace')->where('bookdate','between time',[$sday,$eday])->whereLike('bookside',"%".$bookside."%")->order('bookid desc')->paginate(15,false,['query'=>request()->param()]); 
  $sumtue=Db::name('bookspace')->where('bookdate','between time',[$sday,$eday])->whereLike('bookside',"%".$bookside."%")->sum('booktue');  

   $total=$list->total();

}else if(!empty($bookship)&&!empty($bookside)){
 $list=Db::name('bookspace')->whereLike('bookship',"%".$bookship."%")->whereLike('bookside',"%".$bookside."%")->order('bookid desc')->paginate(15,false,['query'=>request()->param()]); 
 $sumtue=Db::name('bookspace')->whereLike('bookship',"%".$bookship."%")->whereLike('bookside',"%".$bookside."%")->sum('booktue');  

  $total=$list->total();


}else if(!empty($bookdepart)&&!empty($bookside)){
 $list=Db::name('bookspace')->whereLike('bookdepart',"%".$bookdepart."%")->whereLike('bookside',"%".$bookside."%")->order('bookid desc')->paginate(15,false,['query'=>request()->param()]); 
 $sumtue=Db::name('bookspace')->whereLike('bookdepart',"%".$bookdepart."%")->whereLike('bookside',"%".$bookside."%")->sum('booktue');  

  $total=$list->total();


}else if(!empty($startday)&&!empty($endday)&&!empty($bookship)){
  $list=Db::name('bookspace')->whereLike('bookship',"%".$bookship."%")->where('bookdate','between time',[$sday,$eday])->order('bookid desc')->paginate(15,false,['query'=>request()->param()]);
  $sumtue=Db::name('bookspace')->whereLike('bookship',"%".$bookship."%")->where('bookdate','between time',[$sday,$eday])->sum('booktue');  

  $total=$list->total();

}else if(!empty($startday)&&!empty($endday)&&!empty($bookdepart)){
 $list=Db::name('bookspace')->where('bookdate','between time',[$sday,$eday])->whereLike('bookdepart',"%".$bookdepart."%")->order('bookid desc')->paginate(15,false,['query'=>request()->param()]); 
 $sumtue=Db::name('bookspace')->where('bookdate','between time',[$sday,$eday])->whereLike('bookdepart',"%".$bookdepart."%")->sum('booktue');  

  $total=$list->total();

}else if(!empty($bookship)&&!empty($bookdepart)){
 $list=Db::name('bookspace')->whereLike('bookdepart',"%".$bookdepart."%")->whereLike('bookship',"%".$bookship."%")->order('bookid desc')->paginate(15,false,['query'=>request()->param()]); 
 $sumtue=Db::name('bookspace')->whereLike('bookdepart',"%".$bookdepart."%")->whereLike('bookship',"%".$bookship."%")->sum('booktue');  

  $total=$list->total();
}else if(!empty($startday)&&!empty($endday)){
  $list=Db::name('bookspace')->where('bookdate','between time',[$sday,$eday])->order('bookid desc')->paginate(15,false,['query'=>request()->param()]); 
  $sumtue=Db::name('bookspace')->where('bookdate','between time',[$sday,$eday])->sum('booktue');  

  $total=$list->total();
}else if(!empty($bookship)){
  $list=Db::name('bookspace')->whereLike('bookship',"%".$bookship."%")->order('bookid desc')->paginate(15,false,['query'=>request()->param()]); 
  $sumtue=Db::name('bookspace')->whereLike('bookship',"%".$bookship."%")->sum('booktue');  

   $total=$list->total();
}else if(!empty($bookdepart)){
  $list=Db::name('bookspace')->whereLike('bookdepart',"%".$bookdepart."%")->order('bookid desc')->paginate(15,false,['query'=>request()->param()]); 
  $sumtue=Db::name('bookspace')->whereLike('bookdepart',"%".$bookdepart."%")->sum('booktue');  

   $total=$list->total();
}else if(!empty($bookside)){
  $list=Db::name('bookspace')->whereLike('bookside',"%".$bookside."%")->order('bookid desc')->paginate(15,false,['query'=>request()->param()]);
  $sumtue=Db::name('bookspace')->whereLike('bookside',"%".$bookside."%")->sum('booktue');  

   $total=$list->total();
}else{
   $list=Db::name('bookspace')->order('bookid desc')->paginate(15,false,['query'=>request()->param()]);  
   $sumtue=Db::name('bookspace')->sum('booktue');  

   $total=$list->total();
}


$page = $list->render();

$data=[

  'list'=>$list,
  'sumtue'=>$sumtue,
  'total'=>$total,



  'page'=>$page,
];


$this->assign($data);




return view('bookspace/bookspace');


}

 public function second(){

    session_start();
     foreach($_POST as $k=>$v){
    $_SESSION[$k]=$v;
  }

        $startday=input('param.startday','');
        $endday=input('param.endday','');


        $sday=strtotime($startday);
        $eday=strtotime($endday);
       $bookso= input('post.bookso');
       $servicenumber=input('post.servicenumber');
       $bookdepart=input('post.bookdepart');
        if(!empty($bookso)&&!empty($servicenumber)&&!empty($bookdepart)&&!empty($startday)&&!empty($endday)){
           $list=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->whereLike('bookso',"%".$bookso."%")->whereLike('bookdepart',"%".$bookdepart."%")->whereLike('servicenumber',"%".$servicenumber."%")->order('bookid desc')->paginate(15,false,['query'=>request()->param()]);  
           $sumtue=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->whereLike('bookdepart',"%".$bookdepart."%")->whereLike('bookso',"%".$bookso."%")->whereLike('servicenumber',"%".$servicenumber."%")->sum('booktue');  

           $total=$list->total();
            }else if(!empty($bookso)&&!empty($bookdepart)&&!empty($startday)&&!empty($endday)){
              $list=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->whereLike('bookso',"%".$bookso."%")->whereLike('bookdepart',"%".$bookdepart."%")->order('bookid desc')->paginate(15,false,['query'=>request()->param()]);  
              $sumtue=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->whereLike('bookso',"%".$bookso."%")->whereLike('bookdepart',"%".$bookdepart."%")->sum('booktue');  

              $total=$list->total();

            }else if(!empty($servicenumber)&&!empty($bookdepart)&&!empty($startday)&&!empty($endday)){
              $list=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->whereLike('servicenumber',"%".$servicenumber."%")->whereLike('bookdepart',"%".$bookdepart."%")->order('bookid desc')->paginate(15,false,['query'=>request()->param()]);  
              $sumtue=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->whereLike('servicenumber',"%".$servicenumber."%")->whereLike('bookdepart',"%".$bookdepart."%")->sum('booktue');  

              $total=$list->total();

            }else if(!empty($bookso)&&!empty($bookdepart)&&!empty($servicenumber)){
               $list=Db::name('bookspace')->whereLike('bookso',"%".$bookso."%")->whereLike('servicenumber',"%".$servicenumber."%")->whereLike('bookdepart',"%".$bookdepart."%")->order('bookid desc')->paginate(15,false,['query'=>request()->param()]);  
              $sumtue=Db::name('bookspace')->whereLike('bookso',"%".$bookso."%")->whereLike('servicenumber',"%".$servicenumber."%")->whereLike('bookdepart',"%".$bookdepart."%")->sum('booktue');  

           $total=$list->total();
            }else if(!empty($servicenumber)&&!empty($bookdepart)){
               $list=Db::name('bookspace')->whereLike('servicenumber',"%".$servicenumber."%")->whereLike('bookdepart',"%".$bookdepart."%")->order('bookid desc')->paginate(15,false,['query'=>request()->param()]);  
              $sumtue=Db::name('bookspace')->whereLike('servicenumber',"%".$servicenumber."%")->whereLike('bookdepart',"%".$bookdepart."%")->sum('booktue');  

              $total=$list->total();

            }else if(!empty($bookso)&&!empty($bookdepart)){
              $list=Db::name('bookspace')->whereLike('bookso',"%".$bookso."%")->whereLike('bookdepart',"%".$bookdepart."%")->order('bookid desc')->paginate(15,false,['query'=>request()->param()]);  
              $sumtue=Db::name('bookspace')->whereLike('bookso',"%".$bookso."%")->whereLike('bookdepart',"%".$bookdepart."%")->sum('booktue');  

              $total=$list->total();
            }else if(!empty($startday)&&!empty($endday)&&!empty($bookdepart)){
              $list=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->whereLike('bookdepart',"%".$bookdepart."%")->order('bookid desc')->paginate(15,false,['query'=>request()->param()]);  
              $sumtue=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->whereLike('bookdepart',"%".$bookdepart."%")->sum('booktue');  

              $total=$list->total();
            }else if(!empty($bookdepart)){
                $list=Db::name('bookspace')->whereLike('bookdepart',"%".$bookdepart."%")->order('bookid desc')->paginate(15,false,['query'=>request()->param()]);  
              $sumtue=Db::name('bookspace')->whereLike('bookdepart',"%".$bookdepart."%")->sum('booktue');  

              $total=$list->total();
            }else if(!empty($bookso)){
                $list=Db::name('bookspace')->whereLike('bookso',"%".$bookso."%")->order('bookid desc')->paginate(15,false,['query'=>request()->param()]);  
              $sumtue=Db::name('bookspace')->whereLike('bookso',"%".$bookso."%")->sum('booktue');  

              $total=$list->total();
            }else if(!empty($startday)&&!empty($endday)){
                $list=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->order('bookid desc')->paginate(15,false,['query'=>request()->param()]);  
              $sumtue=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->sum('booktue');  

              $total=$list->total();
            }else if(!empty($servicenumber)){
                $list=Db::name('bookspace')->whereLike('servicenumber',"%".$servicenumber."%")->order('bookid desc')->paginate(15,false,['query'=>request()->param()]);  
              $sumtue=Db::name('bookspace')->whereLike('servicenumber',"%".$servicenumber."%")->sum('booktue');  

              $total=$list->total();

            }else{
              $list=Db::name('bookspace')->order('bookid desc')->paginate(15,false,['query'=>request()->param()]);  
              $sumtue=Db::name('bookspace')->sum('booktue');  

              $total=$list->total();
            }
        $page = $list->render();

        $data=[

          'list'=>$list,
          'sumtue'=>$sumtue,
          'total'=>$total,



          'page'=>$page,
        ];


        $this->assign($data);

    return view('search/search');
    

 }





public function trade(){
        
    session_start();
foreach($_POST as $k=>$v){
    $_SESSION[$k]=$v;
  }

       
         $startday=input('param.startday','');
        $endday=input('param.endday','');


        $sday=strtotime($startday);
        $eday=strtotime($endday);
        $shipowner=input('param.shipowner','');
        $destination=input('param.destination','');

        $destinationcountry=input('param.destinationcountry','');
        $departure=input('param.departure','');
        $departurecountry=input('param.departurecountry','');
        $routearea=input('param.routearea','');
        $bookingstatus=input('param.bookingstatus','');
        $preliminary=input('param.preliminary','');



// 按船东
// 按目的港
// 按目的港国家
// 按起运港
// 按起运港国家
// 按区域
// 按审核
// 按订舱状态
             

        if(!empty($startday)&&!empty($endday)&&!empty($shipowner)){
            $tradelist=Db::name('trade')->where('etdtime','between time',[$sday,$eday])->whereLike('shipowner',"%".$shipowner."%")->order('tradeid desc')->paginate(15,false,['query'=>request()->param()]);
            $sumtue=Db::name('trade')->where('etdtime','between time',[$sday,$eday])->whereLike('shipowner',"%".$shipowner."%")->sum('teu');  
           $total=$tradelist->total();


            }else if(!empty($startday)&&!empty($endday)&&!empty($destination)){

            $tradelist=Db::name('trade')->where('etdtime','between time',[$sday,$eday])->whereLike('destination',"%".$destination."%")->order('tradeid desc')->paginate(15,false,['query'=>request()->param()]);

            $sumtue=Db::name('trade')->where('etdtime','between time',[$sday,$eday])->whereLike('destination',"%".$destination."%")->sum('teu');  
           
            $total=$tradelist->total();
           


            }else if(!empty($startday)&&!empty($endday)&&!empty($destinationcountry)){
            $tradelist=Db::name('trade')->where('etdtime','between time',[$sday,$eday])->whereLike('destinationcountry',"%".$destinationcountry."%")->order('tradeid desc')->paginate(15,false,['query'=>request()->param()]);
            $sumtue=Db::name('trade')->where('etdtime','between time',[$sday,$eday])->whereLike('destinationcountry',"%".$destination."%")->sum('teu'); 


            $total=$tradelist->total();


          
            }else  if(!empty($startday)&&!empty($endday)&&!empty($departure)){
            $tradelist=Db::name('trade')->where('etdtime','between time',[$sday,$eday])->whereLike('departure',"%".$departure."%")->order('tradeid desc')->paginate(15,false,['query'=>request()->param()]);
             $sumtue=Db::name('trade')->where('etdtime','between time',[$sday,$eday])->whereLike('departure',"%".$departure."%")->sum('teu');  
            $total=$tradelist->total();
             $page = $tradelist->render();


            }else if(!empty($startday)&&!empty($endday)&&!empty($departurecountry)){
               $tradelist=Db::name('trade')->where('etdtime','between time',[$sday,$eday])->whereLike('departurecountry',"%".$departurecountry."%")->order('tradeid desc')->paginate(15,false,['query'=>request()->param()]);
           $sumtue=Db::name('trade')->where('etdtime','between time',[$sday,$eday])->whereLike('departurecountry',"%".$departurecountry."%")->sum('teu');  
            $total=$tradelist->total();
           

            }else if(!empty($startday)&&!empty($endday)&&!empty($routearea)){
               $tradelist=Db::name('trade')->where('etdtime','between time',[$sday,$eday])->whereLike('routearea',"%".$routearea."%")->order('tradeid desc')->paginate(15,false,['query'=>request()->param()]);
           $sumtue=Db::name('trade')->where('etdtime','between time',[$sday,$eday])->whereLike('routearea',"%".$routearea."%")->sum('teu');  
            $total=$tradelist->total();
            

            }else if(!empty($startday)&&!empty($endday)&&!empty($bookingstatus)){
               $tradelist=Db::name('trade')->where('etdtime','between time',[$sday,$eday])->whereLike('bookingstatus',"%".$bookingstatus."%")->order('tradeid desc')->paginate(15,false,['query'=>request()->param()]);
           $sumtue=Db::name('trade')->where('etdtime','between time',[$sday,$eday])->whereLike('bookingstatus',"%".$bookingstatus."%")->sum('teu');  
            $total=$tradelist->total();


            }else if(!empty($startday)&&!empty($endday)&&!empty($preliminary)){
               $tradelist=Db::name('trade')->where('etdtime','between time',[$sday,$eday])->whereLike('preliminary',"%".$preliminary."%")->order('tradeid desc')->paginate(15,false,['query'=>request()->param()]);
           $sumtue=Db::name('trade')->where('etdtime','between time',[$sday,$eday])->whereLike('preliminary',"%".$preliminary."%")->sum('teu');  
            $total=$tradelist->total();


            }
            else if(!empty($startday)&&!empty($endday)){
              $tradelist=Db::name('trade')->where('etdtime','between time',[$sday,$eday])->order('tradeid desc')->paginate(15,false,['query'=>request()->param()]);
            $sumtue=Db::name('trade')->where('etdtime','between time',[$sday,$eday])->sum('teu');  
           $total=$tradelist->total();
            }else if(!empty($shipowner)){
              $tradelist=Db::name('trade')->whereLike('shipowner',"%".$shipowner."%")->order('tradeid desc')->paginate(15,false,['query'=>request()->param()]);
            $sumtue=Db::name('trade')->whereLike('shipowner',"%".$shipowner."%")->sum('teu');  
           $total=$tradelist->total();
            }else if(!empty($destination)){

               $tradelist=Db::name('trade')->whereLike('destination',"%".$destination."%")->order('tradeid desc')->paginate(15,false,['query'=>request()->param()]);
              
           $sumtue=Db::name('trade')->whereLike('destination',"%".$destination."%")->sum('teu');  
            $total=$tradelist->total();
             

            }else if(!empty($destinationcountry)){
               $tradelist=Db::name('trade')->whereLike('destinationcountry',"%".$destinationcountry."%")->order('tradeid desc')->paginate(15,false,['query'=>request()->param()]);
           $sumtue=Db::name('trade')->whereLike('destinationcountry',"%".$destinationcountry."%")->sum('teu');  
            $total=$tradelist->total();


            }else  if(!empty($departure)){
               $tradelist=Db::name('trade')->whereLike('departure',"%".$departure."%")->order('tradeid desc')->paginate(15,false,['query'=>request()->param()]);
           $sumtue=Db::name('trade')->whereLike('departure',"%".$departure."%")->sum('teu');  
            $total=$tradelist->total();


            }else if(!empty($departurecountry)){
               $tradelist=Db::name('trade')->whereLike('departurecountry',"%".$departurecountry."%")->order('tradeid desc')->paginate(15,false,['query'=>request()->param()]);
           $sumtue=Db::name('trade')->whereLike('departurecountry',"%".$departurecountry."%")->sum('teu');  
            $total=$tradelist->total();
             $page = $tradelist->render();


            }else if(!empty($routearea)){
               $tradelist=Db::name('trade')->whereLike('routearea',"%".$routearea."%")->order('tradeid desc')->paginate(15,false,['query'=>request()->param()]);
           $sumtue=Db::name('trade')->whereLike('routearea',"%".$routearea."%")->sum('teu');  
            $total=$tradelist->total();
           
            }else if(!empty($bookingstatus)){
               $tradelist=Db::name('trade')->whereLike('bookingstatus',"%".$bookingstatus."%")->order('tradeid desc')->paginate(15,false,['query'=>request()->param()]);
           $sumtue=Db::name('trade')->whereLike('bookingstatus',"%".$bookingstatus."%")->sum('teu');  
            $total=$tradelist->total();
            }else if(!empty($preliminary)){
               $tradelist=Db::name('trade')->whereLike('preliminary',"%".$preliminary."%")->order('tradeid desc')->paginate(15,false,['query'=>request()->param()]);
           $sumtue=Db::name('trade')->whereLike('preliminary',"%".$preliminary."%")->sum('teu');  
            $total=$tradelist->total();
            }else{
              $tradelist=Db::name('trade')->order('tradeid desc')->paginate(15,false,['query'=>request()->param()]);
            $sumtue=Db::name('trade')->sum('teu');  
           $total=$tradelist->total();
            }

             
            
          
         
           
         
           //   
           //   
           //   if(!empty($startday)&&!empty($endday)){
           //     $tradelist=Db::name('trade')->where('etdtime','between time',[$startday,$endday])->order('tradeid desc')->paginate(15,false,['query'=>request()->param()]);
           // $sumtue=Db::name('trade')->where('etdtime','between time',[$startday,$endday])->sum('teu');  
           //  $total=$tradelist->total();
           //   $page = $tradelist->render();


           //  }
           //   if(!empty($shipowner)){
           //     $tradelist=Db::name('trade')->whereLike('shipowner',"%".$shipowner."%")->order('tradeid desc')->paginate(15,false,['query'=>request()->param()]);
           // $sumtue=Db::name('trade')->whereLike('shipowner',"%".$shipowner."%")->sum('teu');  
           //  $total=$tradelist->total();
           //   $page = $tradelist->render();


           //  }  
           //  


 $page = $tradelist->render();
       
        $data=[

          'tradelist'=>$tradelist,
          'sumtue'=>$sumtue,
          'total'=>$total,



          'page'=>$page,
        ];


        $this->assign($data);

    return view('trade/trade');
  
 }

}
?>
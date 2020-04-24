<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\facade\Request;


class Add extends Common
{
  public function index()
  {

  //   session_start();


  //   if(Request::isPost()){

      
  // foreach($_POST as $k=>$v){
  //   $_SESSION[$k]=$v;
  // }


  //     $data['bookclerk'] = trim(input('post.bookclerk'));
  //     $data['bookdate'] = strtotime(input('post.bookdate'));
  //     $data['bookpro'] = trim(input('post.bookpro'));
  //     $servicenumber=trim(input('post.servicenumber'));
  //     $data['servicenumber'] =$servicenumber; 
  //     $data['bookcydate'] = strtotime(input('post.bookcydate'));
  //     $data['book20gp'] = trim(input('post.book20gp'));
  //     $data['book40gp'] = trim(input('post.book40gp'));
  //     $data['book40hq'] = trim(input('post.book40hq'));
  //     $data['booktue'] = trim(input('post.booktue'));
  //     $data['hpl'] = trim(input('post.hpl'));
  //     $data['bookpol'] = trim(input('post.bookpol'));
  //     $data['bookpod'] = trim(input('post.bookpod'));
  //     $data['bookship'] = trim(input('post.bookship'));
  //     $data['bookside'] = trim(input('post.bookside'));
  //     $data['bookcontract'] = trim(input('post.bookcontract'));
  //     $data['bookso'] = trim(input('post.bookso'));
  //     $data['bookvelvoy'] = trim(input('post.bookvelvoy'));
  //     $data['bookdepart'] = trim(input('post.bookdepart'));
  //     $data['servicemanager'] = trim(input('post.servicemanager'));
  //     $data['serviceman'] = trim(input('post.serviceman'));
  //     $data['fileman'] = trim(input('post.fileman'));
  //     $data['recordingtime']=time();
  //     $data['cabinet'] = trim(input('post.cabinet'));
  //     $one=Db::name('bookspace')->where('servicenumber', $servicenumber)->select();
  //     if($one){
  //      $this->success('该业务单号已存在，或者该业务单号没填！','index/add/index','',1); 
  //     }else{
  //     $bool=Db::name('bookspace')->insert($data);
 
  //     if($bool){
  //       $bool=[];
  //       $bool['info']='添加成功！';

  //       // $this->success('添加成功!','index/add/index','',1);
  //       return success($bool,'请求成功');
  //     }
  //    }
       
  //   }else{
       return success($bool,'请求成功');
      // }
 
    

  }

  public function indextrade()
  {
 
    session_start();


    if(Request::isPost()){

      
    foreach($_POST as $k=>$v){
      $_SESSION[$k]=$v;
    }
  // 'clerk' => $clerk, 
  //               'referencenum' => $referencenum, 
                
  //               'bookingnum' => $bookingnum,
  //               'jobnum' => $jobnum, 
  //               'departurecountry' => $departurecountry,
  //               'departure' => $departure,
  //               'destination' => $destination,
  //               'destinationcountry' => $destinationcountry,
  //               'cabinettype' => $cabinettype,
  //               'type20' => $type20,
  //               'type40' => $type40,
  //               'type45' => $type45,
  //               'typehq' => $typehq,
  //               'othertype' => $othertype,
  //               'teu' => $teu,
  //               'etdtime' => $etdtime,
  //               'vevo' => $vevo,
  //               'routearea' => $routearea,
  //               'shipowner' => $shipowner,
  //               'contractno' => $contractno,
  //               'bookingstatus' => $bookingstatus,
  //               'preliminary' => $preliminary,
              

      $data['clerk'] = trim(input('post.clerk'));
    
     
      
      $data['referencenum'] =trim(input('post.referencenum'));
      $data['bookingnum'] = trim(input('post.bookingnum'));

      $jobnum=trim(input('post.jobnum'));
      $data['jobnum'] =$jobnum; 
      $data['departurecountry'] = trim(input('post.departurecountry'));
      $data['departure'] = trim(input('post.departure'));
      $data['destination'] = trim(input('post.destination'));
      $data['destinationcountry'] = trim(input('post.destinationcountry'));
      $data['cabinettype'] = trim(input('post.cabinettype'));
      $data['type20'] = trim(input('post.type20'));
      $data['type40'] = trim(input('post.type40'));
      $data['type45'] = trim(input('post.type45'));
      $data['typehq'] = trim(input('post.typehq'));

      $data['othertype'] = trim(input('post.othertype'));
      $data['teu'] = trim(input('post.teu'));
      $data['etdtime'] = strtotime(input('post.etdtime'));
      $data['vevo'] = trim(input('post.vevo'));
      $data['routearea'] = trim(input('post.routearea'));
      $data['shipowner'] = trim(input('post.shipowner'));
      $data['contractno'] = trim(input('post.contractno'));
      $data['bookingstatus'] = trim(input('post.bookingstatus'));
      $data['preliminary'] = trim(input('post.preliminary'));
      $data['nowdepart'] = trim(input('post.nowdepart'));
      $data['nowmember'] = trim(input('post.nowmember'));
      
     
     
   
     $one=Db::name('trade')->where('jobnum', $jobnum)->select();
      if($one){
       $this->success('该工作号已存在，或者工作号没填！','index/add/indextrade','',1); 
      }else{
      $bool=Db::name('trade')->insert($data);

      if($bool){
        $this->success('添加成功!','index/add/indextrade','',1);
     
     }
      }
    }else{

       
         
      return view('tradeadd/tradeadd');

    }
    

  }


  public function update(){

    $bookid=input('param.bookid',0);

    if(Request::isPost()){

      
      
      $data['bookclerk'] = trim(input('post.bookclerk'));
      $data['bookdate'] = strtotime(input('post.bookdate'));
      $data['bookpro'] = input('post.bookpro');
      $data['servicenumber'] = input('post.servicenumber');
      $data['bookcydate'] = strtotime(input('post.bookcydate'));

      $data['book20gp'] = trim(input('post.book20gp'));
      $data['book40gp'] = trim(input('post.book40gp'));
      $data['book40hq'] = trim(input('post.book40hq'));
      $data['booktue'] = trim(input('post.booktue'));
      $data['hpl'] = trim(input('post.hpl'));
      $data['bookpol'] = trim(input('post.bookpol'));
      $data['bookpod'] = trim(input('post.bookpod'));
      $data['bookship'] = trim(input('post.bookship'));
      $data['bookside'] = trim(input('post.bookside'));
      $data['bookcontract'] = trim(input('post.bookcontract'));
     
      $data['bookso'] = trim(input('post.bookso'));
      $data['bookvelvoy'] = trim(input('post.bookvelvoy'));
      $data['bookdepart'] = trim(input('post.bookdepart'));
      $data['servicemanager'] = trim(input('post.servicemanager'));
      $data['serviceman'] = trim(input('post.serviceman'));
      $data['fileman'] = trim(input('post.fileman'));
      $data['recordingtime']=time();
      $data['cabinet'] = trim(input('post.cabinet'));

      
      $bool=Db::name('bookspace')->where('bookid','=',$bookid)->update($data);
     


      if($bool){

        $this->success('修改成功!',url('index/bookspace/index'),'',1);
      }else{
         $this->success('修改成功!',url('index/bookspace/index'),'',1);
      }

    }else{
      
      
      
      $list=Db::name('bookspace')->where('bookid','=',$bookid)->find();
      $data=[
       'list'=>$list,
     ];

     $this->assign($data);
     return view('bookupdate/bookupdate');

   }



 }


 public function tradeupdate(){
 
    $tradeid=input('param.tradeid',0);
   
    if(Request::isPost()){

      
      
     $data['clerk'] = trim(input('post.clerk'));
    
      $data['nowdepart'] = trim(input('post.nowdepart'));
      $data['nowmember'] = trim(input('post.nowmember'));
      
      
      $data['referencenum'] =trim(input('post.referencenum'));
      $data['bookingnum'] = trim(input('post.bookingnum'));
      $data['jobnum'] = trim(input('post.jobnum'));
      $data['departurecountry'] = trim(input('post.departurecountry'));
      $data['departure'] = trim(input('post.departure'));
      $data['destination'] = trim(input('post.destination'));
      $data['destinationcountry'] = trim(input('post.destinationcountry'));
      $data['cabinettype'] = trim(input('post.cabinettype'));
      $data['type20'] = trim(input('post.type20'));
      $data['type40'] = trim(input('post.type40'));
      $data['type45'] = trim(input('post.type45'));
      $data['typehq'] = trim(input('post.typehq'));

      $data['othertype'] = trim(input('post.othertype'));
      $data['teu'] = trim(input('post.teu'));
      $data['etdtime'] = strtotime(input('post.etdtime'));
      $data['vevo'] = trim(input('post.vevo'));
      $data['routearea'] = trim(input('post.routearea'));
      $data['shipowner'] = trim(input('post.shipowner'));
      $data['contractno'] = trim(input('post.contractno'));
      $data['bookingstatus'] = trim(input('post.bookingstatus'));
      $data['preliminary'] = trim(input('post.preliminary'));
     
      
      $bool=Db::name('trade')->where('tradeid','=',$tradeid)->update($data);
     


      if($bool){

        $this->success('修改成功!',url('index/trade/index'),'',1);
      }else{
         $this->success('修改成功!',url('index/trade/index'),'',1);
      }

    }else{
      
      
      
      $list=Db::name('trade')->where('tradeid','=',$tradeid)->find();
      $data=[
       'list'=>$list,
     ];

     $this->assign($data);
     return view('tradeupdate/tradeupdate');

   }



 }
 public function tradedelete(){
     $tradeid=input('param.tradeid',0);
   
      

     $bool=Db::name('trade')->where('tradeid','=',$tradeid)->delete();
    
    
     if($bool){
      $this->success('已删除!',url("index/trade/index"),'',1);
     }
   }


   public function delete(){
     $bookid=input('param.bookid',0);
      

     $bool=Db::name('bookspace')->where('bookid','=',$bookid)->delete();
    
    
     if($bool){
      $this->success('已删除!',url("index/bookspace/index"),'',1);
     }
   }
}

<?php 
namespace app\index\controller;
use think\facade\Request;
use think\Controller;
use think\Db;
// use app\index\model\Nav;

class Pneumonia extends Common
{
	protected $batchValidate = true;
     public function navcheck(){



         $result = $this->validate(input('post.'),'app\index\validate\Pneumonia');

           

        if (true !== $result) {
            // 验证失败 输出错误信息
          
         
           return $result;

       }else{
            return true;
            }

     }

  

	public function index(){
  
	if(Request::isPost()){


		 if (true !== $this->navcheck()) {
            // 验证失败 输出错误信息
         
           $check=$this->navcheck();
         	$list=Db::name('depart')->order('id asc')->select();
			$data=[
			'list'=>$list,
			'check'=>$check,
		];
		$this->assign($data);
           return view('pneumonia/pneumonia');

       }else{
           


    $username= input('post.username');
	  $data['username'] = $username;
	  $data['englishname'] = input('post.englishname');
    $bookday = strtotime(input('post.bookday'));
	  $data['bookday'] = $bookday;
	  $data['temperature'] = input('post.temperature');
	  $data['pneumonia'] = input('post.pneumonia');

      $data['depart'] = input('post.depart');
      $data['optionsz'] = input('post.optionsz');
      $data['healthy'] = input('post.healthy');
      $data['place'] = input('post.place');
      $data['placem'] = input('post.placem');
      $data['goday'] = strtotime(input('post.goday'));
      $data['optionhb'] = input('post.optionhb');
      $data['leaveday'] = strtotime(input('post.leaveday'));
      $data['optionjc'] = input('post.optionjc');
      $data['optionbin'] = input('post.optionbin');   
      $data['recordingtime']=time();
      $data['outdoors']=input('post.outdoors');
      $data['mask']=input('post.mask');
      $data['masknum']=trim(input('post.masknum'));
      $data['lmask']=input('post.lmask');
     
      $one=Db::name('pneumonia')->where('username', $username)->where('bookday', $bookday)->select();
   

if($one){
$this->success('您今天已经填过了，谢谢!','index/pneumonia/index','',1);
}else{

      $bool=Db::name('pneumonia')->insert($data);

      if($bool){
        $this->success('添加成功!','index/pneumonia/protact','',1);
      }
      }
 	 }


		}else{

		$list=Db::name('depart')->order('id asc')->select();
		$data=[
			'list'=>$list,
		];
		$this->assign($data);

		
		return view('pneumonia/pneumonia');

		}


	}
	public function second(){


      $list=Db::name('pneumonia')->paginate(15,false,['query'=>request()->param()]);
     // SELECT DISTINCT 列名称 FROM 表名称
     // 
     // $listm=Db::name('pneumonia')->where('englishname','in',['bony','Aliya','Liz','Damaris','Una','Nana','Sophie','Nicole','Cassie','Damon','Nico'])->column('name','placem');
     // pre($listm);

      $alllist=Db::name('pneumonia')->select();
       $zmask=Db::name('pneumonia')->sum('masknum'); 

       $pneumonia=[];
         foreach($alllist as $v){
              if($v['healthy']==0){
                $pneumonia[]=$v['healthy'];

              }
         }
       $total=$list->total();
      $page=$list->render();
      $sum=count($pneumonia);

   
      $data=[
        'list'=>$list,
        'total'=>$total,
        'page'=>$page,
        'sum'=>$sum,
      	'zmask'=>$zmask,
      ];
      $this->assign($data);		
      return view('pneumonia/plist');

	}
  public function search(){
    
        $startday=strtotime(input('param.startday',''));
        $endday=strtotime(input('param.endday',''));
        $depart=input('param.depart','');
       


        if(!empty($startday)&&!empty($endday)&&!empty($depart)){
           $list=Db::name('pneumonia')->where('bookday','between time',[$startday,$endday])->whereLike('depart',"%".$depart."%")->paginate(15,false,['query'=>request()->param()]);
            $alllist=Db::name('pneumonia')->where('bookday','between time',[$startday,$endday])->whereLike('depart',"%".$depart."%")->select();
            $zmask=Db::name('pneumonia')->where('bookday','between time',[$startday,$endday])->whereLike('depart',"%".$depart."%")->sum('masknum'); 
          
          

        }else if(!empty($startday)&&!empty($endday)){
           $list=Db::name('pneumonia')->where('bookday','between time',[$startday,$endday])->paginate(15,false,['query'=>request()->param()]);
            $alllist=Db::name('pneumonia')->where('bookday','between time',[$startday,$endday])->select();
            $zmask=Db::name('pneumonia')->where('bookday','between time',[$startday,$endday])->sum('masknum'); 

       }else if(!empty($depart)){

         $list=Db::name('pneumonia')->whereLike('depart',"%".$depart."%")->paginate(15,false,['query'=>request()->param()]);
         $alllist=Db::name('pneumonia')->whereLike('depart',"%".$depart."%")->select();
         $zmask=Db::name('pneumonia')->whereLike('depart',"%".$depart."%")->sum('masknum'); 
         
      }
      $pneumonia=[];
         foreach($alllist as $v){
              if($v['healthy']==0){
                $pneumonia[]=$v['healthy'];

              }
         }


      $total=$list->total();
      $page=$list->render();
       $sum=count($pneumonia);
        
      $data=[
        'list'=>$list,
        'total'=>$total,
        'page'=>$page,
        'sum'=>$sum,
        'zmask'=>$zmask,
      ];
      $this->assign($data);   
      return view('pneumonia/plist');

      
    

  }
  public function search2(){
    
        
       $list=Db::name('pneumonia')->where('optionhb',1)->paginate(15,false,['query'=>request()->param()]);

      $page=$list->render();
      

        $data=[
        'list'=>$list,
        'page'=>$page,
        ];
      $this->assign($data);   

      return view('pneumonia/phblist');
       


        
          

      
      
        
      

      
    

  }
   public function search3(){
    
        
       $list=Db::name('pneumonia')->where('healthy',0)->select();
      
       $name=[];
       foreach ($list as $v ) {
      $name[]= $v['username'];
       }
     
       $nameone=array_unique($name);
       $namestr=implode($nameone,',');
       $namearr=explode(',',$namestr);

      $englishname=[];
       foreach ($list as $v ) {
      $englishname[]= $v['englishname'];
       }
    ;
       
       $englishnamestr= strtolower(implode($englishname,','));
      
       $englishnamearr=explode(',',$englishnamestr);
   
        $englishnameone=array_unique($englishnamearr);
        $englishnamestr=implode($englishnameone,',');
        $englishnamearr=explode(',',$englishnamestr);

    


      

    
     
      
       $sum=[];
for($i=0;$i<count($namearr);$i++){

 $listone=Db::name('pneumonia')->where('healthy',0)->where('username',$namearr[$i])->select();
 
      

      $sum[]= Count($listone);


}




      

        $data=[
        'englishnamearr'=>$englishnamearr,
        'namearr'=>$namearr,
        'sum'=>$sum,
       
      
       
        ];

      $this->assign($data);   

      return view('pneumonia/psum');
       


        
          

      
      
        
      

      
    

  }
	public function protact(){


	   	
	      return view('pneumonia/protact');

		}

}

<?php 
namespace app\index\controller;
use think\facade\Request;
use think\Controller;
use think\Db;
// use app\index\model\Nav;

class Pecharts extends Common
{
	public function index(){


		if(Request::isPost()){
			
	    $startday=strtotime(input('param.startday',''));
	    $start=input('param.startday','');
	    $end=input('param.startday','');
        $endday=strtotime(input('param.endday',''));
        $depart=Db::name('depart')->order('id asc')->column('departname');

        $count=[];
      
		for($i=0;$i<count($depart);$i++){
				
				$pcount=Db::name('pneumonia')->where('bookday','between time',[$startday,$endday])->whereLike('depart',"%".$depart[$i]."%")->sum('masknum');
				

				
				$count[]=$pcount;




			}	
			$departjs='[';
			$countjs='[';

			
			for($i=0;$i<(count($depart)<25?count($depart):25);$i++){

				$departjs.='"'.$depart[$i].'",';
				
				$countjs.='"'.$count[$i].'",';
			}

			$departjs = rtrim($departjs,',');

			$countjs = rtrim($countjs,',');
			$departjs .= ']';
			$countjs .= ']';
			$title="各部门{$start}到{$end}自备口罩量";

          $data=[
          	'departjs'=>$departjs,
          	'countjs'=>$countjs,
          	'title'=>$title,
          ];

         $this->assign($data);


			return view('pecharts/pecharts');
			
			
		}else{
			
			$startday=strtotime(date("Y-m-d",strtotime("-1 day")));
			$endday=strtotime(date("Y-m-d",strtotime("-1 day")));
			$start=date("Y-m-d",strtotime("-1 day"));
			$end=date("Y-m-d",strtotime("-1 day"));
			
			$depart=Db::name('depart')->order('id asc')->column('departname');
			 $count=[];
      
		for($i=0;$i<count($depart);$i++){
				
				$pcount=Db::name('pneumonia')->where('bookday','between time',[$startday,$endday])->whereLike('depart',"%".$depart[$i]."%")->sum('masknum');
				

				
				$count[]=$pcount;




			}	
			$departjs='[';
			$countjs='[';

			
			for($i=0;$i<(count($depart)<25?count($depart):25);$i++){

				$departjs.='"'.$depart[$i].'",';
				
				$countjs.='"'.$count[$i].'",';
			}

			$departjs = rtrim($departjs,',');

			$countjs = rtrim($countjs,',');
			$departjs .= ']';
			$countjs .= ']';
			$title="各部门{$start}到{$end}自备口罩量";

          $data=[
          	'departjs'=>$departjs,
          	'countjs'=>$countjs,
          	'title'=>$title,
          ];

         $this->assign($data);
			

			

			return view('pecharts/pecharts');


		}


	}



}



<?php 
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\facade\Request;


class Test extends Common
{
	public function index()
	{
		pre(666);
		if(Request::isPost()){
			
			
			$startday=input('param.startday','');
				

			
			$endday=input('param.endday','');

			$arrayday=periodDate($startday,$endday);
			
			for($i=0;$i<count($arrayday);$i++){

				$sday=strtotime($arrayday[$i]);
				$eday=strtotime($arrayday[$i]);


				$ship=Db::name('bookspace')->where('bookdate','between time',[$sday,$eday])->column('bookship');
              
				$shipstr=implode(',',$ship);

				$shipstr=strtoupper($shipstr);

				$shiparray=explode(",", $shipstr);

				$shiparray=array_unique($shiparray);

				$shiparray=implode(",", $shiparray);
				$shiparray=explode(",", $shiparray);

				$count=[];
				for($i=0;$i<count($shiparray);$i++){

					$tcount=Db::name('bookspace')->where('bookdate','between time',[$sday,$eday])->where('bookship','=',$shiparray[$i])->sum('booktue');


					$count[]=$tcount;

// print_r($tcount);

				}


				$cs=array_combine($shiparray,$count);
				

				$shiparray=array_keys($cs);
				$count=array_values($cs);
				$count=sliceArr($count,count($shiparray));
				

				$shipjs='[';
				$countjs='[';


				for($i=0;$i<(count($shiparray)<25?count($shiparray):25);$i++){

					$shipjs.='"'.$shiparray[$i].'",';

					$countjs.='"'.$count[$i].'",';
				}

				$shipjs = rtrim($shipjs,',');

				$countjs = rtrim($countjs,',');
				$shipjs .= ']';
				$countjs .= ']';


				$data = [

					'shipjs'=>$shipjs,
					'countjs'=>$countjs,
					'arrayday'=>$arrayday,

					


				];


				$this->assign($data);


			}
			


			return view('echarts/echarts2');
			
			
		}else{




			return view('echarts/echarts2');


		}

	}

}




?>
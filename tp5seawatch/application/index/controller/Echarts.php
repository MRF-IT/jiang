<?php 
namespace app\index\controller;
use think\facade\Request;
use think\Controller;
use think\Db;
// use app\index\model\Nav;

class Echarts extends Common
{
	public function index(){


		if(Request::isPost()){
			
			
			$startday=input('param.startday','');
			
			
			
			$endday=input('param.endday','');
			
			
			$sday=strtotime($startday);

			
			$eday=strtotime($endday);

			$start=date("Y-m-d",strtotime(("-1 year"),strtotime($startday)));
			$end=date("Y-m-d",strtotime(("-1 year"),strtotime($endday)));

			
			
			$s=strtotime($start);
			$e=strtotime($end);

			
			$titledayt=date("Y-m-d",strtotime($startday));
			$titleday=date("Y",strtotime($startday));
		
			$titledayy=date("Y",strtotime("-1 years",strtotime($titledayt)));
	
			
			$ship=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->column('bookship');
			$shipy=Db::name('bookspace')->where('bookcydate','between time',[$s,$e])->column('bookship');
			
			
		
			
			$serviceman=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->column('serviceman');
			$servicemany=Db::name('bookspace')->where('bookcydate','between time',[$s,$e])->column('serviceman');
			

			$servicemanager=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->column('servicemanager');
			$servicemanagery=Db::name('bookspace')->where('bookcydate','between time',[$s,$e])->column('servicemanager');
			

			$shipstr=implode(',',$ship);

			$shipstr=strtoupper($shipstr);

			$shiparray=explode(",", $shipstr);
			
			$shiparray=array_unique($shiparray);
			
			$shiparray=implode(",", $shiparray);
			$shiparray=explode(",", $shiparray);
			array_walk($shiparray ,  'trim_value');

			$shiparray=array_unique($shiparray);
			$shiparray=implode(",", $shiparray);
			$shiparray=explode(",", $shiparray);






			$servicestr=implode(',',$serviceman);

			$servicestr=strtoupper($servicestr);

			$servicearray=explode(",", $servicestr);
			
			$servicearray=array_unique($servicearray);
			$servicearray=implode(",", $servicearray);
			$servicearray=explode(",", $servicearray);
			array_walk($servicearray ,  'trim_value');

			$servicearray=array_unique($servicearray);
			$servicearray=implode(",", $servicearray);
			$servicearray=explode(",", $servicearray);


			
			


			$servicemstr=implode(',',$servicemanager);

			$servicemstr=strtoupper($servicemstr);

			$servicemarray=explode(",", $servicemstr);
			
			$servicemarray=array_unique($servicemarray);
			$servicemarray=implode(",", $servicemarray);
			$servicemarray=explode(",", $servicemarray);
			array_walk($servicemarray ,  'trim_value');

			$servicemarray=array_unique($servicemarray);
			$servicemarray=implode(",", $servicemarray);
			$servicemarray=explode(",", $servicemarray);
			

			
			// print_r($servicemanager) ;

			$all=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->sum('booktue');
			$ally=Db::name('bookspace')->where('bookcydate','between time',[$s,$e])->sum('booktue');
			

			$count=[];
			$counts=[];
			$countsm=[];
			$county=[];
			$countsy=[];
			$countsmy=[];

			

			for($i=0;$i<count($servicearray);$i++){
				
				$tscount=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->where('serviceman','=',$servicearray[$i])->sum('booktue');
				
				$counts[]=$tscount;
				


				
			}
			
			$ss=array_combine($servicearray,$counts);
				
			arsort($ss);
			$servicearray=array_keys($ss);
			$counts=array_values($ss);


			for($i=0;$i<count($servicearray);$i++){
				
				$tscounty=Db::name('bookspace')->where('bookcydate','between time',[$s,$e])->where('serviceman','=',$servicearray[$i])->sum('booktue');
				
				$countsy[]=$tscounty;
				


				
			}

			
			$ssy=array_combine($servicearray,$countsy);
				
			arsort($ssy);
			$servicearray=array_keys($ssy);
			$countsy=array_values($ssy);


			for($i=0;$i<count($shiparray);$i++){
				
				$tcount=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->where('bookship','=',$shiparray[$i])->sum('booktue');

				
				$count[]=$tcount;

// print_r($tcount);

			}

			
			$cs=array_combine($shiparray,$count);
				
			arsort($cs);
			$shiparray=array_keys($cs);
			$count=array_values($cs);


			for($i=0;$i<count($shiparray);$i++){
				
				$tcounty=Db::name('bookspace')->where('bookdate','between time',[$s,$e])->where('bookship','=',$shiparray[$i])->sum('booktue');

				
				$county[]=$tcounty;

// print_r($tcount);

			}

			
			$csy=array_combine($shiparray,$county);
				
			arsort($csy);
			$shiparray=array_keys($csy);
			$county=array_values($csy);

			



			for($i=0;$i<count($servicemarray);$i++){
				
				$tsmcount=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->where('servicemanager','=',$servicemarray[$i])->sum('booktue');
				$countsm[]=$tsmcount;


				
			}

			$sms=array_combine($servicemarray,$countsm);
				
			arsort($sms);
			$servicemarray=array_keys($sms);
			$countsm=array_values($sms);




			for($i=0;$i<count($servicemarray);$i++){
				
				$tsmcounty=Db::name('bookspace')->where('bookcydate','between time',[$s,$e])->where('servicemanager','=',$servicemarray[$i])->sum('booktue');

				$countsmy[]=$tsmcounty;


				
			}

			$smsy=array_combine($servicemarray,$countsmy);
				
			arsort($smsy);
			$servicemarray=array_keys($smsy);
			$countsmy=array_values($smsy);
			

			$shipjs='[';
			$countjs='[';
			$countjsy='[';

			
			for($i=0;$i<(count($shiparray)<8?count($shiparray):8);$i++){

				$shipjs.='"'.$shiparray[$i].'",';
				
				$countjs.='"'.$count[$i].'",';
				$countjsy.='"'.$county[$i].'",';
			}

			$shipjs = rtrim($shipjs,',');

			$countjs = rtrim($countjs,',');
			$countjsy = rtrim($countjsy,',');
			$shipjs .= ']';
			$countjs .= ']';
			$countjsy .= ']';



			$servicejs='[';
			$countsjs='[';
			$countsjsy='[';
			for($i=0;$i<(count($servicearray)<8?count($servicearray):8);$i++){

				$servicejs.='"'.$servicearray[$i].'",';
				
				$countsjs.='"'.$counts[$i].'",';
				$countsjsy.='"'.$countsy[$i].'",';
			}

			$servicejs = rtrim($servicejs,',');

			$countsjs = rtrim($countsjs,',');
			$countsjsy = rtrim($countsjsy,',');
			$servicejs .= ']';
			$countsjs .= ']';
			$countsjsy .= ']';




			$servicemjs='[';
			$countsmjs='[';
			$countsmjsy='[';
			for($i=0;$i<(count($servicemarray)<8?count($servicemarray):8);$i++){

				$servicemjs.='"'.$servicemarray[$i].'",';
				
				$countsmjs.='"'.$countsm[$i].'",';
				$countsmjsy.='"'.$countsmy[$i].'",';
			}

			$servicemjs = rtrim($servicemjs,',');

			$countsmjs = rtrim($countsmjs,',');
			$countsmjsy = rtrim($countsmjsy,',');
			$servicemjs .= ']';
			$countsmjs .= ']';
			$countsmjsy .= ']';


			$title="船东{$startday}到{$endday}和{$start}"."\\n"."到{$end}的前十位T量展示";
			$titles="业务员{$startday}到{$endday}和{$start}"."\\n"."到{$end}的前十位T量展示";
			
			$titlesm="业务经理{$startday}到{$endday}和{$start}"."\\n"."到{$end}的前十位T量展示";
			
			$data = [

				'shipjs'=>$shipjs,
				'countjs'=>$countjs,
				'servicemjs'=>$servicemjs,
				'countsmjs'=>$countsmjs,
				'servicejs'=>$servicejs,
				'countsjs'=>$countsjs,

				'countjsy'=>$countjsy,
				
				'countsmjsy'=>$countsmjsy,
				
				'countsjsy'=>$countsjsy,
				'title'=>$title,
				'titles'=>$titles,
				'titlesm'=>$titlesm,
				'all'=>$all,
				'ally'=>$ally,
				'titleday'=>$titleday,
				'titledayy'=>$titledayy,

			];
			

			$this->assign($data);

			return view('echarts/echarts');


		}else{
			
			$a=date("Y-m-d",strtotime("-1 years"));
			$start=date("Y-m-d",strtotime("-1 day",strtotime($a)));
			$end=date("Y-m-d",strtotime("-1 day",strtotime($a)));
			$s=strtotime($start);
			$e=strtotime($end);

			$titleday=date("Y");
			$titledayy=date("Y",strtotime("-1 years",strtotime($titleday)));


			
			$startday=date("Y-m-d",strtotime("-1 day"));
			$endday=date("Y-m-d",strtotime("-1 day"));
			$sday=strtotime($startday);
			$eday=strtotime($endday);


			$ship=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->column('bookship');
			$shipy=Db::name('bookspace')->where('bookcydate','between time',[$s,$e])->column('bookship');
			
			
		
			
			$serviceman=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->column('serviceman');
			$servicemany=Db::name('bookspace')->where('bookcydate','between time',[$s,$e])->column('serviceman');
			

			$servicemanager=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->column('servicemanager');
			$servicemanagery=Db::name('bookspace')->where('bookcydate','between time',[$s,$e])->column('servicemanager');
			

			$shipstr=implode(',',$shipy);

			$shipstr=strtoupper($shipstr);

			$shiparray=explode(",", $shipstr);
			
			$shiparray=array_unique($shiparray);
			
			$shiparray=implode(",", $shiparray);
			$shiparray=explode(",", $shiparray);
			array_walk($shiparray ,  'trim_value');

			$shiparray=array_unique($shiparray);
			$shiparray=implode(",", $shiparray);
			$shiparray=explode(",", $shiparray);






			$servicestr=implode(',',$servicemany);

			$servicestr=strtoupper($servicestr);

			$servicearray=explode(",", $servicestr);
			
			$servicearray=array_unique($servicearray);
			$servicearray=implode(",", $servicearray);
			$servicearray=explode(",", $servicearray);
			array_walk($servicearray ,  'trim_value');

			$servicearray=array_unique($servicearray);
			$servicearray=implode(",", $servicearray);
			$servicearray=explode(",", $servicearray);


			
			


			$servicemstr=implode(',',$servicemanagery);

			$servicemstr=strtoupper($servicemstr);

			$servicemarray=explode(",", $servicemstr);
			
			$servicemarray=array_unique($servicemarray);
			$servicemarray=implode(",", $servicemarray);
			$servicemarray=explode(",", $servicemarray);
			array_walk($servicemarray ,  'trim_value');

			$servicemarray=array_unique($servicemarray);
			$servicemarray=implode(",", $servicemarray);
			$servicemarray=explode(",", $servicemarray);
			

			
			// print_r($servicemanager) ;

			$all=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->sum('booktue');
			$ally=Db::name('bookspace')->where('bookcydate','between time',[$s,$e])->sum('booktue');
			

			$count=[];
			$counts=[];
			$countsm=[];
			$county=[];
			$countsy=[];
			$countsmy=[];

			

			for($i=0;$i<count($servicearray);$i++){
				
				$tscount=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->where('serviceman','=',$servicearray[$i])->sum('booktue');
				
				$counts[]=$tscount;
				


				
			}
			
			$ss=array_combine($servicearray,$counts);
				
			arsort($ss);
			$servicearray=array_keys($ss);
			$counts=array_values($ss);


			for($i=0;$i<count($servicearray);$i++){
				
				$tscounty=Db::name('bookspace')->where('bookcydate','between time',[$s,$e])->where('serviceman','=',$servicearray[$i])->sum('booktue');
				
				$countsy[]=$tscounty;
				


				
			}

			
			$ssy=array_combine($servicearray,$countsy);
				
			arsort($ssy);
			$servicearray=array_keys($ssy);
			$countsy=array_values($ssy);


			for($i=0;$i<count($shiparray);$i++){
				
				$tcount=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->where('bookship','=',$shiparray[$i])->sum('booktue');

				
				$count[]=$tcount;

// print_r($tcount);

			}

			
			$cs=array_combine($shiparray,$count);
				
			arsort($cs);
			$shiparray=array_keys($cs);
			$count=array_values($cs);


			for($i=0;$i<count($shiparray);$i++){
				
				$tcounty=Db::name('bookspace')->where('bookcydate','between time',[$s,$e])->where('bookship','=',$shiparray[$i])->sum('booktue');

				
				$county[]=$tcounty;

// print_r($tcount);

			}

			
			$csy=array_combine($shiparray,$county);
				
			arsort($csy);
			$shiparray=array_keys($csy);
			$county=array_values($csy);

			



			for($i=0;$i<count($servicemarray);$i++){
				
				$tsmcount=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->where('servicemanager','=',$servicemarray[$i])->sum('booktue');
				$countsm[]=$tsmcount;


				
			}

			$sms=array_combine($servicemarray,$countsm);
				
			arsort($sms);
			$servicemarray=array_keys($sms);
			$countsm=array_values($sms);


			for($i=0;$i<count($servicemarray);$i++){
				
				$tsmcounty=Db::name('bookspace')->where('bookcydate','between time',[$s,$e])->where('servicemanager','=',$servicemarray[$i])->sum('booktue');

				$countsmy[]=$tsmcounty;


				
			}

			$smsy=array_combine($servicemarray,$countsmy);
				
			arsort($smsy);
			$servicemarray=array_keys($smsy);
			$countsmy=array_values($smsy);
			

			$shipjs='[';
			$countjs='[';
			$countjsy='[';

			
			for($i=0;$i<(count($shiparray)<8?count($shiparray):8);$i++){

				$shipjs.='"'.$shiparray[$i].'",';
				
				$countjs.='"'.$count[$i].'",';
				$countjsy.='"'.$county[$i].'",';
			}

			$shipjs = rtrim($shipjs,',');

			$countjs = rtrim($countjs,',');
			$countjsy = rtrim($countjsy,',');
			$shipjs .= ']';
			$countjs .= ']';
			$countjsy .= ']';



			$servicejs='[';
			$countsjs='[';
			$countsjsy='[';
			for($i=0;$i<(count($servicearray)<8?count($servicearray):8);$i++){

				$servicejs.='"'.$servicearray[$i].'",';
				
				$countsjs.='"'.$counts[$i].'",';
				$countsjsy.='"'.$countsy[$i].'",';
			}

			$servicejs = rtrim($servicejs,',');

			$countsjs = rtrim($countsjs,',');
			$countsjsy = rtrim($countsjsy,',');
			$servicejs .= ']';
			$countsjs .= ']';
			$countsjsy .= ']';




			$servicemjs='[';
			$countsmjs='[';
			$countsmjsy='[';
			for($i=0;$i<(count($servicemarray)<8?count($servicemarray):8);$i++){

				$servicemjs.='"'.$servicemarray[$i].'",';
				
				$countsmjs.='"'.$countsm[$i].'",';
				$countsmjsy.='"'.$countsmy[$i].'",';
			}

			$servicemjs = rtrim($servicemjs,',');

			$countsmjs = rtrim($countsmjs,',');
			$countsmjsy = rtrim($countsmjsy,',');
			$servicemjs .= ']';
			$countsmjs .= ']';
			$countsmjsy .= ']';


			$title="船东{$startday}和{$start}的T量展示";
			$titles="业务员{$startday}和{$start}的T量展示";
			
			$titlesm="业务经理{$startday}和{$start}的T量展示";
			
			$data = [

				'shipjs'=>$shipjs,
				'countjs'=>$countjs,
				'servicemjs'=>$servicemjs,
				'countsmjs'=>$countsmjs,
				'servicejs'=>$servicejs,
				'countsjs'=>$countsjs,

				'countjsy'=>$countjsy,
				
				'countsmjsy'=>$countsmjsy,
				
				'countsjsy'=>$countsjsy,
				'title'=>$title,
				'titles'=>$titles,
				'titlesm'=>$titlesm,
				'all'=>$all,
				'ally'=>$ally,
				'titleday'=>$titleday,
				'titledayy'=>$titledayy,

			];
			

			$this->assign($data);

			return view('echarts/echarts');


		}


	}



}



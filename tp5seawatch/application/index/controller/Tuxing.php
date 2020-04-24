<?php 
namespace app\index\controller;
use think\facade\Request;
use think\Controller;
use think\Db;
// use app\index\model\Nav;

class Tuxing extends Common
{
	public function index(){


		if(Request::isPost()){
			
			
			$startday=input('param.startday','');
			
			
			
			$endday=input('param.endday','');
			
			
			$sday=strtotime($startday);

			
			$eday=strtotime($endday);

			
			
			
			
			$ship=Db::name('bookspace')->where('bookdate','between time',[$sday,$eday])->column('bookship');
			
			$serviceman=Db::name('bookspace')->where('bookdate','between time',[$sday,$eday])->column('serviceman');

			$servicemanager=Db::name('bookspace')->where('bookdate','between time',[$sday,$eday])->column('servicemanager');




    // [0] => ONE
    // [11] => MSC
    // [13] => COSCO
    // [18] => CMA
    // [22] => EMC
    // [23] => HPL
    // [34] => MSK
    // [38] => FESCO
    // [42] => HMM

			// $ship = array_unique($ship);
			$shipstr=implode(',',$ship);

			$shipstr=strtoupper($shipstr);

			$shiparray=explode(",", $shipstr);
			
			$shiparray=array_unique($shiparray);
			$shiparray=implode(",", $shiparray);
			$shiparray=explode(",", $shiparray);
			array_walk($shiparray ,  'trim_value');

			$shiparray=array_unique($shiparray);






			$servicestr=implode(',',$serviceman);

			$servicestr=strtoupper($servicestr);

			$servicearray=explode(",", $servicestr);
			
			$servicearray=array_unique($servicearray);
			$servicearray=implode(",", $servicearray);
			$servicearray=explode(",", $servicearray);
			array_walk($servicearray ,  'trim_value');

			$servicearray=array_unique($servicearray);


			
			


			$servicemstr=implode(',',$servicemanager);

			$servicemstr=strtoupper($servicemstr);

			$servicemarray=explode(",", $servicemstr);
			
			$servicemarray=array_unique($servicemarray);

		   
			$servicemarray=implode(",", $servicemarray);
			$servicemarray=explode(",", $servicemarray);
			array_walk($servicemarray ,  'trim_value');

			$servicemarray=array_unique($servicemarray);
			

			
	


			$count=[];
			$counts=[];
			$countsm=[];

			for($i=0;$i<count($servicearray);$i++){
				
				$tscount=Db::name('bookspace')->where('bookdate','between time',[$sday,$eday])->where('serviceman','=',$servicearray[$i])->sum('booktue');
				
				$counts[]=$tscount;
				


				
			}
			$ss=array_combine($servicearray,$counts);
				
			arsort($ss);
			$servicearray=array_keys($ss);
			$counts=array_values($ss);

			
			for($i=0;$i<count($shiparray);$i++){
				
				$tcount=Db::name('bookspace')->where('bookdate','between time',[$sday,$eday])->where('bookship','=',$shiparray[$i])->sum('booktue');

				
				$count[]=$tcount;



// print_r($tcount);

			}

			$cs=array_combine($shiparray,$count);
				
			arsort($cs);
			
			$shiparray=array_keys($cs);
			$count=array_values($cs);




			for($i=0;$i<count($servicemarray);$i++){
				
				$tsmcount=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->where('servicemanager','=',$servicemarray[$i])->sum('booktue');
				$countsm[]=$tsmcount;


				
			}

			$sms=array_combine($servicemarray,$countsm);

			
			arsort($sms);
			$servicemarray=array_keys($sms);
			$countsm=array_values($sms);



			$shipjs='[';
			$countjs='[';

			
			for($i=0;$i<(count($shiparray)<10?count($shiparray):10);$i++){

				$shipjs.='"'.$shiparray[$i].'",';
				
				$countjs.='"'.$count[$i].'",';
			}

			$shipjs = rtrim($shipjs,',');

			$countjs = rtrim($countjs,',');
			$shipjs .= ']';
			$countjs .= ']';



			$servicejs='[';
			$countsjs='[';
			for($i=0;$i<(count($servicearray)<10?count($servicearray):10);$i++){

				$servicejs.='"'.$servicearray[$i].'",';
				
				$countsjs.='"'.$counts[$i].'",';
			}

			$servicejs = rtrim($servicejs,',');

			$countsjs = rtrim($countsjs,',');
			$servicejs .= ']';
			$countsjs .= ']';




			$servicemjs='[';
			$countsmjs='[';
			for($i=0;$i<(count($servicemarray)<10?count($servicemarray):10);$i++){

				$servicemjs.='"'.$servicemarray[$i].'",';
				
				$countsmjs.='"'.$countsm[$i].'",';
			}

			$servicemjs = rtrim($servicemjs,',');

			$countsmjs = rtrim($countsmjs,',');
			$servicemjs .= ']';
			$countsmjs .= ']';


			$title="船东{$startday}到{$endday}T量";
			$titles="业务员{$startday}到{$endday}T量";
			
			$titlesm="业务经理{$startday}到{$endday}T量";
			
			$data = [

				'shipjs'=>$shipjs,
				'countjs'=>$countjs,
				'servicemjs'=>$servicemjs,
				'countsmjs'=>$countsmjs,
				'servicejs'=>$servicejs,
				'countsjs'=>$countsjs,
				'title'=>$title,
				'titles'=>$titles,
				'titlesm'=>$titlesm,

			];
			

			$this->assign($data);


			return view('tuxing/tuxing');
			
			
		}else{
			
			// $color = array('gold','yellow','blue');
   //           echo json_encode($color)."<br />";

		  $weekday=[];
           for($i=1;$i<=7;$i++){
           			$weekday[]=strtotime(date('Y-m-d', (time() - ((date('w') == 0 ? 7 : date('w')) - $i) * 24 * 3600)));
           }
			
         
		
			
          
			$ship=Db::name('bookspace')->where('bookcydate','between time',[$weekday[0],$weekday[0]])->column('bookship');
			
			// $s=Db::name('bookspace')->where('bookcydate','between time',[$weekday[0],$weekday[0]])->column('booktue');
			


	
			$serviceman=Db::name('bookspace')->where('bookcydate','between time',[$weekday[0],$weekday[0]])->column('serviceman');

			$servicemanager=Db::name('bookspace')->where('bookcydate','between time',[$weekday[0],$weekday[0]])->column('servicemanager');

			$shipstr=implode(',',$ship);

			$shipstr=strtoupper($shipstr);

			$shiparray=explode(",", $shipstr);
			
			$shiparray=array_unique($shiparray);
			$shiparray=implode(",", $shiparray);
			$shiparray=explode(",", $shiparray);
			array_walk($shiparray ,  'trim_value');
			$shiparray=array_unique($shiparray);


			$servicestr=implode(',',$serviceman);

			$servicestr=strtoupper($servicestr);

			$servicearray=explode(",", $servicestr);
			
			$servicearray=array_unique($servicearray);
			$servicearray=implode(",", $servicearray);
			$servicearray=explode(",", $servicearray);
			array_walk($servicearray ,  'trim_value');
			$servicearray=array_unique($servicearray);



			
			


			$servicemstr=implode(',',$servicemanager);

			$servicemstr=strtoupper($servicemstr);

			$servicemarray=explode(",", $servicemstr);
			
			$servicemarray=array_unique($servicemarray);
			$servicemarray=implode(",", $servicemarray);
			$servicemarray=explode(",", $servicemarray);
			array_walk($servicemarray ,  'trim_value');
			$servicemarray=array_unique($servicemarray);
			


			
			// print_r($servicemanager) ;


      

// 			$count=[];
// 			$counts=[];
// 			$countsm=[];

// 			// for($i=0;$i<count($servicearray);$i++){
				
// 			// 	$tscount=Db::name('bookspace')->where('bookcydate','between time',[$weekday[$i],$weekday[$i]])->where('serviceman','=',$servicearray[$i])->sum('booktue');
				
// 			// 	$counts[]=$tscount;
				


				
// 			// }

			
// 			// $ss=array_combine($servicearray,$counts);
				
// 			// arsort($ss);
// 			// $servicearray=array_keys($ss);
// 			// $counts=array_values($ss);



		
			
			for($j=0;$j<count($weekday);$j++){
			for($i=0;$i<(count($shiparray)<5?count($shiparray):5);$i++){
				
				$tcount=Db::name('bookspace')->where('bookcydate','between time',[$weekday[$j],$weekday[$j]])->where('bookship','=',$shiparray[$i])->sum('booktue');
             
				$count[]=$tcount;
		


				

			}

		
			}


			for($j=0;$j<count($weekday);$j++){
			for($i=0;$i<(count($servicearray)<5?count($servicearray):5);$i++){
				
				$tcounts=Db::name('bookspace')->where('bookcydate','between time',[$weekday[$j],$weekday[$j]])->where('serviceman','=',$servicearray[$i])->sum('booktue');
             
				$counts[]=$tcounts;
		


				

			}

		
			}



			for($j=0;$j<(count($servicearray)<5?count($servicearray):5);$j++){
				  for($i=$j;$i<count($counts);$i++){
								if($i%(count($servicearray)<5?count($servicearray):5)==$j){
									$countsecond[]=$counts[$i];
									

								}
				                
							}

							$countlists[$j]=$countsecond;
							array_splice($countsecond, 0, count($countsecond));
							}




							for($i=0;$i<(count($servicearray)<5?count($servicearray):5);$i++){

                           $datass[]=['name'=>$servicearray[$i],'type'=>'line','stack'=>'总量','data'=>$countlists[$i], 'label'=> [
                'normal'=> [
                    'show'=> true,
                    'position'=> 'top']
                
            ]];

						}



						$servicearray= json_encode($servicearray);

		$datay = json_encode($datass); 












		for($j=0;$j<count($weekday);$j++){
			for($i=0;$i<(count($servicemarray)<5?count($servicemarray):5);$i++){
				
				$tcountsm=Db::name('bookspace')->where('bookcydate','between time',[$weekday[$j],$weekday[$j]])->where('servicemanager','=',$servicemarray[$i])->sum('booktue');
             
				$countsm[]=$tcountsm;
		


				

			}

		
			}



			for($j=0;$j<(count($servicemarray)<5?count($servicemarray):5);$j++){
				  for($i=$j;$i<count($countsm);$i++){
								if($i%(count($servicemarray)<5?count($servicemarray):5)==$j){
									$countthreen[]=$countsm[$i];
									

								}
				                
							}

							$countlistsm[$j]=$countthreen;
							array_splice($countthreen, 0, count($countthreen));
							}




							for($i=0;$i<(count($servicemarray)<5?count($servicemarray):5);$i++){

                           $datassm[]=['name'=>$servicemarray[$i],'type'=>'line','stack'=>'总量','data'=>$countlistsm[$i], 'label'=> [
                'normal'=> [
                    'show'=> true,
                    'position'=> 'top']
                
            ]];

						}



						$servicemarray= json_encode($servicemarray);

		$dataym = json_encode($datassm); 


			// $evencount= array_filter($count,function($var){
   //       return(!($var & 1));
   //    },ARRAY_FILTER_USE_KEY);
			// $evencount=implode(",", $evencount);
			// $evencount=explode(",", $evencount);
	

				for($j=0;$j<(count($shiparray)<5?count($shiparray):5);$j++){
				  for($i=$j;$i<count($count);$i++){
								if($i%(count($shiparray)<5?count($shiparray):5)==$j){
									$countfirst[]=$count[$i];
									

								}
				                
							}

							$countlist[$j]=$countfirst;
							array_splice($countfirst, 0, count($countfirst));
							}

			// $oddcount= array_filter($count,function($var){
   //       return($var & 1);
   //    },ARRAY_FILTER_USE_KEY);

			// $oddcount=implode(",", $oddcount);
			// $oddcount=explode(",", $oddcount);

      
			
						for($i=0;$i<(count($shiparray)<5?count($shiparray):5);$i++){

                           $datas[]=['name'=>$shiparray[$i],'type'=>'line','stack'=>'总量','data'=>$countlist[$i], 'label'=> [
					                'normal'=> [
					                    'show'=> true,
					                    'position'=> 'top']
					                
					            ]];

						}
						
						
// $chunk = array_chunk($count, 3);
// $json=json_encode($chunk);

// 			$countfirst=[];
        $shiparray= json_encode($shiparray);

		$data = json_encode($datas); 
		pre($data);

	
			
			// echo $data; //自己输出json数据看清楚是不是你要的json数据结构
			// 
			
			// for($i=0;$i<count($count);$i++){
			// 	if($i%3==0){
			// 		$countfirst[]=$count[$i];
					

			// 	}
                
			// }
			
// 			$countsecond=[];


			//  pre($countfirst);
			// for($i=1;$i<count($count);$i++){
			// 	if($i%2==1){
			// 		$countfirst[]=$count[$i];
					

			// 	}
               
			// }
			
// 			$countthree=[];

			
			
// 			for($i=2;$i<count($count);$i++){
// 				if($i%3==2){
// 					$countthree[]=$count[$i];
					

// 				}
                
// 			}

			


			
    		// pre($cs);
		
			// $cs=array_combine($shiparray,$count);
			
			// arsort($cs);
			// $shiparray=array_keys($cs);
			// $count=array_values($cs);



			// for($i=0;$i<count($servicemarray);$i++){
				
			// 	$tsmcount=Db::name('bookspace')->where('bookcydate','between time',[$sday,$eday])->where('servicemanager','=',$servicemarray[$i])->sum('booktue');
			// 	$countsm[]=$tsmcount;


				
			// }

			// $sms=array_combine($servicemarray,$countsm);
				
			// arsort($sms);
			// $servicemarray=array_keys($sms);
			// $countsm=array_values($sms);
			
            
			// $shipjs='[';
			// $countjsa='[';
			// $countjsb='[';
			// $countjsc='[';
			

			
			// for($i=0;$i<count($countfirst);$i++){

				

				
				
			// 	$countjsa.='"'.$countfirst[$i].'",';

			// 	$countjsb.='"'.$countsecond[$i].'",';
			// 	$countjsc.='"'.$countthree[$i].'",';
				
			// }
			

			

			// $countjsa = rtrim($countjsa,',');
			
			// $countjsb = rtrim($countjsb,',');
			// $countjsc = rtrim($countjsc,',');
			
			// $countjsa .= ']';
			// $countjsb .= ']';
			// $countjsc .= ']';
			


			// for($i=0;$i<(count($shiparray)<10?count($shiparray):10);$i++){
			// 		$shipjs.='"'.$shiparray[$i].'",';

			// }
			// 		$shipjs = rtrim($shipjs,',');
					// $shipjs .= ']';
					
			// $servicejs='[';
			// $countsjs='[';
			
			// for($i=0;$i<(count($servicearray)<10?count($servicearray):10);$i++){

			// 	$servicejs.='"'.$servicearray[$i].'",';
				
			// 	$countsjs.='"'.$counts[$i].'",';
			// }
		

			// $servicejs = rtrim($servicejs,',');

			// $countsjs = rtrim($countsjs,',');
			// $servicejs .= ']';
			// $countsjs .= ']';




			// $servicemjs='[';
			// $countsmjs='[';
			// for($i=0;$i<(count($servicemarray)<10?count($servicemarray):10);$i++){

			// 	$servicemjs.='"'.$servicemarray[$i].'",';
				
			// 	$countsmjs.='"'.$countsm[$i].'",';
			// }

			// $servicemjs = rtrim($servicemjs,',');

			// $countsmjs = rtrim($countsmjs,',');
			// $servicemjs .= ']';
			// $countsmjs .= ']';


			$title="船东按ETD周期T量图";
			$titles="业务员按ETD周期T量图";
			
			$titlesm="业务经理按ETD周期T量图";
			
			// $data = [

			// 	// 'shipjs'=>$shipjs,
			// 	'title'=>$title,
			// 	'data'=>$data,
			// 	'shiparray'=>$shiparray,


			// 	'titles'=>$titles,
			// 	'datay'=>$datay,
			// 	'servicearray'=>$servicearray,


			// 	'titlesm'=>$titlesm,
			// 	'dataym'=>$dataym,
			// 	'servicemarray'=>$servicemarray,

				// 'json'=>$json,

				// 'countjsa'=>$countjsa,
				// 'countjsb'=>$countjsb,
				// 'countjsc'=>$countjsc,
				// 'servicemjs'=>$servicemjs,
				// 'countsmjs'=>$countsmjs,
				// 'servicejs'=>$servicejs,
				// 'countsjs'=>$countsjs,
				// 'title'=>$title,
				// 'titles'=>$titles,
				// 'titlesm'=>$titlesm,

			// ];


			pre(success($data,'请求成功！')) ;
			

			// $this->assign($data);

			// return view('tuxing/tuxing');


		}


	}



}



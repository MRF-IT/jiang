<?php
namespace app\index\controller;

use think\Controller;
use think\facade\Request;
use think\Db;

include('../vendor/phpexcel/PHPExcel.php');

class Newtradeexcel extends Controller
{
	public function index()
	{

		if(Request::isPost()){
			
			if (!empty($_FILES['excel']['name'])) {
		        $fileName = $_FILES['excel']['name']; //得到文件全名
		       

		        $dotArray = explode('.', $fileName);    //把文件名安.区分，拆分成数组

		        $type = end($dotArray);

		        if ($type != "xls" && $type != "xlsx") {
		        	$ret['res'] = "0";
		        	$ret['msg'] = "不是Excel文件，请重新上传!";
		        	pre($ret);
		        	return json_encode($ret);
		        }
		        
		        //取数组最后一个元素，得到文件类型
		        $uploaddir = "./excel_dir/" . date("Y-m-d") . '/';//设置文件保存目录 注意包含

		        if (!file_exists($uploaddir)) {
		        	mkdir($uploaddir, 0777, true);
		        }
		        
		        $path = $uploaddir . md5(uniqid(rand())) . '.' . $type; //产生随机文件名

		        //$path = "images/".$fileName; //客户端上传的文件名；
		        //下面必须是tmp_name 因为是从临时文件夹中移动
		        move_uploaded_file($_FILES['excel']['tmp_name'], $path); //从服务器临时文件拷贝到相应的文件夹下
		        
		        $file_path = $path;
		        if (!file_exists($path)) {
		        	$ret['res'] = "0";
		        	$ret['msg'] = "上传文件丢失!" . $_FILES['excel']['error'];
		        	pre($ret);
		        	return json_encode($ret);
		        }
		        
		        //文件的扩展名
		        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
		        if ($ext == 'xlsx') {
		        	$objReader = \PHPExcel_IOFactory::createReader('Excel2007');
		        	$objPHPExcel = $objReader->load($file_path, 'utf-8');
		        } elseif ($ext == 'xls') {
		        	$objReader = \PHPExcel_IOFactory::createReader('Excel5');
		        	$objPHPExcel = $objReader->load($file_path, 'utf-8');
		        }

		        
		        $sheet = $objPHPExcel->getSheet(0);
		        $highestRow = $sheet->getHighestRow(); // 取得总行数


		        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
		        $ar = array();
		        $i = 0;
		        $importRows = 0;

		        for ($j = 2; $j <= $highestRow; $j++) {
		        	$importRows++;
		            // echo $importRows;
		           $clerk = (string)$objPHPExcel->getActiveSheet()->getCell("A$j")->getValue();//需要导入的realName
		          

		              //需要导入的phone
		            $referencenum = (string)$objPHPExcel->getActiveSheet()->getCell("B$j")->getValue(); //需要导入的company
		            $bookingnum = (string)$objPHPExcel->getActiveSheet()->getCell("C$j")->getValue();     //需要导入的job
		            $jobnum = (string)$objPHPExcel->getActiveSheet()->getCell("D$j")->getValue();     //需要导入的job
		            


		            $departurecountry = (string)$objPHPExcel->getActiveSheet()->getCell("E$j")->getValue();     //需要导入的job
		            $departure = (string)$objPHPExcel->getActiveSheet()->getCell("F$j")->getValue();     //需要导入的job
		            $destination = (string)$objPHPExcel->getActiveSheet()->getCell("G$j")->getValue();     //需要导入的job
		            $destinationcountry = (string)$objPHPExcel->getActiveSheet()->getCell("H$j")->getValue();     //需要导入的job
		            $cabinettype = (string)$objPHPExcel->getActiveSheet()->getCell("I$j")->getValue();     //需要导入的job
		            $type20 = (string)$objPHPExcel->getActiveSheet()->getCell("J$j")->getValue();     //需要导入的job
		            $type40 = (string)$objPHPExcel->getActiveSheet()->getCell("K$j")->getValue();     //需要导入的job
		            $type45 = (string)$objPHPExcel->getActiveSheet()->getCell("L$j")->getValue();     //需要导入的job
		            $typehq = (string)$objPHPExcel->getActiveSheet()->getCell("M$j")->getValue();     //需要导入的job
		            $othertype = (string)$objPHPExcel->getActiveSheet()->getCell("N$j")->getValue();     //需要导入的job
		            $teu = (string)$objPHPExcel->getActiveSheet()->getCell("O$j")->getValue(); 
		                //需要导入的job
		            $etdtime = (Integer)$objPHPExcel->getActiveSheet()->getCell("P$j")->getValue(); 
		             $etdtime = ($etdtime-70*365-19)*86400-8*3600;     //需要导入的job
		                
		            $vevo = (string)$objPHPExcel->getActiveSheet()->getCell("Q$j")->getValue();     //需要导入的job
		            $routearea = (string)$objPHPExcel->getActiveSheet()->getCell("R$j")->getValue();     //需要导入的job
		            $shipowner = (string)$objPHPExcel->getActiveSheet()->getCell("S$j")->getValue();     //需要导入的job
		            $contractno = (string)$objPHPExcel->getActiveSheet()->getCell("T$j")->getValue();     //需要导入的job
		            $bookingstatus = (string)$objPHPExcel->getActiveSheet()->getCell("U$j")->getValue();     //需要导入的job
		            $preliminary = (string)$objPHPExcel->getActiveSheet()->getCell("V$j")->getValue();     //需要导入的job
		            
		            
		            
		               //需要导入的job
		            // var_dump($user);
		            // exit;
		            // $ret['mdata'] = $this->addMemb($phone, $realName, $company, $job, $email);//这里就是我的数据库添加操作定义的一个方法啦,对应替换为自己的
		           
		           $data = [
		           	'tradeid' => null, 
		           	'clerk' => $clerk, 
		           	'referencenum' => $referencenum, 
		           	
		           	'bookingnum' => $bookingnum,
		           	'jobnum' => $jobnum, 
		           	'departurecountry' => $departurecountry,
		           	'departure' => $departure,
		           	'destination' => $destination,
		           	'destinationcountry' => $destinationcountry,
		           	'cabinettype' => $cabinettype,
		           	'type20' => $type20,
		           	'type40' => $type40,
		           	'type45' => $type45,
		           	'typehq' => $typehq,
		           	'othertype' => $othertype,
		           	'teu' => $teu,
		           	'etdtime' => $etdtime,
		           	'vevo' => $vevo,
		           	'routearea' => $routearea,
		           	'shipowner' => $shipowner,
		           	'contractno' => $contractno,
		           	'bookingstatus' => $bookingstatus,
		           	'preliminary' => $preliminary,
		          
		           
		           
		           
		           ];


		           $ret['mdata'] = Db::name('trade')->insert($data);
		           



		           if ($ret['mdata']&& !is_Bool($ret['mdata'])) {
		           	$ar[$i] = $ret['mdata'];
		           	
		           	$i++;
		           }
		           
		       }
		       
		        // exit;
		       if ($i > 0) {
		       	$ret['res'] = "0";
		       	$ret['sucrNum'] = $i;
		       	$ret['allNum'] = $importRows;
		       	$ret['errNum'] = $importRows - $i;
		       	$ret['mdata'] = $ar;
		       	$ret['msg'] = "导入完毕!";
		       	pre($ret);
		       	return json_encode($ret);
		       }
		       $ret['res'] = "1";
		       $ret['allNum'] = $importRows;
		       $ret['errNum'] = 0;
		       $ret['sucNum'] = $importRows;
		       $ret['mdata'] = "导入成功!";
		       pre($ret);
		       return json_encode($ret);
		   } else {
		   	$ret['res'] = "0";
		   	$ret['msg'] = "上传文件失败!";
		   	pre($ret);
		   	return json_encode($ret);
		   }	
		}
		return view('excel/excel');
	}

	
}


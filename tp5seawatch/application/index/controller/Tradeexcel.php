<?php
namespace app\index\controller;

use think\Controller;
use think\facade\Request;
use think\Db;

include('../vendor/phpexcel/PHPExcel.php');

class Tradeexcel extends Controller
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
		           $bookcontractno = (string)$objPHPExcel->getActiveSheet()->getCell("A$j")->getValue();//需要导入的realName
		           $bookdate = (Integer)$objPHPExcel->getActiveSheet()->getCell("B$j")->getValue(); 

		           $bookdate = ($bookdate-70*365-19)*86400-8*3600;

		              //需要导入的phone
		            $bookcarrier = (string)$objPHPExcel->getActiveSheet()->getCell("C$j")->getValue(); //需要导入的company
		            $bookregion = (string)$objPHPExcel->getActiveSheet()->getCell("D$j")->getValue();     //需要导入的job
		            $bookstatus1 = (string)$objPHPExcel->getActiveSheet()->getCell("E$j")->getValue();     //需要导入的job
		            


		            $bookstatus2 = (string)$objPHPExcel->getActiveSheet()->getCell("F$j")->getValue();     //需要导入的job
		            	$bookcarrierso	 = (string)$objPHPExcel->getActiveSheet()->getCell("G$j")->getValue();     //需要导入的job
		             $bookhpl= (string)$objPHPExcel->getActiveSheet()->getCell("H$j")->getValue();     //需要导入的job
		            $bookrefno = (string)$objPHPExcel->getActiveSheet()->getCell("I$j")->getValue();     //需要导入的job
		            $bookts = (string)$objPHPExcel->getActiveSheet()->getCell("J$j")->getValue();     //需要导入的job
		            $bookprcno = (string)$objPHPExcel->getActiveSheet()->getCell("K$j")->getValue();     //需要导入的job
		            $bookpol = (string)$objPHPExcel->getActiveSheet()->getCell("L$j")->getValue();     //需要导入的job
		            $bookpod = (string)$objPHPExcel->getActiveSheet()->getCell("M$j")->getValue();     //需要导入的job
		             $book20  = (string)$objPHPExcel->getActiveSheet()->getCell("N$j")->getValue();     //需要导入的job
		            $book40= (string)$objPHPExcel->getActiveSheet()->getCell("O$j")->getValue();     //需要导入的job
		            $book40hq = (string)$objPHPExcel->getActiveSheet()->getCell("P$j")->getValue();     //需要导入的job
		            $bookother = (string)$objPHPExcel->getActiveSheet()->getCell("Q$j")->getValue();     //需要导入的job
		            $booktue = (string)$objPHPExcel->getActiveSheet()->getCell("R$j")->getValue();     //需要导入的job
		             $bookweight= (string)$objPHPExcel->getActiveSheet()->getCell("S$j")->getValue();     //需要导入的job
		            $bookcommodity= (string)$objPHPExcel->getActiveSheet()->getCell("T$j")->getValue();     //需要导入的job
		             $bookfvetd  = (Integer)$objPHPExcel->getActiveSheet()->getCell("U$j")->getValue(); 
		             $bookfvetd = ($bookfvetd-70*365-19)*86400-8*3600;   //需要导入的job
		           $bookmvetd = (Integer)$objPHPExcel->getActiveSheet()->getCell("V$j")->getValue(); 
		            $bookmvetd = ($bookmvetd-70*365-19)*86400-8*3600;     //需要导入的job
		             $bookweek = (string)$objPHPExcel->getActiveSheet()->getCell("W$j")->getValue();
		             $bookmonth = (string)$objPHPExcel->getActiveSheet()->getCell("X$j")->getValue();
		             $bookservice = (string)$objPHPExcel->getActiveSheet()->getCell("Y$j")->getValue();
		             $bookvelvoy = (string)$objPHPExcel->getActiveSheet()->getCell("Z$j")->getValue();
		             $bookpic = (string)$objPHPExcel->getActiveSheet()->getCell("AA$j")->getValue();
		             $bookmgr = (string)$objPHPExcel->getActiveSheet()->getCell("AB$j")->getValue();
		             $bookdept = (string)$objPHPExcel->getActiveSheet()->getCell("AC$j")->getValue();
		             $bookremark = (string)$objPHPExcel->getActiveSheet()->getCell("AD$j")->getValue();
		             $bookagent = (string)$objPHPExcel->getActiveSheet()->getCell("AE$j")->getValue();
		             $bookoperator = (string)$objPHPExcel->getActiveSheet()->getCell("AF$j")->getValue();
		             $bookcontract = (string)$objPHPExcel->getActiveSheet()->getCell("AG$j")->getValue();
		             $bookdocclerk = (string)$objPHPExcel->getActiveSheet()->getCell("AH$j")->getValue();
		           
		               //需要导入的job
		            // var_dump($user);
		            // exit;
		            // $ret['mdata'] = $this->addMemb($phone, $realName, $company, $job, $email);//这里就是我的数据库添加操作定义的一个方法啦,对应替换为自己的
		           
		           $data = [
		           	'bookid' => null, 
		           	'bookcontractno' => $bookcontractno, 
		           	'bookdate' => $bookdate, 
		           	
		           	'bookcarrier' => $bookcarrier,
		           	'bookregion' => $bookregion, 
		           	'bookstatus1' => $bookstatus1,
		           	'bookstatus2' => $bookstatus2,
		           	'bookcarrierso' => $bookcarrierso,
		           	'bookhpl' => $bookhpl,
		           	'bookrefno' => $bookrefno,
		           	'bookts' => $bookts,
		           	'bookprcno' => $bookprcno,
		           	'bookpol' => $bookpol,
		           	'bookpod' => $bookpod,
		           	'book20' => $book20,
		           	'book40' => $book40,
		           	'book40hq' => $book40hq,
		           	'bookother' => $bookother,
		           	'booktue' => $booktue,
		           	'bookweight' => $bookweight,
		           	'bookcommodity' => $bookcommodity,
		           	
		           	'bookfvetd' => $bookfvetd,
		           	'bookmvetd' => $bookmvetd,
		           
		           	'bookweek' => $bookweek,
		           	'bookmonth' => $bookmonth,
		           	'bookservice' => $bookservice,
		           	'bookvelvoy' => $bookvelvoy,
		           	'bookpic' => $bookpic,
		           	'bookmgr' => $bookmgr,
		           	'bookdept' => $bookdept,
		           	'bookremark' => $bookremark,
		           	'bookagent' => $bookagent,
		           	'bookoperator' => $bookoperator,
		           	'bookcontract' => $bookcontract,
		           	'bookdocclerk' => $bookdocclerk,
		           ];


		           $ret['mdata'] = Db::name('booktrade')->insert($data);
		           



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


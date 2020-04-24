<?php
namespace app\index\controller;

use think\Controller;
use think\facade\Request;
use think\Db;

include('../vendor/phpexcel/PHPExcel.php');

class Excel extends Controller
{
	public function index()
	{

		if(Request::isPost()){
			
			if (!empty($_FILES['excel']['name'])) {
		        $fileName = $_FILES['excel']['name'];    //得到文件全名

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
		           $bookclerk = (string)$objPHPExcel->getActiveSheet()->getCell("A$j")->getValue();//需要导入的realName
		           $bookdate = (Integer)$objPHPExcel->getActiveSheet()->getCell("B$j")->getValue(); 
		           $bookdate = ($bookdate-70*365-19)*86400-8*3600;

		              //需要导入的phone
		            $bookpro = (string)$objPHPExcel->getActiveSheet()->getCell("C$j")->getValue(); //需要导入的company
		            $servicenumber = (string)$objPHPExcel->getActiveSheet()->getCell("D$j")->getValue();     //需要导入的job
		            $bookcydate = (Integer)$objPHPExcel->getActiveSheet()->getCell("E$j")->getValue();     //需要导入的job
		            $bookcydate = ($bookcydate-70*365-19)*86400-8*3600;



		            $book20gp = (string)$objPHPExcel->getActiveSheet()->getCell("F$j")->getValue();     //需要导入的job
		            	$book40gp	 = (string)$objPHPExcel->getActiveSheet()->getCell("G$j")->getValue();     //需要导入的job
		             $book40hq= (string)$objPHPExcel->getActiveSheet()->getCell("H$j")->getValue();     //需要导入的job
		            $booktue = (string)$objPHPExcel->getActiveSheet()->getCell("I$j")->getValue();     //需要导入的job
		            $hpl = (string)$objPHPExcel->getActiveSheet()->getCell("J$j")->getValue();     //需要导入的job
		            $bookpol = (string)$objPHPExcel->getActiveSheet()->getCell("K$j")->getValue();     //需要导入的job
		            $bookpod = (string)$objPHPExcel->getActiveSheet()->getCell("L$j")->getValue();     //需要导入的job
		            $bookship = (string)$objPHPExcel->getActiveSheet()->getCell("M$j")->getValue();     //需要导入的job
		             $bookside  = (string)$objPHPExcel->getActiveSheet()->getCell("N$j")->getValue();     //需要导入的job
		            $bookcontract= (string)$objPHPExcel->getActiveSheet()->getCell("O$j")->getValue();     //需要导入的job
		            $bookso = (string)$objPHPExcel->getActiveSheet()->getCell("P$j")->getValue();     //需要导入的job
		            $bookvelvoy = (string)$objPHPExcel->getActiveSheet()->getCell("Q$j")->getValue();     //需要导入的job
		            $bookdepart = (string)$objPHPExcel->getActiveSheet()->getCell("R$j")->getValue();     //需要导入的job
		             $servicemanager= (string)$objPHPExcel->getActiveSheet()->getCell("S$j")->getValue();     //需要导入的job
		            $serviceman= (string)$objPHPExcel->getActiveSheet()->getCell("T$j")->getValue();     //需要导入的job
		             $fileman  = (string)$objPHPExcel->getActiveSheet()->getCell("U$j")->getValue();     //需要导入的job
		           $cabinet = (string)$objPHPExcel->getActiveSheet()->getCell("V$j")->getValue();     //需要导入的job
		               //需要导入的job
		            // var_dump($user);
		            // exit;
		            // $ret['mdata'] = $this->addMemb($phone, $realName, $company, $job, $email);//这里就是我的数据库添加操作定义的一个方法啦,对应替换为自己的
		           
		           $data = [
		           	'bookid' => null, 
		           	'bookclerk' => $bookclerk, 
		           	'bookdate' => $bookdate, 
		           	'bookpro' => $bookpro,
		           	'servicenumber' => $servicenumber,
		           	'bookcydate' => $bookcydate, 
		           	'book20gp' => $book20gp,
		           	'book40gp' => $book40gp,
		           	'book40hq' => $book40hq,
		           	'booktue' => $booktue,
		           	'hpl' => $hpl,
		           	'bookpol' => $bookpol,
		           	'bookpod' => $bookpod,
		           	'bookship' => $bookship,
		           	'bookside' => $bookside,
		           	'bookcontract' => $bookcontract,
		           	'bookso' => $bookso,
		           	'bookvelvoy' => $bookvelvoy,
		           	'bookdepart' => $bookdepart,
		           	'servicemanager' => $servicemanager,
		           	'serviceman' => $serviceman,
		           	'fileman' => $fileman,
		           	'cabinet' => $cabinet,
		           ];


		           $ret['mdata'] = Db::name('bookspace')->insert($data);
		           



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


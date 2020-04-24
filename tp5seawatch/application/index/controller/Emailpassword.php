<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\facade\Request;



class Emailpassword extends Common
{
  public function index()
  {
    
header("Access-Control-Allow-Origin:*"); 

// $user = array(
// 	"userid"=>"nora@jiazelogistics.com",
// 	"name"=> "nora",
// 	"department"=> array(1,2),
// 	"position"=> "文件",
// 	"mobile"=> "15913215421",
// 	"gender"=> "2",
// 	"enable"=> 1,
// 	"password"=>"Jz112233",
// 	"cpwd_login"=>0
// 	);



// echo '<pre>';
// print_r($user);
// echo '</pre>';

// json_encode(value)  PHP数组 转 json
// json_decode(json)  json  转PHP数组
  //这里就是你要的数据
// $json = json_decode($user); 
  //这里就是你要的数据
  //
  //
   
//   if(Request::isPost()){

// //   	Array
// // (
// //     [userid] => 12
// //     [enable] => 1
// //     [password] => eeee
// //     [cpwd_login] => 0
// // )
//   	$emailupdate=input('post.');
//   	$emailkey=array_keys($emailupdate);
//   	$emailvalue=array_values($emailupdate);

// 	// pre($emailkey);
// 	// pre($emailvalue);

//   	// $departjs='[';
// 			// $countjs='[';

			
// 			// for($i=0;$i<(count($depart)<25?count($depart):25);$i++){

// 			// 	$departjs.='"'.$depart[$i].'",';
				
// 			// 	$countjs.='"'.$count[$i].'",';
// 			// }

// 			// $departjs = rtrim($departjs,',');

// 			// $countjs = rtrim($countjs,',');
// 			// $departjs .= ']';
		
// 			// $countjs .= ']';
// 			// $servicearray=array_keys($ss);
// 			// $counts=array_values($ss);

// 			$emailjs='{';
//   	for($i=0;$i<count($emailupdate);$i++){
//   		$emailjs.='"'.$emailkey[$i].'":'.'"'.$emailvalue[$i].'",';
				
//   	}
//   	$emailjs = rtrim($emailjs,',');
//   	$emailjs .= '}';
		
//    $data=[

//    	'emailjs'=>$emailjs,
//    ];
// 	$this->assign($data);
//   return view('emailpassword/ajaxtest');

//   	// pre($json);

//   }else{

// $emailjs='';
//     $data=[

//     'emailjs'=>$emailjs,
//    ];
//   $this->assign($data);
//   
//   
//   
     // token?grant_type=client_credential&appid={$this->appId}&secret=".$this->appSevret; 
//       $url = "https://api.exmail.qq.com/cgi-bin/gettoken?corpid=
// ww921a4970fdb80915&corpsecret=21IMFXF4U-ojj3INDsVGl6TLTmE6TFP8iYIWJiz03sTGuYukyOLKerUFch938Dxd";
            // $json = $this->httpsRequest($url);
//        json转数组
//             $arr = json_decode($json,1);
// //        $access_token 字符串
//             $access_token = $arr['access_token'];
//             file_put_contents($filename,$access_token);
           
      return view('emailpassword/ajaxtest');




  
    

  }


}
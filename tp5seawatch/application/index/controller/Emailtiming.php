<?php
namespace app\index\controller;

use think\facade\Request;
use think\Controller;
use think\Db;
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
// require 'vendor/autoload.php';
use Email\Email;

class Emailtiming
{
    public function index()
    {

 

    	// return view();
    	// Email::send('993749289@qq.com','j18681461311@163.com','测试邮箱标题','这个是可测试邮箱内容');
  //   	ignore_user_abort();//关掉浏览器，PHP脚本也可以继续执行.
		// set_time_limit(0);// 通过set_time_limit(0)可以让程序无限制的执行下去
		// // $timeb ='03-28';//672678000  704304000  31626000  735840000  767376000  31536000 767376000 767462400 767548800 798912000 1585238400 796233600  827856000 859392000 1585238400 922464000 1553616000
		
		$timen=date('m-d',time());
	
		
		
       $birthdaylist=Db::name('birthdayemail')->column('name,englishname,idcard,birthdayid,emailaddr');
       // $email=Db::name('email')->select();

  // foreach($email as $v){
  //    $emailenglishname[]=$v['englishname'];
  // }

       foreach($birthdaylist as $v){
                $idcardlist[]=$v['idcard'];
                $englishname[]=$v['englishname'];
                $birthdayid[]=$v['birthdayid'];
                $emailaddr[]=$v['emailaddr'];

       }


    // for($i=0;$i<count($englishname);$i++){

    // 	 $emailaddr[]=Db::name('email')->where('englishname','=',$englishname[$i])->column('emailname');
    	
        
    // }
    // pre($englishname);
    // pre($emailaddr);

// $emailaddr = array_reduce($emailaddr, 'array_merge', array());


// 		for($i=0;$i<count($englishname);$i++){
// 		    	$bool=Db::name('birthdayemail')->where('birthdayid','=',$birthdayid[$i])->setField('emailaddr',$emailaddr[$i]);
		    	
		    	
// 		    }

		
       foreach($idcardlist as $idcard){
       	$birth[] = date('m-d',strtotime(substr($idcard, 6, 8)));
       }

		// // while(true){
		// 			//   sleep(86400);
		// 			//   
		for($i=0;$i<count($birth);$i++){
			if($birth[$i]==$timen){
			 $flag= Email::send($emailaddr[$i],'注册成功','恭喜你加入爱代码，爱生活世界');
						if($flag){
						    echo "发送邮件成功！";
						}else{
						    echo "发送邮件失败！";
						}

			
		}		
			
		}
		  	
   //  $flag= Email::send('j18681461311@163.com','注册成功','恭喜你加入爱代码，爱生活世界');
			// if($flag){
			//     echo "发送邮件成功！";
			// }else{
			//     echo "发送邮件失败！";
			// }



		// $mail = new PHPMailer(true);

		// try {
		//     //Server settings
		//     $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
		//     $mail->isSMTP();                                            // Send using SMTP
		//     $mail->Host       = 'smtp.qq.com';                    // Set the SMTP server to send through
		//     $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		//     $mail->Username   = '3067148074@qq.com';                     // SMTP username
		//     $mail->Password   = 'zyxwezftmynldgfb';                               // SMTP password
		//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
		//     $mail->Port       = 587;                                    // TCP port to connect to

		//     //Recipients
		//     $mail->setFrom('3067148074@qq.com', 'Mailer');
		//     // $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient 2131056841@qq.com
		//     $mail->addAddress('2131056841@qq.com');               // Name is optional
		//     // $mail->addReplyTo('info@example.com', 'Information');
		//     // $mail->addCC('cc@example.com');
		//     // $mail->addBCC('bcc@example.com');

		//     // Attachments
		//     // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//     // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		//     // Content
		//     $mail->isHTML(true);                                  // Set email format to HTML
		//     $mail->Subject = '测试邮箱标题';
		//     $mail->Body    = '这个是可测试邮箱内容';
		//     // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		//     $mail->send();
		//     echo '邮件发送成功';
		// } catch (Exception $e) {
		//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		// }
	}

    
}

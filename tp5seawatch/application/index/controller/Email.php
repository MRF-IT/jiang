<?php

namespace app\index\controller;
class Email {

 public function email() {

 	alert(111);
        $toemail='1904099796@qq.com';
        $name='static7';
        $subject='QQ邮件发送测试';
        $content='恭喜你，邮件测试成功。';
        dump(send_mail($toemail,$name,$subject,$content));
    }
    }
<?php  

namespace app\index\controller;
use think\facade\Request;
use think\Controller;
use think\Db;
// use app\index\model\Nav;

class Timetest extends Common
{
	public function index(){







		ignore_user_abort();//关掉浏览器，PHP脚本也可以继续执行.
		set_time_limit(0);// 通过set_time_limit(0)可以让程序无限制的执行下去
		$timeb =strtotime('1994-04-27');//672678000  704304000  31626000  735840000  767376000  31536000
		$timen=time();

		while(true){
		  sleep(3);
		$timen=time();

		  	file_put_contents('log.txt', $timen.PHP_EOL,FILE_APPEND);
		}
}
}

?>
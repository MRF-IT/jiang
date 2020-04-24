<?php


// 应用公共文件
function pre($con){
	echo '<pre>';
	print_r($con);
	echo '</pre>';
	exit;
}


/**
 * 标签字符串替换带截取
 * @param $substr [string] 
 * @param $start [int] 
 * @param $length [int] 
 * @param $charset [charset]
 * @return new string
 */

function my_replace($substr, $start, $length, $charset=''){
	$pattern = "/<[^<>]+>/";
	$content = preg_replace($pattern, '', $substr);

	if($charset){
		return mb_substr($content,$start, $length, $charset);
	}else{
		return mb_substr($content,$start, $length);
	}
	
}


function periodDate($start_time,$end_time){
    $start_time = strtotime($start_time);
    $end_time = strtotime($end_time);
    $i=0;
    while ($start_time<=$end_time){
        $arr[$i]=date('Y-m-d',$start_time);
        $start_time = strtotime('+1 day',$start_time);
        $i++;
    }

    return $arr;
}



function sliceArr($arr, $num)
{
    //数组的个数
    $listcount = count($arr);
    /*if($listcount < $num){
        //数组总数不能少于需要获取的数量
        return [];
    }*/
    $num = $listcount < $num ? $listcount:$num;
    //分成$num 个数组每一个数组是多少个元素
    $parem = floor($listcount / $num);
    //分成$num 个数组还余多少个元素
    $paremm = $listcount % $num;
    $start = 0;
    $new_array = [];
    for ($i = 0; $i < $num; $i++) {
        $end = $i < $paremm ? $parem + 1 : $parem;
        $new_array[$i] = array_slice($arr, $start, $end);
        $start = $start + $end;
    }

    return $new_array;
}


function  trim_value (& $value ) {
 $value  =  trim ( $value );
}

function set_value($name){
    return isset($_SESSION[$name])?$_SESSION[$name]:"";
}


function success($data=[],$msg='',$ret='200'){
   return json_encode(['ret'=>$ret,'msg'=>$msg,'data'=>$data]);
}
<?php

class Api{
    public $corpid;
    public $corpsecret;

    public function __construct($corpid,$corpsecret){
        $this->corpid = $corpid;
        $this->corpsecret = $corpsecret;
    }

//    新增临时素材
    // public function add_lssc($media,$type){

    //     $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token={$this->get_access_token()}&type=".$type;
    //     $img = $media;
    //     $img = realpath($img);
    //     $data = ['media'=>new CURLFile($img)];
    //     $status = $this->httpsRequest($url,$data);
    //     var_dump($status);
    // }

    //获取临时素材
    // public function get_token(){
    //     // $mid = "RA2qkr3_OhnSjdrZ0D_lKE_4NIe42jI-bQFEdqExiMSt2BRt4O-8vx3acWcPuYSp";&media_id=$mid
    //     $url = "https://api.weixin.qq.com/cgi-bin/media/get?access_token={$this->get_access_token()}";
    //     echo $this->httpsRequest($url);
    // }


 //    public function create_menu(){
 //        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$this->get_access_token();

 //        $data = '{
 //     "button":[
 //     {
 //          "type":"click",
 //          "name":"今日歌曲",
 //          "key":"MUSIC"
 //      },
 //      {
 //          "type":"click",
 //          "name":"新闻",
 //          "key":"NEWS"
 //      },
 //      {
 //           "name":"菜单",
 //           "sub_button":[
 //           {
 //               "type":"view",
 //               "name":"搜索",
 //               "url":"http://www.baidu.com/"
 //            },
 //            {
 //               "type":"view",
 //               "name":"JSSDK",
 //               "url":"http://wx.wangliang.wang/jssdk.php"
 //            },
 //            {
 //               "type":"click",
 //               "name":"赞一下我们",
 //               "key":"ZAN"
 //            }]
 //       }]
 // }';
 //        $status = $this->httpsRequest($url,$data);
 //        var_dump($status);
 //    }















//    获取access_token
    // public function get_access_token(){

//        把这个字符串写到一个文件里
//         $filename = './cache/'.md5($this->appId.$this->appSevret).'_access_token.txt';


//         if(file_exists($filename) && is_file($filename)){
// //            文件存在
//             $filectime = filectime($filename)+7000;
//             $time = time();
//             if($filectime<$time){  //已过期
//                 $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appId}&secret=".$this->appSevret;
//                 $json = $this->httpsRequest($url);
// //        json转数组
//                 $arr = json_decode($json,1);
// //        $access_token 字符串
//                 $access_token = $arr['access_token'];
//                 file_put_contents($filename,$access_token);
//                 return $access_token;
//             }else{  //未过期
//                 return file_get_contents($filename);
//             }
//         }else{
//            文件不存在
            // $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appId}&secret=".$this->appSevret; 
//       $url = "https://api.exmail.qq.com/cgi-bin/gettoken?corpid=
// {$this->corpid}&corpsecret=".$this->corpsecret;
//             $json = $this->httpsRequest($url);
// //        json转数组
//             $arr = json_decode($json,1);
// //        $access_token 字符串
//             $access_token = $arr['access_token'];
//             file_put_contents($filename,$access_token);
//             return $access_token;
//         // }
//     }


















    /**
     * CURL请求
     *
//      * @param $url
//      * @param null $data
//      * @return mixed
//      */
//     public function httpsRequest($url,$data = null){

//         $curl = curl_init();
//         curl_setopt($curl, CURLOPT_URL, $url);
//         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
//         curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
//         if (!empty($data)){
//             curl_setopt($curl, CURLOPT_POST, 1);
//             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
//         }
//         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//         $output = curl_exec($curl);
//         curl_close($curl);
//         return $output;
//     }
// }


}






?>
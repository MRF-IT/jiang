<?php 
namespace app\index\validate;	

use think\Validate;


class Pneumonia extends Validate
{
    protected $rule =   [
        'username'  => 'require|min:2|max:10',
        'englishname'   => 'require|min:2|max:10',
        'depart'   => 'require',
       
        'place'   => 'require',
        'temperature'   => 'require',
        'placem'   => 'require',
        'bookday'   => 'require',
        'goday'   => 'require',
        'outdoors'   => 'require',
        'mask'   => 'require',
        'masknum'   => 'require|min:0|max:100',
       
        
      
    ];

 
    protected $message  =   [
        'username.require' => '姓名必须',
        'username.max'     => '姓名最多不能超过10个字符',
        'username.min'     => '姓名最少不能少于2个字符',
        'englishname.require'   => '英文名必须',
        'englishname.max'     => '英文名最多不能超过10个字符',
        'englishname.min'     => '英文名最少不能少于2个字符',
        'depart.require'     => '部门必须',
        'place.require'     => '年休地必须',
        'placem.require'     => '现在地必须',
        'temperature.require'     => '体温测量必须',
        'bookday.require'     => '填表日期必须',
        'goday.require'     => '回深日期必须',
        'outdoors.require'     => '是否外出必须',
        'mask.require'     => '口罩型号必须',
        'masknum.require'     => '口罩数量必须',
        'masknum.min'     => '口罩数量不能少于0个',
        'masknum.max'     => '口罩数量不能超过100个',
           
    ];


}


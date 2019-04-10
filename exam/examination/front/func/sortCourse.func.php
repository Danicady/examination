<?php
/**
 * Created by PhpStorm.
 * User: 19473
 * Date: 2018/11/12
 * Time: 15:39
 */
function sortCourse($type)
{
    foreach ($type as $key=>$val)
    {

        switch ($val['course'])
        {
            case '写作':
                $type[$key]['index']=1;
                break;
            case '听力':
                $type[$key]['index']=2;
                break;
            case '选择题':
                $type[$key]['index']=3;
                break;
            case '填空题':
                $type[$key]['index']=4;
                break;
            case '判断题':
                $type[$key]['index']=5;
                break;
            case '应用题':
                $type[$key]['index']=6;
                break;
            case '选词填空':
                $type[$key]['index']=7;
                break;
            case '长篇阅读':
                $type[$key]['index']=8;
                break;
            case '仔细阅读':
                $type[$key]['index']=9;
                break;
            case '翻译':
                $type[$key]['index']=10;
                break;



        }
    }

    $flag = array();
    foreach($type as $v){
        $flag[] = $v['index'];
    }
    array_multisort($flag, SORT_ASC, $type);
    return $type;
}
function removeNull($type)
{
    foreach( $type as $k=>$v) {
        if($v['num']=='') unset($type[$k]);
    }
    $type = array_merge($type);
    return $type;
}


function getRandChar($length){
    $str = null;
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";//大小写字母以及数字
    $max = strlen($strPol)-1;

    for($i=0;$i<$length;$i++){
        $str.=$strPol[rand(0,$max)];
    }
    return $str;
}

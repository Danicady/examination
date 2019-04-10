<?php
/**
 * Created by PhpStorm.
 * User: 19473
 * Date: 2018/11/9
 * Time: 10:16
 */
require 'include.php';
header("Content-Type: text/html; charset=UTF-8");
include "phpword/phpword/PHPWord.php";
include 'paichon.php';
$token='c4ca4238a0b923820dcc509a6f75849b';
$sql = "select userID from user WHERE token='{$token}'";

$res = fetchOne($sql);
$userID=$res['userID'];
$difficulty='易';//难易程度
$chioceClass='1';//选择班级
$unit='1';//选择单元
$type= array(
    array('course'=>'判断题','num'=>'1','grade'=>100),
    array('course'=>'选择题','num'=>'3','grade'=>100),
    array('course'=>'填空题','num'=>'14','grade'=>100),
//
);//是一个数组 0:科目 1:数目 2:分数
$type=removeNull($type);
//$type=sortCourse($type);

$tques=array();//选择科目
$courseID=null;
$num=array();
$grade=array();
$course ='HTML5应用开发';
$examTime="30";
$pnature="A";
$nianji="2015级、2016级软件工程专业 本科";
$title = "成都东软学院";
$tiS="课程名称：{$course}  适用：{$nianji}";
$tiT="【 √ 】闭卷";


$time = getCurrentYear();
$preTime = intval($time)-1;
$currenYear="{$preTime}-{$time}";



$grade = null;
$response=array();


$sql="select courseID from course WHERE cname ='{$course}' ";

$res = fetchOne($sql);

$courseID=$res['courseID'];

$num=array();
$titleNum=array();

//$choiceCourse = [];
foreach ($type as $key=>$val) {
    $sql = "select * from subject WHERE courseID='{$courseID}'AND difficulty ='{$difficulty}' AND unit='{$unit}'AND type ='{$val['course']}'";
    $mes = fetchAll($sql);

    if (!is_null($mes)) {
        $grade +=$val['grade']*count($mes);
        $border = intval($val['num']);
        if (count($mes) == 1) {
            $border = 1;
        } else if ($border == count($mes)) {
            $border = count($mes);
        } else if ($border > count($mes)) {
            $border = count($mes);
        }

        if (count($mes) == $border) {
            $numbers = range(0, count($mes) - 1);
        } else {
            $numbers = range(0, count($mes) - 1);
        }

        $flag = array_rand($numbers, $border);
        $numBorder=$border>1?$border:1;
        //   $val['course']=$val['course']."(".$val['grade']*$numBorder."分)";
        $val['course']=$val['course']."("."每小题".$val['grade']."分,"."本题共".$val['grade']*$numBorder."分)";
        if ($border > 1) {
            for ($i = 0; $i < $border; $i++) {

                $response[$val['course']][] = $mes[$flag[$i]];
            }
        } else {


            $response[$val['course']][] = $mes[0];
        }

    }
}
foreach ($response as $value){
    foreach ($value as $v){
        $num[]=$v['sid'];
    }
}

//foreach ($response as $key =>$value)
//{
//
//  $titleNum[$key]=count($value);
//
//}
//var_dump($titleNum);

$ans = paichon($courseID,$num);


$phpWord=new PHPWord();
$templateProcessor=$phpWord->loadTemplate('test.docx');

$templateProcessor->setValue('num0',$currenYear);
$templateProcessor->setValue('num',$unit);
$templateProcessor->setValue('ab',$pnature);
$templateProcessor->setValue('course',$course);
$templateProcessor->setValue('suit',$chioceClass);
$str='';
//$title=['一、选择题'];
$i=1;

foreach ($response as $key =>$value)
{
    $str.='<w:rFonts w:hint="eastAsia" w:ascii="黑体" w:hAnsi="黑体" w:eastAsia="黑体"/>'.number2chinese($i,false).'、 '.$key.'<w:br />'.'	';
    foreach ($value as $f =>$it)
    {
        $arry = explode('\n', $it['question']);
    //xml转义字符
        $arry = str_replace(array('<','>'),array('&lt; ','&gt; '),$arry);
        if (count($arry) >= 2) {
            foreach ($arry as $it => $v) {
                if ($it == 0) {
                    // $section->addText(($f + 1) . ':' . $v, 'myOwnStyle');
                    $str.=($f + 1) . '.  ' . $v.'<w:br />'.'	';
                } else {
//                            $section->addText($v, 'myOwnStyle');
                    $str.=  $v.'<w:br />'.'	';

                }

            }
        }
        else {
            //  $section->addText(($f + 1) . ':' . $arry[0], 'myOwnStyle');
            $str.=($f + 1) . '.  '. $arry[0].'<w:br />'.'	';
//                    $section->addTextBreak(1);
        }
    }
    $i++;
}

$templateProcessor->setValue('pro1',$str);
$templateProcessor->save('test1.docx');
var_dump($str);
//$templateProcessor->save('test1.docx');

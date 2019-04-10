<?php
/**
 * Created by PhpStorm.
 * User: lamb.18281578906
 * Date: 2018/11/13
 * Time: 11:25
 */
//var_dump(phpinfo());

//var_dump($pid);

require_once 'include.php';
$pid=$_GET['id'];
//$pid=32;
$sql ="select * from paper where pid='{$pid}'";

$res=fetchOne($sql);
//$word = new COM("word.application");
//
//var_dump($word);
function word2html($wordname,$htmlname)
{
    $word = new COM("word.application") or die("Unable to instanciate Word");
    $word->Visible = 1;
    $word->Documents->Open($wordname);
    $word->Documents[1]->SaveAs($htmlname,8);
    $word->Quit();
    $word = null;
    unset($word);

}


$filename=$res['place'];
//var_dump($filename);
//$str='D:\HTML\xampp\htdocs\php\upload';
//
//var_dump(dirname($filename));
$res=explode('\\',$filename);
//
$last=end($res);

//var_dump($end);


//var_dump($htmlSrc);

word2html($filename,$filename.'.html');
$htmlSrc=$filename.'.html';
//var_dump($htmlSrc);

$front="http://10.195.7.51:9090/Examination/exam/examination/front/upload/".$last.'.html';
echo $front;
//header("location:$front");





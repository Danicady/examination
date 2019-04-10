<?php
/**
 * Created by PhpStorm.
 * User: 19473
 * Date: 2018/11/14
 * Time: 15:28
 */

//require_once 'include.php';
//header("Content-Type: text/html; charset=UTF-8");
//$pid=$_GET['id'];
////$pid=17;
//$sql = "select place from paper WHERE pid='{$pid}'";
//$mes = fetchOne($sql);
//
//download_by_path($mes['place']);
//function download_by_path($path_name){
//    ob_end_clean();
//
//    $hfile = fopen($path_name, "rb") or die("Can not find file: $path_name\n");
//    echo $hfile;
//    $fileinfo=pathinfo($path_name);
////    Header("Content-type: application/octet-stream");
////    Header("Content-Transfer-Encoding: binary");
////    Header("Accept-Ranges: bytes");
//    Header("Content-Length: ".filesize($path_name));
//    Header("Content-Disposition: attachment; filename={$fileinfo['filename']}.doc");
//    while (!feof($hfile)) {
//
//        echo fread($hfile, 1024);
//    }
//    fclose($hfile);
//}
require_once 'include.php';
$pid=$_GET['id'];
//$pid=17;
$sql = "select place from paper WHERE pid='{$pid}'";
$mes = fetchOne($sql);

header("Content-type:text/html;charset=utf-8");




$file_dir = $mes['place'];   //下载文件存放目录
//检查文件是否存在
if (! file_exists ( $file_dir  )) {
    echo "文件找不到";
    exit ();
} else {
    $file_dir=iconv("UTF-8","gb2312",$file_dir) ;
    //将编码转为支持中英文的gb2312编码
    if(!isset($file_dir)||trim($file_dir)==''){
        return '500服务器内部错误';
    }
    if(!file_exists($file_dir)){ //检查文件是否存在
        return '404访问的文件不存在';
    }
    $file_type=explode('.',$file_dir);
    $file_type=$file_type[count($file_type)-1];
    // $file_name=trim($new_name=='')?$file_name;

    //输入文件标签
    header("Content-type: application/octet-stream");
    header("Accept-Ranges: bytes");
    header("Accept-Length: ".filesize($file_dir));
    $fileinfo=pathinfo($file_dir);
    $filename=$fileinfo['filename'].'.docx';
    header("Content-Disposition: attachment; filename=".$filename);
    $file_type=fopen($file_dir,'rb'); //打开文件
    echo $file_type;
    //输出文件内容
    $file_size=filesize($file_dir);//获取文件大小
    $buffer=1024;   //定义1KB的缓存空间
    $file_count=0;  //计数器,计算发送了多少数据
    while(!feof($file_type) && ($file_size>$file_count))
    { //feof检测是否已经到达文件末尾
        //如果文件还没读到结尾，且还有数据没有发送
        $senddata=fread($file_type,$buffer);
        //读取文件内容到缓存区
        $file_count+=$senddata;
        echo $senddata;
    }
    //echo fread($file_type,filesize($file_url));
    fclose($file_type);
}
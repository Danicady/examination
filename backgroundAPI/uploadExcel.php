<?php
/**
 * Created by PhpStorm.
 * User: 19473
 * Date: 2018/11/6
 * Time: 16:17
 */
require_once 'v1.7.6/Classes/PHPExcel.php';
require_once 'v1.7.6/Classes/PHPExcel/IOFactory.php';
require_once 'v1.7.6/Classes/PHPExcel/Reader/Excel5.php';




//$path ='D:/study/web/workplace/excelTomysql/';

$path =dirname(__FILE__);
$filename=$_FILES['myFile']['name'];
$dest = $path.'/'.$filename;
$res = move_uploaded_file($_FILES['myFile']['tmp_name'],$dest);
$link = mysqli_connect('localhost','root','root','exam');
mysqli_select_db($link,'subject');

if($res)

{
    $objReader = PHPExcel_IOFactory::createReader('excel2007');
//    $excelpath='upload.xlsx';
    $objPHPExcel = $objReader->load($filename);
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();
    for($j=2;$j<=$highestRow;$j++)                        //从第二行开始读取数据

    {

        $str = "";

        for ($k = 'A'; $k <= $highestColumn; $k++)            //从A列读取数据

        {

            $str .= $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue() . '|*|';//读取单元格

        }

        $str=mb_convert_encoding($str,'utf-8','auto');//根据自己编码修改

        $strs = explode("|*|",$str);


        $sql = "insert into subject (question,courseID,unit,difficulty,score,type,answer,userID,sdate) values 
('{$strs[0]}','{$strs[1]}','{$strs[2]}','{$strs[3]}','{$strs[4]}','{$strs[5]}','{$strs[6]}','{$strs[7]}','{$strs[8]}')";


    $res = mysqli_query($link,$sql);
    if(!$res)
    {
        echo "error";
    }


    }




    }
else{
    echo 'fail';
}

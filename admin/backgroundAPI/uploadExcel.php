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
$path =dirname(__FILE__);
$fileName=$_FILES['myFile']['name'];
// $filename='demo1.xlsx';
$dest = $path.'/uploadExcel/'.$fileName;
$res = move_uploaded_file($_FILES['myFile']['tmp_name'],$dest);
$link = mysqli_connect('localhost','root','','exam');
if($res)
{
    $objReader = PHPExcel_IOFactory::createReader('excel2007');///excel 读取器
    $objPHPExcel = $objReader->load('uploadExcel/'.$fileName,$encode='utf-8');///加载Excel文件
    $drawing = new PHPExcel_Writer_Excel2007_Drawing();

    $drawingHashTable = new PHPExcel_HashTable();
    $drawingHashTable->addFromSource($drawing->allDrawings($objPHPExcel));
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow(); // 取得总行数
    $highestColumn = $sheet->getHighestColumn(); // 取得总列数
    $dirName=explode('.',$fileName);
    $pathname=$path.'/';
    $filedir='images/'.$dirName[0].'/';
    if(!file_exists($pathname.$filedir)) {
        mkdir($pathname.$filedir);
    }
    for ($i = 0; $i < $drawingHashTable->count(); $i++)
    {
        $path =dirname(__FILE__);
        $memoryDrawing = $drawingHashTable->getByIndex($i);
        if ($memoryDrawing instanceof PHPExcel_Worksheet_Drawing)
        {

            $filename = $memoryDrawing->getPath();
            $imageFileName = $memoryDrawing->getIndexedFilename();
            $path_f = 'http://10.195.7.51:9090/Examination/admin/backgroundAPI/'.$filedir. $memoryDrawing->getIndexedFilename();

                $path = $pathname.$filedir.'/' . $memoryDrawing->getIndexedFilename();
                copyfiles($filename, $path);
            //            move_uploaded_file($filename, $path);
                $cell = $memoryDrawing->getWorksheet()->getCell($memoryDrawing->getCoordinates());
                // 将该单元格的值设置为单元格的文本加上图片的 img 标签
                $cell->setValue($cell->getValue() . '|||' . $path_f);
            }

    }

    $reData=array();
    for($i=2,$k=0;$i<=$highestRow;$i++,$k++)
    {

        $str = "";
        for ($j='A';$j<=$highestColumn;$j++){
            $str .= $objPHPExcel->getActiveSheet()->getCell("$j$i")->getValue() . '|*|';//读取单元格
        }
        $str=mb_convert_encoding($str,'utf-8','auto');//根据自己编码修改
        $strs = explode("|*|",$str);
        $courseID=mysqli_fetch_row(mysqli_query($link,"select courseID from course where cname='{$strs[1]}'"));
        $sql = "insert into subject (question,courseID,unit,difficulty,score,type,answer,userID,sdate) values
('{$strs[0]}','{$courseID[0]}','{$strs[2]}','{$strs[3]}','{$strs[4]}','{$strs[5]}','{$strs[6]}','{$strs[7]}','{$strs[8]}')";
        $reData[]=[$strs[0],$strs[1],$strs[2],$strs[3],$strs[4],$strs[5],$strs[6],$strs[7],$strs[8]];
        $res = mysqli_query($link,$sql);
    }
    echo json_encode($reData,JSON_UNESCAPED_UNICODE);
}
else{
    echo 'fail';
}

function copyfiles($file1,$file2){
    $contentx =@file_get_contents($file1);
    $openedfile = fopen($file2, "w");
    // http://www.manongjc.com/article/1350.html
    fwrite($openedfile, $contentx);
    fclose($openedfile);
    if ($contentx === FALSE) {
        $status=false;
    }else $status=true;
    return $status;
}
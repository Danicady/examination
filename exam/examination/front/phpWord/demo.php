<?php
header("Content-Type: text/html; charset=UTF-8");
include "phpword/PHPWord.php";

$link=mysqli_connect('localhost','root','root','exam');
$sql ="select * from subject WHERE courseID='1'AND difficulty ='易' AND unit='1'";
$course="英语";
//查到符合条件的题;
function fetchAll($sql)
{
    global $link;
    $res =mysqli_query($link,$sql);

    while (@$row=mysqli_fetch_assoc($res))
    {
        $rows[]=$row;
    }

    return $rows;

}
$mes = fetchAll($sql);




$PHPWord = new PHPWord();
$PHPWord->addFontStyle('rStyle', array('bold' => true, 'italic' => true, 'size' => 16));
$PHPWord->addParagraphStyle('pStyle', array('align' => 'center', 'spaceAfter' => 100));
$PHPWord->addTitleStyle(1, array('bold' => true), array('spaceAfter' => 240));


$section = $PHPWord->createSection();//创建新页面
$section->addTitle($course, 1);
$section->addTextBreak(2);

foreach ($mes as $it) {

$arry = explode('\n',$it['question']);

    $fontStyle = array('color' => '000000', 'size' => 15, 'align' => 'center');
    $PHPWord->addFontStyle('myOwnStyle', $fontStyle);
    $section->addText( $it['type'].':','myOwnStyle');
    $section->addTextBreak(1);
    foreach ($arry as $val)
    {
        $section->addText( $val,'myOwnStyle');
    }
    $section->addTextBreak(1);


}

$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'word2007');
$objWriter->save('demo.doc');

?>
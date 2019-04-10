<?php
/**
 * Created by PhpStorm.
 * User: 19473
 * Date: 2018/12/10
 * Time: 16:25
 */
require_once 'include.php';
//$courseID=1;
//$num=['24','28','23','25'];//now
$res=[];
function paichon($courseID,$num)
{

    $sql = "select * from paper WHERE courseID={$courseID}";
    $res = fetchAll($sql);
   if(!is_null($res))
   {
       foreach ($res as $val)
       {
           $numed = explode(',',$val['num']);//ago
           $numbers = findNum($numed,$num);
           $ans =($numbers/count($num));
           if($ans>0.3)
           {
               array_push($res,$ans);
           }
       }
   }
    return $res;
}


function findNum($num1,$num2)
{
    $i = 0;
    foreach ($num1 as $val)
    {
        if(in_array($val,$num2))
        {
            $i++;
        }
    }
    return $i;

}


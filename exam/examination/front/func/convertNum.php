<?php
/**
 * Created by PhpStorm.
 * User: 19473
 * Date: 2018/11/12
 * Time: 14:27
 */
function number2chinese($num,$mode = true,$sim = true){

    if(!is_numeric($num)) return '含有非数字非小数点字符！';

    $char    = $sim ? array('零','一','二','三','四','五','六','七','八','九')

        : array('零','壹','贰','叁','肆','伍','陆','柒','捌','玖');

    $unit    = $sim ? array('','十','百','千','','万','亿','兆')

        : array('','拾','佰','仟','','萬','億','兆');



    //小数部分

    if(strpos($num, '.')){

        list($num,$dec) = explode('.', $num);

        $dec = strval(round($dec,2));






    }

    //整数部分

    $str = $mode ? strrev(intval($num)) : strrev($num);

    for($i = 0,$c = strlen($str);$i < $c;$i++) {

        $out[$i] = $char[$str[$i]];

        if($mode){

            $out[$i] .= $str[$i] != '0'? $unit[$i%4] : '';

            if($i>1 and $str[$i]+$str[$i-1] == 0){

                $out[$i] = '';

            }

            if($i%4 == 0){

                $out[$i] .= $unit[4+floor($i/4)];

            }

        }

    }

    $retval = join('',array_reverse($out));

    return $retval;

}
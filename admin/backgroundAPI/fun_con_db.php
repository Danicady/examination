<?php
/**
 * Created by PhpStorm.
 * User: DY
 * Date: 2018/11/7
 * Time: 10:07
 */
function db_con(){
    $con=mysqli_connect("localhost",'root','','exam');
    mysqli_query($con,"set names utf8");
    return $con;
}
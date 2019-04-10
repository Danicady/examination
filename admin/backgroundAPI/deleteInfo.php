<?php
/**
 * Created by PhpStorm.
 * User: DY
 * Date: 2018/11/8
 * Time: 9:25
 */
require "fun_con_db.php";
if ($_GET){
    $id=$_GET['id'];
    $con=db_con();
    if(mysqli_query($con,"delete from relationship where id='{$id}'")){
        echo json_encode(array("message"=>"delete success"));
    }else{
        echo json_encode(array("message"=>"delete failed"));
    }
}
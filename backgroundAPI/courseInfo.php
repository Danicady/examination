<?php
/**
 * Created by PhpStorm.
 * User: DY
 * Date: 2018/11/14
 * Time: 16:19
 */
require 'fun_con_db.php';
$con=db_con();
$res=mysqli_query($con,"select cname from course");
$data=[];
while ($row=mysqli_fetch_assoc($res))
    $data[]=$row['cname'];
echo json_encode($data);
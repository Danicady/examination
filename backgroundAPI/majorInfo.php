<?php
/**
 * Created by PhpStorm.
 * User: DY
 * Date: 2018/11/9
 * Time: 14:14
 */

if($_GET){
    $department=$_GET['department'];
    $DEPARTMENT=['0'=>'信息与软件工程系','1'=>'计算机科学与工程系','2'=>'商务管理系','3'=>'数字艺术系','4'=>'信息管理系','5'=>'应用外语系'];
    $MAJOR[0]=['软件工程','信息工程','数据科学与大数据技术'];
    $MAJOR[1]=['计算机科学与技术', '网络工程', '物联网工程', '信息安全与管理'];
    $MAJOR[2]=['人力资源管理', '资产评估', '财务管理', '市场营销'];
    $MAJOR[3]=['工业设计', '数字媒体技术', '动画', '艺术与科技'];
    $MAJOR[4]=['信息管理与信息系统', '物流管理', '电子商务'];
    $MAJOR[5]=['日语', '商务英语', '英语'];
    foreach ($DEPARTMENT as $key=>$v) {
        if ($department==$v) {
            echo json_encode($MAJOR[$key]);
            break;
        }
    }
}
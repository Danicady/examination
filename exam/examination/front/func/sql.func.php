<?php
/**
 * Created by PhpStorm.
 * User: 19473
 * Date: 2018/7/14
 * Time: 13:45
 */
/*连接数据库*/

function connect()
{
    $link=mysqli_connect('localhost','root','') or die("连接数据库失败");
     mysqli_set_charset($link,'utf-8');
    mysqli_select_db($link,'exam')or die("指定数据库打不开");
    return $link;

}

$link = connect();
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
/*
 * 取得某一行数据*/
function fetchOne ($sql)
{
   global $link;
    $res = mysqli_query($link,$sql);
    $row = mysqli_fetch_array($res,MYSQLI_ASSOC);
    return $row;
}
/*
 * 删除数据*/
function delete($table,$where=null)
{
   global $link;
    $where=$where==null?null:" where id=".$where;
    $sql = "delete from {$table}{$where}";
    $res = mysqli_query($link,$sql);
   return $res;
}
/*
 * 添加数据*/
function insert($table,$arry)
{

  global $link;
 //insert into ( , , ,) values('','')
    $keys = "".join(",",array_keys($arry));
    $values ="'".join("','",array_values($arry))."'";
    $sql = "insert into {$table}({$keys}) VALUES ({$values})";

    $res = mysqli_query($link,$sql);
 if($res)
 {
     return mysqli_insert_id($link);
 }
 else{
     return false;
 }
}
/*
 * 更新数据*/

function update($table,$arry,$where)
{

//update table set key='value',key2='value2'where id = 3;
    global $link;
    $where = $where==null?null:"where userID=".$where;
    $seps=null;
    foreach ($arry as $key => $value)
    {
        if($seps == null)
            $stp="";
        else
            $stp=",";
        $seps.=$stp.$key."='".$value."'";
    }


    $sql = "update {$table} set {$seps}{$where}";


    $res = mysqli_query($link,$sql);
  if($res)
      return mysqli_affected_rows($link);
  else return false;

}
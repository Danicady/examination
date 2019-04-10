<?php
/**
 * Created by PhpStorm.
 * User: 19473
 * Date: 2018/7/14
 * Time: 13:49
 */
header("content-type:text/html;charset=utf-8");
date_default_timezone_set("PRC");
define("ROOT",dirname(__FILE__));
set_include_path(".".PATH_SEPARATOR.ROOT."/func".PATH_SEPARATOR.ROOT."/configs".get_include_path());
require_once 'sql.func.php';
require_once 'convertNum.php';
require_once 'sortCourse.func.php';


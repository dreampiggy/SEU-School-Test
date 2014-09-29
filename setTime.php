<?php
include("conn.php");
$minutes=$_COOKIE["minutes"];
$seconds=$_COOKIE["seconds"];
$checkStudent=$_COOKIE["student"];		//学号
$checkCard=$_COOKIE["card"];		//一卡通号

mysql_query("UPDATE Students
SET Minutes=$minutes,Seconds=$seconds WHERE Student_num='{$checkStudent}' AND Card_num='{$checkCard}'");
?>
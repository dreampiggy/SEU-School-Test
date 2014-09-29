<?php
header("Content-type:text/html;charset=utf-8");
include("conn.php");
$checkStudent=(string)$_POST['student_number'];
$checkCard=(string)$_POST['card_number'];
$result = mysql_query("SELECT questionID,Minutes,Seconds FROM Students
	WHERE Student_num='{$checkStudent}' && Card_num='{$checkCard}'");
$nullAnswer = mysql_query("SELECT id FROM Students
	WHERE Student_num='{$checkStudent}' && Card_num='{$checkCard}' && Score is NULL");
if(preg_match('/^[0-9]{2}[0-9a-zA-Z]{1}[0-9]{5}$/',$checkStudent)&&preg_match('/^[0-9]{9}$/',$checkCard))
{
if($row=mysql_fetch_array($result))
{
	if(!mysql_fetch_array($nullAnswer))
	{
	setcookie("student", $checkStudent, 0);
	setcookie("card", $checkCard, 0);
	echo "<script>alert(' 你已经答过题喽，直接进入得分页面');window.location.href='scorePage.php';</script>";
	}
	else
	{
	setcookie("student", $checkStudent, 0);
	setcookie("card", $checkCard, 0);
	setcookie("questionID",$row["questionID"],0);
	setcookie("minutes",$row["Minutes"], 0);
	setcookie("seconds",$row["Seconds"], 0);
	echo "<script>alert('登录成功啦，现在进入答题页面');window.location.href='answerPage.php';</script>";
	}
}
else
{
	echo "<script>alert('学号或一卡通不正确！'); window.location.href='index.html';</script>";
}
}
else
{
	echo "<script>alert('学号或一卡通格式不正确');window.location.href='index.html';</script>";
}
mysql_close($con);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>登录中……</title>
</head>
<body>
</body>
</html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>答题结果</title>
<script type="text/javascript" src="javascript/cookie.js"></script>
</head>
<body onload="delCookie('readConstruct')">
<link href="css/scorePage.css" type="text/css" rel="stylesheet" />
<div id="bgImage"><img src="images/scorePage/bk.jpg" /></div> 
<?php

include("conn.php");

$student_number=$_COOKIE["student"];
$card_number=$_COOKIE["card"];
$questionID=$_COOKIE["questionID"];

$nullAnswer = mysql_query("SELECT id FROM Students
	WHERE Student_num='{$student_number}' && Card_num='{$card_number}' && Score IS NULL");
if(!mysql_fetch_array($nullAnswer))
{
mysql_close($conn);
echo "<script>alert('请按照正常的流程答题！');window.location.href='index.html';</script>";
}
$unAnswerArray='';
for ($i=1; $i<=30; $i++)
{
	$number="q".$i;//从表单q1到q30来取出它的值（就是abcd其中之一），组成字符串
	$anwser=$_POST[$number];
	$anserArray[$i]=$anwser;
}


$memcache=memcache_connect("localhost",11211);

if($memcache->get("trueCache".$questionID))
{
	$questionArray=$memcache->get("trueCache".$questionID);
}
else
{
	$questionArray=mysql_fetch_row(mysql_query("SELECT * FROM QuestionID WHERE id = '{$questionID}'"));
	$memcache->set("trueCache".$questionID,$questionArray);
}

$questionArray=mysql_fetch_row(mysql_query("SELECT * FROM QuestionID WHERE id = '{$questionID}'"));
$choiceScore=0;
$trueNum=0;
for($i=1;$i<21;$i++)
{
$questionNum=$questionArray[$i];
$result = mysql_fetch_array(mysql_query("SELECT * FROM Questions WHERE absnumber ='{$questionNum}' "));

if($anserArray[$i]==$result["answer"])
{
$choiceScore++;
$trueNum++;
}
}
$judgeScore=0;
for($i=21;$i<31;$i++)
{
$questionNum=$questionArray[$i];
$result = mysql_fetch_array(mysql_query("SELECT * FROM Questions WHERE absnumber ='{$questionNum}' "));
if($anserArray[$i]==$result["answer"])
{
$judgeScore++;
$trueNum++;
}
}
$finalScore=4*$choiceScore+2*$judgeScore;

mysql_query("UPDATE Students
SET Score=$finalScore,TrueNum=$trueNum WHERE Student_num='{$student_number}' AND Card_num='{$card_number}'");


mysql_close($conn);

echo "<div id='user'><div id='userText'>$student_number</div></div><div id='clock'><div id='clockNum'><span id='minutes' value=''></span><span>已结束</span><span id='seconds'></span></div></div>";


echo "
<div id=\"scoreBlock\">
<div id='scoreText'>成绩:</div>
<div id='trueText'><b>答对".$trueNum."道</b></div>
<div id='grades'>".$finalScore
."</div></div>";
?>

<div id="leave">
<a href="javascript:window.opener=null;window.open('','_self');window.close();" onmousemove="this.style.backgroundColor='#4097b9'" onmouseout="this.style.backgroundColor='#539ebb'">退出</a>
</div>
<div id="author"><b>制作方：&nbsp软件学院&nbsp李卓立&nbsp高奕丽&nbsp韩畅&nbsp韦权</b></div>
</body>
</html>
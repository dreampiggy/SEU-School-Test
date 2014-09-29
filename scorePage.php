<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>得分页面</title>
<script type="text/javascript" src="javascript/cookie.js"></script>
</head>
<body>
<link href="css/scorePage.css" type="text/css" rel="stylesheet" />
<div id="bgImage"><img src="images/scorePage/bk.jpg" /></div> 
<?php

$checkStudent=$_COOKIE["student"];
$checkCard=$_COOKIE["card"];
include("conn.php");
$result = mysql_query("SELECT * FROM Students
	WHERE Student_num='{$checkStudent}' && Card_num='{$checkCard}'");
$nullAnswer = mysql_query("SELECT * FROM Students
	WHERE Student_num='{$checkStudent}' && Card_num='{$checkCard}' && Score IS NOT NULL");
if(!mysql_fetch_array($nullAnswer))
{
echo "<script>alert('你还没有答题哦！'); window.location.href='index.html';</script>";
}
echo "<div id='user'><div id='userText'>$checkStudent</div></div>";
echo "<div id='clock'><div id='clockNum'><span id='minutes' value=''></span><span>已结束</span><span id='seconds'></span></div></div>";

$row = mysql_fetch_array($result);
echo "
<div id=\"scoreBlock\">
<div id='scoreText'>成绩:</div>
<div id='trueText'><b>答对".$row['TrueNum']."道</b></div>
<div id='grades'>".$row['Score']."</div></div>";


mysql_close($conn);
?>

<div id="leave">
<a href="javascript:window.opener=null;window.open('','_self');window.close();" onmousemove="this.style.backgroundColor='#4097b9'" onmouseout="this.style.backgroundColor='#539ebb'">退出</a>
</div>
<div id="author"><b>制作方：&nbsp&nbsp软件学院</b></div>
</body>
</html>
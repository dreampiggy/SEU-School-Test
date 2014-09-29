<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>管理员</title>

<?php

include("conn.php");
$checkAdmin=(string)$_POST['admin_number'];
$checkPassword=(string)$_POST['password_number'];
$DepartNum=(string)$_POST['search_number'];
$result = mysql_query("SELECT * FROM Administrator
	WHERE Name='{$checkAdmin}' && Password='{$checkPassword}'");
if(preg_match('/^[a-zA-z]{5}$/',$checkAdmin)&&preg_match('/^[0-9]{9}$/',$checkPassword))
{	
	if($row=mysql_fetch_array($result))
	{
		;
	}
	else
	{
		echo "<script>alert('管理员账号错误！');window.location.href='index.html'</script>";
	}
}
else
{
	echo "<script>alert('登陆信息错误！'); window.location.href='index.html';</script>";
}

?>

</head>
<body>
<link href="css/admin.css" type="text/css" rel="stylesheet" />
<div id="bgImage"><img src="images/scorePage/bk.jpg" /></div> 

        <div id="light" class="white_content">
          <div id="helpTitle"></div>
               <p>
<?php


$Department=$DepartNum."%";
$avgResult=mysql_query("SELECT AVG(Score) AS avgscore FROM Students WHERE Student_num LIKE '{$Department}'");
$highResult=mysql_query("SELECT MAX(Score) AS maxscore FROM Students WHERE Student_num LIKE '{$Department}'");
$scoreResult = mysql_query("SELECT * FROM Students WHERE Score IS NOT NULL && Student_num LIKE '{$Department}'  ORDER BY Score DESC");
$maxScoreJudge;

while($maxScore = mysql_fetch_array($highResult))
{
	$maxScoreJudge = $maxScore["maxscore"];
}

if($maxScoreJudge!='')
{
	while($avgScore = mysql_fetch_array($avgResult))
	{
		echo "平均分：".round($avgScore["avgscore"],2)."<br>";
	}
	{
		echo "最高分：".$maxScoreJudge."<br><br>";
	}
	echo "详细列表（按得分排序）：<br><br>";
	while($row = mysql_fetch_array($scoreResult))
	{
		echo "姓名：".$row["name"]."&nbsp;&nbsp;&nbsp;学号：".$row["Student_num"]."&nbsp;&nbsp;&nbsp;得分：".$row["Score"]."<br>";
	}
}
else
{
	echo "<br>该院系暂时没有人完成答题";
}
?>

               </p>
</div>

<div id="leave">
<a href="javascript:window.opener=null;window.open('','_self');window.close();" onmousemove="this.style.backgroundColor='#4097b9'" onmouseout="this.style.backgroundColor='#539ebb'">退出</a>
</div>
</body>
</html>
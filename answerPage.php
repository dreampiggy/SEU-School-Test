<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>答题页面</title>
<script type="text/javascript" src="javascript/cookie.js"></script>
<script type="text/javascript" src="javascript/jquery-1.11.1.min.js"></script>
</head>
<body onload="bigClock()">
<script type="text/javascript" src="javascript/answerPage.js"></script>
<link href="css/answerPage.css" type="text/css" rel="stylesheet" /><div id="preloaderImg"></div>
<div id="submit" onmouseover="this.style.backgroundImage='url(images/answerPage/submit1.gif)'" onmouseout="this.style.backgroundImage='url(images/answerPage/submit.gif)'" onclick="submitAnswer()">
<div id="submitText">提交</div>
</div>
<div id="bigClock" style="display:none"></div>
<div id="alertTime" style="display:none">抓紧时间，还有5分钟哦</div>
<?php
include("conn.php");		//引用数据库验证php文件
$checkStudent=$_COOKIE["student"];		//学号
$checkCard=$_COOKIE["card"];		//一卡通号
$questionID=$_COOKIE["questionID"];		//套题号
$nullAnswer = mysql_query("SELECT id FROM Students
	WHERE Student_num='{$checkStudent}' && Card_num='{$checkCard}' && Score is NULL");
if(!mysql_fetch_array($nullAnswer))//进行验证，若数据库中学号一卡通正确且无答题记录则继续，否则跳转主页，防止直接输入answerPage.php恶意登录
{
$url="index.html";
mysql_close($conn);
echo "<script language='javascript' type='text/javascript'>";
echo "alert('你还没有登录哦，先来登录吧！');";
echo "window.location.href='$url';";  
echo "</script>";
}		//验证结束
echo "<div id='user'><div id='userText'>$checkStudent</div></div>";
echo "<div id='clock'><div id='clockNum'><span id='minutes' value=''></span><span>:</span><span id='seconds'></span></div></div>";
echo "<div id=\"mainPage\">
    <div id=\"questionBox\" class=\"questionBox\">";
$memcache=memcache_connect("localhost",11211);
if($memcache->get("qNumCache".$questionID))
{
	$questionArray=$memcache->get("qNumCache".$questionID);
}
else
{
	$questionArray=mysql_fetch_row(mysql_query("SELECT * FROM QuestionID WHERE id = '{$questionID}'"));
	$memcache->set("qNumCache".$questionID,$questionArray);
}
for($i=1;$i<31;$i++)
{
$questionNum=$questionArray[$i];
if($memcache->get("anum".$questionNum))
{
	$row=$memcache->get("anum".$questionNum);
}
else
{
	$row = mysql_fetch_array(mysql_query("SELECT * FROM Questions WHERE absnumber ='{$questionNum}'"));
	$memcache->set("anum".$questionNum,$row);
}
$number="q".$i;
$question_info=$row["question"];
if($i==1)		//分类，为了逻辑和算法上的好处理，将题目分组1，2-9，10-20，21-29，30分别处理
{echo "
<div id=\"displayAnswer{$i}\" class=\"answerBox\">
<div id=\"question{$i}\" class=\"question\"><span>{$i}</span>/30<br/>{$question_info}
</div>
<br />
<div id=\"Answer0{$i}1\" class=\"answer\"><a href='#' class=\"answerText\" onmouseover=\"javascript:this.style.backgroundColor='#ffffff'; this.style.color='#5391bb' \"  onmouseout=\"javascript:this.style.backgroundColor='#5391bb'; this.style.color='#ffffff' \" onclick=\"changeAnswer('0{$i}1')\"><span>{$row["a"]}</span></a></div>
<div id=\"Answer0{$i}2\" class=\"answer\"><a href='#' class=\"answerText\" onmouseover=\"javascript:this.style.backgroundColor='#ffffff'; this.style.color='#5391bb' \"  onmouseout=\"javascript:this.style.backgroundColor='#5391bb'; this.style.color='#ffffff' \" onclick=\"changeAnswer('0{$i}2')\"><span>{$row["b"]}</span></a></div>
<div id=\"Answer0{$i}3\" class=\"answer\"><a href='#' class=\"answerText\" onmouseover=\"javascript:this.style.backgroundColor='#ffffff'; this.style.color='#5391bb' \"  onmouseout=\"javascript:this.style.backgroundColor='#5391bb'; this.style.color='#ffffff' \" onclick=\"changeAnswer('0{$i}3')\"><span>{$row["c"]}</span></a></div>
<div id=\"Answer0{$i}4\" class=\"answer\"><a href='#' class=\"answerText\" onmouseover=\"javascript:this.style.backgroundColor='#ffffff'; this.style.color='#5391bb' \"  onmouseout=\"javascript:this.style.backgroundColor='#5391bb'; this.style.color='#ffffff' \" onclick=\"changeAnswer('0{$i}4')\"><span>{$row["d"]}</span></a></div>
</div>
";
continue;
}
if($i<10&&$i>1)		//2-9选择题
{echo "
<div id=\"displayAnswer{$i}\" class=\"answerBox\" style=\"display:none\">
<div id=\"question{$i}\" class=\"question\"><span>{$i}</span>/30<br/>{$question_info}
</div>
<br />
<div id=\"Answer0{$i}1\" class=\"answer\"><a href='#' class=\"answerText\" onmouseover=\"javascript:this.style.backgroundColor='#ffffff'; this.style.color='#5391bb' \"  onmouseout=\"javascript:this.style.backgroundColor='#5391bb'; this.style.color='#ffffff' \" onclick=\"changeAnswer('0{$i}1')\"><span>{$row["a"]}</span></a></div>
<div id=\"Answer0{$i}2\" class=\"answer\"><a href='#' class=\"answerText\" onmouseover=\"javascript:this.style.backgroundColor='#ffffff'; this.style.color='#5391bb' \"  onmouseout=\"javascript:this.style.backgroundColor='#5391bb'; this.style.color='#ffffff' \" onclick=\"changeAnswer('0{$i}2')\"><span>{$row["b"]}</span></a></div>
<div id=\"Answer0{$i}3\" class=\"answer\"><a href='#' class=\"answerText\" onmouseover=\"javascript:this.style.backgroundColor='#ffffff'; this.style.color='#5391bb' \"  onmouseout=\"javascript:this.style.backgroundColor='#5391bb'; this.style.color='#ffffff' \" onclick=\"changeAnswer('0{$i}3')\"><span>{$row["c"]}</span></a></div>
<div id=\"Answer0{$i}4\" class=\"answer\"><a href='#' class=\"answerText\" onmouseover=\"javascript:this.style.backgroundColor='#ffffff'; this.style.color='#5391bb' \"  onmouseout=\"javascript:this.style.backgroundColor='#5391bb'; this.style.color='#ffffff' \" onclick=\"changeAnswer('0{$i}4')\"><span>{$row["d"]}</span></a></div>
</div>
";
continue;
}
if($i<21&&$i>9)		//10-20选择题
{echo "
<div id=\"displayAnswer{$i}\" class=\"answerBox\" style=\"display:none\">
<div id=\"question{$i}\" class=\"question\"><span>{$i}</span>/30<br/>{$question_info}
</div>
<br />
<div id=\"Answer{$i}1\" class=\"answer\"><a href='#' class=\"answerText\" onmouseover=\"javascript:this.style.backgroundColor='#ffffff'; this.style.color='#5391bb' \"  onmouseout=\"javascript:this.style.backgroundColor='#5391bb'; this.style.color='#ffffff' \" onclick=\"changeAnswer('{$i}1')\"><span>{$row["a"]}</span></a></div>
<div id=\"Answer{$i}2\" class=\"answer\"><a href='#' class=\"answerText\" onmouseover=\"javascript:this.style.backgroundColor='#ffffff'; this.style.color='#5391bb' \"  onmouseout=\"javascript:this.style.backgroundColor='#5391bb'; this.style.color='#ffffff' \" onclick=\"changeAnswer('{$i}2')\"><span>{$row["b"]}</span></a></div>
<div id=\"Answer{$i}3\" class=\"answer\"><a href='#' class=\"answerText\" onmouseover=\"javascript:this.style.backgroundColor='#ffffff'; this.style.color='#5391bb' \"  onmouseout=\"javascript:this.style.backgroundColor='#5391bb'; this.style.color='#ffffff' \" onclick=\"changeAnswer('{$i}3')\"><span>{$row["c"]}</span></a></div>
<div id=\"Answer{$i}4\" class=\"answer\"><a href='#' class=\"answerText\" onmouseover=\"javascript:this.style.backgroundColor='#ffffff'; this.style.color='#5391bb' \"  onmouseout=\"javascript:this.style.backgroundColor='#5391bb'; this.style.color='#ffffff' \" onclick=\"changeAnswer('{$i}4')\"><span>{$row["d"]}</span></a></div>
</div>
";
continue;
}
if($i<30&&$i>20)		//21-29判断题
{echo "
<div id=\"displayAnswer{$i}\" class=\"answerBox\" style=\"display:none\">
<div id=\"question{$i}\" class=\"question\"><span>{$i}</span>/30<br/>{$question_info}
</div>
<br />
<div id=\"Answer{$i}1\" class=\"answer\"><a href='#' class=\"answerText\" onmouseover=\"javascript:this.style.backgroundColor='#ffffff'; this.style.color='#5391bb' \"  onmouseout=\"javascript:this.style.backgroundColor='#5391bb'; this.style.color='#ffffff' \" onclick=\"changeAnswer('{$i}1')\"><span>正确</span></a></div>
<div id=\"Answer{$i}2\" class=\"answer\"><a href='#' class=\"answerText\" onmouseover=\"javascript:this.style.backgroundColor='#ffffff'; this.style.color='#5391bb' \"  onmouseout=\"javascript:this.style.backgroundColor='#5391bb'; this.style.color='#ffffff' \" onclick=\"changeAnswer('{$i}2')\"><span>错误</span></a></div>
<div id=\"Answer{$i}3\" class=\"answer\" style='display:none'><a class=\"answerText\"><span></span></a></div>
<div id=\"Answer{$i}4\" class=\"answer\" style='display:none'><a class=\"answerText\"><span></span></a></div>
</div>
";
continue;}
if($i==30)		//最后一道题目，同时点击会自动验证和提交表单
{echo "
<div id=\"displayAnswer{$i}\" class=\"answerBox\" style=\"display:none\">
<div id=\"question{$i}\" class=\"question\"><span>{$i}</span>/30<br/>{$question_info}
</div>
<br />
<div id=\"Answer{$i}1\" class=\"answer\"><a href='#' class=\"answerText\" onmouseover=\"javascript:this.style.backgroundColor='#ffffff'; this.style.color='#5391bb' \"  onmouseout=\"javascript:this.style.backgroundColor='#5391bb'; this.style.color='#ffffff' \" onclick=\"finalAnswer('301')\"><span>正确</span></a></div>
<div id=\"Answer{$i}2\" class=\"answer\"><a href='#' class=\"answerText\" onmouseover=\"javascript:this.style.backgroundColor='#ffffff'; this.style.color='#5391bb' \"  onmouseout=\"javascript:this.style.backgroundColor='#5391bb'; this.style.color='#ffffff' \" onclick=\"finalAnswer('302')\"><span>错误</span></a></div>
<div id=\"Answer{$i}3\" class=\"answer\" style='display:none'><a class=\"answerText\"><span></span></a></div>
<div id=\"Answer{$i}4\" class=\"answer\" style='display:none'><a class=\"answerText\"><span></span></a></div>
</div>
";
break;}
}


echo "</div>";
echo "<form id=\"submitAnswer\" action=testAnswer.php method=\"post\" style=\"display:none\">";			//通过把选项记录到一个隐藏的radio表单，方便提交，到时候可以改写
for($j=1;$j<=30;$j++)
echo "
<input id='form{$j}1' type=radio name=\"q{$j}\" value=\"a\">
<input id='form{$j}2' type=radio name=\"q{$j}\" value=\"b\">
<input id='form{$j}3' type=radio name=\"q{$j}\" value=\"c\">
<input id='form{$j}4' type=radio name=\"q{$j}\" value=\"d\">
";
mysql_close($conn);		//结束
?>
<a id="checked" value=0 display:none></a>		<!--为了捕获关闭页面的JS函数和最后提交表单跳转页面不发生冲突而设置-->
</form>

<script language="JavaScript">
window.onbeforeunload = function()			//捕获离开当前页面的函数，一旦刷新，尝试关闭，跳转都会出现一个提示框，已解决最后表单提交而跳转页面的冲突问题以及倒计时跳转问题（倒计时结束，表单提交都不会出现提示框而直接跳转）
{
if((document.getElementById("checked").value!=1) && ((document.getElementById("minutes").innerHTML!=0) || (document.getElementById("seconds").innerHTML!=0)))
{
setTimeout(function(){setTimeout(0)}, 0);
SetCookie('minutes',document.getElementById("minutes").innerHTML);
SetCookie('seconds',document.getElementById("seconds").innerHTML);
AjaxTime();
return "一旦离开页面，答题进度不会保存且时间继续，仅建议在网页未完全加载时使用。\n真的要继续吗？";
}
}
</script>
<div id="presentPage" style="display:none">1</div>

<div id="questionBar">
<div id="presentBar" style="display:none">1</div>
            <ul class="pagination" id="numBar">
            <div id="bar1" class="barForm">
            <li id="num1" class="current" onclick="jumpAnswer(1)"><a>01</a></li>
            <li id="num2" onclick="jumpAnswer(2)"><a>02</a></li>
            <li id="num3" onclick="jumpAnswer(3)"><a>03</a></li>
            <li id="num4" onclick="jumpAnswer(4)"><a>04</a></li>
            <li id="num5" onclick="jumpAnswer(5)"><a>05</a></li>
            <li id="num6" onclick="jumpAnswer(6)"><a>06</a></li>
            <li id="num7" onclick="jumpAnswer(7)"><a>07</a></li>
            <li id="num8" onclick="jumpAnswer(8)"><a>08</a></li>
            <li id="num9" onclick="jumpAnswer(9)"><a>09</a></li>
            <li id="num10" onclick="jumpAnswer(10)"><a>10</a></li>
            </div><div id="bar2" class="barForm" style="display:none">
            <li id="num11" onclick="jumpAnswer(11)"><a>11</a></li>
            <li id="num12" onclick="jumpAnswer(12)"><a>12</a></li>
            <li id="num13" onclick="jumpAnswer(13)"><a>13</a></li>
            <li id="num14" onclick="jumpAnswer(14)"><a>14</a></li>
            <li id="num15" onclick="jumpAnswer(15)"><a>15</a></li>
            <li id="num16" onclick="jumpAnswer(16)"><a>16</a></li>
            <li id="num17" onclick="jumpAnswer(17)"><a>17</a></li>
            <li id="num18" onclick="jumpAnswer(18)"><a>18</a></li>
            <li id="num19" onclick="jumpAnswer(19)"><a>19</a></li>
            <li id="num20" onclick="jumpAnswer(20)"><a>20</a></li>
            </div><div id="bar3" class="barForm" style="display:none">
            <li id="num21" onclick="jumpAnswer(21)"><a>21</a></li>
            <li id="num22" onclick="jumpAnswer(22)"><a>22</a></li>
            <li id="num23" onclick="jumpAnswer(23)"><a>23</a></li>
            <li id="num24" onclick="jumpAnswer(24)"><a>24</a></li>
            <li id="num25" onclick="jumpAnswer(25)"><a>25</a></li>
            <li id="num26" onclick="jumpAnswer(26)"><a>26</a></li>
            <li id="num27" onclick="jumpAnswer(27)"><a>27</a></li>
            <li id="num28" onclick="jumpAnswer(28)"><a>28</a></li>
            <li id="num29" onclick="jumpAnswer(29)"><a>29</a></li>
            <li id="num30" onclick="jumpAnswer(30)"><a>30</a></li>
            </div></ul>
			<ul id="LandRArrowBar">
            <li id="barLeftArrow" class="arrow unavailable" onclick="leftBar()"><a></a></li>
            <li id="barRightArrow" class="arrow" onclick="rightBar()"><a></a></li>
			</ul>
</ul>
</div>
</body>
</html>
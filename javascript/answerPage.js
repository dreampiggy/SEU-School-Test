function changeAnswer(answerNum)
{
    var answerStr;
    if(answerNum.charAt(0)=='0')
    {
    answerStr=answerNum.charAt(1);
    }
    else
    {
    answerStr=answerNum.charAt(0)+answerNum.charAt(1);
    }
    var answerStr2=answerNum.charAt(0)+answerNum.charAt(1);
    var answerValue=answerNum.charAt(2);
    var answerValueInt=parseInt(answerValue);
    var answerStrInt=parseInt(answerStr);
    //这里加上点击选项后的动画或者改变形式

    var pageNum=document.getElementById("presentPage").innerHTML;//这里改变选中的选项的样式
    var inputNum=4*pageNum-4;
    for(var j=0;j<4;j++)
    {
    document.getElementsByTagName("a")[inputNum+j].className="answerText";
    }
    document.getElementsByTagName("a")[inputNum+answerValueInt-1].className="checkedAnswer";

    var form1 = document.getElementById("answerForm"); 
    var name1="q"+answerStrInt;
    var counter=4*answerStrInt-5+answerValueInt;
    
    
    document.getElementsByTagName("input")[counter].checked=true;
    //可以加入保留答题记录
    
    
    document.getElementById("num"+pageNum).className="answeredBarNum";
    document.getElementById("presentPage").innerHTML++;
    pageNum=document.getElementById("presentPage").innerHTML;
    if(answerStrInt==10 || answerStrInt==20 || answerStrInt==30)
    rightBar();

    if(document.getElementById("num"+pageNum).className=="answeredBarNum")
    {document.getElementById("num"+pageNum).className="answeredBarNum current";}
    else
    {document.getElementById("num"+pageNum).className="current";}

    //这里加上上一道题目消失的动画或者切换动画

    document.getElementById("displayAnswer"+answerStrInt).style.display="none";

    answerStrInt++;


    var AnswerID2="#displayAnswer"+answerStrInt;
    $(document).ready(function(){
        $(AnswerID2).fadeIn()
        });
}

function finalAnswer(answerNum)
{
    var answerStr;
    answerStr=answerNum.charAt(0)+answerNum.charAt(1);
    var answerValue=answerNum.charAt(2);
    var answerValueInt=parseInt(answerValue);
    var answerStrInt=parseInt(answerStr);
    var counter=4*answerStrInt-5+answerValueInt;
    document.getElementsByTagName("input")[counter].checked=true;

    var answerValue=answerNum.charAt(2);//改变选中的选项样式
    var answerValueInt=parseInt(answerValue);
    var pageNum=document.getElementById("presentPage").innerHTML;
    var inputNum=4*pageNum-4;
    for(var j=0;j<4;j++)
    {
    document.getElementsByTagName("a")[inputNum+j].className="answerText";
    }
    document.getElementsByTagName("a")[inputNum+answerValueInt-1].className="checkedAnswer";
    document.getElementById("num"+pageNum).className="answeredBarNum current";
    submitAnswer();
}


function submitAnswer()    //验证表单
{
    var r=confirm("你确认要提交答案吗？");
    if (r==false)
    {
    	return 0;
    }
    var unAnsweredNum='';
    for(var i=0;i<120;i+=4){
    for(var j=0;j<4;j++)
    {
    if(document.getElementsByTagName("input")[i+j].checked)
    break;
    else if(j==3)
    unAnsweredNum=unAnsweredNum+(i/4+1)+'  ';
    }
    }
    if (unAnsweredNum!='')
    {
    alert("第"+unAnsweredNum+"题还没有答，先去答完吧。")
    return false;
    }
    document.getElementById("checked").value=1;
    document.getElementById("submitAnswer").submit();
}


function jumpAnswer(pageNum)
{
    var presentPage=document.getElementById("presentPage").innerHTML;
    if(presentPage==pageNum)
    {
    document.getElementById("num"+pageNum).className="answeredBarNum current";
    return true;
    }
    for (var i=1;i<31;i++)
    document.getElementById("displayAnswer"+i).style.display="none";

    //题目切换动画
    var AnswerID="#displayAnswer"+pageNum;
    $(document).ready(function(){
        $(AnswerID).fadeIn()
        });

    var inputNum=4*pageNum-4;
    for(var j=0;j<4;j++)
    {
    if(document.getElementsByTagName("input")[inputNum+j].checked)
    {
    document.getElementsByTagName("a")[inputNum+j].className="checkedAnswer";
    }
    }


    if(document.getElementById("num"+pageNum).className=="answeredBarNum" && document.getElementById("num"+presentPage).className=="answeredBarNum current")
    {
    document.getElementById("num"+pageNum).className="answeredBarNum current";
    document.getElementById("num"+presentPage).className="answeredBarNum";
    }
    if(document.getElementById("num"+pageNum).className=="answeredBarNum" && document.getElementById("num"+presentPage).className=="current")
    {
    document.getElementById("num"+pageNum).className="answeredBarNum current";
    document.getElementById("num"+presentPage).className="";
    }
    if(document.getElementById("num"+pageNum).className=="" && document.getElementById("num"+presentPage).className=="answeredBarNum current")
    {
    document.getElementById("num"+pageNum).className="current";
    document.getElementById("num"+presentPage).className="answeredBarNum";
    }
    if(document.getElementById("num"+pageNum).className=="" && document.getElementById("num"+presentPage).className=="current")
    {
    document.getElementById("num"+pageNum).className="current";
    document.getElementById("num"+presentPage).className="";
    }
    document.getElementById("presentPage").innerHTML=pageNum;
}

function leftBar()
{
    var presentBarNum=document.getElementById("presentBar").innerHTML;
    if(presentBarNum==1)
    return true;
    //
    var BarID="#bar"+presentBarNum;
    $(document).ready(function(){
      $(BarID).fadeOut(300);
        });
    presentBarNum--;
    var BarID2="#bar"+presentBarNum;
    $(document).ready(function(){
      $(BarID2).animate({bottom:"0px"});
        });


    document.getElementById("presentBar").innerHTML=presentBarNum;
    document.getElementById("barRightArrow").className="arrow";
    if(presentBarNum==1)
    document.getElementById("barLeftArrow").className="arrow unavailable";
}

function rightBar()
{
    var presentBarNum=document.getElementById("presentBar").innerHTML;
    if(presentBarNum==3)
    return true;
    //动画
    var BarID="#bar"+presentBarNum;
    $(document).ready(function(){
      $(BarID).animate({bottom:"+450px"});
        });
    presentBarNum++;
    var BarID2="#bar"+presentBarNum;
    $(document).ready(function(){
        $(BarID2).fadeIn(400);
        });


    document.getElementById("presentBar").innerHTML=presentBarNum;
    document.getElementById("barLeftArrow").className="arrow";
    if(presentBarNum==3)
    document.getElementById("barRightArrow").className="arrow unavailable";
}

//计时器代码
var intDiff = parseInt(getCookie('minutes'))*60+parseInt(getCookie('seconds'));//倒计时总秒数量

function timer(intDiff){
    var timeID=window.setInterval(function(){
    var minute=0,
        second=0;//时间默认值       
    if(intDiff > 0){
    if(intDiff <= 300 && intDiff>280)
    {
        $(document).ready(function(){
        $("#alertTime").slideDown();
        });
    }
    if(intDiff <= 280 && intDiff>60)
    {
        $(document).ready(function(){
        $("#alertTime").slideUp();
        });
    }
    if(intDiff <= 60)
    {
        document.getElementById("alertTime").innerHTML="最后1分钟，请抓紧时间";
        $(document).ready(function(){
        $("#alertTime").slideDown();
        });
    }
    minute = Math.floor(intDiff / 60);
    second = Math.floor(intDiff) - (minute * 60);
    if (minute <= 9) minute = '0' + minute;
    if (second <= 9) second = '0' + second;
    $('#minutes').html(minute);
    $('#seconds').html(second);
    intDiff--;
    }
    else
    {
        $('#minutes').html(0);
		$('#seconds').html(0);
	    SetCookie('minutes',0);
		SetCookie('seconds',0);
		clearInterval(timeID); 
        AjaxTime();
		alert("时间到了，我们将把你答完的题目提交。");
		document.getElementById("submitAnswer").submit();
    }
    }, 1000);
} 

$(function(){ //借用jQuery
    timer(intDiff);
}); 


function AjaxTime()
{
	var xmlHttp2;//使用Ajax动态验证验证码
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlHttp2=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	 	xmlHttp2=new ActiveXObject("Microsoft.XMLHTTP");
	  } 
	    xmlHttp2.open("POST","setTime.php",true);  
	    xmlHttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlHttp2.send();
}

function bigClock()
{
    $(document).ready(function(){
    $("#bigClock").fadeIn();
    $("#bigClock").animate({
    left:'10%',
    opacity:'0.0',
    top:'0px'},"slow")
    });
}
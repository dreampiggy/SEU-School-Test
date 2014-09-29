function checkIdentify()
{
var xmlHttp;//使用Ajax动态验证验证码
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlHttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  } 
    var checkCode=document.getElementById("xym").value;

    checkCodeName="validateCode="+checkCode;
    xmlHttp.open("POST","checkCode.php",true);  
    xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlHttp.send(checkCodeName);
    xmlHttp.onreadystatechange=function () {  
        if(xmlHttp.readyState==4 && xmlHttp.status==200) {  
            var msg=xmlHttp.responseText;    //设置标志用于表示验证码是否正确  
            if(msg=="a  ")  
                {
	                document.getElementById('wrongCapt').style.display='none';
	                var userN=document.getElementById('username').value;
	                var userC=document.getElementById('cardname').value;
	                var namereg  = /^[0-9]{2}[0-9a-zA-Z]{1}[0-9]{5}$/;
	                var pwdreg = /^21314[0-9]{4}$/;
	                if(!namereg.exec(userN))
	                {
	                	alert("用户名格式错误");
	                	changeImg();
	                	return; 
	                }
	                if(!pwdreg.exec(userC)){
	                	alert("一卡通格式错误");
	                	changeImg();
	                	return;
	                }
	                else{
		                document.getElementById('loginForm').submit();
	                }
                }
            else  
                {
                document.getElementById('wrongCapt').style.display='inline';
                document.getElementById('xym').focus();
                }
        }  
    }
    return false;
}
function checkIdentifyForImg()
{
var xmlHttp;//使用Ajax动态验证验证码
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlHttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  } 
    var checkCode=document.getElementById("xym").value;

    checkCodeName="validateCode="+checkCode;
    xmlHttp.open("POST","checkCode.php",true);  
    xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlHttp.send(checkCodeName);
    xmlHttp.onreadystatechange=function () {  
        if(xmlHttp.readyState==4 && xmlHttp.status==200) {  
            var msg=xmlHttp.responseText;    //设置标志用于表示验证码是否正确  
            if(msg=="a  ")  
                {
                document.getElementById('wrongCapt').style.display='none';
                }
            else  
                {
                document.getElementById('wrongCapt').style.display='inline';
                document.getElementById('xym').focus();
                }
        }  
    }
}
function changeImg()
{
    var checkImg=document.getElementById("captchaImg");  
        checkImg.src="identify.php?num="+Math.random(); //需要加num=Math.random()以防止图片在本地缓存，单击图片时不刷新显示  
}
function checkRead()
{
    if(getCookie("readConstruct")!=1)
        openInstruct();
}

function openInstruct()
{
document.getElementById('fade').style.display='inline';
$(document).ready(function(){
    $("#light").fadeIn(800)
    });
SetCookie("readConstruct",1);
}

function closeInstruct()
{
$(document).ready(function(){
    $("#light").fadeOut()
    });
    document.getElementById('fade').style.display='none';
}
function switchToAdmin()
{
    document.getElementById("loginForm").style.display='none';
    document.getElementById("teacherForm").style.display='block';
    document.getElementById("dot1").src="images/index/dot2.gif";
    document.getElementById("dot2").src="images/index/dot1.gif";
}
function switchToStudent()
{
	document.getElementById("teacherForm").style.display='none';
	document.getElementById("loginForm").style.display='block';
    document.getElementById("dot1").src="images/index/dot1.gif";
    document.getElementById("dot2").src="images/index/dot2.gif";
}
function adminLogin()
{
	document.getElementById('teacherForm').submit();
}

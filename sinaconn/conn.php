<?php
/* 
 * Function ：数据库连接文件
 * Author   ：李卓立，高奕丽，韩畅，韦权
 * 
*/
$conn = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
if(!$conn)
{
	echo "<script>alert(' 对不起，服务器出了点问题，请稍等或联系我们');window.location.href='index.html';</script>";
}
else{
	mysql_query("set names utf8"); 
	mysql_select_db(SAE_MYSQL_DB,$conn);
	if(!$conn)
	{
		echo "<script>alert(' 对不起，服务器出了点问题，请稍等或联系我们');window.location.href='index.html';</script>";
	}
}
?>
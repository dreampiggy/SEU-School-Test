<?php  
    session_start();  
    if(strtoupper($_POST['validateCode'])==strtoupper($_SESSION['VerifyCode']))//判断文本框中输入的值和$_SESSION中保存的值是否相等  
        echo "a";           
    else   
        echo "b";  
?>  
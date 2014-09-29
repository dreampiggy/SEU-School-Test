<?php
  $con = mysql_connect("localhost","root", "");
  if(!$con){
    die(mysql_error());
  }
  mysql_query("set names utf8", $con);
  mysql_select_db('xiaoshi',$con);
  for ($id=1;$id<3949;$id++)
  {
  $query = "update Students set Score = NULL,Minutes = 30,Seconds = 0,TrueNum = 0 where id = $id";
  mysql_query($query,$con);
  }
?>

<?php
  $con = mysql_connect("localhost","root", "");
  if(!$con){
    die(mysql_error());
  }
  mysql_query("set names utf8", $con);
  mysql_select_db('test',$con);

  $i = 0;
  while($i < 100){
    $id = $i +1;

    mysql_query("insert into questionid values('$id','','','','','','','','','','',
       '','','','','','','','','','',
       '','','','','','','','','','')", $con);
    $qArray = array();
    $j = 0;
    $seTemp = rand(1,60);

    while($j < 20){
      if(in_array($seTemp, $qArray)){
          $seTemp = rand(1,60);
      }else{
        array_push($qArray, $seTemp);
        $j++;
      }
    }

    $j = 0;
    $juTemp = rand(61,103);
    while($j < 10){
      if(in_array($juTemp, $qArray)){
          $juTemp = rand(61,103);
      }else{
        array_push($qArray, $juTemp);
        $j++;
      }
    }

    //print_r($qArray);
    $counter = 0;
    while($counter < 30){
      $colNum = $counter + 1;
      //$id = $i + 1;
      $query = "update questionid set $colNum" ."c". " = ".$qArray[$counter]." where id = ".$id;
      echo $query."\n";
      mysql_query($query, $con);
      $counter ++;
    }

    $i++;  
  }
?>

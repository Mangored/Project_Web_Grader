<?php
$conn = mysql_connect("localhost","mangese","000000");
  if($conn != FALSE)
  {
    session_start();
    $PID = $_REQUEST["pid"];
    $SID = $_REQUEST["sid"];
    $DATE = $_REQUEST["date"];
    $TIME = $_REQUEST["time"];
    $FULLMARK = $_REQUEST["fullMark"];
    mysql_query("use grader;");
    mysql_query("insert into homework (P_ID,LANGUAGE,S_ID,AssignDate,AssignTime,DeadlineDate,DeadlineTime,FullMark) values ($PID,(select Language from problem where p_id = '$PID'),$SID,now(),now(),'$DATE','$TIME','$FULLMARK');");
  }
?>

<?php
  $F = $_REQUEST["file"];
  $conn = mysql_connect("localhost","mangese","000000");
if($conn != FALSE)
{
  mysql_query("use grader;");

  echo "alert('$F');";
  mysql_query("delete from submit where source_file = '$F';",$ERR);
  exec("rm File/$F ",$out,$err);
  echo "alert('$err');";
  $EM = mysql_error($ERR);
  echo "alert('$ERR');";
}
?>

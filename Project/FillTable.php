<?php
  $conn = mysql_connect("localhost","mangese","000000");
  if($conn != FALSE)
  {
    session_start();
    mysql_query("use grader;");
    mysql_query("set NAMES UTF8;");
    $Section = $_REQUEST["Section"];
    $UID = $_SESSION["uid"];
    $result = mysql_query("select h.h_id as pid,p.Remark as problemName,p.Language as language,p.File_Name as fileName,concat(h.deadlinedate,' ',h.deadlinetime) as deadline,count(su.u_id) as num  ,(case when (select status from submit where su.H_ID = H_id and u_id = '$UID' and status = 'P' limit 1) is null then 'F' else 'P' end)  as status from homework h join section s on h.S_ID = s.S_ID join problem p on p.P_ID = h.P_ID left join submit su on su.H_ID = h.H_ID and su.u_id = '$UID'  where s.S_ID = '$Section' and h.deleteflag is null and (DATE(now())<h.Deadlinedate or (DATE(now()) = h.deadlinedate and TIME(now())<=h.deadlinetime)) and p.deleteflag is null group by h.h_id order by h.h_id;");
    $RowNum = 0;
    while($row = mysql_fetch_assoc($result))
    {
      $RowNum = $RowNum+1;
      echo "<tr>";
      echo "<td style='width:6%; text-align:center; padding: .6555555rem;'>";
      echo "$RowNum";
      echo "</td>";
      echo "<td style='width:18%;  padding: .6555555rem;' class = 'use'>";
      $PN = $row['problemName'];
      $LA = $row['language'];
      $FN = $row['fileName'];
      $LA1 = '"'.$LA.'"';
      $PID = $row['pid'];
      $QTY = $row['num'];
      $DD = $row['deadline'];
      echo "<a href = 'Problem/$FN' target = '_blank' data-toggle='tooltip' data-placement='bottom' title='Click for view problem'>$PN</a>";
      echo "</td>";
      echo "<td style='width:11%; text-align:center; padding: .6555555rem;'>";
      echo "$LA";
      echo "</td>";
      echo "<td style='width:22%; text-align:center; padding: .6555555rem;'>";
      echo "$DD";
      echo "</td>";
      echo "<td style='width:21%; text-align:center; padding: .6555555rem;'>";
      echo "$QTY";
      echo "</td>";
      echo "<td style='width:10%; text-align:center; padding: .6555555rem;'>";
      $Status = $row['status'];
      if(!strcmp($Status, "F"))
      {
        echo "<div style='color:#E74C3C'>Fail</div>";
      }
      else
      {
        echo "<div style='color:#2ECC71'>Pass";
      }
      echo "</td>";
      echo "<td style='width:12%; text-align:center;'>";
      if(!strcmp($Status, "F"))
      {
      if(!strcmp($LA, "Java")){
         echo "<button type='button' class='btn btn-info btn-sm upload-btn'  onclick = 'ModalHeaderFunc(this,$PID,$LA1);' data-toggle='modal' ";
         echo "data-target='#javaUpload'>Upload</button>";
      }else
      {
        echo "<button type='button' class='btn btn-info btn-sm upload-btn'  onclick = 'ModalHeaderFunc1(this,$PID,$LA1);' data-toggle='modal' ";
        echo "data-target='#notjavaUpload'>Upload</button>";
      }
      }
      else
      {
         echo "<button type='button' class='btn btn-info btn-sm upload-btn'  ";
        echo ">Upload</button>";
      }
     
      
      echo "</td>";
      echo "</tr>";
    }
  }
?>

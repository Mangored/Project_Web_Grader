<?php
$conn = mysql_connect("localhost","mangese","000000");
  if($conn != FALSE)
  {
    session_start();
    mysql_query("use grader;");
    mysql_query("set NAMES UTF8;");
    $MYTYPE = $_SESSION["utype"];
    $FNE = $_REQUEST["fnameEdit"];
    $LNE = $_REQUEST["lnameEdit"];
  
    // echo "alert('in php');";
    
    $UID = $_REQUEST["uidreq"];
    $UT = $_REQUEST["utypereq"];

    // echo "console.log('testlog');";
    //  echo "console.log('$FNE');";
    //  echo "console.log('$LNE');";
     $FNE1 = "'".$FNE."'";
     $LNE1 = "'".$LNE."'";
    //  echo "console.log($FNE1);";
    //  echo "console.log($LNE1);";

    
    // echo "alert('$MYTYPE');";

    $FN = $_REQUEST["fnamereq"];
    $LN = $_REQUEST["lnamereq"];
    $UN = $_REQUEST["unamereq"];

    $SID = $_REQUEST["sidreq"];
    $DP = $_REQUEST["departreq"];
    $EM = $_REQUEST["emailreq"];
    $PW = $_REQUEST["passreq"];

    $UID1 = "'".$UID."'";
    $UT1 = "'".$UT."'";

    $FN1 = "'".$FN."'";
    $LN1 = "'".$LN."'";
    $UN1 = "'".$UN."'";
    
    $SID1 = "'".$SID."'";
    $DP1 = "'".$DP."'";
    $EM1 = "'".$EM."'";
    $PW1 = "'".$PW."'";

    // echo "alert('uid '+ $UID1);";
    // echo "alert('utype '+ $UT1);";
    // echo "alert('fname '+ $FN1);";
    // echo "alert('lname '+ $LN1);";
    // echo "alert('uname '+ $UN1);";

    // echo "alert('sid '+ $SID1);";
    // echo "alert('dp '+ $DP1);";
    // echo "alert('email '+ $EM1);";
    // echo "alert('PW '+ $PW1);";
    $topEdit='';
    
    $subquery="uPDATE user" ;
    $subquery=$subquery. " set ";
    $subquery=$subquery. ' USER_TYPE =  "'.$UT.'"';
    
    if ($FN!=''){
        $subquery=$subquery. ' ,Firstname =  "'.$FN.'"';
      // echo "alert('FN OK');";
    }
    if ($LN!=''){
      $subquery=$subquery. ' ,Lastname =  "'.$LN.'"';
    // echo "alert('LN OK');";
    }
    if ($UN!=''){
      $result = mysql_query("select username as un from user where username = '$UN';");
      while($row = mysql_fetch_assoc($result))
      {
        $CheckUser = 1;
      }
      if($CheckUser == 0)
      {
       $subquery=$subquery. ' ,Username =  "'.$UN.'"';
      }
      else
      {
        echo "alert('Username Already Taken');";       
      }
    }
    if ($SID!=''){
      $subquery=$subquery. ' ,Student_ID =  "'.$SID.'"';
    // echo "alert('SID OK');";
    }
    if ($DP!=''){
      $subquery=$subquery. ' ,Department =  "'.$DP.'"';
    // echo "alert('DP OK');";
    }
    if ($EM!=''){
      $subquery=$subquery. ' ,Email =  "'.$EM.'"';
    // echo "alert('EM OK');";
    }
    if ($PW!=''){
      $subquery=$subquery. ' ,Password   =  md5("'.$PW.'")';
    // echo "alert('PW OK');";
    }

    if($MYTYPE!='A'){
      if ($FN!=''){
        // $topEdit=$topEdit.$FN.' ';
        $_SESSION["firstname"] = $FN;
      }
      else{
        // $topEdit=$topEdit.$FNE.' ';
        $_SESSION["firstname"] = $FNE;
      }
      if ($LN!=''){
        // $topEdit=$topEdit.$LN; 
        $_SESSION["lastname"] = $LN;
      }else{
        // $topEdit=$topEdit.$LNE; 
        $_SESSION["lastname"] = $LNE;
    }
        echo "location.reload();";
    }
      
      // echo "alert('$subquery');";
      // echo "alert('$topEdit');";
      // echo "alert('$subquery WHERE U_ID =$UID;');";
    $result = mysql_query("$subquery WHERE U_ID =$UID;");

    
  }
?>

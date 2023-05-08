<?php
  include 'db.php';
  session_start();
  $a1 = $_POST["a1"];
  $a2 = $_POST["a2"];
  $a3 = $_POST["a3"];
  $a4 = $_POST["a4"];
  $a5 = $_POST["a5"];
  $a6 = $_POST["a6"];
 
  $dbname2 = $_SESSION['dbname2'];
  mysqli_select_db($conn, $dbname2);

  $tbname = $_SESSION['selecttb'];

  $attr_count = $_SESSION['attr_count'];

  if($attr_count==1)
    $sql = "INSERT INTO $tbname VALUES ('$a1');";
  
  else if($attr_count==2)
    $sql = "INSERT INTO $tbname VALUES ('$a1','$a2');";

  else if($attr_count==3)
    $sql = "INSERT INTO $tbname VALUES ('$a1','$a2','$a3');";

  else if($attr_count==4)
    $sql = "INSERT INTO $tbname VALUES ('$a1','$a2','$a3','$a4');";

  else if($attr_count==5)
    $sql = "INSERT INTO $tbname VALUES ('$a1','$a2','$a3','$a4','$a5');";

  else if($attr_count==6)
    $sql = "INSERT INTO $tbname VALUES ('$a1','$a2','$a3','$a4','$a5','$a6');";

  $conn->query($sql);
  $conn->close();
  header('location: readtb.php?dbname2='.$dbname2.'&selecttb='.$tbname);
?>
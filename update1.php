<?php
  include 'db.php';

session_start();

  $dbname2 = $_SESSION['dbname2'];
  mysqli_select_db($conn, $dbname2);

  $selecttb = $_SESSION['selecttb'];

  $col1 = $_GET[$_SESSION['num']];
  $doctor_idd = $_GET['doctor_idd'];

  $coll1 = $_SESSION['num'];

  $sqll = "update ".$_SESSION['selecttb'] ." set $coll1='$doctor_idd' where $coll1=$col1";
  
  $conn->query($sqll);
  $conn->close();
  header("location: readtb.php?dbname2=$dbname2&selecttb=$selecttb");
?>
<?php
  include 'db.php';

session_start();

  $dbname2 = $_SESSION['dbname2'];
  mysqli_select_db($conn, $dbname2);

  $selecttb = $_SESSION['selecttb'];

  $col1 = $_GET[$_SESSION['num']];
  $doctor_idd = $_GET['doctor_idd'];
  $col2 = $_GET[$_SESSION['col2']];
  $col3 = $_GET[$_SESSION['col3']];

  $coll1 = $_SESSION['num'];
  $coll2 = $_SESSION['coll2'];
  $coll3 = $_SESSION['coll3'];

  $sqll = "update ".$_SESSION['selecttb'] ." set $coll1='$doctor_idd', $coll2='$col2', $coll3='$col3' where $coll1=$col1";

  $conn->query($sqll);
  $conn->close();
  header("location: readtb.php?dbname2=$dbname2&selecttb=$selecttb");
?>
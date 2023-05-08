<?php
  include 'db.php';

  session_start();

  $dbname2 = $_SESSION['dbname2'];
  mysqli_select_db($conn, $dbname2);

  $selecttb = $_SESSION['selecttb'];

  $sql = "select * from $selecttb;";
  $result = mysqli_query($conn, $sql);

  $coll1 = $_SESSION['num'];

  $col1 = $_GET['doctor_idd'];
 
  while($roww = mysqli_fetch_row($result)){

  $sqll = "DELETE FROM $selecttb WHERE $coll1=$col1";
  
  $conn->query($sqll);
  break;
  }
  
  $conn->close();
  header('location: readtb.php?dbname2='.$dbname2.'&selecttb='.$selecttb);
?>
<?php
  include 'db.php';

  session_start();

  mysqli_select_db($conn, $_SESSION['selecteddb']);

  $selecttb = $_SESSION['selecttb'];

  $sql = "select * from $selecttb;";
  $result = mysqli_query($conn, $sql);

  $selectedtb = $_GET['selecttb'];

  $sql = "DROP TABLE $selectedtb";

  $conn->query($sql);
  
  $conn->close();
  header('location: index.php');
?>
<?php
  include 'db.php';
  $tbname = $_POST["tbname"];
  $num = $_POST["num"];
  $a1 = $_POST["a1"];
  $d1 = $_POST["d1"];
  $a2 = $_POST["a2"];
  $d2 = $_POST["d2"];
  $a3 = $_POST["a3"];
  $d3 = $_POST["d3"];
  $a4 = $_POST["a4"];
  $d4 = $_POST["d4"];
  $a5 = $_POST["a5"];
  $d5 = $_POST["d5"];

  $dbname = $_POST["dbname"];

  mysqli_select_db($conn, $dbname);

  $sql = ($num == 1) ? "CREATE TABLE $tbname($a1 $d1)" :  (($num == 2) ? "CREATE TABLE $tbname($a1 $d1, $a2 $d2);" : (($num == 3) ? "CREATE TABLE $tbname($a1 $d1, $a2 $d2, $a3 $d3);" : (($num == 4) ? "CREATE TABLE $tbname($a1 $d1, $a2 $d2, $a3 $d3, $a4 $d4);" : "CREATE TABLE $tbname($a1 $d1, $a2 $d2, $a3 $d3, $a4 $d4, $a5 $d5);")));

  $conn->query($sql);

  $conn->close();
  header("location: index.php");
?>
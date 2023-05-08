<?php
  include 'db.php';
  $name = $_GET['name'];
  $sql = "DROP DATABASE $name";
  $conn->query($sql);
  $conn->close();
  header("location: index.php");
?>
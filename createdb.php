<?php
  include 'db.php';
  $name = $_POST["name"];
 
  $sql = "CREATE DATABASE $name;";

  $conn->query($sql);

  $conn->close();
  header("location: index.php");
?>
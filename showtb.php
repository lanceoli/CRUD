<?php
  include 'db.php';
session_start();
echo '<head>';
echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
echo '</head>';
  $selectdb = $_POST["selectdb"];
  $_SESSION['selecteddb'] = $selectdb;
  mysqli_select_db($conn, "$selectdb");

  $sql = "show tables;";

    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  echo '<table class="table" style = "position:absolute;margin-left:20%;">';
  $count = 1;
    while( $row = mysqli_fetch_row($result) ){
        if($count == 1){
          echo "<tr>";
            echo '<th class="form-control m-2"><b>Tables: </b></th></tr>';
            $count = $count + 1;
        }
      echo "<tr>";
      echo '<td>' . $row[0]. '</td>';
      echo '<td><a class="btn btn-danger" href="delete_table.php?selecttb=' . $row[0] . '" role="button">Delete</a></td>';
      echo "</tr> ";
  }
  
  echo '<form class="form-inline m-2" style = "position:absolute;margin-left:2%;" action="back.php" method="POST">';
  echo '<button type="submit" class="btn btn-primary" style = "position:absolute;margin-left:2%;">Back to Page</button>';
  echo '</form>';
  echo '</table>';
  $conn->close();
?>
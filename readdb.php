<?php
  include 'db.php';

  $sql = "show databases;";

  $result = $conn->query($sql);

    while( $row = mysqli_fetch_row( $result )){
      echo "<tr>";
      echo '<td>' . $row[0]. '</td>';
                
      echo '<td><a class="btn btn-danger" href="delete.php?name=' . $row[0] . '" role="button">Delete</a></td>';
      echo "</tr>";
  }

  $conn->close();
  
?>
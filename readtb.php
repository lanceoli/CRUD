<?php
  include 'db.php';

  echo '<head>';
echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
echo '</head>';
  echo '<body>';
  session_start();

   $_SESSION['dbname2'] = $_GET["dbname2"];

  $dbname2 = $_GET["dbname2"];
  mysqli_select_db($conn, $dbname2);

  $selecttb = $_GET["selecttb"];
  $_SESSION['selecttb'] = $_GET["selecttb"];

  
  $col_count = "select count(*) as num_col from information_schema.columns where table_name = '$selecttb';";

  $d_type = "SELECT DATA_TYPE from INFORMATION_SCHEMA. COLUMNS where table_schema = '$dbname2' and table_name = '$selecttb'";
  $d_typee = mysqli_query($conn, $d_type);
  $data_type = mysqli_fetch_row($d_typee);

  $column_count = mysqli_query($conn, $col_count);

  $col_select = "SHOW COLUMNS FROM $selecttb";
  $column_select = mysqli_query($conn, $col_select);

  $column_sel = "SELECT count(*)
  FROM information_schema.columns
  WHERE table_name = '$selecttb';";
  $count_numm = mysqli_query($conn, $column_sel);
  $count_num = mysqli_fetch_row($count_numm);
  $_SESSION['attr_count'] = $count_num[0];
  
  if($count_num[0] == 1){
    $orderby = $_SESSION['order_list1'] ?? 'ASC';
    $coltosort = $_SESSION['col_order_list1'] ?? $_SESSION['first_col1'];
  }

  if($count_num[0] == 2){
    $orderby = $_SESSION['order_list'] ?? 'ASC';
    $coltosort = $_SESSION['col_order_list'] ?? $_SESSION['first_col2'];
  }
    
  if($count_num[0] == 3){
    $orderby = $_SESSION['order_list3'] ?? 'ASC';
    $coltosort = $_SESSION['col_order_list3'] ?? $_SESSION['first_col3'];
  }

  if($count_num[0] == 4){
    $orderby = $_SESSION['order_list4'] ?? 'ASC';
    $coltosort = $_SESSION['col_order_list4'] ?? $_SESSION['first_col4'];
  }
  if($count_num[0] == 5){
    $orderby = $_SESSION['order_list5'] ?? 'ASC';
    $coltosort = $_SESSION['col_order_list5'] ?? $_SESSION['first_col5'];
  }
  if($count_num[0] == 6){
    $orderby = $_SESSION['order_list6'] ?? 'ASC';
    $coltosort = $_SESSION['col_order_list6'] ?? $_SESSION['first_col6'];
  }
  
    $sql = "select * from $selecttb
  order by $coltosort $orderby;"; // add sort stuff here

  $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
 
  if ($col_count > 0) {
    // output data of each row

  // 1 attribute
  if($count_num[0] == 1){
    $options = []; // options for sort

    $counter = 1;
    $row_count = 2;

    echo '<table class = "table">';
    while($col = mysqli_fetch_row($column_select)){
      array_push($options,$col[0]); // add column name to array
      $_SESSION['first_col1'] = $col[0];// add default value

      echo "<th>" . $col[0] . "</th>";
      if($counter > 1){
        $_SESSION['coll'.$counter] = $col[0];
      }


    if($counter == 1){
      $num = $col[0];
      $_SESSION['num'] = $col[0];
    }

    echo "<br>";
      while($row = mysqli_fetch_row($result)){
        if($row[0] == $_GET[$num]){
          echo '<form class="form-inline m-2" action="update1.php" method="GET">';
          echo '<td><input type="text" class="form-control" name="doctor_idd" value="'.$row[0].'"></td>';
          
          echo '<td><button type="submit" class="btn btn-primary">Save</button></td>';
          echo '<input type="hidden" name="'.$num.'" value="'.$row[0].'">';
          echo '</form>';
        }
        else{
          echo  "<tr><td>".$row[0]. '</td><td><a class="btn btn-primary" href="readtb.php?dbname2='.$dbname2.'&selecttb='.$selecttb.'&'.$num.'=' . $row[0] . '" role="button">Update</a>
          <a class="btn btn-danger" href="delete_record.php?doctor_idd=' . $row[0] . '" role="button">Delete</a></td></tr>';
        }
      }
    }
    echo '</table>';
    // sort
echo '<form class="form-inline m-2" action="sort.php" method="GET">';
$selection = array('ASC', 'DESC');
echo '<select name = "order1">
      <option value="0">Select Order</option>';

foreach ($selection as $selection) {
    $selected = ($selection == $selection) ? "selected" : "";
    echo '<option  value="'.$selection.'">'.$selection.'</option>';
    echo $selected;
}
echo '</select>';

//
echo '<select name="col_to_sort1">';
echo '<option value="0">Please Select Option</option>';

echo '<option value="'.$options[0].'"  ">'.$options[0].'</option>';
echo '<option value="'.$options[1].'" >'.$options[1].'</option>';

echo '</select>';

// submit button
echo '<td><button type="submit" class="btn btn-primary">Sort</button></td>';
echo '</form>';
    }

  // 2 attributes
  if($count_num[0] == 2){
    $options = []; // options for sort

    $counter = 1;
    $row_count = 2;

    echo '<table class = "table">';
    while($col = mysqli_fetch_row($column_select)){
      array_push($options,$col[0]); // add column name to array
      if($counter == 1)

      $_SESSION['first_col2'] = $col[0];// add default value

      echo "<th>" . $col[0] . "</th>";
      if($counter > 1){
        $_SESSION['coll'.$counter] = $col[0];
      }

    if($counter == 1){
      $num = $col[0];
      $_SESSION['num'] = $col[0];
    }

    if($counter == 2){
      $col2 = $col[0];
      $_SESSION['col2'] = $col2;
    }

    if($counter < 2){
      $counter++;
      continue;
    }

    echo "<br>";
      while($row = mysqli_fetch_row($result)){
        if($row[0] == $_GET[$num]){
          echo '<form class="form-inline m-2" action="update2.php" method="GET">';
          echo '<td><input type="text" class="form-control" name="doctor_idd" value="'.$row[0].'"></td>';
          echo '<td><input type="text" class="form-control" name="'.$col2.'" value="'.$row[1].'"></td>';
          
          echo '<td><button type="submit" class="btn btn-primary">Save</button></td>';
          echo '<input type="hidden" name="'.$num.'" value="'.$row[0].'">';
          echo '</form>';
        }
        else{
          echo  "<tr><td>".$row[0]. '</td><td>'
          .$row[1].'</td><td><a class="btn btn-primary" href="readtb.php?dbname2='.$dbname2.'&selecttb='.$selecttb.'&'.$num.'=' . $row[0] . '" role="button">Update</a>
          <a class="btn btn-danger" href="delete_record.php?doctor_idd=' . $row[0] . '" role="button">Delete</a></td></tr>';
        }
      }
    }
    echo '</table>'; //here
    // sort
echo '<form class="form-inline m-2" action="sort.php" method="GET">';
$selection = array('ASC', 'DESC');
echo '<select name = "order">
      <option value="0">Select Order</option>';

foreach ($selection as $selection) {
    $selected = ($selection == $selection) ? "selected" : "";
    echo '<option  value="'.$selection.'">'.$selection.'</option>';
    echo $selected;
}
echo '</select>';

//
echo '<select name="col_to_sort">';
echo '<option value="0">Please Select Option</option>';

echo '<option value="'.$options[0].'"  ">'.$options[0].'</option>';

echo '<option value="'.$options[1].'" >'.$options[1].'</option>';
echo '</select>';

// submit button
echo '<td><button type="submit" class="btn btn-primary">Sort</button></td>';
echo '</form>';

    }

    // 3 attributes
    if($count_num[0] == 3){

  $options = []; // options for sort

    $counter = 1;
    $row_count = 2;

    echo '<table class = "table">';
    while($col = mysqli_fetch_row($column_select)){
      array_push($options,$col[0]); // add column name to array
      if($counter == 1)
        $_SESSION['first_col3'] = $col[0]; // add default value

      echo '<th>' . $col[0] . '</th>';
      if($counter > 1){
        $_SESSION['coll'.$counter] = $col[0];
      }

    if($counter == 1){
      $num = $col[0];
      $_SESSION['num'] = $col[0];
    }

    if($counter == 2){
      $col2 = $col[0];
      $_SESSION['col2'] = $col2;
    }

    if($counter == 3){
      $col3 = $col[0];
      $_SESSION['col3'] = $col3;
    }

    if($counter < 3){
      $counter++;
      continue;
    }

      while($row = mysqli_fetch_row($result)){
        if($row[0] == $_GET[$num]){
          $_SESSION['value1'] = $row[0];
          echo '<form class="form-inline m-2" action="update.php" method="GET">';
          echo '<td><input type="text" class="form-control" name="doctor_idd" value="'.$row[0].'"></td>';
          echo '<td><input type="text" class="form-control" name="'.$col2.'" value="'.$row[1].'"></td>';
          echo '<td><input type="text" class="form-control" name="'.$col3.'" value="'.$row[2].'"></td>';
          
          echo '<td><button type="submit" class="btn btn-primary">Save</button></td>';
          echo '<input type="hidden" name="'.$num.'" value="'.$row[0].'">';
          echo '</form>';
        }
        else{
          echo  '<tr><td>'.$row[0]. '</td><td>'
          .$row[1]."</td><td>"
          .$row[2]. '</td><td><a class="btn btn-primary" href="readtb.php?dbname2='.$dbname2.'&selecttb='.$selecttb.'&'.$num.'=' . $row[0] . '" role="button">Update</a>
          <a class="btn btn-danger" href="delete_record.php?doctor_idd=' . $row[0] . '" role="button">Delete</a></td></tr>';

        }
      }
    }
    echo '</table>';
// sort
echo '<form class="form-inline m-2" action="sort.php" method="GET">';
    $selection = array('ASC', 'DESC');
    echo '<select name = "order3">
          <option value="0">Select Order</option>';
  
    foreach ($selection as $selection) {
        $selected = ($selection == $selection) ? "selected" : "";
        echo '<option  value="'.$selection.'">'.$selection.'</option>';
        echo $selected;
    }
    echo '</select>';

//
    echo '<select name="col_to_sort3">';
echo '<option value="0">Please Select Option</option>';

echo '<option value="'.$options[0].'"  ">'.$options[0].'</option>';
echo '<option value="'.$options[1].'" >'.$options[1].'</option>';
echo '<option value="'.$options[2].'" >'.$options[2].'</option>';

echo '</select>';

// submit button
echo '<td><button type="submit" class="btn btn-primary">Sort</button></td>';
echo '</form>';

    }

    // 4 attributes
    if($count_num[0] == 4){
      $options = []; // options for sort

      $counter = 1;
      $row_count = 2;

      echo '<table class = "table">';
      while($col = mysqli_fetch_row($column_select)){
        array_push($options,$col[0]); // add column name to array

      $_SESSION['first_col4'] = $col[0]; // add default value

        echo "<th>" . $col[0] . "</th>";
        if($counter > 1){
          $_SESSION['coll'.$counter] = $col[0];
        }
  
      if($counter == 1){
        $num = $col[0];
        $_SESSION['num'] = $col[0];
      }
  
      if($counter == 2){
        $col2 = $col[0];
        $_SESSION['col2'] = $col2;
      }
  
      if($counter == 3){
        $col3 = $col[0];
        $_SESSION['col3'] = $col3;
      }

      if($counter == 4){
        $col4 = $col[0];
        $_SESSION['col4'] = $col4;
      }
  
      if($counter < 4){
        $counter++;
        continue;
      }
  
        while($row = mysqli_fetch_row($result)){
          if($row[0] == $_GET[$num]){
            echo '<form class="form-inline m-2" action="update4.php" method="GET">';
            echo '<td><input type="text" class="form-control" name="doctor_idd" value="'.$row[0].'"></td>';
            echo '<td><input type="text" class="form-control" name="'.$col2.'" value="'.$row[1].'"></td>';
            echo '<td><input type="text" class="form-control" name="'.$col3.'" value="'.$row[2].'"></td>';
            echo '<td><input type="text" class="form-control" name="'.$col4.'" value="'.$row[3].'"></td>';
            
            echo '<td><button type="submit" class="btn btn-primary">Save</button></td>';
            echo '<input type="hidden" name="'.$num.'" value="'.$row[0].'">';
            echo '</form>';
          }
          else{
            echo  "<tr><td>".$row[0]. '</td><td>'
            .$row[1]."</td><td>"
            .$row[2]."</td><td>".$row[3]."</td><td>"
            . '<a class="btn btn-primary" href="readtb.php?dbname2='.$dbname2.'&selecttb='.$selecttb.'&'.$num.'=' . $row[0] . '" role="button">Update</a>
            <a class="btn btn-danger" href="delete_record.php?doctor_idd=' . $row[0] . '" role="button">Delete</a></td></tr>';
          }
        }
      }
      echo '</table>';
      // sort
echo '<form class="form-inline m-2" action="sort.php" method="GET">';
$selection = array('ASC', 'DESC');
echo '<select name = "order4">
      <option value="0">Select Order</option>';

foreach ($selection as $selection) {
    $selected = ($selection == $selection) ? "selected" : "";
    echo '<option  value="'.$selection.'">'.$selection.'</option>';
    echo $selected;
}
echo '</select>';

//
echo '<select name="col_to_sort4">';
echo '<option value="0">Please Select Option</option>';

echo '<option value="'.$options[0].'"  ">'.$options[0].'</option>';
echo '<option value="'.$options[1].'" >'.$options[1].'</option>';
echo '<option value="'.$options[2].'" >'.$options[2].'</option>';
echo '<option value="'.$options[3].'" >'.$options[3].'</option>';

echo '</select>';

// submit button
echo '<td><button type="submit" class="btn btn-primary">Sort</button></td>';
echo '</form>';
      }

      // 5 attributes
      if($count_num[0] == 5){
        $options = []; // options for sort

        $counter = 1;
        $row_count = 2;

        echo '<table class = "table">';
        while($col = mysqli_fetch_row($column_select)){
          array_push($options,$col[0]); // add column name to array

      $_SESSION['first_col5'] = $col[0]; // add default value

          echo "<th>" . $col[0] . "</th>";
          if($counter > 1){
            $_SESSION['coll'.$counter] = $col[0];
          }
    
        if($counter == 1){
          $num = $col[0];
          $_SESSION['num'] = $col[0];
        }
    
        if($counter == 2){
          $col2 = $col[0];
          $_SESSION['col2'] = $col2;
        }
    
        if($counter == 3){
          $col3 = $col[0];
          $_SESSION['col3'] = $col3;
        }
  
        if($counter == 4){
          $col4 = $col[0];
          $_SESSION['col4'] = $col4;
        }

        if($counter == 5){
          $col5 = $col[0];
          $_SESSION['col5'] = $col5;
        }
    
        if($counter < 5){
          $counter++;
          continue;
        }
    
          while($row = mysqli_fetch_row($result)){
            if($row[0] == $_GET[$num]){
              echo '<form class="form-inline m-2" action="update5.php" method="GET">';
              echo '<td><input type="text" class="form-control" name="doctor_idd" value="'.$row[0].'"></td>';
              echo '<td><input type="text" class="form-control" name="'.$col2.'" value="'.$row[1].'"></td>';
              echo '<td><input type="text" class="form-control" name="'.$col3.'" value="'.$row[2].'"></td>';
              echo '<td><input type="text" class="form-control" name="'.$col4.'" value="'.$row[3].'"></td>';
              echo '<td><input type="text" class="form-control" name="'.$col5.'" value="'.$row[4].'"></td>';
              
              echo '<td><button type="submit" class="btn btn-primary">Save</button></td>';
              echo '<input type="hidden" name="'.$num.'" value="'.$row[0].'">';
              echo '</form>';
            }
            else{
              echo  "<tr><td>".$row[0]. '</td><td>'
            .$row[1]."</td><td>"
            .$row[2]."</td><td>".$row[3]."</td><td>"
            .$row[4]."</td><td>". 
            '<a class="btn btn-primary" href="readtb.php?dbname2='.$dbname2.'&selecttb='.$selecttb.'&'.$num.'=' . $row[0] . '" role="button">Update</a>
            <a class="btn btn-danger" href="delete_record.php?doctor_idd=' . $row[0] . '" role="button">Delete</a></td></tr>';
            }
          }
        }
        echo '</table>';
        // sort
echo '<form class="form-inline m-2" action="sort.php" method="GET">';
$selection = array('ASC', 'DESC');
echo '<select name = "order5">
      <option value="0">Select Order</option>';

foreach ($selection as $selection) {
    $selected = ($selection == $selection) ? "selected" : "";
    echo '<option  value="'.$selection.'">'.$selection.'</option>';
    echo $selected;
}
echo '</select>';

//
echo '<select name="col_to_sort5">';
echo '<option value="0">Please Select Option</option>';

echo '<option value="'.$options[0].'"  ">'.$options[0].'</option>';
echo '<option value="'.$options[1].'" >'.$options[1].'</option>';
echo '<option value="'.$options[2].'" >'.$options[2].'</option>';
echo '<option value="'.$options[3].'" >'.$options[3].'</option>';
echo '<option value="'.$options[4].'" >'.$options[4].'</option>';

echo '</select>';

// submit button
echo '<td><button type="submit" class="btn btn-primary">Sort</button></td>';
echo '</form>';
        }

      // 6 attributes
      if($count_num[0] == 6){
        $options = []; // options for sort

        $counter = 1;
        $row_count = 2;

        echo '<table class = "table">';
        while($col = mysqli_fetch_row($column_select)){
          array_push($options,$col[0]); // add column name to array

      $_SESSION['first_col6'] = $col[0]; // add default value

          echo "<th>" . $col[0] . "</th>";
          if($counter > 1){
            $_SESSION['coll'.$counter] = $col[0];
          }
    
        if($counter == 1){
          $num = $col[0];
          $_SESSION['num'] = $col[0];
        }
    
        if($counter == 2){
          $col2 = $col[0];
          $_SESSION['col2'] = $col2;
        }
    
        if($counter == 3){
          $col3 = $col[0];
          $_SESSION['col3'] = $col3;
        }
  
        if($counter == 4){
          $col4 = $col[0];
          $_SESSION['col4'] = $col4;
        }

        if($counter == 5){
          $col5 = $col[0];
          $_SESSION['col5'] = $col5;
        }

        if($counter == 6){
          $col6 = $col[0];
          $_SESSION['col6'] = $col6;
        }
    
        if($counter < 6){
          $counter++;
          continue;
        }
    
          while($row = mysqli_fetch_row($result)){
            if($row[0] == $_GET[$num]){
              echo '<form class="form-inline m-2" action="update6.php" method="GET">';
              echo '<td><input type="text" class="form-control" name="doctor_idd" value="'.$row[0].'"></td>';
              echo '<td><input type="text" class="form-control" name="'.$col2.'" value="'.$row[1].'"></td>';
              echo '<td><input type="text" class="form-control" name="'.$col3.'" value="'.$row[2].'"></td>';
              echo '<td><input type="text" class="form-control" name="'.$col4.'" value="'.$row[3].'"></td>';
              echo '<td><input type="text" class="form-control" name="'.$col5.'" value="'.$row[4].'"></td>';
              echo '<td><input type="text" class="form-control" name="'.$col6.'" value="'.$row[5].'"></td>';
              
              echo '<td><button type="submit" class="btn btn-primary">Save</button></td>';
              echo '<input type="hidden" name="'.$num.'" value="'.$row[0].'">';
              echo '</form>';
            }
            else{
              echo  "<tr><td>".$row[0]. '</td><td>'
            .$row[1]."</td><td>"
            .$row[2]."</td><td>".$row[3]."</td><td>"
            .$row[4]."</td><td>".
            $row[5]."</td><td>". 
            '<a class="btn btn-primary" href="readtb.php?dbname2='.$dbname2.'&selecttb='.$selecttb.'&'.$num.'=' . $row[0] . '" role="button">Update</a>
            <a class="btn btn-danger" href="delete_record.php?doctor_idd=' . $row[0] . '" role="button">Delete</a></td></tr>';
            }
          }
        }
        echo '</table>';
        // sort
echo '<form class="form-inline m-2" action="sort.php" method="GET">';
$selection = array('ASC', 'DESC');
echo '<select name = "order6">
      <option value="0">Select Order</option>';

foreach ($selection as $selection) {
    $selected = ($selection == $selection) ? "selected" : "";
    echo '<option  value="'.$selection.'">'.$selection.'</option>';
    echo $selected;
}
echo '</select>';

//
echo '<select name="col_to_sort6">';
echo '<option value="0">Please Select Option</option>';

echo '<option value="'.$options[0].'"  ">'.$options[0].'</option>';
echo '<option value="'.$options[1].'" >'.$options[1].'</option>';
echo '<option value="'.$options[2].'" >'.$options[2].'</option>';
echo '<option value="'.$options[3].'" >'.$options[3].'</option>';
echo '<option value="'.$options[4].'" >'.$options[4].'</option>';
echo '<option value="'.$options[5].'" >'.$options[5].'</option>';
echo '</select>';

// submit button
echo '<td><button type="submit" class="btn btn-primary">Sort</button></td>';
echo '</form>';
        }
        
// inserting data ----------------
        echo '<form class="form-inline m-2" action="insert.php" method="POST">

        <label for="name">Insert Data:</label>';
    
        for($i = 1; $i <= $count_num[0]; $i++){
      if($i==1){
        echo '<input type="text" class="form-control m-2" id="a1" name="a1">';
      }
      else{
          echo '<input type="text" class="form-control m-2" id="a'.$i . '" name="a'.$i.'">';
      }
    }

        echo '<button type="submit" class="btn btn-primary">Insert Data</button>
      </form>';
      
// back button ----------------------
        echo '<form class="form-inline m-2" action="back.php" method="POST">';
        echo '<button type="submit" class="btn btn-primary">Back to Page</button>';
        echo '</form>';
  }
  echo '</body>';
  $conn->close();
  
?>
<?php
  include 'db.php';
session_start();

  $dbname2 = $_SESSION['dbname2'];
  mysqli_select_db($conn, $dbname2);

  $selecttb = $_SESSION['selecttb'];

  $att_num = $_SESSION['attr_count'];

    if($att_num == 1){
        $_SESSION['order_list1'] = $_GET['order1'];
        $_SESSION['col_order_list1'] = $_GET['col_to_sort1'];
    }
    if($att_num == 2){
        $_SESSION['order_list'] = $_GET['order'];
        $_SESSION['col_order_list'] = $_GET['col_to_sort'];
    }
    if($att_num == 3){
        $_SESSION['order_list3'] = $_GET['order3'];
        $_SESSION['col_order_list3'] = $_GET['col_to_sort3'];
    }
    if($att_num == 4){
        $_SESSION['order_list4'] = $_GET['order4'];
        $_SESSION['col_order_list4'] = $_GET['col_to_sort4'];
    }
    if($att_num == 5){
        $_SESSION['order_list5'] = $_GET['order5'];
        $_SESSION['col_order_list5'] = $_GET['col_to_sort5'];
    }
    if($att_num == 6){
        $_SESSION['order_list6'] = $_GET['order6'];
        $_SESSION['col_order_list6'] = $_GET['col_to_sort6'];
    }
    

  $conn->close();
  header("location: readtb.php?dbname2=$dbname2&selecttb=$selecttb");
?>
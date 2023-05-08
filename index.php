<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
  <h1><b>PHP + MySQL CRUD Server</b></h1>
  <p>Create, read, update, and delete records below</p>

  <table class = "table">
  <tbody>
    <?php include 'readdb.php'; ?>
  </tbody>
  </table>
<!-- database -->
  <form class="form-inline m-2" action="createdb.php" method="POST">

    <label for="name">Database Name:</label>
    <input type="text" class="form-control m-2" id="name" name="name">

    <button type="submit" class="btn btn-primary">Add Database</button>
  </form>
  <hr>
<!-- table -->
  <form class="form-inline m-2" action="createtb.php" method="POST">
  <label for="dbname">Create Table for (database name):</label>
    <input type="text" class="form-control m-2" id="dbname" name="dbname">

  <label for="tbname">Table Name:</label>
  <input type="text" class="form-control m-2" id="tbname" name="tbname">

    <label for="num" class = "col-md-6">Number of Attributes (max. 5):</label>
    <input type="number" class="form-control m-2" id="num" name="num" min="1" max="5" step="1" value="0">

    
    <label for="a1" class = "col-md-5">Attribute 1:</label>
    <input type="text" class="form-control m-2" id="a1" name="a1">

    <label for="d1" class = "col-md-5">Data Type:</label>
    <input type="text" class="form-control m-2" id="d1" name="d1">

    <label for="a1" class = "col-md-5">Attribute 2:</label>
    <input type="text" class="form-control m-2" id="a2" name="a2">

    <label for="d1" class = "col-md-5">Data Type:</label>
    <input type="text" class="form-control m-2" id="d2" name="d2">

    <label for="a1" class = "col-md-5">Attribute 3:</label>
    <input type="text" class="form-control m-2" id="a3" name="a3">

    <label for="d1" class = "col-md-5">Data Type:</label>
    <input type="text" class="form-control m-2" id="d3" name="d3">

    <label for="a1" class = "col-md-5">Attribute 4:</label>
    <input type="text" class="form-control m-2" id="a4" name="a4">

    <label for="d1" class = "col-md-5">Data Type:</label>
    <input type="text" class="form-control m-2" id="d4" name="d4">

    <label for="a1" class = "col-md-5">Attribute 5:</label>
    <input type="text" class="form-control m-2" id="a5" name="a5">

    <label for="d1" class = "col-md-5">Data Type:</label>
    <input type="text" class="form-control m-2" id="d5" name="d5">

    <button type="submit" class="btn btn-primary">Add Table</button>
  </form>
<hr>
  <!-- Show tables in database -->

  <form class="form-inline m-2" action="showtb.php" method="POST">

  <label for="selectdb">Show Tables for (database name):</label>
    <input type="text" class="form-control m-2" id="selectdb" name="selectdb">

    <button type="submit" class="btn btn-primary">Show tables</button>
</form>

<!-- show tables -->
<form class="form-inline m-2" action="readtb.php" method="GET">

<label for="dbname2">Show Table for (database name):</label>
  <input type="text" class="form-control m-2" id="dbname2" name="dbname2">

<label for="selecttb">Show Table:</label>
  <input type="text" class="form-control m-2" id="selecttb" name="selecttb">

  <button type="submit" class="btn btn-primary">Show table</button>
</form>

<!-- showing all tables -->
  <table class = "table">
    <tbody>
      <?php include 'showtb.php'; ?>
    </tbody>
  </table>

<!-- show table -->
<table class="table">
    <tbody>
      <?php include 'readtb.php'; ?>
    </tbody>
  </table>  

</div>
</body>
</html>
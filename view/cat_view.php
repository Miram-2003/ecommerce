<?php
require_once("../functions/cat_function.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
  
  position: absolute;
  left: 180px;
  top:150px;
  border-collapse: collapse; 
  margin-left: 10px;
  margin-right: px;
  width: 80%;
  
}
th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}
th {
  background-color:rgb(255, 255, 255);
  text-align: center;  
}

</style>
</head>
<body>

    <h4> Add a category</h4>
    <form action ="../actions/addcat.php" method = "post">
    <input type ="text" name = "cat">

    <button> Add </button>
</form>
    <h2>Category list</h2>
   
    <?php
    displaycat()

    ?>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</body>
</html>
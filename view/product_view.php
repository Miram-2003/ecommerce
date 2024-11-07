<?php
require_once ("../functions/brand_function.php");
require_once ("../functions/cat_function.php");

require_once("../functions/product_function.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action ="../actions/addproduct.php" method= "post" enctype="multipart/form-data">
        product category :<?php echo display_cat_option(); ?><br><br>
        product  brand: <?php echo display_brand_option(); ?><br><br>
        product name: <input name ="title"><br><br>
        product price: <input name ="price"><br><br>
        product description: <input name="desc"><br><br>
        product image: <input type="file" name ="image" accept="image/*"> <br><br>
        produt keyword: <input name="word">

        <button> submit </button>

</form>

products

<?php
    displayproduct()

    ?>





</body>
</html>
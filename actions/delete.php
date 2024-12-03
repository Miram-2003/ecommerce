<?php
include("controllers/general_controller.php");
if (!isset($_GET["id"])) {
    header("Location: ../view/brand_view.php");
    exit;
}else{
    $id = $_GET["id"];
    $result = delete($id);
    if ($result) {
        header("Location: ../view/brand_view.php");
        exit;
    }else{
        header("Location: ../view/brand_view.php?msg=sorry, something went wrong");
        echo"sorry something went wrrong";
        exit;
    }
        

}
?>
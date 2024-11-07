<?php

require_once("../controllers/cat_controller.php");

function displaycat(){
    $result = get_cat_ctr();
  

    echo "<table id='Table' >";
        echo "<thead>";
        echo "<tr>";

        echo "<th>Category Name</th>";
        echo  "<th>Actions</th>";
        echo "</tr>";
        echo "</thead>"; 
        echo "<tbody>";
        foreach ($result as $row) {
            echo "<tr>";

            echo "<td>". $row['cat_name'] ."</td>";
            echo "<td>
            <a href=\"../view/edit_brand.php?id=" . $row['cat_id'] . "\">
                <ion-icon name='pencil-outline'></ion-icon>
            </a>
            <a href=\"../actions/delete.php?id=" . $row['cat_id'] . "\">
                <ion-icon name='trash-outline'></ion-icon>
            </a>
            </td>";
        

            echo "</tr>";
                }
        echo "</tbody>";
        echo "</table>";
    
}


function display_cat_option(){
    $result = get_cat_ctr(); // Fetch brand data
    $option = "<select name='cat'>";  
    $option .= "<option></option>";    // Start the select element

    foreach($result as $row){
        // Append each option to the select element
        $option .= "<option value ='".$row['cat_id']."'> ".$row['cat_name']." </option>";
    }

    $option .= "</select>";    // Close the select element
    return $option;
}
?>
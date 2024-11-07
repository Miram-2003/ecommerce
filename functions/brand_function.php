<?php

require_once("../controllers/general_controller.php");

function displaybrand(){
    $result = get_brand_ctr();
  

    echo "<table id='Table' >";
        echo "<thead>";
        echo "<tr>";

        echo "<th>Brand Name</th>";
        echo  "<th>Actions</th>";
        echo "</tr>";
        echo "</thead>"; 
        echo "<tbody>";
        foreach ($result as $row) {
            echo "<tr>";

            echo "<td>". $row['brand_name'] ."</td>";
            echo "<td>
            <a href=\"../view/edit_brand.php?id=" . $row['brand_id'] . "\">
                <ion-icon name='pencil-outline'></ion-icon>
            </a>
            <a href=\"../actions/delete.php?id=" . $row['brand_id'] . "\">
                <ion-icon name='trash-outline'></ion-icon>
            </a>
            </td>";
        

            echo "</tr>";
                }
        echo "</tbody>";
        echo "</table>";
    
}

function display_brand_option(){
    $result = get_brand_ctr(); // Fetch brand data
    $option = "<select name='brand'>";  
    $option .= "<option></option>";    // Start the select element

    foreach($result as $row){
        // Append each option to the select element
        $option .= "<option value ='".$row['brand_id']."'> ".$row['brand_name']." </option>";
    }

    $option .= "</select>";    // Close the select element
    return $option;
}




?>
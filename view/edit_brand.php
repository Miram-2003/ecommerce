<?php

c
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
        #brandContainer{
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 9999;
        height: 200px;
        width: 300px;
            }
        </style>  
    </head>
    <body>
        <div id="brandContainer">
            <h2>edit</h2>
         
            <form id="brandForm" action="../action/edit_a_brand_action.php" method="post" name="update">
                <input type="hidden" name="brandid" value="<?php echo $brand["brand_id"]; ?>">
                <label for="brandName">brand Name:</label><br>
                <input type="text" id="brandName" name="brandName" value="<?php echo $brand["brand_name"]  ?>" required>
                <!-- <span class="error" style="color: red">*<?php echo isset($cerror)? $cerror:'';?></span><br><br> -->
                <button type="submit" name="editbrand" id="submitBtn">update</button>
            </form>
            <button id="closeFormBtn" >cancel</button>
        </div>
        
    
    </body>
    </html>

   
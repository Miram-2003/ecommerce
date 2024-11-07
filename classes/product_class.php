<?php
require_once("../settings/db_class.php");

class product_class extends db_connection{


        public function add_product($pro_cat, $prod_brand, $prod_title, $prod_price, $prod_des, $prod_key) {
            $ndb = new db_connection();
            $prod_title = mysqli_real_escape_string($ndb->db_conn(), $prod_title);
            $prod_price = mysqli_real_escape_string($ndb->db_conn(), $prod_price);
            $prod_des = mysqli_real_escape_string($ndb->db_conn(), $prod_des); // Corrected
            $prod_key = mysqli_real_escape_string($ndb->db_conn(), $prod_key);
            $prod_brand = mysqli_real_escape_string($ndb->db_conn(), $prod_brand); // Corrected
    
            $sql = "INSERT INTO `products`(`product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_keywords`) 
                    VALUES ('$pro_cat','$prod_brand','$prod_title','$prod_price','$prod_des','$prod_key')";
            return $this->db_query($sql);
        }
    
    
    public function get_product(){
		$ndb = new db_connection();
		$sql="SELECT * FROM `products`";
		$result=$ndb->db_fetch_all($sql);
		return $result;
	}

	public function get_a_product($id){
		$id = (int)$id;
		$ndb = new db_connection();
		$sql= "SELECT * FROM `products` WHERE 1 `product_id` =$id";
		$result = $ndb->db_fetch_one($sql);
		return $result;

	

	}


	public function delete($id){
		$ndb = new db_connection();
		$sql = "DELETE FROM `products` WHERE `product_id` = $id ";
		$delete_result = $this->db_query($sql);

		return $delete_result;


	}


}



?>
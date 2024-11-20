<?php
require_once("../ecommerceproject/settings/db_class.php");

class product_class extends db_connection{


        public function add_product($user_id, $pro_mcat, $pro_scat, $prod_name, $prod_price, $prod_des, $prod_qty, $prod_img) {
            $ndb = new db_connection();
			$id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
            $name = mysqli_real_escape_string($ndb->db_conn(), $prod_name);
            $price = mysqli_real_escape_string($ndb->db_conn(), $prod_price);
            $des = mysqli_real_escape_string($ndb->db_conn(), $prod_des); // Corrected
            $scat = mysqli_real_escape_string($ndb->db_conn(), $pro_scat);
            $mcat = mysqli_real_escape_string($ndb->db_conn(), $pro_mcat); 
			$qty = mysqli_real_escape_string($ndb->db_conn(), $prod_qty);
			$img= mysqli_real_escape_string($ndb->db_conn(), $prod_img);
    
            $sqlQuery = "INSERT INTO `products`( `store_id`, `main_cat_id`, `sub_cat_id`, `name`, `description`, `price`,  `img`, `qty`)
			 VALUES  ('$id','$mcat','$scat',' $name','$des','$price','$img','$qty')";
            return $this->db_query($sqlQuery);
        }
    
    
    public function get_product_by_Seller($id){

		$ndb = new db_connection();
		$sql="SELECT * FROM `products` WHERE `store_id` = '$id'";
		$result=$ndb->db_fetch_all($sql);
		return $result;
	}

	public function get_all_product(){

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
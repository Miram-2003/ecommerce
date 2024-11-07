<?php
//connect to database class
require_once("../settings/db_class.php");

/**
*General class to handle all functions 
*/
/**
 *@author David Sampah
 *
 */

//  public function add_brand($a,$b)
// 	{
// 		$ndb = new db_connection();	
// 		$name =  mysqli_real_escape_string($ndb->db_conn(), $a);
// 		$desc =  mysqli_real_escape_string($ndb->db_conn(), $b);
// 		$sql="INSERT INTO `brands`(`brand_name`, `brand_description`) VALUES ('$name','$desc')";
// 		return $this->db_query($sql);
// 	}
class cat_class extends db_connection{

	public function add_cat($catname){
		$ndb = new db_connection();
		$name =  mysqli_real_escape_string($ndb->db_conn(), $catname);
		$sql="INSERT INTO `categories`( `cat_name`) VALUES ('$name')";
		return $this->db_query($sql);



	}


	public function get_cat(){
		$ndb = new db_connection();
		$sql="SELECT * FROM `categories`";
		$result=$ndb->db_fetch_all($sql);
		return $result;
	}

	public function get_a_cat($id){
		$id = (int)$id;
		$ndb = new db_connection();
		$sql= "SELECT * FROM `categories` WHERE `cat_id` =$id";
		$result = $ndb->db_fetch_one($sql);
		return $result;

	

	}


	public function delete($id){
		$ndb = new db_connection();
		$sql = "DELETE FROM `categories` WHERE cat_id = $id ";
		$delete_result = $this->db_query($sql);

		return $delete_result;


	}
	
	//--INSERT--//
	

	//--SELECT--//



	//--UPDATE--//



	//--DELETE--//
	

}

?>
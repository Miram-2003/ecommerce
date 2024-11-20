<?php
//connect to database class
require_once("../ecommerceproject/settings/db_class.php");

/**
*General class to handle all functions 
*/
/**
 *@author David Sampah
 *
 */


class cat_class extends db_connection{

	public function add_cat($catname){
		$ndb = new db_connection();
		$name =  mysqli_real_escape_string($ndb->db_conn(), $catname);
		$sql="INSERT INTO `main_cat`( `cat_name`) VALUES ('$name')";
		return $this->db_query($sql);



	}


	public function get_cat(){
		$ndb = new db_connection();
		$sql="SELECT * FROM `main_cat`";
		$result=$ndb->db_fetch_all($sql);
		return $result;
	}

	public function get_a_cat($id){
		$ndb = new db_connection();
		$id = (int) mysqli_real_escape_string($ndb->db_conn(),$id);
		$ndb = new db_connection();
		$sql= "SELECT * FROM `main_cat` WHERE `cat_id` =$id";
		$result = $ndb->db_fetch_one($sql);
		return $result;

	

	}


	public function delete($id){
		$ndb = new db_connection();
		$id = (int) mysqli_real_escape_string($ndb->db_conn(),$id);
		$ndb = new db_connection();
		$sql = "DELETE FROM `main cat` WHERE cat_id = $id ";
		$delete_result = $this->db_query($sql);

		return $delete_result;


	}


	public function getCategoryOptions() {
		$conn = new db_connection();
	
		// Fetch all main categories
		$mainQuery = "SELECT cat_id, cat_name FROM main_cat ORDER BY cat_name";
		$mainCategories = $this->db_fetch_all($mainQuery);
	
		// Fetch all subcategories
		$subQuery = "SELECT sub_id, sub_name, cat_id FROM sub_cat ORDER BY sub_name";
		$subCategories = $this->db_fetch_all($subQuery);
	
		// Organize subcategories by main category
		$categoryData = [];
		if (!empty($subCategories)) {
			foreach ($subCategories as $sub) {
				$categoryData[$sub['cat_id']][] = [
					'subcategory_id' => $sub['sub_id'],
					'subcategory_name' => $sub['sub_name']
				];
			}
		}
	
		// Generate HTML for main category dropdown
		$options = '<label for="main_cat">Main Category:</label>
					<select class ="form-select" name="main_cat" id="main_cat" required>
					<option value="" disabled selected>Select a Main Category</option>';
		foreach ($mainCategories as $mainCat) {
			$options .= "<option value='" . htmlspecialchars($mainCat['cat_id']) . "'>"
						. htmlspecialchars($mainCat['cat_name']) . "</option>";
		}
		$options .= "</select><br>";
	
		// Generate a placeholder for subcategories dropdown
		$options .= '<label for="sub_cat">Subcategory:</label>
					<select class ="form-select" name="sub_cat" id="sub_cat" required>
					<option value="" disabled selected>Select a Subcategory</option>
					</select>';
	
		// Add JavaScript for dynamic behavior
		$options .= '<script>
			document.getElementById("main_cat").addEventListener("change", function() {
				const mainCatId = this.value;
				const subCatDropdown = document.getElementById("sub_cat");
	
				// Clear existing options
				subCatDropdown.innerHTML = "<option value=\'\' disabled selected>Select a Subcategory</option>";
	
				// Subcategories data
				const subCategories = ' . json_encode($categoryData) . ';
	
				// Populate subcategories for the selected main category
				if (subCategories[mainCatId]) {
					subCategories[mainCatId].forEach(function(subCat) {
						const option = document.createElement("option");
						option.value = subCat.subcategory_id;
						option.textContent = subCat.subcategory_name;
						subCatDropdown.appendChild(option);
					});
				}
			});
		</script>';
	
		
		return $options;
	}
	

	
	
	//--INSERT--//
	

	//--SELECT--//



	//--UPDATE--//



	//--DELETE--//

	public function getMainName($id) {
		$conn = new db_connection();
		$sql = "SELECT `cat_name` FROM `main_cat` WHERE  `cat_id` = $id";
		$result = $conn->db_fetch_one($sql);
		return $result["cat_name"];
	}


	public function getSubName($id) {
		$conn = new db_connection();
		$sql = "SELECT `sub_name`  FROM `sub_cat` WHERE  `sub_id` = $id";
		$result = $conn->db_fetch_one($sql);
		return $result["sub_name"];
	}
	

}


?>
<?php
$filepath = realpath(dirname(__FILE__));// No such file or directory is Solution
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
?>

<?php
// include_once'../lib/Database.php';
// include_once'../helpers/Format.php';
?>

<?php

class Catagory	{
		
		private $db;
		private $fm;
		
		function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

     /*===========================================================
                           Insert Category
       ===========================================================*/
public function catInsert($catName){
	
	$catName = $this->fm->validation($catName);

	$catName = mysqli_real_escape_string($this->db->link, $catName);
	if (empty($catName)) {
		$msg = "<span class='error'>Catagory field must not be empty !</span>";
		return $msg;
	}else{
		$query     = "INSERT INTO tbl_category(catName) VALUES('$catName')";
		$catinsert = $this->db->insert($query);
		if ($catinsert) {
      $msg = "<span class='success'>Catagory Inserted Successfully !</span>";
      return $msg;
     }else{
      $msg = "<span class='error'>Catagory Not Inserted Successfully !</span>";
      return $msg;
     }
	}
}

     /*===========================================================
                          Select Category
       ===========================================================*/
public function getAllCat(){

	$query  = "SELECT * FROM tbl_category ORDER BY catId DESC";
	$result = $this->db->select($query);
    return $result;
}


public function getCatById($id){
	$query  = "SELECT * FROM tbl_category WHERE catId ='$id'";
	$result = $this->db->select($query);
	return $result;
}


     /*===========================================================
                           Update Category
       ===========================================================*/
public function catUpdate($catName, $id){

	$catName = $this->fm->validation($catName);
	$id = $this->fm->validation($id);

	$catName = mysqli_real_escape_string($this->db->link, $catName);
	$id = mysqli_real_escape_string($this->db->link, $id);

	if (empty($catName)) {
		$msg = "<span class='error'>Catagory field must not be empty !</span>";
		return $msg;
	}else{
		$query = "UPDATE tbl_category
                  SET
                  catName     = '$catName'
		          WHERE catId ='$id'";
		$update_row = $this->db->update($query);

		if ($update_row) {
			$msg = "<span class='success'>Catagory Updated Successfully</span>";
		    return $msg;
		}else{
			$msg = "<span class='error'>Catagory Not Updated Successfully</span>";
		    return $msg;
		}
	}
}


     /*===========================================================
                            Delete Category
       ===========================================================*/
public function delCatById($id){
	$query   = "DELETE FROM tbl_category WHERE catId ='$id'";
	$deldata = $this->db->delete($query);
		if ($deldata) {
			$msg = "<span class='success'>Catagory Deleted Successfully</span>";
		    return $msg;
		}else{
			$msg = "<span class='error'>Catagory Not Deleted Successfully</span>";
		    return $msg;
		}
}








	}

?>
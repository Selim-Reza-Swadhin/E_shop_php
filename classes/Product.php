<?php
$filepath = realpath(dirname(__FILE__));// No such file or directory is Solution
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
?>

<?php
    //include_once'../lib/Database.php';
    //include_once'../helpers/Format.php';
?>

<?php

class Product{

    private $db;
    private $fm;

    function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }

    /*===========================================================
                      Insert Product And Image
      ===========================================================*/
//public function productInsert($_POST, $_FILES)k $data, $file dia catch korlam just eta ekta parameter
    public function productInsert($data, $file){
//        $productName = $this->fm->validation($productName);//AGE KORTAM EVABE
//        $productName = $this->fm->validation($_POST['productName']);//evabe kora jay

//        $productName = mysqli_real_escape_string($this->db->link, $productName);//AGE KORTAM EVABE
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);//productName is table name
        $catId       = mysqli_real_escape_string($this->db->link, $data['catId']);
        $brandId     = mysqli_real_escape_string($this->db->link, $data['brandId']);
        $body        = mysqli_real_escape_string($this->db->link, $data['body']);
        $price       = mysqli_real_escape_string($this->db->link, $data['price']);
        $type        = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $file_name == "" || $type == "") {
            $msg = "<span class='error'>Field must not be empty</span>";
            return $msg;
        }elseif($file_size > 1048567){

            echo "<span class='error'>Image size should be less then 1MB</span>";

        }elseif(in_array($file_ext, $permited) === false){

            echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";

        }else{
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productName, catId, brandId, body, price, image, type) VALUES('$productName', '$catId', '$brandId', '$body', '$price', '$uploaded_image', '$type')";

            $inserted_row = $this->db->insert($query);
            if ($inserted_row) {
                $msg = "<span class='success'>Product Inserted Successfully !</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Product Not Inserted Successfully !</span>";
                return $msg;
            }
        }

    }


    /*===========================================================
                     Select Product And INNER JOIN
      ===========================================================*/
    /*public function getAllProduct(){
        $query = "SELECT * FROM tbl_product ORDER BY productId DESC";
        $result = $this->db->select($query);
        return $result;
    }*/

    //Combine Table or INNER JOIN
    public function getAllProduct(){
        //Table name Alias
        $query = "SELECT p.*, c.catName, b.brandName
                 FROM tbl_product as p, tbl_category as c, tbl_brand as b
                 WHERE p.catId = c.catId AND  p.brandId = b.brandId
                 ORDER BY p.productId DESC";




       /* $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
                 FROM tbl_product
                 
                 INNER JOIN tbl_category
                 ON tbl_product.catId = tbl_category.catId
                 
                 INNER JOIN tbl_brand
                 ON tbl_product.brandId = tbl_brand.brandId
                 
                 ORDER BY tbl_product.productId DESC";*/

        $result = $this->db->select($query);
        return $result;
    }

    public function getProById($id){
        $query  = "SELECT * FROM tbl_product WHERE productId ='$id'";
        $result = $this->db->select($query);
        return $result;
    }


    /*===========================================================
                     Update Product And Image
      ===========================================================*/
    //public function productInsert($_POST, $_FILES, $id)k $data, $file $id dia catch korlam just eta ekta parameter
    public function productUpdate($data, $file, $id){
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);//productName is table name
        $catId       = mysqli_real_escape_string($this->db->link, $data['catId']);
        $brandId     = mysqli_real_escape_string($this->db->link, $data['brandId']);
        $body        = mysqli_real_escape_string($this->db->link, $data['body']);
        $price       = mysqli_real_escape_string($this->db->link, $data['price']);
        $type        = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "") {
            $msg = "<span class='error'>Field must not be empty</span>";
            return $msg;
        }else{
            if (!empty($file_name)) {

                if ($file_size > 1048567) {

                    echo "<span class='error'>Image size should be less then 1MB</span>";

                } elseif (in_array($file_ext, $permited) === false) {

                    echo "<span class='error'>You can upload only:-" . implode(', ', $permited) . "</span>";

                } else {
                    /*----------------------------------------------
                                   Update Product And Image
                      ----------------------------------------------*/
                    move_uploaded_file($file_temp, $uploaded_image);

                    $query = "UPDATE tbl_product
                              SET
                              productName = '$productName',
                              catId       = '$catId',
                              brandId     = '$brandId',
                              body        = '$body',
                              price       = '$price',
                              image       = '$uploaded_image',
                              type        = '$type'
                              WHERE productId ='$id'";

                    $updated_row = $this->db->update($query);
                    if ($updated_row) {
                        $msg = "<span class='success'>Product Updated Successfully !</span>";
                        return $msg;
                    } else {
                        $msg = "<span class='error'>Product Not Updated Successfully !</span>";
                        return $msg;
                    }
                }
            }else{
                /*----------------------------------------------
                                  Update Product Without Image
                  ----------------------------------------------*/
                $query = "UPDATE tbl_product
                              SET
                              productName = '$productName',
                              catId       = '$catId',
                              brandId     = '$brandId',
                              body        = '$body',
                              price       = '$price',                              
                              type        = '$type'
                              WHERE productId ='$id'";

                $updated_row = $this->db->update($query);
                if ($updated_row) {
                    $msg = "<span class='success'>Product Updated Successfully !</span>";
                    return $msg;
                } else {
                    $msg = "<span class='error'>Product Not Updated Successfully !</span>";
                    return $msg;
                }
            }
    }
    }

/*===========================================================
                  Delete Product And Image
  ===========================================================*/
    public function delProById($id){
        //image deleted from folder
        $query   = "SELECT * FROM tbl_product WHERE productId ='$id'";
        $getData = $this->db->select($query);
        if ($getData) {
            while ($delImg = $getData->fetch_assoc()) {
                $dellink = $delImg['image'];
                unlink($dellink);
            }
        }

        //data deleted
        $dataquery   = "DELETE FROM tbl_product WHERE productId ='$id'";
        $delpro = $this->db->delete($dataquery);
        if ($delpro) {
            $msg = "<span class='success'>Product Deleted Successfully</span>";
            return $msg;
        }else{
            $msg = "<span class='error'>Product Not Deleted Successfully</span>";
            return $msg;
        }
    }

    /*===========================================================
                      View Part Start
      ===========================================================*/
    //FEATURE PRODUCTS
    public function getFeaturedProduct(){
        $query  = "SELECT * FROM tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }

    //NEW PRODUCTS
    public function getNewProduct(){
        $query  = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }

    public function getSingleProduct($id){
        //Table name Alias
        $query = "SELECT p.*, c.catName, b.brandName
                 FROM tbl_product as p, tbl_category as c, tbl_brand as b
                 WHERE p.catId = c.catId AND  p.brandId = b.brandId
                 AND p.productId= '$id'";




        /* $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
                  FROM tbl_product

                  INNER JOIN tbl_category
                  ON tbl_product.catId = tbl_category.catId

                  INNER JOIN tbl_brand
                  ON tbl_product.brandId = tbl_brand.brandId

                  ORDER BY tbl_product.productId DESC";*/

        $result = $this->db->select($query);
        return $result;
    }

    /*Brand*/
    public function latestFromIphone(){
        $query  = "SELECT * FROM tbl_product WHERE brandId = '8' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestFromSamsung(){
        $query  = "SELECT * FROM tbl_product WHERE brandId = '6' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestFromAcer(){
        $query  = "SELECT * FROM tbl_product WHERE brandId = '5' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestFromCanon(){
        $query  = "SELECT * FROM tbl_product WHERE brandId = '4' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function productByCat($id){
        $id = mysqli_real_escape_string($this->db->link, $id);//sanitize
        $query  = "SELECT * FROM tbl_product WHERE catId ='$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function insertCompareData($cmprid, $cmrId){
        $cmrId = mysqli_real_escape_string($this->db->link, $cmrId);//sanitize
        $productId = mysqli_real_escape_string($this->db->link, $cmprid);

        $comquery = "SELECT * FROM tbl_compare WHERE cmrId= '$cmrId' AND productId='$productId'";
        $check = $this->db->select($comquery);
        if ($check) {
            $msg = "<span class='error'>Already added !</span>";
            return $msg;
        }


        $query = "SELECT * FROM tbl_product WHERE productId= '$productId'";


       /* $getPro = $this->db->select($query);
        if ($getPro) {
            while ($result = $getPro->fetch_assoc()) {
                $productId = $result['productId'];
                $productName = $result['productName'];
                $price = $result['price'];
                $image = $result['image'];

                $query = "INSERT INTO tbl_compare(cmrId, productId, productName, price, image) VALUES('$cmrId', '$productId', '$productName', '$price', '$image')";
                $inserted_row = $this->db->insert($query);

                if ($inserted_row) {
                    $msg = "<span class='success'>Added to compare</span>";
                    return $msg;
                }else{
                    $msg = "<span class='error'>Not added</span>";
                    return $msg;
                }
            }
        }*/

/*fetch_assoc() boolean error*/
     $result = $this->db->select($query)->fetch_assoc();
        if ($result) {
            $productId = $result['productId'];
            $productName = $result['productName'];
            $price = $result['price'];
            $image = $result['image'];

            $query = "INSERT INTO tbl_compare(cmrId, productId, productName, price, image) VALUES('$cmrId', '$productId', '$productName', '$price', '$image')";
            $inserted_row = $this->db->insert($query);

            if ($inserted_row) {
                $msg = "<span class='success'>Added ! Check Compare Page</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Not added</span>";
                return $msg;
            }
        }

        }


    public function getCompareData($cmrId){
        $query = "SELECT * FROM tbl_compare WHERE cmrId= '$cmrId' ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function delCompareData($cmrId){
        $dataquery   = "DELETE FROM tbl_compare WHERE cmrId ='$cmrId'";
        $delpro = $this->db->delete($dataquery);
    }


    public function saveWishListData($id, $cmrId){

        $comquery = "SELECT * FROM tbl_wishlist WHERE cmrId= '$cmrId' AND productId='$id'";
        $check = $this->db->select($comquery);
        if ($check) {
            $msg = "<span class='error'>Already added !</span>";
            return $msg;
        }

        $query = "SELECT * FROM tbl_product WHERE productId= '$id'";
        $result = $this->db->select($query)->fetch_assoc();//catch only one data
        if ($result) {
                $productId = $result['productId'];
                $productName = $result['productName'];
                $price = $result['price'];
                $image = $result['image'];

                $query = "INSERT INTO tbl_wishlist(cmrId, productId, productName, price, image) VALUES('$cmrId', '$productId', '$productName', '$price', '$image')";

                $inserted_row = $this->db->insert($query);
            if ($inserted_row) {
                $msg = "<span class='success'>Added ! Check WishList Page</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Not added</span>";
                return $msg;
            }
            }
        }


    public function getWlistData($cmrId){
        $query = "SELECT * FROM tbl_wishlist WHERE cmrId= '$cmrId' ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
        }

    public function delWlistData($cmrId, $productId){
        $dataquery   = "DELETE FROM tbl_wishlist WHERE cmrId ='$cmrId' && productId='$productId'";
        $delpro = $this->db->delete($dataquery);
    }








    }
    ?>
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

class Customer{

    private $db;
    private $fm;

    function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function customerRegistration($data){
        $name = mysqli_real_escape_string($this->db->link, $data['name']);//sanitize
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $zip = mysqli_real_escape_string($this->db->link, $data['zip']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == "" || $password == "") {
            $msg = "<span class='error'>Fields must not be empty !</span>";
            return $msg;
        }

        $mailquery = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
        $mailcheck = $this->db->select($mailquery);
        if ($mailcheck != false) {
            $msg = "<span class='error'>Email already exists !</span>";
            return $msg;
        }else{
            $query = "INSERT INTO tbl_customer(name, address, city, country, zip, phone, email, password) VALUES('$name', '$address', '$city', '$country', '$zip', '$phone', '$email', '$password')";

            $inserted_row = $this->db->insert($query);
            if ($inserted_row) {
                $msg = "<span class='success'> Customer Data Inserted Successfully !</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Customer Data Not Inserted Successfully !</span>";
                return $msg;
            }
        }

    }

    public function customerLogin($dataa){
        $email    = mysqli_real_escape_string($this->db->link, $dataa['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($dataa['password']));
        if (empty($email) || empty($password)) {
            $msg = "<span class='error'>Fields must not be empty !</span>";
            return $msg;
        }

        $query = "SELECT * FROM tbl_customer WHERE email ='$email' && password ='$password'";
        $result = $this->db->select($query);
        if ($result != false) {
            $value = $result->fetch_assoc();
            Session::set("cuslogin", true);//$key='cuslogin, $val='$value['id']'
            Session::set("cmrId", $value['id']);//$key='cuslogin, $val='$value['id']'//id from field name
            Session::set("cmrName", $value['name']);
            //header("Location:index.php");
            //header("Location:admin/dashbord.php");
            header("Location:cart.php");
        }else{
            $msg = "<span class='error'>Email or Password Not match !</span>";
            return $msg;
        }
    }


    public function getCustomerData($id){
        $query = "SELECT * FROM tbl_customer WHERE id= '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function customerUpdate($data, $cmrId){
        $name = mysqli_real_escape_string($this->db->link, $data['name']);//sanitize
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $zip = mysqli_real_escape_string($this->db->link, $data['zip']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);

        if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == "") {
            $msg = "<span class='error'>Fields must not be empty !</span>";
            return $msg;
        }else{
            $query = "UPDATE tbl_customer
                      SET
                      name     = '$name',
                      address  = '$address',
                      city     = '$city',
                      country  = '$country',
                      zip      = '$zip',
                      phone    = '$phone',
                      email    = '$email'
                      WHERE id = '$cmrId'";
            $update_row = $this->db->update($query);

            if ($update_row) {
                $msg = "<span class='success'>Profile Updated Successfully</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Profile Not Updated Successfully</span>";
                return $msg;
            }

        }
    }











}
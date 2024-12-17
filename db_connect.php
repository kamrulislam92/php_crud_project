<?php 

class connect_db {
    public $connect;

    function __construct() {
        $this->connect = mysqli_connect("localhost", "root", "", "php_oop_crud_db");

        if (!$this->connect) {
            die("Database connection failed: " . mysqli_connect_error());
        }
    }

    public function inserted($data) {
        $result = $this->connect->query($data);
        // if ($result) {
        //     echo "Data inserted successfully!";
        // } else {
        //     echo "Data insertion failed: " . $this->connect->error;
        // }
    }
    // public function select($data) {
    //     $result = $this->connect->query($data);
    
    //     // Check for query errors
    //     if (!$result) {
    //         die("Query error: " . $this->connect->error);
    //     }
    
    //     // Return results or an empty array
    //     return $result->num_rows > 0 ? $result : [];
    // }
    public function selects($data){
        $result = $this->connect->query($data);
        if($result->num_rows> 0){
            return $result;
        }else{
            return false;
        }
    }

    // edit function data for view 
    public function editData($edit){
        $result = $this->connect->query($edit);
        if($result){
            return $result;
        }else{
            return false;
        }
    }
}



?>
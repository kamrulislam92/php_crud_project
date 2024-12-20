<?php 

class connect_db {
    public $connect;

    function __construct() {
        $this->connect = mysqli_connect("localhost", "root", "", "php_oop_crud_db");

        if (!$this->connect) {
            die("Database connection failed: " . mysqli_connect_error());
        }
    }

    // insert data in database 
    public function inserted($data) {
        $result = $this->connect->query($data);
        if($result){
            header("Location: index.php?msg=".urlencode('Data inserted successfully done'));
         }
    }

    // view data in table 
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

    // update data for function
    public function updateData($updateD){
        $result = $this->connect->query($updateD);
        if($result){
           header("Location: index.php?msg=".urlencode('Data upadeted successfully done'));
        }
    } 

     // delete data for function
    public function deleteData($deleteData){
        $result = $this->connect->query($deleteData);
        if($result){
            header("Location: index.php?msg=".urlencode('Data delete successfully!'));
         }
    }

    // public function editData($query) {
    //     $result = $this->connect->query($query);
    //     return $result && $result->num_rows > 0 ? $result->fetch_assoc() : false;
    // }
    
    



}


?>



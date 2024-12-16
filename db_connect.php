<?php 

    class connect_db{
        public $connect;
      function __construct(){
            $this->connect = mysqli_connect("localhost","root","","php_oop_crud_db");

            // if( $this->connect){
            //     echo "Database connected successfully";
            // }else{
            //     echo "Database connect faild";
            // }
        
        }
      }

    // $conn_obj = new connect_db;


?>
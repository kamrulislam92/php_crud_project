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
        if ($result) {
            echo "Data inserted successfully!";
        } else {
            echo "Data insertion failed: " . $this->connect->error;
        }
    }
}

$db = new connect_db();

if (isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $date_of_birth = $_POST['date_of_birth'];
    $address = $_POST['address'];
    $message_note = $_POST['message_note'];

    $image = "";
    if (isset($_FILES['image']['tmp_name'])) {
        $tmp_name = $_FILES['image']['tmp_name'];
        $target = "images";
        $name = basename($_FILES['image']['name']);
        $image = $name;

        // Move the uploaded file
        if (!move_uploaded_file($tmp_name, "$target/$name")) {
            die("Failed to upload image.");
        }
    }

    if ($full_name == "" || $email == "") {
        echo "Fields must not be empty.";
    } else {
      
        $insert_Data = "
        INSERT INTO user_info (full_name, email, contact, date_of_birth, address, image, message_note) 
        VALUES ('$full_name', '$email', '$contact', '$date_of_birth', '$address', '$image', '$message_note')";

        // Call the insert method
        $db->inserted($insert_Data);
    }
}

?>
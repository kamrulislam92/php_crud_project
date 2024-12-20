<?php
    include "db_connect.php";

    
    $db = new connect_db();

    // Fetch Data for Profile View
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Form and Table Design</title>
    <!-- Bootstrap CDN link for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- view profile data  start-->

 <div class="container">
        <div class="back_button text-end clip-path-corner">
            <a href="index.php" class="btn btn-success btn-lg me-3 ">
                Go to user list<i class="bi bi-box-arrow-left"></i>
            </a>
        </div>
        <div class="form-container">
            <h2 class="text-center"> Contact Form</h2>
            <div class="row">
                <samp>
                <?php if(isset($_GET['msg'])){
                        echo "" .$_GET['msg'];
                    }
                ?>
                </samp>
            </div>
            <form action="#" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <!-- Name Field -->
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control" value="<?php if(isset($_GET['edit'])) echo $data['full_name']; ?>" id="name" name="full_name" placeholder="Full Name" required>
                        <input type="hidden" value="<?php if(isset($_GET['edit'])) echo $data['id']; ?>" name="id">
                    </div>

                    <!-- Email Field -->
                    <div class="col-md-6 mb-3">
                        <input type="email" class="form-control" value="<?php if(isset($_GET['edit'])) echo $data['email']; ?>" id="email" name="email" placeholder="Email Address" required>
                    </div>

                    <!-- Phone Field -->
                    <div class="col-md-6 mb-3">
                        <input type="number" class="form-control"value="<?php if(isset($_GET['edit'])) echo $data['contact']; ?>" id="phone" name="contact" placeholder="Phone Number" required>
                    </div>

                    <!-- Date of Birth Field -->
                    <div class="col-md-6 mb-3">
                        <input type="date" class="form-control"value="<?php if(isset($_GET['edit'])) echo $data['date_of_birth']; ?>" id="dob" name="date_of_birth" placeholder="Date of Birth" required>
                    </div>

                    <!-- Age Field -->
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control"value="<?php if(isset($_GET['edit'])) echo $data['address']; ?>" id="address" name="address" placeholder="address" required>
                    </div>
                    <!-- File Upload Field -->
                    <div class="col-md-6 mb-3">
                        <input type="file" class="form-control"value="<?php if(isset($_GET['edit'])) echo $data['image']; ?>" id="file" name="image" accept="image/*" placeholder="Upload Image" required>
                    </div>
                    <!-- Message Field -->
                    <div class="col-md-6 mb-3">
                        <textarea class="form-control" id="message" name="message_note" rows="2" placeholder="Message" required><?php if(isset($_GET['edit'])) echo $data['message_note']; ?></textarea>
                    </div>
                    <!-- Submit Button aligned to the right -->
                    <div class="col-md-6 text-end mt-4">
                        <?php if(isset($_GET['edit'])) { ?>
                        <button type="submit" name="update" class="btn btn-primary">Update </button>
                        <?php }else{ ?>
                        <button type="submit" name="submit" class="btn btn-primary">save </button>
                        <?php } ?>
                    </div>
                </div>
            </form>
        </div>
</div>

<!-- Bootstrap JS (for functionality if needed) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>

<style>
    .mt-5 {
    width: 60% !important;
    margin: 0 auto !important;
   
}
a.btn.btn-success.btn-lg.me-3 {
    padding: 5px 34px;
}
.back_button{
    background: linear-gradient(45deg, #28a745, #218838); color: white;
    border-radius-left-top:10px;
}

.back_button {
    background: linear-gradient(45deg, #28a745, #218838);
    color: white;
    border-top-left-radius: 10px; /* Top-left corner radius */
    border-top-right-radius: 10px; /* Top-left corner radius */
    border: none; /* Remove any default border */
    padding: 10px 20px; /* Add some padding for better button appearance */
    text-decoration: none; /* Remove underline for links */
  
}

.back_button:hover {
    background: linear-gradient(45deg, #218838, #28a745); /* Reverse gradient on hover */
    color: white;
}
.card{ 
    padding:50px;
    border-top-left-radius:none !important;
    border-top-right-radius:none !important;
    }

    .clip-path-corner {
        background: linear-gradient(45deg, #28a745, #218838);
        position: relative;
        clip-path: polygon(10% 0, 90% 0, 100% 90%, 100% 100%, 0 100%, 0 90%);
        /* clip-path: polygon(10% 0, 90% 0, 100% 10%, 100% 90%, 90% 100%, 10% 100%, 0 90%, 0 10%); */
    }
</style>
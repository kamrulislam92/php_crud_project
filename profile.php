<?php
 include "db_connect.php";

   
 $db = new connect_db();

 // Fetch Data for Profile View
 $profile_data = [];
 if (isset($_GET['view'])) {
     $id = intval($_GET['view']);
     $query = "SELECT * FROM user_info WHERE id = $id";
     $profile_data = $db->editData($query)->fetch_assoc();
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
  
<?php if (!empty($profile_data)){ ?>
        <div class="profile-container mt-5 ">
           <div class="back_button text-end clip-path-corner">
            <a href="index.php" class="btn btn-success btn-lg me-1 ">
                Back to Home
                </a>
           </div>
            <!-- <h3 class="text-center">Profile Details</h3> -->
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-5">
                        <img src="images/<?php echo $profile_data['image']; ?>" class="img-fluid rounded-start" height="300" width="300" alt="Profile Image">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $profile_data['full_name']; ?></h5>
                            <p class="card-text"><strong>Email:</strong> <?php echo $profile_data['email']; ?></p>
                            <p class="card-text"><strong>Phone:</strong> <?php echo $profile_data['contact']; ?></p>
                            <p class="card-text"><strong>Date of Birth:</strong> <?php echo $profile_data['date_of_birth']; ?></p>
                            <p class="card-text"><strong>Address:</strong> <?php echo $profile_data['address']; ?></p>
                            <p class="card-text"><strong>Message:</strong> <?php echo $profile_data['message_note']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<!-- view profile data  end-->
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
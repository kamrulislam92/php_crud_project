<?php 
    include "db_connect.php";

   
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

    //select data from database 
    $db = new connect_db();
    $query = "SELECT * FROM user_info";
    $view_data = $db->selects($query);


    // view data for edit 
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $db = new connect_db();
        $query = "SELECT * FROM user_info WHERE id = $id";
        $data = $db->editData($query)->fetch_assoc();
    }
    
    // update data
    if(isset($_POST['update'])){
                   $id = $_POST['id'];
            $full_name = $_POST['full_name'];
                $email = $_POST['email'];
              $contact = $_POST['contact'];
        $date_of_birth = $_POST['date_of_birth'];
              $address = $_POST['address'];
                $image = $_POST['image'];
         $message_note = $_POST['message_note'];

         $db = new connect_db();

         $query = "UPDATE user_info SET full_name = '$full_name', email = '$email', contact = '$contact', date_of_birth = '$date_of_birth', address = '$address', image = '$image', message_note = '$message_note' WHERE id = $id ";
         $data = $db->updateData($query);
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

<div class="container">


    <!-- Form Section -->
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

   

    <!-- Table Section -->
    <div class="table-container">
         <!-- Search Box Section -->
        <div class="search-box ">
            <input type="text" id="search" class="form-control" placeholder="Search by Name, Email or Message">
            <i class="bi bi-search"></i>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date of Birth</th>
                        <th>Address</th>
                        <th>Message</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>


                <?php 
                
                if (!empty($view_data)) {
                    while ($row = $view_data->fetch_assoc()) {
                ?>                
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['full_name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['contact']; ?></td>
                    <td><?php echo $row['date_of_birth']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td>
                        <?php 
                            $message = $row['message_note'];
                            echo strlen($message) > 25 ? substr($message, 0, 25) . "..." : $message; 
                        ?>
                    </td>
                    <td>
                        <img src="images/<?php echo $row['image']; ?>" alt="User Image" width="50" height="50">
                    </td>
                    <td>
                       <a href="index.php?edit=<?php echo $row['id']; ?>"  class="btn btn-success btn-sm me-1">
                            <i class="bi bi-pencil-square"></i>
                       </a>
                       <a href="index.php?viewProfile<?php echo $row['id']; ?>"  class="btn btn-primary btn-sm me-1"> <i class="bi bi-eye"></i></a>
                       <a href="index.php?delete<?php echo $row['id']; ?>"  class="btn btn-danger btn-sm">
                         <i class="bi bi-trash"></i>
                        </a>
                       
                    </td>
                </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>No records found.</td></tr>";
                }
                ?>
                   
                </tbody>
            </table>
        </div>

        <!-- Modern Pagination Section -->
        <nav aria-label="Table Pagination">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- Bootstrap JS (for functionality if needed) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>

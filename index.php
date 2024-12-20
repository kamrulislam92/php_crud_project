<?php 
    include "db_connect.php";

    $db = new connect_db();

   
// old select data view ===============

// $db = new connect_db();
// $query = "SELECT * FROM user_info";
// $view_data = $db->selects($query);


    //select data view from database and pagination 
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
    $limit = 4;
    $offset = ($page-1)*$limit;
    $db = new connect_db();
    $query = "SELECT * FROM user_info LIMIT {$offset},{$limit}";
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

    // delete data from database 

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $db = new connect_db();
        $query = "DELETE FROM user_info WHERE id = $id";
        $del = $db->deleteData($query);
    }

    // searching code start 
    // $search = '';
    // if(isset($_GET['search'])){
    //     $search = $_GET['search'];
    //     echo $search;
    // }

    // $limit = 5;


    
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
    <div class="back_button text-end clip-path-corner">
    <a href="user_entry_form.php" class="btn btn-success btn-lg me-3 ">
        Go to user entry<i class="bi bi-box-arrow-right"></i>
    </a>
</div>
    <!-- Table Section -->
    <div class="table-container">
         <!-- Search Box Section -->
         <div class="search-box  ">
            <form action="" method="get" class="d-flex justify-content-end">
                <input type="text" id="search" value="" class="form-control" placeholder="Search by Name, Email or Message">
                <button type="submit"><i class="bi bi-search"></i>Search</button>
            </form>
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
                    <td class="d-flex">
                       <a href="index.php?edit=<?php echo $row['id']; ?>"  class="btn btn-success btn-sm me-1">
                            <i class="bi bi-pencil-square"></i>
                       </a>
                        <a href="profile.php?view=<?php echo $row['id']; ?>"  class="btn btn-success btn-sm me-1">
                        <i class="bi bi-eye"></i>
                       </a>
                      
                       <a href="index.php?delete=<?php echo $row['id']; ?>"  class="btn btn-danger btn-sm">
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

        <?php 

        $db = new connect_db();
        $query = "SELECT * FROM user_info";
        $pagination = $db->pagination($query);

        $buttonCount = $pagination->num_rows;
        $totalPage = ceil($buttonCount / $limit);
        
        if ($buttonCount > $limit) {
            if($page > 1){
                $previous = $page-1;
                echo '<li class="page-item"> 
                <a class="page-link" href="index.php?page=' . $previous . '"> <span aria-hidden="true">&laquo;</span></a>
                </li>';
            }
            for ($i = 1; $i <= $totalPage; $i++) {

                // page number show pagination ar moddhe 
                if($i>$page+3 or $i<$page-2){
                    $dis = "d-none";
                }else{
                    $dis = "";
                }
                if($i == $page){
                    $activePage = "active";
                }else{
                    $activePage = "";
                }
            echo '<li class="page-item"> 
                    <a class="page-link '.$dis.''.$activePage.'" href="index.php?page=' . $i . '">' . $i . '</a>
                    </li>';
            }
            if($page < $totalPage){
                $next = $page+1;
                echo '<li class="page-item"> 
                <a class="page-link" href="index.php?page=' . $next . '"> <span aria-hidden="true">&raquo;</span></a>
                </li>';
            }
        }
        
        ?>
                
                
                <form action="" method="get" class="text-end">
                    <div class="input-group mb-3 " width="50">
                    <input type="number" name="page" class="form-control" min="" max="" placeholder="Enter your  page number">
                     <button type="submit" class="btn btn-primary">Go</button>
                    </div>
                </form>
            </ul>
        </nav>
    </div>
</div>

<!-- Bootstrap JS (for functionality if needed) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>

<style>
.active {
    color: #fff !important;
}
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
    a.btn.btn-success.btn-lg.me-3 {
    padding: 5px 34px;
}
</style>

               
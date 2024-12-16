<?php 
    include "db_connect.php";

   
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
                    <input type="text" class="form-control" id="name" name="full_name" placeholder="Full Name" required>
                </div>

                <!-- Email Field -->
                <div class="col-md-6 mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                </div>

                <!-- Phone Field -->
                <div class="col-md-6 mb-3">
                    <input type="number" class="form-control" id="phone" name="contact" placeholder="Phone Number" required>
                </div>

                <!-- Date of Birth Field -->
                <div class="col-md-6 mb-3">
                    <input type="date" class="form-control" id="dob" name="date_of_birth" placeholder="Date of Birth" required>
                </div>

                <!-- Age Field -->
                <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" id="address" name="address" placeholder="address" required>
                </div>
                <!-- File Upload Field -->
                <div class="col-md-6 mb-3">
                    <input type="file" class="form-control" id="file" name="image" accept="image/*" placeholder="Upload Image" required>
                </div>
                <!-- Message Field -->
                <div class="col-md-6 mb-3">
                    <textarea class="form-control" id="message" name="message_note" rows="2" placeholder="Message" required></textarea>
                </div>
                <!-- Submit Button aligned to the right -->
                <div class="col-md-6 text-end mt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date of Birth</th>
                        <th>Age</th>
                        <th>Message</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>John Doe</td>
                        <td>john.doe@example.com</td>
                        <td>+1234567890</td>
                        <td>1990-01-01</td>
                        <td>34</td>
                        <td>Hello, I have a question.</td>
                        <td><img src="https://via.placeholder.com/50" alt="Uploaded Image" class="uploaded-image"></td>
                        <td>
                            <button class="btn btn-success btn-sm me-1">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn btn-primary btn-sm me-1">
                                <i class="bi bi-eye"></i>
                            </button>
                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>Jane Smith</td>
                        <td>jane.smith@example.com</td>
                        <td>+0987654321</td>
                        <td>1985-05-15</td>
                        <td>39</td>
                        <td>I need help with the order.</td>
                        <td><img src="https://via.placeholder.com/50" alt="Uploaded Image" class="uploaded-image"></td>
                        <td>
                            <button class="btn btn-success btn-sm me-1">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn btn-primary btn-sm me-1">
                                <i class="bi bi-eye"></i>
                            </button>
                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
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

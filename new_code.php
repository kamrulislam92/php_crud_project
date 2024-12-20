<?php
include "db_connect.php";

$db = new connect_db();

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $date_of_birth = $_POST['date_of_birth'];
    $address = trim($_POST['address']);
    $message_note = trim($_POST['message_note']);

    // Handle File Upload
    $image = "";
    if (!empty($_FILES['image']['tmp_name'])) {
        $tmp_name = $_FILES['image']['tmp_name'];
        $target_dir = "images/";
        $name = basename($_FILES['image']['name']);
        $image = uniqid() . "_" . $name; // Add unique ID to avoid duplicate file names
        $target_file = $target_dir . $image;

        if (!move_uploaded_file($tmp_name, $target_file)) {
            die("Failed to upload image.");
        }
    }

    if (empty($full_name) || empty($email)) {
        echo "Fields must not be empty.";
    } else {
        if (isset($_POST['submit'])) {
            $insert_Data = "
                INSERT INTO user_info (full_name, email, contact, date_of_birth, address, image, message_note) 
                VALUES ('$full_name', '$email', '$contact', '$date_of_birth', '$address', '$image', '$message_note')";
            $db->inserted($insert_Data);
        } elseif (isset($_POST['update'])) {
            $id = intval($_POST['id']);
            $update_Data = "
                UPDATE user_info SET 
                full_name = '$full_name', email = '$email', contact = '$contact', 
                date_of_birth = '$date_of_birth', address = '$address', 
                image = '$image', message_note = '$message_note' 
                WHERE id = $id";
            $db->updateData($update_Data);
        }
    }
}

// Handle Data Deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $query = "DELETE FROM user_info WHERE id = $id";
    $db->deleteData($query);
}

// Fetch All Data
$query = "SELECT * FROM user_info";
$view_data = $db->selects($query);

// Fetch Data for Editing
$edit_data = [];
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $query = "SELECT * FROM user_info WHERE id = $id";
    $edit_data = $db->editData($query)->fetch_assoc();
}

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
    <title>Form, Table, and Profile View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <!-- Form Section -->
    <div class="form-container">
        <h2 class="text-center">Contact Form</h2>
        <form action="#" method="POST" enctype="multipart/form-data">
            <div class="row">
                <input type="hidden" name="id" value="<?php echo $edit_data['id'] ?? ''; ?>">
                <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" name="full_name" placeholder="Full Name"
                           value="<?php echo $edit_data['full_name'] ?? ''; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email"
                           value="<?php echo $edit_data['email'] ?? ''; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" name="contact" placeholder="Phone"
                           value="<?php echo $edit_data['contact'] ?? ''; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="date" class="form-control" name="date_of_birth"
                           value="<?php echo $edit_data['date_of_birth'] ?? ''; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" name="address" placeholder="Address"
                           value="<?php echo $edit_data['address'] ?? ''; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="file" class="form-control" name="image" accept="image/*">
                </div>
                <div class="col-md-6 mb-3">
                    <textarea class="form-control" name="message_note" rows="2"
                              placeholder="Message"><?php echo $edit_data['message_note'] ?? ''; ?></textarea>
                </div>
                <div class="col-md-6 text-end">
                    <?php if (isset($_GET['edit'])): ?>
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                    <?php else: ?>
                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>

    <!-- Table Section -->
    <div class="table-container mt-5">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>DOB</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($row = $view_data->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['full_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['contact']; ?></td>
                        <td><?php echo $row['date_of_birth']; ?></td>
                        <td>
                            <a href="index.php?view=<?php echo $row['id']; ?>" class="btn btn-info btn-sm"><i class="bi bi-person"></i> View</a>
                            <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                            <a href="index.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Profile View Section -->
    <?php if (!empty($profile_data)): ?>
        <div class="profile-container mt-5">
            <h3 class="text-center">Profile Details</h3>
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="images/<?php echo $profile_data['image']; ?>" class="img-fluid rounded-start" alt="Profile Image">
                    </div>
                    <div class="col-md-8">
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
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



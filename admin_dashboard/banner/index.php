<?php
include '../dbConnection.php';
include '../header.php';

// Ensure file uploads are enabled and the upload directory is writable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $t1 = $_POST['t1'];
    $t2 = $_POST['t2'];
    $t3 = $_POST['t3'];
    $content = $_POST['content'];
    $buttons = implode(",", $_POST['buttons']);
    $status = $_POST['status']; 
    
    // Handle file upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $photo = $_FILES['photo']['name'];
        $temp_name = $_FILES['photo']['tmp_name'];
        $folder = "/usr/share/nginx/html/uploads/";

        // Validate file type
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['photo']['type'], $allowed_types)) {
            // Move the file to the destination folder
            if (move_uploaded_file($temp_name, $folder . $photo)) {
                echo "<div class='alert alert-success'>File uploaded successfully.</div>";
            } else {
                echo "<div class='alert alert-danger'>Failed to move uploaded file.</div>";
                $photo = ''; // Reset the photo name if upload failed
            }
        } else {
            echo "<div class='alert alert-danger'>Invalid file type. Only JPG, PNG, and GIF files are allowed.</div>";
            $photo = ''; // Reset the photo name if file type is invalid
        }
    } else {
        echo "<div class='alert alert-warning'>No file uploaded or upload error occurred.</div>";
        $photo = ''; // Reset the photo name if no file was uploaded
    }

    // Insert form data into the database
    $sql = "INSERT INTO banner (t1, t2, t3, content, buttons, images, status) VALUES ('$t1', '$t2', '$t3', '$content', '$buttons', '$photo', '$status ')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>New banner created successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}
?>

<h2>Add Banner</h2>
<form method="post" action="" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="t1" class="form-label">Title 1</label>
        <input type="text" class="form-control" id="t1" name="t1" required>
    </div>
    <div class="mb-3">
        <label for="t2" class="form-label">Title 2</label>
        <input type="text" class="form-control" id="t2" name="t2" required>
    </div>
    <div class="mb-3">
        <label for="t3" class="form-label">Title 3</label>
        <input type="text" class="form-control" id="t3" name="t3" required>
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <input type="text" class="form-control" id="content" name="content" required>
    </div>
    <div class="mb-3">
        <label for="buttons" class="form-label">Buttons</label>
        <select class="form-control" id="buttons" name="buttons[]" multiple>
            <?php
            $button_sql = "SELECT * FROM buttons";
            $button_result = $conn->query($button_sql);
            if ($button_result->num_rows > 0) {
                while ($button_row = $button_result->fetch_assoc()) {
                    echo "<option value='" . $button_row['id'] . "'>" . $button_row['buttonname'] . "</option>";
                }
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="photo" class="form-label">Images</label>
        <input type="file" class="form-control" id="photo" name="photo" accept="uploads/*">
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-control" id="status" name="status" required>
            <option value="">Select Status</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
            <option value="pending">Pending</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php include '../footer.php'; ?>

<?php
include 'dbConnection.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table = $_POST['table'];

    if ($table == 'courses') {
        $content = $_POST['content'];
        $images = uploadImage($_FILES['images']['name'], $_FILES['images']['tmp_name']);
        $descriptions = $_POST['descriptions'];
        $buttonlink = $_POST['buttonlink'];

        $sql = "INSERT INTO courses (content, images, descriptions, buttonlink) VALUES ('$content', '$images', '$descriptions', '$buttonlink')";
    
    } elseif ($table == 'testimonials') {
        $names = $_POST['names'];
        $descriptions = $_POST['descriptions'];

        $sql = "INSERT INTO testimonials (names, descriptions) VALUES ('$names', '$descriptions')";

    } elseif ($table == 'banners') {
        $t1 = $_POST['t1'];
        $t2 = $_POST['t2'];
        $t3 = $_POST['t3'];
        $content = $_POST['content'];
        $buttons = implode(',', $_POST['buttons']);
            // Handle file upload
        if (isset($_FILES['images']) && $_FILES['images']['error'] == UPLOAD_ERR_OK) {
            $photo = $_FILES['images']['name'];
            $temp_name = $_FILES['images']['tmp_name'];
            $folder = "uploads/";

            // Validate file type
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($_FILES['images']['type'], $allowed_types)) {
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

        $sql = "INSERT INTO banners (t1, t2, t3, content, buttons, images) VALUES ('$t1', '$t2', '$t3', '$content', '$buttons', '$photo')";

    } elseif ($table == 'buttons') {
        $buttonname = $_POST['buttonname'];
        $buttonlink = $_POST['buttonlink'];

        $sql = "INSERT INTO buttons (buttonname, buttonlink) VALUES ('$buttonname', '$buttonlink')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>New record created successfully in $table.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}



<h2>Add Record</h2>
<form method="post" action="" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="table" class="form-label">Select Table</label>
        <select class="form-control" id="table" name="table" required>
            <option value="courses">Courses</option>
            <option value="testimonials">Testimonials</option>
            <option value="banners">Banners</option>
            <option value="buttons">Buttons</option>
        </select>
    </div>
    <!-- Add form fields dynamically based on table selection using JS or show all fields and manage visibility with CSS -->
    <!-- Include your dynamic form fields here -->
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php include 'footer.php'; ?>

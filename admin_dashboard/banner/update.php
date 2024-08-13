<?php
include '../dbConnection.php';
include '../header.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM banner WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $selected_buttons = explode(",", $row['buttons']); // Convert comma-separated string to array
    }
}
function uploadImage($imageName, $imageTempName) {
    $targetDir = "uploads/"; // Define the directory to store uploaded images
    $targetFile = $targetDir . basename($imageName); // Path of the file to be uploaded
    
    // Check if the directory exists, if not, create it
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    
    // Move the uploaded file to the target directory
    if (move_uploaded_file($imageTempName, $targetFile)) {
        return $targetFile; // Return the path of the uploaded image
    } else {
        return ""; // Return an empty string if the upload failed
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $t1 = $_POST['t1'];
    $t2 = $_POST['t2'];
    $t3 = $_POST['t3'];
    $content = $_POST['content'];
    $buttons = implode(",", $_POST['buttons']); // Convert array to comma-separated string
    // Handle image upload
    if (isset($_FILES['image1']) && $_FILES['image1']['error'] == 0) {
        $images = uploadImage($_FILES['image1']['name'], $_FILES['image1']['tmp_name']);
    } else {
        $images = ""; // Handle the case when no image is uploaded or there is an error
    }

    $sql = "UPDATE banner SET t1='$t1', t2='$t2', t3='$t3', content='$content', buttons='$buttons', images='$images' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Banner updated successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating banner: " . $conn->error . "</div>";
    }
}
?>

<h2>Update Banner</h2>
<form method="post" action="">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <div class="mb-3">
        <label for="t1" class="form-label">Title 1</label>
        <input type="text" class="form-control" id="t1" name="t1" value="<?php echo $row['t1']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="t2" class="form-label">Title 2</label>
        <input type="text" class="form-control" id="t2" name="t2" value="<?php echo $row['t2']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="t3" class="form-label">Title 3</label>
        <input type="text" class="form-control" id="t3" name="t3" value="<?php echo $row['t3']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <input type="text" class="form-control" id="content" name="content" value="<?php echo $row['content']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="buttons" class="form-label">Buttons</label>
        <select class="form-control" id="buttons" name="buttons[]" multiple>
            <?php
            $button_sql = "SELECT * FROM buttons";
            $button_result = $conn->query($button_sql);
            if ($button_result->num_rows > 0) {
                while($button_row = $button_result->fetch_assoc()) {
                    $selected = in_array($button_row['id'], $selected_buttons) ? "selected" : "";
                    echo "<option value='".$button_row['id']."' $selected>".$button_row['buttonname']."</option>";
                }
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="image1" class="form-label">Images</label>
        <input type="file" class="form-control" id="image1" name="image1" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php include '../footer.php'; ?>

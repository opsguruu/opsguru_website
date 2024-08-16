<?php
include '../dbConnection.php';
include '../header.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM testimonials WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $names = $_POST['names'];
    $descriptions = $_POST['descriptions'];

    $sql = "UPDATE testimonials SET names='$names', descriptions='$descriptions' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Testimonial updated successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating testimonial: " . $conn->error . "</div>";
    }
}
?>

<h2>Update Testimonial</h2>
<form method="post" action="">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <div class="mb-3">
        <label for="names" class="form-label">Name</label>
        <input type="text" class="form-control" id="names" name="names" value="<?php echo $row['names']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="descriptions" class="form-label">Description</label>
        <textarea class="form-control" id="descriptions" name="descriptions" rows="4" required><?php echo $row['descriptions']; ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php include '../footer.php'; ?>

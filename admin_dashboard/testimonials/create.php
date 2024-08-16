<?php
include '../dbConnection.php';
include '../header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $names = $_POST['names'];
    $descriptions = $_POST['descriptions'];

    $sql = "INSERT INTO testimonials (names, descriptions) VALUES ('$names', '$descriptions')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>New testimonial created successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}
?>

<h2>Add Testimonial</h2>
<form method="post" action="">
    <div class="mb-3">
        <label for="names" class="form-label">Name</label>
        <input type="text" class="form-control" id="names" name="names" required>
    </div>
    <div class="mb-3">
        <label for="descriptions" class="form-label">Description</label>
        <textarea class="form-control" id="descriptions" name="descriptions" rows="4" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php include '../footer.php'; ?>

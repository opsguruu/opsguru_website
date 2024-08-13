<?php
include '../dbConnection.php';
include '../header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $buttonname = $_POST['buttonname'];
    $buttonlink = $_POST['buttonlink'];

    $sql = "INSERT INTO buttons (buttonname, buttonlink) VALUES ('$buttonname', '$buttonlink')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>New button created successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}
?>

<h2>Add Button</h2>
<form method="post" action="">
    <div class="mb-3">
        <label for="buttonname" class="form-label">Button Name</label>
        <input type="text" class="form-control" id="buttonname" name="buttonname" required>
    </div>
    <div class="mb-3">
        <label for="buttonlink" class="form-label">Button Link</label>
        <input type="text" class="form-control" id="buttonlink" name="buttonlink" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php include '../footer.php'; ?>

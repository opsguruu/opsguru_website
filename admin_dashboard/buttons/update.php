<?php
include '../dbConnection.php';
include '../header.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM buttons WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $buttonname = $_POST['buttonname'];
    $buttonlink = $_POST['buttonlink'];

    $sql = "UPDATE buttons SET buttonname='$buttonname', buttonlink='$buttonlink' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Button updated successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating button: " . $conn->error . "</div>";
    }
}
?>

<h2>Update Button</h2>
<form method="post" action="">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <div class="mb-3">
        <label for="buttonname" class="form-label">Button Name</label>
        <input type="text" class="form-control" id="buttonname" name="buttonname" value="<?php echo $row['buttonname']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="buttonlink" class="form-label">Button Link</label>
        <input type="text" class="form-control" id="buttonlink" name="buttonlink" value="<?php echo $row['buttonlink']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php include '../footer.php'; ?>

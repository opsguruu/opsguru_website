<?php
include '../dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM banner WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Banner deleted successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error deleting banner: " . $conn->error . "</div>";
    }
}

header('Location: read.php');
?>

<?php
include '../dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM testimonials WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Testimonial deleted successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error deleting testimonial: " . $conn->error . "</div>";
    }
}

header('Location: read.php');
?>

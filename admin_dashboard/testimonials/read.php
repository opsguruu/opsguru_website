<?php
include '../dbConnection.php';
include '../header.php';

$sql = "SELECT * FROM testimonials";
$result = $conn->query($sql);

echo "<h2>Testimonials</h2>";
echo "<a href='create.php' class='btn btn-success mb-3'>Add New Testimonial</a>";

if ($result->num_rows > 0) {
    echo "<table class='table table-bordered'>";
    echo "<tr><th>ID</th><th>Name</th><th>Description</th><th>Actions</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["names"]."</td><td>".$row["descriptions"]."</td>
        <td><a href='update.php?id=".$row["id"]."' class='btn btn-primary'>Edit</a> 
        <a href='delete.php?id=".$row["id"]."' class='btn btn-danger'>Delete</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "<p>No testimonials found.</p>";
}

include '../footer.php';
?>

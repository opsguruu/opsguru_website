<?php
include '../dbConnection.php';
include '../header.php';

$sql = "SELECT * FROM buttons";
$result = $conn->query($sql);

echo "<h2>Buttons</h2>";
echo "<a href='create.php' class='btn btn-success mb-3'>Add New Button</a>";

if ($result->num_rows > 0) {
    echo "<table class='table table-bordered'>";
    echo "<tr><th>ID</th><th>Button Name</th><th>Button Link</th><th>Actions</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["buttonname"]."</td><td>".$row["buttonlink"]."</td>
        <td><a href='update.php?id=".$row["id"]."' class='btn btn-primary'>Edit</a> 
        <a href='delete.php?id=".$row["id"]."' class='btn btn-danger'>Delete</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "<p>No buttons found.</p>";
}

include '../footer.php';
?>

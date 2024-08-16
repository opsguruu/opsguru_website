<?php
include '../dbConnection.php';
include '../header.php';

$sql = "SELECT * FROM banner";
$result = $conn->query($sql);

echo "<h2>Banners</h2>";
echo "<a href='index.php' class='btn btn-success mb-3'>Add New Banner</a>";

if ($result->num_rows > 0) {
    echo "<table class='table table-bordered'>";
    echo "<tr><th>ID</th><th>Title 1</th><th>Title 2</th><th>Title 3</th><th>Content</th><th>Buttons</th><th>Images</th><th>Actions</th></tr>";
    while($row = $result->fetch_assoc()) {
        // Convert button IDs to button names
        $button_ids = explode(",", $row["buttons"]);
        $button_names = [];
        foreach ($button_ids as $button_id) {
            $button_sql = "SELECT buttonname FROM buttons WHERE id=$button_id";
            $button_result = $conn->query($button_sql);
            if ($button_result->num_rows == 1) {
                $button_row = $button_result->fetch_assoc();
                $button_names[] = $button_row['buttonname'];
            }
        }
        $button_names_string = implode(", ", $button_names);

        echo "<tr><td>".$row["id"]."</td><td>".$row["statuss"]."</td><td>".$row["t1"]."</td><td>".$row["t2"]."</td><td>".$row["t3"]."</td><td>".$row["content"]."</td><td>".$button_names_string."</td><td>
        <img src=uploads/".$row["images"]." alt='Banner Image' style='max-width: 100px;'>
        </td>
        <td><a href='update.php?id=".$row["id"]."' class='btn btn-primary'>Edit</a> 
        <a href='delete.php?id=".$row["id"]."' class='btn btn-danger'>Delete</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "<p>No banners found.</p>";
}

include '../footer.php';
?>

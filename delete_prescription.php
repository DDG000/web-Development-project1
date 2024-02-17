<?php



include 'config.php';


$id = $_POST['prescription_id'];


$delete_query = "DELETE FROM prescription_records1 WHERE prescription_id = ?";
$stmt = $connection->prepare($delete_query);
$stmt->bind_param("i", $id);


if ($stmt->execute()) {
    echo "Record deleted successfully!";
} else {
    echo "Error deleting record: " . $connection->error;
}


$stmt->close();
$connection->close();
?>

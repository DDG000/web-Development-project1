<?php



include 'config.php';


$id = $_POST['id'];


$delete_query = "DELETE FROM customer_information1 WHERE id = ?";
$stmt = $connection->prepare($delete_query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Record deleted successfully!";
} else {
    echo "Error deleting record: " . $stmt->error;
}


$stmt->close();
?>

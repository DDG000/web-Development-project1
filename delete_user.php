<?php
// delete_record.php

// Establish database connection
include 'config.php';

// Get the record ID from the AJAX request
$id = $_POST['id'];

// Construct the SQL query to delete the record
$delete_query = "DELETE FROM customer_information1 WHERE id = ?";
$stmt = $connection->prepare($delete_query);
$stmt->bind_param("i", $id);

// Execute the query
if ($stmt->execute()) {
    echo "Record deleted successfully!";
} else {
    echo "Error deleting record: " . $stmt->error;
}

// Close the statement
$stmt->close();
?>

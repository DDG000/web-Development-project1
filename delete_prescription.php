<?php
// delete_record.php

// Establish database connection
include 'config.php';

// Get the record ID from the AJAX request
$id = $_POST['prescription_id'];

// Construct the SQL query to delete the record
$delete_query = "DELETE FROM prescription_records1 WHERE prescription_id = ?";
$stmt = $connection->prepare($delete_query);
$stmt->bind_param("i", $id);

// Execute the query
if ($stmt->execute()) {
    echo "Record deleted successfully!";
} else {
    echo "Error deleting record: " . $connection->error;
}

// Close the statement and the database connection
$stmt->close();
$connection->close();
?>

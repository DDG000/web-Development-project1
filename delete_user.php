<?php
<<<<<<< HEAD



include 'config.php';


$id = $_POST['id'];


=======
// delete_record.php

// Establish database connection
include 'config.php';

// Get the record ID from the AJAX request
$id = $_POST['id'];

// Construct the SQL query to delete the record
>>>>>>> 51e389bd0ea242df003b8c097566a2a1c7d34bcd
$delete_query = "DELETE FROM customer_information1 WHERE id = ?";
$stmt = $connection->prepare($delete_query);
$stmt->bind_param("i", $id);

<<<<<<< HEAD
=======
// Execute the query
>>>>>>> 51e389bd0ea242df003b8c097566a2a1c7d34bcd
if ($stmt->execute()) {
    echo "Record deleted successfully!";
} else {
    echo "Error deleting record: " . $stmt->error;
}

<<<<<<< HEAD

=======
// Close the statement
>>>>>>> 51e389bd0ea242df003b8c097566a2a1c7d34bcd
$stmt->close();
?>

<?php
include 'config.php';


$sql = "SELECT prescription_id, prescription_date, customerId FROM prescription_records1";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
 
    $prescriptions = [];
    while ($row = $result->fetch_assoc()) {
        $prescriptions[] = $row;
    }

  
    header('Content-Type: application/json');
    echo json_encode($prescriptions);
} else {
  
    echo json_encode(['error' => 'No prescriptions found']);
}

$conn->close();
?>

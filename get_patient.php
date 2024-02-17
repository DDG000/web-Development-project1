<?php


include 'config.php';




$customerId = $_GET['customerId'];


$sql = "SELECT * FROM customer_information1 WHERE customer_id = $customerId";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
   
    $row = $result->fetch_assoc();

  
    header('Content-Type: application/json');
    echo json_encode($row);
} else {
  
    echo json_encode(['error' => 'No data found']);
}


$conn->close();
?>

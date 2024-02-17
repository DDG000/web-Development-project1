<?php

include 'config.php';


$prescriptionDate = '2023-12-26';  


$query = "SELECT image FROM prescription_records1 WHERE prescription_date = ?";
$statement = $connection->prepare($query);
$statement->bind_param("s", $prescriptionDate);
$statement->execute();
$result = $statement->get_result();

$imagePaths = array();
while ($row = $result->fetch_assoc()) {
    $imagePaths[] = $row['image'];
}

$statement->close();
$connection->close();


if (!empty($imagePaths)) {
    foreach ($imagePaths as $imagePath) : ?>
    <img src="<?php echo $imagePath; ?>" alt="Prescription Image">
    <?php endforeach;
} else {
    echo "No images found for the specified date."; 
}
?>

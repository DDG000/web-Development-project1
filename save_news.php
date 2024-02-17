<?php
session_start();

include 'config.php'; 


if (!isset($_SESSION['customerId']) || !is_numeric($_SESSION['customerId'])) {
    header("Location: error.php?message=Invalid customer ID");
    exit();
}
$customerId = $_SESSION['customerId'];


$stmt = $connection->prepare("SELECT role, first_Name FROM job_roles INNER JOIN customer_information1 ON job_roles.ID = customer_information1.ID WHERE job_roles.ID = ?");
if ($stmt) {
    $stmt->bind_param("i", $customerId);
    $stmt->execute();
    $stmt->bind_result($role, $first_Name);
    $stmt->fetch();
    $stmt->close();

 
} else {
   
    echo "Error preparing SQL statement.";
}


// ...


$news = $_POST['message'];
$insertSQL = "INSERT INTO news (ID, news) VALUES (?, ?)";
$insertStatement = $connection->prepare($insertSQL);
$insertStatement->bind_param("is", $customerId, $news);
if (!$insertStatement->execute()) {
    throw new Exception("Error inserting into news table: " . $insertStatement->error);
}
echo '<script>alert("Massage sent successfully !");</script>';
echo '<script>window.location.href = "News.php";</script>';

$connection->close();
?>

<?php

include 'config.php';


error_reporting(E_ALL);
ini_set('display_errors', 1);


$email = $_POST['echeck'];
$prescriptionDate = date('Y-m-d');


if (isset($_FILES['prescriptionPhoto']) && $_FILES['prescriptionPhoto']['error'] == UPLOAD_ERR_OK) {
  
    $fileName = $_FILES['prescriptionPhoto']['name'];
    $fileTmpName = $_FILES['prescriptionPhoto']['tmp_name'];
    $fileSize = $_FILES['prescriptionPhoto']['size'];
    $fileType = $_FILES['prescriptionPhoto']['type'];

  
    $allowedTypes = array('image/jpeg', 'image/png', 'image/gif');
    if (!in_array($fileType, $allowedTypes)) {
        echo "Invalid file type. Only JPEG, PNG, and GIF files are allowed.";
        exit;
    }

    
    $targetDir = "./imagesave/"; 
    $targetFilePath = $targetDir . $fileName;
    if (move_uploaded_file($fileTmpName, $targetFilePath)) {
        

       
        $query = "SELECT id, first_Name,telephone FROM customer_information1 WHERE email = ?";
        $statement = $connection->prepare($query);
        $statement->bind_param("s", $email);
        $statement->execute();
        $statement->store_result();
        $statement->bind_result($customerID, $firstName,$telephone);
        

        
        if ($statement->fetch()) {
           
            $insertSQL1 = "INSERT INTO prescription_records1(prescription_date, customer_id, image, name, telephone) VALUES (?, ?, ?, ?, ?)";
            $insertStatement1 = $connection->prepare($insertSQL1);
            $insertStatement1->bind_param("sissi", $prescriptionDate, $customerID, $fileName, $firstName, $telephone); 
        
           
            if ($insertStatement1->execute()) {
                echo "<script>alert('Prescription record inserted into prescription_records1 successfully!');</script>";
            } else {
                echo "Error inserting prescription record into prescription_records1: " . $insertStatement1->error;
            }
        
            
            $insertSQL2 = "INSERT INTO prescription_records2(p_date, customer_id, image, name, telephone) VALUES (?, ?, ?, ?, ?)";
            $insertStatement2 = $connection->prepare($insertSQL2);
            $insertStatement2->bind_param("sissi", $prescriptionDate, $customerID, $fileName, $firstName, $telephone); 
        
          
            if ($insertStatement2->execute()) {
                echo "<script>alert('Prescription record inserted into prescription_records2 successfully!');</script>";
                echo '<script>window.location.href = "HomePage2.php";</script>';
            } else {
                echo "Error inserting prescription record into prescription_records2: " . $insertStatement2->error;
            }
        }
        
          
        } else {
            echo "Customer not found";
        }
    } else {
        echo "Error uploading file.";
    }



$statement->close();
$connection->close();
?>

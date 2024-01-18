<?php
// Include the database configuration file
include 'config.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Retrieve data from the form
$email = $_POST['echeck'];
$prescriptionDate = date('Y-m-d');

// Check if the file field is set and not empty
if (isset($_FILES['prescriptionPhoto']) && $_FILES['prescriptionPhoto']['error'] == UPLOAD_ERR_OK) {
    // Get the uploaded file information
    $fileName = $_FILES['prescriptionPhoto']['name'];
    $fileTmpName = $_FILES['prescriptionPhoto']['tmp_name'];
    $fileSize = $_FILES['prescriptionPhoto']['size'];
    $fileType = $_FILES['prescriptionPhoto']['type'];

    // Validate the file type (optional)
    $allowedTypes = array('image/jpeg', 'image/png', 'image/gif');
    if (!in_array($fileType, $allowedTypes)) {
        echo "Invalid file type. Only JPEG, PNG, and GIF files are allowed.";
        exit;
    }

    // Move the uploaded file to the desired directory
    $targetDir = "./imagesave/"; // Specify your upload directory here
    $targetFilePath = $targetDir . $fileName;
    if (move_uploaded_file($fileTmpName, $targetFilePath)) {
        // File uploaded successfully

        // Step 1: Get Customer ID based on Email
        $query = "SELECT id, first_Name,telephone FROM customer_information1 WHERE email = ?";
        $statement = $connection->prepare($query);
        $statement->bind_param("s", $email);
        $statement->execute();
        $statement->store_result();
        $statement->bind_result($customerID, $firstName,$telephone);
        

        // Fetch the result
        if ($statement->fetch()) {
            // Step 2: Insert data into the prescription_records1 table
            $insertSQL1 = "INSERT INTO prescription_records1(prescription_date, customer_id, image, name, telephone) VALUES (?, ?, ?, ?, ?)";
            $insertStatement1 = $connection->prepare($insertSQL1);
            $insertStatement1->bind_param("sissi", $prescriptionDate, $customerID, $fileName, $firstName, $telephone); // Bind the parameters
        
            // Execute the first statement
            if ($insertStatement1->execute()) {
                echo "<script>alert('Prescription record inserted into prescription_records1 successfully!');</script>";
            } else {
                echo "Error inserting prescription record into prescription_records1: " . $insertStatement1->error;
            }
        
            // Step 3: Insert data into the prescription_records2 table
            $insertSQL2 = "INSERT INTO prescription_records2(p_date, customer_id, image, name, telephone) VALUES (?, ?, ?, ?, ?)";
            $insertStatement2 = $connection->prepare($insertSQL2);
            $insertStatement2->bind_param("sissi", $prescriptionDate, $customerID, $fileName, $firstName, $telephone); // Bind the parameters
        
            // Execute the second statement
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


// Close the database connection
$statement->close();
$connection->close();
?>

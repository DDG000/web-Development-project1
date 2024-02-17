<?php

include 'config.php';

$first_Name = $_POST['Fname'];
$last_Name = $_POST['Lname'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$street_Address = $_POST['sadd'];
$city = $_POST['city'];
$userPassword = $_POST["password"];

$emailCheckSQL = "SELECT password FROM customer_information1 WHERE email = '$email'";
$emailCheckResult = $connection->query($emailCheckSQL);

if ($emailCheckResult->num_rows > 0) {
    echo '<script>alert("This Email is already in use. Please try again with a different email.");</script>';
    echo '<script>window.location.href = "login.html";</script>';
    exit();
}

// Hash the password
$hashedPassword = password_hash($userPassword, PASSWORD_BCRYPT);

// Start a transaction
$connection->begin_transaction();

try {
    // Insert into customer_information1
    $insertSQL = "INSERT INTO customer_information1 (first_Name, last_Name, telephone, email, street_Address, city, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $insertStatement = $connection->prepare($insertSQL);
    $insertStatement->bind_param("sssssss", $first_Name, $last_Name, $telephone, $email, $street_Address, $city, $hashedPassword);

    if (!$insertStatement->execute()) {
        throw new Exception("Error inserting into customer_information1: " . $insertStatement->error);
    }

    // Get the last inserted ID from customer_information1
    $customerId = $connection->insert_id;

    // Insert into Job_roles
    $role = "customer";  // Replace with the actual role you want to insert
    $insertJobRolesSQL = "INSERT INTO job_role2 (ID, role) VALUES (?, ?)";
    $insertJobRolesStatement = $connection->prepare($insertJobRolesSQL);
    $insertJobRolesStatement->bind_param("is", $customerId, $role);

    if (!$insertJobRolesStatement->execute()) {
        throw new Exception("Error inserting into Job_roles: " . $insertJobRolesStatement->error);
    }

    // Commit the transaction
    $connection->commit();

    echo '<script>alert("Account Created Successfully. Please use Already User Menu to log in.");</script>';
    echo '<script>window.location.href = "login.html";</script>';
} catch (Exception $e) {
    // Rollback the transaction on exception
    $connection->rollback();
    echo "Transaction failed: " . $e->getMessage();
}

// Close prepared statements
$insertStatement->close();
$insertJobRolesStatement->close();

// Close the database connection
$connection->close();
?>
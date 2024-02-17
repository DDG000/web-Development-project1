<?php

include 'config.php';

$first_Name = $_POST['Fname'];
$last_Name = $_POST['Lname'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$role = $_POST['job']; 
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

<<<<<<< HEAD
$hashedPassword = password_hash($userPassword, PASSWORD_BCRYPT);


$connection->begin_transaction();

try {
   
=======
// Hash the password
$hashedPassword = password_hash($userPassword, PASSWORD_BCRYPT);

// Start a transaction
$connection->begin_transaction();

try {
    // Insert into customer_information1
>>>>>>> 51e389bd0ea242df003b8c097566a2a1c7d34bcd
    $insertSQL = "INSERT INTO customer_information1 (first_Name, last_Name, telephone, email, street_Address, city, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $insertStatement = $connection->prepare($insertSQL);
    $insertStatement->bind_param("sssssss", $first_Name, $last_Name, $telephone, $email, $street_Address, $city, $hashedPassword);

    if (!$insertStatement->execute()) {
        throw new Exception("Error inserting into customer_information1: " . $insertStatement->error);
    }

<<<<<<< HEAD
   
=======
    // Get the last inserted ID from customer_information1
>>>>>>> 51e389bd0ea242df003b8c097566a2a1c7d34bcd
    $customerId = $connection->insert_id;

  
   
    if( $role === "Employee"){
    $insertJobRolesSQL = "INSERT INTO job_roles (ID, role) VALUES (?, ?)";
    $insertJobRolesStatement = $connection->prepare($insertJobRolesSQL);
    $insertJobRolesStatement->bind_param("is", $customerId, $role);

    if (!$insertJobRolesStatement->execute()) {
        throw new Exception("Error inserting into Job_roles: " . $insertJobRolesStatement->error);
    }

<<<<<<< HEAD
  
=======
    // Commit the transaction
>>>>>>> 51e389bd0ea242df003b8c097566a2a1c7d34bcd
    $connection->commit();

    echo '<script>alert("Account Created Successfully.");</script>';
    echo '<script>window.location.href = "adduser.php";</script>';
}

elseif( $role === "Manager"){
    $insertJobRolesSQL = "INSERT INTO job_roles (ID, role) VALUES (?, ?)";
    $insertJobRolesStatement = $connection->prepare($insertJobRolesSQL);
    $insertJobRolesStatement->bind_param("is", $customerId, $role);

    if (!$insertJobRolesStatement->execute()) {
        throw new Exception("Error inserting into Job_roles: " . $insertJobRolesStatement->error);
    }

<<<<<<< HEAD
=======
    // Commit the transaction
>>>>>>> 51e389bd0ea242df003b8c097566a2a1c7d34bcd
    $connection->commit();

    echo '<script>alert("Account Created Successfully.");</script>';
    echo '<script>window.location.href = "adduser.php";</script>';
}

elseif( $role === "Admin"){
    $insertJobRolesSQL = "INSERT INTO job_roles (ID, role) VALUES (?, ?)";
    $insertJobRolesStatement = $connection->prepare($insertJobRolesSQL);
    $insertJobRolesStatement->bind_param("is", $customerId, $role);

    if (!$insertJobRolesStatement->execute()) {
        throw new Exception("Error inserting into Job_roles: " . $insertJobRolesStatement->error);
    }

<<<<<<< HEAD
  
=======
    // Commit the transaction
>>>>>>> 51e389bd0ea242df003b8c097566a2a1c7d34bcd
    $connection->commit();

    echo '<script>alert("Account Created Successfully. ");</script>';
    echo '<script>window.location.href = "adduser.php";</script>';
}
} catch (Exception $e) {
<<<<<<< HEAD
  
=======
    // Rollback the transaction on exception
>>>>>>> 51e389bd0ea242df003b8c097566a2a1c7d34bcd
    $connection->rollback();
    echo "Transaction failed: " . $e->getMessage();
}

<<<<<<< HEAD

$insertStatement->close();
$insertJobRolesStatement->close();


=======
// Close prepared statements
$insertStatement->close();
$insertJobRolesStatement->close();

// Close the database connection
>>>>>>> 51e389bd0ea242df003b8c097566a2a1c7d34bcd
$connection->close();
?>

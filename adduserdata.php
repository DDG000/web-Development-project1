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

$hashedPassword = password_hash($userPassword, PASSWORD_BCRYPT);


$connection->begin_transaction();

try {
   
    $insertSQL = "INSERT INTO customer_information1 (first_Name, last_Name, telephone, email, street_Address, city, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $insertStatement = $connection->prepare($insertSQL);
    $insertStatement->bind_param("sssssss", $first_Name, $last_Name, $telephone, $email, $street_Address, $city, $hashedPassword);

    if (!$insertStatement->execute()) {
        throw new Exception("Error inserting into customer_information1: " . $insertStatement->error);
    }

   
    $customerId = $connection->insert_id;

  
   
    if( $role === "Employee"){
    $insertJobRolesSQL = "INSERT INTO job_roles (ID, role) VALUES (?, ?)";
    $insertJobRolesStatement = $connection->prepare($insertJobRolesSQL);
    $insertJobRolesStatement->bind_param("is", $customerId, $role);

    if (!$insertJobRolesStatement->execute()) {
        throw new Exception("Error inserting into Job_roles: " . $insertJobRolesStatement->error);
    }

  
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

  
    $connection->commit();

    echo '<script>alert("Account Created Successfully. ");</script>';
    echo '<script>window.location.href = "adduser.php";</script>';
}
} catch (Exception $e) {
  
    $connection->rollback();
    echo "Transaction failed: " . $e->getMessage();
}


$insertStatement->close();
$insertJobRolesStatement->close();


$connection->close();
?>

<?php
// Start the session
session_start();

// Include database configuration (assuming valid details in config.php)
include 'config.php';

// Retrieve user credentials from POST data (implement input validation here)
$userEmail = $_POST["regemail"];
$userPassword = $_POST["regpassword"];

// Step 1: Retrieve user information using prepared statement
$sql = "SELECT id, first_name, password FROM customer_information1 WHERE email = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $userEmail);
$stmt->execute();
$stmt->bind_result($customerId, $firstName, $storedHashedPassword);
$stmt->fetch();
$stmt->close();

if ($customerId) { // User found
    if (password_verify($userPassword, $storedHashedPassword)) {
        // Step 2: Retrieve role using prepared statement
        $sql3 = "SELECT role FROM job_roles WHERE ID = ?";
        $stmt3 = $connection->prepare($sql3);
        $stmt3->bind_param("i", $customerId);
        $stmt3->execute();
        $stmt3->bind_result($role);
        $stmt3->fetch();
        $stmt3->close();

        // Step 3: Set session variable and redirect based on role
        $_SESSION['customerId'] = $customerId; // Store customer ID in session
        switch ($role) {
            case 'Manager':
                header("Location: Manager.php");
                exit();
            case 'Admin':
                header("Location: AdminInterface.php");
                exit();
            case 'Employee':
                header("Location: Employee.php");
                exit();
            default:
                header("Location: HomePage2.php");
                exit();
        }
    } else {
        header("Location: login.html?error=incorrect_password"); // Redirect with error message
        exit();
    }
} else {
    header("Location: login.html?error=user_not_found"); // Redirect with error message
    exit();
}
?>

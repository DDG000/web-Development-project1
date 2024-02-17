<?php

session_start();


include 'config.php';


$userEmail = $_POST["regemail"];
$userPassword = $_POST["regpassword"];


$sql = "SELECT id, first_name, password FROM customer_information1 WHERE email = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $userEmail);
$stmt->execute();
$stmt->bind_result($customerId, $firstName, $storedHashedPassword);
$stmt->fetch();
$stmt->close();

if ($customerId) { 
    if (password_verify($userPassword, $storedHashedPassword)) {
       
        $sql3 = "SELECT role FROM job_roles WHERE ID = ?";
        $stmt3 = $connection->prepare($sql3);
        $stmt3->bind_param("i", $customerId);
        $stmt3->execute();
        $stmt3->bind_result($role);
        $stmt3->fetch();
        $stmt3->close();

      
        $_SESSION['customerId'] = $customerId; 
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
        header("Location: login.html?error=incorrect_password"); 
        exit();
    }
} else {
    header("Location: login.html?error=user_not_found"); 
    exit();
}
?>

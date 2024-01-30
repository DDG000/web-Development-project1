
<?php
// Start the session
session_start();

// Include database configuration (assuming valid details in config.php)
include 'config.php';

// Verify and sanitize customerId (replace with appropriate validation logic)
if (!isset($_SESSION['customerId']) || !is_numeric($_SESSION['customerId'])) {
    header("Location: error.php?message=Invalid customer ID");
    exit();
}
$customerId = $_SESSION['customerId'];

// Prepare SQL statement with placeholder for customerId
$sql = "SELECT role FROM job_roles WHERE ID = ?";
$stmt = $connection->prepare($sql);

// Bind parameter and execute
if ($stmt) {
    $stmt->bind_param("i", $customerId);
    $stmt->execute();

    // Bind result
    $stmt->bind_result($role);
    $stmt->fetch();

    // Close statement
    $stmt->close();

    // Check role and redirect if not "customer"
    if ($role !== "Admin") {
        header("Location: HomePage.html");
        exit();
    }
} if (!isset($_SESSION['customerId']) || !is_numeric($_SESSION['customerId'])) {
    header("Location: error.php?message=Invalid customer ID");
    exit();
}
$customerId = $_SESSION['customerId'];

// Prepare SQL statement with placeholder for customerId
$stmt = $connection->prepare("SELECT role, first_Name FROM job_roles INNER JOIN customer_information1 ON job_roles.ID = customer_information1.ID WHERE job_roles.ID = ?");

// Bind parameter and execute
if ($stmt) {
    $stmt->bind_param("i", $customerId);
    $stmt->execute();

    // Bind result
    $stmt->bind_result($role, $first_Name);
    $stmt->fetch();

    // Close statement
    $stmt->close();
}

// Proceed with actions for a customer
// ...
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="user_management.css">
    <title>Document</title>
</head>
<body>
<div class="box">
  <ul style="text-align: left; ">

  <div class="one">
     <li><p style="color:#3280274; font-weight: bold;">Hello ..<?php echo ucfirst($first_Name); ?></p>
  
    <li><p style="color: #337ab7;font-weight: bold; ">ID: <?php echo $customerId; ?></p></li>
    
     </li> <li><p style="color: #337ab7;font-weight: bold;">Position: <?php echo $role; ?></p></li>
  </ul>
  <div class="circle">
            <div class="txt">ADD USER</div>
            <a href="adduser.php"><div class="image">
                <img src="./image/addimg2.png" width="180px" height="100px"></div>
        </div></a>

        <div class="circle">
            <div class="txt">REMOVE USER</div>
            <a href="removeuser.php"><div class="image">
                <img src="./image/remove.jpg" width="180px" height="100px"></div>
        </div></a>
        <div class="circle">
            <div class="txt">UPDATE USER</div>
            <a href="updateuser.php"><div class="image">
                <img src="./image/view.jpg" width="180px" height="100px"></div>
        </div></a>
        
 </div>
 

 <div class="logo">
           <a href="HomePage2.php">     <img src="image/logo.jpg" alt="Healthcare Pharmacy"></a>
            </div>
            <div class="logo-text">
                <p class="logo-text">QUEENSWAY</p>
            </div>

</div> 



 
</body>
</html>
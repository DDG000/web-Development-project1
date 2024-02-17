
<?php

session_start();


include 'config.php';


if (!isset($_SESSION['customerId']) || !is_numeric($_SESSION['customerId'])) {
    header("Location: error.php?message=Invalid customer ID");
    exit();
}
$customerId = $_SESSION['customerId'];


$sql = "SELECT role FROM job_roles WHERE ID = ?";
$stmt = $connection->prepare($sql);


if ($stmt) {
    $stmt->bind_param("i", $customerId);
    $stmt->execute();

  
    $stmt->bind_result($role);
    $stmt->fetch();


    $stmt->close();

 

} if (!isset($_SESSION['customerId']) || !is_numeric($_SESSION['customerId'])) {
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
}


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
<a href="Admininterface.php"><img src="image/back1.jpg"  style="width: 50px;height: 50px;float: left; "></a> 
  <ul style="text-align: left; ">

  <div class="one">
     <li><p style="color:#3280274; font-weight: bold;">Hello ..<?php echo ucfirst($first_Name); ?></p>
  
    <li><p style="color: #337ab7;font-weight: bold; ">ID: <?php echo $customerId; ?></p></li>
    
     </li> <li><p style="color: #337ab7;font-weight: bold;">Position: <?php echo $role; ?></p></li>
  </ul>
  <div class="circle">
            <div class="txt">ADD ITEMS</div>
            <a href="additems.php"><div class="image">
                <img src="./image/in.jpg" width="180px" height="100px"></div>
        </div></a>

        <div class="circle">
            <div class="txt">REMOVE ITEMS</div>
            <a href=""><div class="image">
                <img src="./image/remove.jpg" width="180px" height="100px"></div>
        </div></a>
        <div class="circle">
            <div class="txt">UPDATE ITEMS</div>
            <a href=""><div class="image">
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
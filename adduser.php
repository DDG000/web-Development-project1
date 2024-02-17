<?php
<<<<<<< HEAD

session_start();

include 'config.php';

=======
// Start the session
session_start();

// Include database configuration (assuming valid details in config.php)
include 'config.php';

// Verify and sanitize customerId (replace with appropriate validation logic)
>>>>>>> 51e389bd0ea242df003b8c097566a2a1c7d34bcd
if (!isset($_SESSION['customerId']) || !is_numeric($_SESSION['customerId'])) {
    header("Location: error.php?message=Invalid customer ID");
    exit();
}
$customerId = $_SESSION['customerId'];

<<<<<<< HEAD

$sql = "SELECT role FROM job_roles WHERE ID = ?";
$stmt = $connection->prepare($sql);


=======
// Prepare SQL statement with placeholder for customerId
$sql = "SELECT role FROM job_roles WHERE ID = ?";
$stmt = $connection->prepare($sql);

// Bind parameter and execute
>>>>>>> 51e389bd0ea242df003b8c097566a2a1c7d34bcd
if ($stmt) {
    $stmt->bind_param("i", $customerId);
    $stmt->execute();

<<<<<<< HEAD
  
    $stmt->bind_result($role);
    $stmt->fetch();

   
    $stmt->close();

=======
    // Bind result
    $stmt->bind_result($role);
    $stmt->fetch();

    // Close statement
    $stmt->close();

    // Check role and redirect if not "customer"
>>>>>>> 51e389bd0ea242df003b8c097566a2a1c7d34bcd
    if ($role !== "Admin") {
        header("Location: HomePage.html");
        exit();
    }
} if (!isset($_SESSION['customerId']) || !is_numeric($_SESSION['customerId'])) {
    header("Location: error.php?message=Invalid customer ID");
    exit();
}
$customerId = $_SESSION['customerId'];

<<<<<<< HEAD

$stmt = $connection->prepare("SELECT role, first_Name FROM job_roles INNER JOIN customer_information1 ON job_roles.ID = customer_information1.ID WHERE job_roles.ID = ?");


=======
// Prepare SQL statement with placeholder for customerId
$stmt = $connection->prepare("SELECT role, first_Name FROM job_roles INNER JOIN customer_information1 ON job_roles.ID = customer_information1.ID WHERE job_roles.ID = ?");

// Bind parameter and execute
>>>>>>> 51e389bd0ea242df003b8c097566a2a1c7d34bcd
if ($stmt) {
    $stmt->bind_param("i", $customerId);
    $stmt->execute();

<<<<<<< HEAD
 
    $stmt->bind_result($role, $first_Name);
    $stmt->fetch();

   
    $stmt->close();
}


=======
    // Bind result
    $stmt->bind_result($role, $first_Name);
    $stmt->fetch();

    // Close statement
    $stmt->close();
}

// Proceed with actions for a customer
>>>>>>> 51e389bd0ea242df003b8c097566a2a1c7d34bcd
// ...
?>

















<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap');
    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>login page</title>
    <link rel="stylesheet" href="adduser.css">



</head>

<body>

    <form action="http://localhost/New%20Web/adduserdata.php" method="post">
  

        <div id="reg">
            <br>
            <ul class="ul1">
                <label class="la1"> Add Member :</label>
                <br>
                <br>
                <br>

                <label class="la2"></label>
                <br><br>
                <label class="la3">First Name :</label><br>
                <input type="text" class="c1" name="Fname" placeholder="......." required>
                <br><br> <br> <br>
                <label class="la3">Last Name :</label><br>
                <input type="text" class="c1" name="Lname" placeholder="......." required>
                <br><br><br><br>

                <label class="la3">Telephone Number:</label><br>
                <input type="tel" class="c1" name="telephone" required>
                <br><br> <br> <br>

                <label class="la3">E mail :</label><br>
                <input type="email" class="c1" name="email" required>
                <br><br> <br> <br>

                <label class="la3">Select Jobe Role:</label><br>
                <select name ="job" required>
                    <option value="Employee">Employee</option>
                    <option value="Manager">Manager</option>
                    <option value="Admin">Admin</option>

                </select>
                <br><br><br><br>
                <label class="la3">Address :</label><br>
                <input type="text" class="c1" name="sadd" placeholder="......." required>
                <br><br><br><br>

                <label class="la3">City :</label><br>
                <input type="text" class="c1" name="city" placeholder="......." required>
                <br><br><br><br>

                <label class="la3">Password :</label><br>
                <input type="password" class="c1" id="password" name="password" placeholder="......" required>
                <br><br><br><br>

                <label class="la3">Confirm Password :</label><br>
                <input type="password" class="c1" id="cpassword" name="cpassword" placeholder="......" required>
                <br><br><br><br>

                <span id="message"></span><br><br>
                <input type="submit" id="btn1" onclick="comparePasswords()" style="font-size: 25px;">


                <script>
                   

                    

                    function comparePasswords() {

                        var password = document.getElementById("password").value;
                        var cpassword = document.getElementById("cpassword").value;
                        var message = document.getElementById("message");

                        if (password === cpassword) {
                            message.innerHTML = "Passwords match!";
                            message.style.color = "green";


                        } else {
                            message.innerHTML = "Passwords do not match!";
                            message.style.color = "red";
                        }
                    }


                    document.getElementById("password").addEventListener("input", comparePasswords);
                    document.getElementById("cpassword").addEventListener("input", comparePasswords);
                </script>

            </ul>







        </div>
<<<<<<< HEAD
        <a href="user_management.php"><img src="image/back1.jpg"  style="width: 50px;height: 50px;float: left; "></a> 
=======
>>>>>>> 51e389bd0ea242df003b8c097566a2a1c7d34bcd
    </form>


</body>

</html>
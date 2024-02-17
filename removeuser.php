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






<?php
include 'config.php';

// Execute a query to select data based on the ID and join with customer_information1
$sql = "SELECT job_roles.role, customer_information1.first_Name, customer_information1.last_Name,customer_information1.id
        FROM job_roles
        JOIN customer_information1 ON job_roles.ID = customer_information1.id";


$result = $connection->query($sql);

// Fetch and store data in an array
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
?>





<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Attendance Dashboard | By Code Info</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Font Awesome Cdn Link -->
    <!-- Add jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <meta http-equiv="refresh" content="60">
</head>
<body>
    <div class="container">
        <nav>
            <ul>
                <li>
                    <a href="#" class="logo">
                        <img src="./image/logo.jpg">
                        <span class="nav-item">Queensway</span>
                    </a>
                </li>
                <li><a href="#">
                    <i class="fas fa-menorah"></i>
                    <span class="nav-item">Dashboard</span>
                </a></li>
                
                <li><a href="#">
                    <i class="fas fa-database"></i>
                    <span class="nav-item"> Customer Report</span>
                </a></li>

                <li><a href="#">
                    <i class="fas fa-cog"></i>
                    <span class="nav-item">Search</span>
                </a></li>
        
                <li><a href="#" class="logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <a href="user_management.php"><img src="image/back1.jpg"  style="width: 50px;height: 50px;float: left; "></a> 
                </a></li>
            </ul>
        </nav>

        <section class="main">
            <div class="main-top">
                <h1>Prescription View :</h1>
                <i class="fas fa-user-cog"></i>
            </div>

            <div id="imageModal" class="modal">
                <span onclick="closeImageModal()" class="close">&times;</span>
                <img id="prescriptionImage" class="modal-content">
            </div>

            <section class="attendance">
                <div class="attendance-list">
                    <h1>Prescription List</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th> First Name</th>
                                <th> Last Name</th>
                                <th>Position</th>

                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        foreach ($data as $row) {
                            echo "
                                <form method='post' action=''>
                                    <tr class='active'>
                                        <td>" . $row["id"] . "</td>
                                        <td>" . $row["first_Name"] . "</td>
                                        <td>" . $row["last_Name"] . "</td>
                                        <td>" . $row["role"] . "</td>
                                      
                                        <td><button onclick=\"deleteRow(" . $row["id"] . ")\">Remove</button></td>
                                    </tr>
                                </form>
                            ";
                          
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </section>

    </div>

    <script>
        function deleteRow(id) {
    if (confirm("Are you sure you want to delete this record?")) {

        $.ajax({
            type: "POST",
            url: "delete_user.php",
            data: { id: id },
            success: function(response) {
              
                alert(response); 
            },
            error: function(error) {
                console.error("Error deleting record: " + error);
            }
        });
    }
}

        function showImage(imageSrc) {
            document.getElementById("prescriptionImage").src = imageSrc;
            document.getElementById("imageModal").style.display = "block";
        }

        function closeImageModal() {
            document.getElementById("imageModal").style.display = "none";
        }
    </script>

</body>
</html>

<?php

$connection->close();
?>

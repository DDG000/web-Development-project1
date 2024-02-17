<?php
include 'config.php';


$sql = "SELECT prescription_records1.prescription_id, prescription_records1.created_at, prescription_records1.image,prescription_records1.name,prescription_records1.telephone
        FROM prescription_records1
        JOIN customer_information1 ON prescription_records1.customer_id = customer_information1.id";

$result = $connection->query($sql);


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
                    
                    <span class="nav-item">Back</span>
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

            <div class='users'>
                <?php
                foreach ($data as $row) {
                    echo "
                            <div class='card'>
                                <img src='./image/profile.png'><br>
                                <td>" . $row["prescription_id"] . "</td><br>
                                <td>" . $row["name"] . "</td><br>
                                <button>Profile</button>
                            </div>
                        ";
                }
                ?>
            </div>

            <section class="attendance">
                <div class="attendance-list">
                    <h1>Prescription List</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Prescription ID</th>
                                <th>Name</th>
                                <th>Telephone</th>
                                <th>Date & Time</th>
                                <th>Prescription</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        foreach ($data as $row) {
                            echo "
                                <form method='post' action=''>
                                    <tr class='active'>
                                        <td>" . $row["prescription_id"] . "</td>
                                        <td>" . $row["name"] . "</td>
                                        <td>" . $row["telephone"] . "</td>
                                        <td>" . $row["created_at"] . "</td>
                                        <td><button type='button' onclick=\"showImage('./imagesave/" . $row["image"] . "')\">View</button></td>
                                        <td><button onclick=\"deleteRow(" . $row["prescription_id"] . ")\">Done</button></td>
                                    </tr>
                                </form>
                            ";
                            echo "<script>console.log('Image Path: " . $row["image"] . "');</script>";
                        }
                        ?>
                        </tbody>
                    </table>
                    
                </div>
            </section>
        </section>
    </div>

    <script>
        function deleteRow(prescription_id) {
    if (confirm("Are you sure you want to delete this record?")) {
       
        $.ajax({
            type: "POST",
            url: "delete_prescription.php",
            data: { prescription_id: prescription_id },
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

<?php

session_start();


include 'config.php';

if (!isset($_SESSION['customerId']) || !is_numeric($_SESSION['customerId'])) {
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

?>
 






 <!DOCTYPE html>
<html>
<head>
    <title>Job Dashboard | By Code Info</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="News2.css" />
</head>
<body>
    <div class="container">
        <nav>
            <div class="navbar">
                <div class="logo">
                    <img src="./image/logo.jpg" alt="">
                </div>
                <ul>
                    <li><a href="#">
                        <i class="fas fa-user"></i>
                        <span class="nav-item">Dashboard</span>
                    </a></li>
                    <li><a href="#">
                        <i class="fas fa-chart-bar"></i>
                        <span class="nav-item">Message List</span>
                    </a></li>
                    <li><a href="#" class="logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <a href="News.php"><img src="image/back1.jpg"  style="width: 50px;height: 50px;float: left; "></a>
                    </a></li>
                </ul>
            </div>
        </nav>

        <section class="main">
            <div class="main-top">
                <p>Queensway Pharmacy</p>
            </div>
            <div class="main-body">
                

                <div class="row">
                    <p>There are more than <span>400</span> News</p>
                </div>

                <form action="save_news.php" method="post">
                    <div class="job_card">
                        <div class="job_details">
                            <div class="img">
                                <i class="fab fa-google-drive"></i>
                            </div>

                            <div class="text">
                                <ul>
                                    <!-- Other details -->
                                    <li><p> ID : <?php echo $customerId; ?></p>
                                    
                                    </li>  
                                    <li><p> name : <?php echo $first_Name; ?></p></li> 
                                    <li><p> position : <?php echo $role; ?></p></li>  
                                </ul>
                               
                                <span></span>
                            </div>
                        </div>
                        <div class="job_salary">
                            <textarea id="message" name="message" rows="10" cols="60"></textarea>
                          
                             <button class="send-button" type="submit">Send</button>
                        </div>

                    </div>
                </form>

            </div>
        </section>
    </div>
</body>
</html>


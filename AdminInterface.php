


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

    
    if ($role !== "Admin") {
        header("Location: HomePage.html");
        exit();
    }
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
    <title>Admin Interface</title>
    <link rel="stylesheet" href="AdminInterface.css">
    <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    
</head>
<body>

    <header>
        <nav>
            <div class="logo">
               <a href="HomePageEmp.php"> <img src="image/logo.jpg" alt="Healthcare Pharmacy"></a>
            </div>
            <div class="logo-text">
                <p>QUEENSWAY</p>
            </div>
            
            <form action="http://localhost/New%20Web/search.php"  method="post">

<div class="search-bar">
    <input type="text" name="search"   placeholder="Search...">
    <button type="submit"  name ="sub">Search</button>
</div>
</form>
            
            <div class="nav-buttons">

               
                <a href="logout.php"><img src="image/logout.jpg"></a>
                <span>0</span>
            </div>
        </nav>
    </header>

    <header2>
        <nav class="top-nav">
            <div class="nav-links">
                <ul>
                    <li class="mega-menu">
                        <a href="#">Medicine <span class="arrow">&#9662;</span></a>

                        <div class="mega-content">
                            <ul>
                                <a class="a2" href="searchcg.php?search=HEART">HEART</a>
                                <a class="a2"  href="searchcg.php?search=CENTRAL NERVOUS SYSTEM">CENTRAL NERVOUS SYSTEM</a>
                                <a class="a2" href="blank.html"> EAR, NOSE, THROAT</a>
                                <a class="a2" href="blank.html"> DIABETES</a>
                                <a class="a2 " href="blank.html">EYE</a>
                                <a class="a2" href="blank.html"> GASTRO INTESTINAL SYSTEM</a>
                                <a class="a2" href="blank.html">MALIGNANT DISEASE & IMMUNOSUPPRESSIONS</a>

                            </ul>
                        </div>
                    </li>
                    <li class="mega-menu">
                        <a href="#">Medical Devices <span class="arrow">&#9662;</span></a>
                        <div class="mega-content">
                            <ul>
                                <a class="a2" href="searchcg.php?search=FIRST AID">FIRST AID</a>
                                <a class="a2" href="blank.html">HEALTH DEVICES</a>
                                <a class="a2" href="blank.html"> SUPPORTS & BRACES</a>


                            </ul>
                        </div>
                    </li>
                    <li class="mega-menu">
                        <a href="#">Wellness <span class="arrow">&#9662;</span></a>

                        <div class="mega-content">
                            <ul>
                                <a class="a2" href="searchcg.php?search=EYES & EARS">EYES & EARS</a>
                                <a class="a2" href="blank.html">COUGH, COLD & ALLERGY</a>
                                <a class="a2" href="blank.html">DIET & NUTRITION</a>
                                <a class="a2" href="blank.html"> BEAUTY SUPPLEMENTS</a>
                                <a class="a2 " href="blank.html">ADULT & DIABETIC CARE</a>
                                <a class="a2" href="blank.html"> PREVENTIVE CARE</a>
                                <a class="a2" href="blank.html">PAIN & FEVER</a>
                            </ul>
                        </div>
                    </li>
                    <li class="mega-menu">
                        <a href="#">Personal Care <span class="arrow">&#9662;</span></a>
                        <div class="mega-content">
                            <ul>
                                <a class="a2" href="searchcg.php?search=NOURISHMENT">NOURISHMENT</a>
                                <a class="a2" href="blank.html">ACCESSORIES</a>
                                <a class="a2" href="blank.html">SKIN CARE</a>
                                <a class="a2" href="blank.html"> HAND & FOOT CARE</a>
                            </ul>
                        </div>
                    </li>
                    <div class="words">
                        <li><a href="searchcg.php?search=GSE">GSE</a></li>
                        <li><a href="blank.html">SWISSE</a></li>
                        <li><a href="blank.html">PROMOTIONS</a></li>

                    </div>
                </ul>
            </div>
        </nav>
    </header2>


    
    
        <div class="img">
        <h1>QUEENSWAY</h1>
        <div class="text">
  <ul style="text-align: left; ">
     <li><p style="color:#3280274; font-weight: bold;">Hello .. <?php echo ucfirst($first_Name); ?>
</p>   
    <li><p style="color: #337ab7;font-weight: bold; ">ID: <?php echo $customerId; ?></p></li>
    
     </li> <li><p style="color: #337ab7;font-weight: bold;">Position: <?php echo $role; ?></p></li>
  </ul>
 
</div>
        <img src="./Web/img1.png" width="596" height="440">
        <h2>Employees Are Heart Of Our Compnany.</h2>
    </div>

    <div class="box1">
        <div class="circle">
            <div class="txt">PREPARE ORDER</div>
            <a href="prepare_order.php"><div class="image">
               <img src="./Web/img2.png" width="150px" height="40px"></div>
        </div></a>
        <div class="circle">
            <div class="txt">NEWS</div>
           <a href="News.php"> <div class="image">
                <img src="./Web/img33.png" width="100%" height="100%"></div>
        </div></a>
        <div class="circle">
            <div class="txt">REPORTS</div>
            <div class="image">
                <img src="./Web/img4.png" width="150px" height="40px"></div>
        </div>
        <div class="circle">
            <div class="txt">MY PROFILE</div>
            <a href="viewprofile.php"><div class="image">
                <img src="./Web/img55.png" width="150px" height="40px"></div>
        </div></a>
        <div class="circle">
            <div class="txt">CUSTOMER DETAILS</div>
            <div class="image">
                <img src="./Web/img66.png" width="150px" height="40px"></div>
        </div>
        <div class="circle">
            <div class="txt">INVENTRY</div>
            <a href="inventry.php"><div class="image">
                <img src="./Web/img7.png" width="150px" height="40px"></div>
        </div></a>
        <div class="circle">
            <div class="txt">FINANCIAL MANAGEMENT</div>
            <div class="image">
                <img src="./Web/img8.png" width="150px" height="40px"></div>
        </div>
        <div class="circle">
            <div class="txt">PROMOTION & DISCOUNT</div>
            <div class="image">
                <img src="./Web/img9.png" width="150px" height="40px"></div>
        </div>
        <div class="circle">
            <div class="txt"> USER MANAGEMENT</div>
           <a href="user_management.php"> <div class="image">
                <img src="./Web/img10.png" width="150px" height="40px"></div>
        </div></a>
        <div class="circle">
            <div class="txt">CONTENT MANAGEMENT</div>
            <div class="image">
                <img src="./Web/img11.png" width="150px" height="40px"></div>
        </div>
        <div class="circle">
            <div class="txt">MONITERING & MAINTENSE</div>
            <div class="image">
                <img src="./Web/img12.png" width="150px" height="40px"></div>
        </div>
    </div>

     <!-- footer -->
     <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4>company</h4>
                    <ul>
                        <li><a href="#">about us</a></li>
                        <li><a href="#">our services</a></li>
                        <li><a href="#">privacy policy</a></li>
                        <li><a href="#">afflicate program</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>get help</h4>
                    <ul>
                        <li><a href="#">Faq</a></li>
                        <li><a href="#">shipping</a></li>
                        <li><a href="#">order status</a></li>
                        <li><a href="#">return</a></li>
                        <li><a href="#">payment option</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>contact us</h4>
                    <ul>
                        <li><a href="#">011-4323123</a></li>
                        <li><a href="#">011-5645342</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>follow us</h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>


            </div>
        </div>
    </footer>
    <!-- footer -->
</body>
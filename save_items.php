<?php
session_start();
include 'config.php';





if (!isset($_SESSION['customerId']) || !is_numeric($_SESSION['customerId'])) {
    header("Location: error.php?message=Invalid customer ID");
    exit();
}
$customerId = $_SESSION['customerId'];

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['submit'])){

    $Item_name =$_POST['Iname'];
    $catagoery =$_POST['item'];
    $Quantity =$_POST['qty'];
    $Brand_Name =$_POST['brand_name'];
    $price =$_POST['price'];
     
   
if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
  
    $fileName = $_FILES['img']['name'];
    $fileTmpName = $_FILES['img']['tmp_name'];
    $fileSize = $_FILES['img']['size'];
    $fileType = $_FILES['img']['type'];

    $allowedTypes = array('image/jpeg', 'image/png', 'image/gif');
    if (!in_array($fileType, $allowedTypes)) {
        echo "Invalid file type. Only JPEG, PNG, and GIF files are allowed.";
        exit;
    }

   
    $targetDir = "./imagesave/"; 
    $targetFilePath = $targetDir . $fileName;
    if (move_uploaded_file($fileTmpName, $targetFilePath)) {
     

        

         
            $insertSQL1 = "INSERT INTO items(catagorey, item_name,qty,brand_name, price,image,user_id) VALUES (?, ?, ?, ?, ?,?,?)";
            $insertStatement1 = $connection->prepare($insertSQL1);
            $insertStatement1->bind_param("ssisisi",   $catagoery,  $Item_name, $Quantity,  $Brand_Name,  $price, $fileName,$customerId); // Bind the parameters
    
           
            if ($insertStatement1->execute()) {
                echo "<script>alert(' successfully!');</script>";
                header("Location: inventry.php");
            } else {
                echo "Error " . $insertStatement1->error;
            }

       
        
          
        } else {
            echo "Item not found";
        }
    } else {
        echo "Error uploading file.";
    }

}


$connection->close();
?>

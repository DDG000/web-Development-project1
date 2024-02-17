<?php
session_start();


include 'config.php';


if (!isset($_SESSION['customerId']) || !is_numeric($_SESSION['customerId'])) {
    header("Location: error.php?message=Invalid customer ID");
    exit();
}
$customerId = $_SESSION['customerId'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

 
    if (isset($_FILES['profile_image'])) {
        $file = $_FILES['profile_image'];
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];

        
        if ($file_error === 0) {
        
            $file_destination = './imagesave/' . $file_name;
            if (move_uploaded_file($file_tmp, $file_destination)) {
              
                $sql = "UPDATE profilephoto SET image='$file_destination' WHERE id=$customerId";
                if (!mysqli_query($connection, $sql)) {
                    echo "Error updating profile image: " . mysqli_error($connection);
                }
            } else {
                echo "Error moving uploaded file";
            }
        } else {
            echo "Error uploading file";
        }
    } else {
        echo "No file uploaded";
    }

   
    if (isset($_POST['first_Name']) && isset($_POST['last_Name']) && isset($_POST['email']) && isset($_POST['telephone'])) {
        $firstname = mysqli_real_escape_string($connection, $_POST['first_Name']);
        $lastname = mysqli_real_escape_string($connection, $_POST['last_Name']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $telephone = mysqli_real_escape_string($connection, $_POST['telephone']);

   
        $sql = "UPDATE customer_information1 SET first_Name='$firstname', last_Name='$lastname', email='$email', telephone='$telephone' WHERE id=$customerId";
        if (mysqli_query($connection, $sql)) {
            echo "Profile updated successfully";
            header("Location: viewprofile.php"); 
            exit();
        } else {
            echo "Error updating profile: " . mysqli_error($connection);
        }
    } else {
        echo "All fields are required";
    }
}
?>

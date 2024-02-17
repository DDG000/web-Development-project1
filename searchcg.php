<?php
include 'config.php';

$data = []; // Initialize $data to avoid potential warnings
$searchMessage = ""; // Initialize search message

    $ctg = $_GET['search'];

    // Prepared statement to prevent SQL injection
    $sql = "SELECT items.image, items.item_name AS name, items.price
            FROM items WHERE catagorey LIKE ?";
    $stmt = $connection->prepare($sql);
    $searchTerm = "%$ctg%"; // Adding wildcards to search for partial matches
    $stmt->bind_param("s", $searchTerm);

    // Execute the query
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        } else {
           echo '<script> alert("Search Item Not Available");</script>'
           ;

           header("Location: HomePage.html");
        }
    } else {
        echo "Error executing query: " . $stmt->error;
    }
    $stmt->close();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heart cart</title>
    <link rel="stylesheet" href="styles1.css">
</head>
<body>
    <nav>
        <div class="logo">
            <img src="image/logo.jpg" alt="Healthcare Pharmacy">
        </div>
        <div class="logo-text">
            <p>QUEENSWAY</p>
        </div>
        
        <form method="POST" action="">
            <div class="search-bar">
                <input type="text" name="search" placeholder="Search...">
                <button type="submit" name="sub">Search</button>
            </div>
        </form>
       
        <div class="nav-buttons">
            <a href="#">Home</a>
            <button id="toggle-cart">
                <img src="image/carticon.jpg" alt="Cart">
                <span id="cart-item-count">0</span> 
            </button>
        </div>
    </nav>

    <main>
        <div class="product-container">
        <a href="HomePage.html"><img src="image/back1.jpg"  style="width: 50px;height: 50px;float: left; "></a>
        <?php
foreach ($data as $row) {
    echo "
    <div class='product'>
        <img src='./imagesave/" . $row["image"] . "' alt='Product Image'>
        <h3>" . $row["name"] . "</h3>
        <p>" . $row["price"] . "</p>
        <h4>In Stock</h4>
        <button class='add-to-cart' data-name='" . $row["name"] . "' data-price='" . $row["price"] . "'>Add to Cart</button>
    </div>
    ";
}
?>

        </div>
    </main>

    <aside class="cart-container" id="cart-container">
        <h2>Shopping Cart</h2>
        <ul id="cart-items"></ul>
        <p>Total: LKR<span id="cart-total">0.00</span></p>
        <br>
        <button id="clear-cart">Clear Cart</button>
        <button id="hide-cart">Hide Cart</button>
        <div> <button id="checkout">Proceed to Checkout</button></div>
    </aside>

    <script src="script1.js"></script>
</body>
</html>

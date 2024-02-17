<?php
include 'config.php';


$stmt = $connection->prepare("SELECT news.news_id, news.created_at, news.news, customer_information1.first_Name, news.ID, job_roles.role
                                 FROM news
                                 JOIN customer_information1 ON news.ID = customer_information1.id
                                 JOIN job_roles ON news.ID = job_roles.ID");

$stmt->execute();
$result = $stmt->get_result();


$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

?>




<!DOCTYPE html>
    <html lang="en">
    <head>
      <title>Job Dashboard | By Code Info</title>
     
     
      <link rel="stylesheet" href="News.css" />
      <meta http-equiv="refresh" content="30">

      <script>
        
      </script>
    </head>
    <body>
      <div class="container">
        <nav>
          <div class="navbar">
            <div class="logo">
              <img src="/pic/logo.jpg" alt="">
              
            </div>
            <ul>
              <li><a href="#">
                <i class="fas fa-user"></i>
                <span class="nav-item">Dashboard</span>
              </a>
              </li>
              <li><a href="#">
                <i class="fas fa-chart-bar"></i>
               <a href="News2.php"> <span class="nav-item">Send Massage</span></a>
              </a>


              <li><a href="#" class="logout">
                <i class="fas fa-sign-out-alt"></i>
               <span class="nav-item">Back</span>
              </a>
              </li>
            </ul>
          </div>
        </nav>
    
        <section class="main">
          <div class="main-top">
            <p>Queensway Phamacy</p>
          </div>
          <div class="main-body">
            <h1>Share Alerts</h1>
          
          <div class="search_bar">
            <input type="search" placeholder="Search ...">
            <select name="" id="myselect">
              <option value ="option1"  >Today</option>
              <option value = "option2">Last Three Days</option>
              <option value = "option3">Week</option>
              <option value = "option3">Month</option>
            
            </select>
           <button type="button" class ="button1" >Display</button>
          </div>
    

          <div class="row">
            <p>There are more than <span>400</span> News</p>
            
          </div>
    

            <?php if ($result->num_rows > 0) : ?>
    <?php foreach ($result as $row) : ?>

      <div class="job_card">
  <div class="job_salary">
    <div class="news_item">
      
        <h3>ID: <?php echo $row['ID']; ?></h3><br>
        <h3>Name: <?php echo $row['first_Name']; ?></h3><br>
        <h3>Position: <?php echo $row['role']; ?></h3><br><br>
        <h3>Time : <?php echo $row['created_at']; ?></h3>
      </div>

      <div class="message-box">
        <p class="message"><?php echo $row['news']; ?></p>
      </div>
    
  </div>
</div>


    <?php endforeach; ?>

<?php else : ?>
    <p>No news found.</p>
<?php endif; ?>


        </div>
        </section>
      </div>
    
    </body>
    </html></span>

<!-- //algorithm -->

<html>

<head>
   
    <link rel="stylesheet" href="assets\css\style.css">
    
    <link rel="stylesheet" href="https://www.phptutorial.net/app/css/style.css">
    <link rel="stylesheet" href="assets\css\userdetails.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">



</head>

<body>
    
            
            
            

            
                
  <div class="profile-row">
            <p class="profile-info"> Total Sales</p>
 <div class="table-container">
            <table class="table table-bordered">
                <tr>
                    <th>Id</th>
                    <th>Product Name</th>
                    <th> Image</th>
                    <th>Quantity</th>
                    

                </tr>

                <?php
                     $servername = "localhost";
                     $username = "root";
                     $password = "";
                     $database = "shop_db";
                     $conn = new mysqli($servername, $username, $password, $database);
                $sqlQuery = "select * from cart";
                $results = $conn->query($sqlQuery);
                if ($results->num_rows > 0) {
                    while ($data = mysqli_fetch_assoc($results)) {
                ?>
                        <tr>
                            <td><?php echo $data['user_id']; ?></td>
                            <td><?php echo $data['name']; ?></td>
                            <td><img src="uploaded_img/<?php echo $data['image']; ?>" height="50" width="50"></td>
                            <!-- <td><img src="<?= $data['image']; ?>" height="50" width="50"></td> -->
                             <td><?php echo $data['quantity']; ?></td>
                             <td><?php echo $data['price']; ?></td>
                           
                        </tr>
                <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
    </div>
    </div>
</body>

</html>
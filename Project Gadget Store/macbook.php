<?php
	session_start();
	require_once("connection.php");
	
	//read from database from iphone table
	$query1 = "select m.img,p.model,p.price,m.display,m.chip,m.cpu,m.gpu,m.memory,m.ssd,m.camera,m.biometrics,m.weight,m.color from macbook AS m inner join product AS p on m.pid=p.PID";
	$data1 = mysqli_query($con, $query1); 

	?>


<!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>Laptop</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="products.css">

</head>
<body>
<!-- NAVIGATION -->
<nav class="navbar navbar-expand-lg navbar-light bg-light py-3 fixed-top">
    <div class="container-fluid">
        <img src="image/logo2.jpg" width = "40" height = "40"alt="">
        <!-- NAME -->
        Gadget Store
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link"  href="homepage.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="iphone.php">Phone</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="macbook.php" style="color: gray">Laptop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="ipad.php">Tab</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="watch.php">Watch</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="airpods.php">AirPods</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="accessories.php">Accessories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="login.php">Account</a>
                </li>
                <li class="nav-item">
                    <form method="post">
                        <div class= "searchBox">
                          <input type="text" class= "searchText" name="search" placeholder = "Type to search...">
                          <a href = "#" class = "searchBtn"><i class="far fa-search"></i></a>
						</form>
							<?php	
							if($_SERVER['REQUEST_METHOD'] == "POST")
								{
									//something was posted
									$device=$_POST['search'];
									$iphone="iphone";
									$macbook="macbook";
									$ipad="ipad";
									$airpods="airpods";
									$watch="watch";
									$accessories="accessories";
									if($device === $iphone){
										header("Location: iphone.php");
										die;
									}
									elseif($device === $macbook){
										header("Location: macbook.php");
										die;
									}
									elseif($device === $ipad){
										header("Location: ipad.php");
										die;
									}
									elseif($device === $airpods){
										header("Location: airpods.php");
										die;
									}
									elseif($device === $watch){
										header("Location: watch.php");
										die;
									}
									elseif($device === $accessories){
										header("Location: accessories.php");
										die;
									}
								}	
							?>
                        </div>
                  </li>
                  <!-- <li class="nav-item">
                    <i class="far fa-shopping-bag"></i>
                  </li> -->
            </ul>
        </div>
    </div>
</nav>

<div class="categories">
    <h2 class="title">Laptops</h2>
    <div class="small-container">
        <div class="row">
            <?php
				if(mysqli_num_rows($data1)>0){
					while($result = mysqli_fetch_array($data1)){?>
            <div style="padding-top: 20px" class="col-3">
			
                <img src=<?php echo $result[0]; ?> alt="">
                <h4><?php echo $result[1]; ?> </h4>
                <p>৳  <?php echo $result[2]; ?>/- </p>
                <p class="desc">
                    <?php echo $result[3]; ?> <br>
                    <?php echo $result[4]; ?> <br>
                    <?php echo $result[5]; ?> <br>
                    <?php echo $result[6]; ?> <br>
                    <?php echo $result[7]; ?> <br>
                    <?php echo $result[8]; ?>  <br>
                    <?php echo $result[9]; ?>  <br>
                    <?php echo $result[10]; ?> <br>
                    <?php echo $result[11]; ?> <br>
                    <?php echo $result[12]; ?> 
                </p>
            </div>
			<?php
			
						}
					}
					?>
           
            
        </div>
    </div>
</div>

<footer class="mt-5 py-5">
        <div class="row ">
            <div class="footer-one col-lg-12 col-md-6 col-12">
                <p style="text-align: center; color: white; font-size: 30px">Gadget Store Bangladesh</p>

            </div>
        </div>
        <div class="row container mx-auto pt-5">
            <div class="footer-one col-lg-12 col-md-6 col-12">
                <center>
                    <a href="https://www.facebook.com/"><img src="image/facebook.png" alt="" width="100"></a>
                    <a href="https://www.instagram.com/"><img src="image/logo-instagram-png-41284.png" alt="" width="70"></a>
                    <a href="https://www.twitter.com/"><img src="image/twitter-512.png" alt="" width="80"></i></a>
                </center>

                <h5 class="pb-2">Contact Us</h5>
                <div>
                    <h6 class="text-uppercase">Address</h6>
                    <p style = "text-align: center; color: white;">Bashundhara City Shopping Complex, Panthapath, Dhaka-1205</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Phone</h6>
                    <p style = "text-align: center; color: white;">Customer Service: 09678-666777</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Email</h6>
                    <p style = "text-align: center; color: white;">contact@admin.com.bd</p>
                </div>
            </div>

        </div>
        <div class="copywrite mt-5">
            <div class="row container mx-auto">
                <div class="col-lg-12 col-md-6 col-12 text-nowrap">
                    <p>Prices and offers are subject to change. © 2022. All Rights Reserved.  </p>
                </div>

            </div>

        </div>
    </footer>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html></title>
</head>
<body>

</body>
</html>
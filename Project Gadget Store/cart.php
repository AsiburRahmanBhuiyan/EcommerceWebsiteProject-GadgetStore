<?php
session_start();
	require_once("connection.php");
		
	$query1="SELECT pid,model,price,subprice,quantity from temp where pid!='NULL'";
	$data1=mysqli_query($con, $query1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>

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
                        <a class="nav-link"  href="admin_homepage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="admin_iphone.php">Phone</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="admin_macbook.php">Laptop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="admin_ipad.php" style="color: gray;">Tab</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="admin_watch.php">Watch</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="admin_airpods.php">TWS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="admin_accessories.php">Accessories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="user_profile.php">User</a>
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
										header("Location: admin_iphone.php");
										die;
									}
									elseif($device === $macbook){
										header("Location: admin_macbook.php");
										die;
									}
									elseif($device === $ipad){
										header("Location: admin_ipad.php");
										die;
									}
									elseif($device === $airpods){
										header("Location: admin_airpods.php");
										die;
									}
									elseif($device === $watch){
										header("Location: admin_watch.php");
										die;
									}
									elseif($device === $accessories){
										header("Location: admin_accessories.php");
										die;
									}
								}	
							?>
                      </li>
                      <li class="nav-item">
                        <a href = "cart-viewer.php"><i class="far fa-shopping-bag"></i></a>
                      </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="categories">
        <h2 class="title">Cart</h2>
        <div class="small-container cart-page">
            <!-- TABLE -->
			<table>
				<tr>
					<th>Product ID</th>
					<th>Quantity</th>
					<th>	</th>
					<th>	</th>
					<th>Product</th>
					<th>Subtotal</th>
				</tr>
                <!-- FIXME: Example Product 1 -->
				<?php
				if(mysqli_num_rows($data1)>0){
					
					while($result = mysqli_fetch_array($data1)){
						?>
				
				<tr>	
					<td><?php echo $result[0]; ?></td> <!-- Product ID here -->
					
					
					<td>
				
					<center><?php echo $result[4]; ?><br>
					<form method="get">
                    <a href="cart.php?quan=<?php echo $result['pid'];?>" class="modbtn"> <center>Change quantity</center> </a>
					</form>
					<?php
					if(isset($_GET['quan'])){
						$pid=$_GET['quan'];	
						$pr="SELECT * from temp where pid='$pid'";
						$prod=mysqli_query($con,$pr);
						$re=mysqli_fetch_array($prod);
					?>
					<form method="post">
					<input id="text" type="number" name="quantity" value="">				<!-- Quantity here -->
					<span data-placeholder="quantity"></span></center>
					</td>
					
					<?php }?>
					<td>
					<input id="button" type="submit" class="signbtn" name="confirm" value="Confirm Product" style="height: 30px; "><br>
					<?php
					if (isset($_POST['confirm'])){
						$quantity=$_POST['quantity'];
						$sub=$re[2]*$quantity;
						$q="UPDATE temp set subprice='$sub',quantity='$quantity' where pid='$re[0]'";
						$x=mysqli_query($con,$q);
						header("Location: cart.php");	
						
						
				}
				?>
					<form method="get">
                    <a href="buy.php?remove=<?php echo $result['pid'];?>" class="modbtn"> <center>Remove</center> </a>
					</form></td><br>
					</form>
					
					
					<td>
					<td>
                        <div class="cart-info">
                            <div>
                                <br>
                                <p style="text-align: left; font-size: 20px;"><b><?php echo $result[1]; ?> </b></p> <!-- Model name here -->
                                <p> ৳   <?php echo $result[2]; ?>/-</p> <!-- Unit Price here -->
                                  
                            </div>
                    </td>   
					<td>৳  <?php echo $result[3]; ?>/- </td> <!-- TODO: Subtotal = Price x Quantity here -->
				</tr>
				<?php
				}}
				?>
                

			</table>
            
            <!-- TOTAL -->
            <div class="total-price">
                <table>
                    <tr>
                        <td><?php 
						$tot="select sum(subprice) from temp";
						$d=mysqli_query($con,$tot);
						$res=mysqli_fetch_array($d);
						
						
						?></td>
                    </tr>
                    <tr>
                        <td><b>Total</b> ৳ <?php echo $res[0];?>/- </td> <!-- TODO: Total = Sum of Subtotals * 32% of Subtotals -->
                        
                    </tr>
                    <tr>
					<form method="get">
                        <td><a href="buy.php?tot=<?php echo $res[0]?>" class="purbtn"><center>Confirm Purchase</center></a></td>
                    </form>
					</tr>
                </table>
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
</html>
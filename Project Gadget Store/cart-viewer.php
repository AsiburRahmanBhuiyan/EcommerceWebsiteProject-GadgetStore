<?php
session_start();
	include("connection.php");
	include("functions.php");
	
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$o = $_POST['order_ID'];
		
		if(!empty($o)){
		//read from database from cart table
		
		$query1="SELECT p.pid,q.quantity,m.model,price.price,c.total_cost from pid p,quantity q, model m, price,cart c where c.order_no='$o' and p.pid=q.pid and p.pid=m.pid and p.pid=price.pid and p.order_no='$o' and m.order_no='$o' and q.order_no='$o' and price.order_no='$o'";
		//$query1 = "SELECT x.order_no,x.pid,x.quantity,x.model,x.price,x.total_cost from (SELECT c.order_no, p.pid, q.quantity, m.model, price.price, c.total_cost from cart c, pid p, quantity q, price, model m where c.order_no='$order_ID' and p.order_no='$order_ID' and q.order_no='$order_ID' and price.order_no='$order_ID') as x GROUP BY x.model;" ;
		$data1 = mysqli_query($con, $query1);
		$total1 = mysqli_num_rows($data1);
	}}
	
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart View</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="products.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>

</head>

<body style="background-image: linear-gradient(ghostwhite, floralwhite)">

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
                        <a class="nav-link"  href="admin_panel.php">Admin</a>
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


    <!-- FORM -->
    
    <form  method = "post" action="#" class="signup-form">
        <h1>Cart Records</h1>

        <div class="txtb">
            <input type="number" name = "order_ID" required>
            <span data-placeholder="Order ID"></span>
        </div>

        <input type="submit" class="cartbtn" value="View">
    </form>

    <script src="main.js" type="text/javascript"></script>



    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <!-- Table headers for carts -->

    <div class="categories">
        <h2 class="title">Cart</h2>
        <div class="small-container cart-page">
            <!-- TABLE -->
			<table>
				<tr>
					<th>Order ID</th>
					<th>Product ID</th>
					<th>Quantity</th>
					<th>Product Model</th>
					<th>Amount</th>
				</tr>
				
				<?php
			if(mysqli_num_rows($data1)>0){
			while($result = mysqli_fetch_array($data1)){
			
				$orderID = $o;
				$pid = $result[0];
				$quantity = $result[1];
				$model = $result[2];
				$price = $result[3];
				$totalCost = $result[4];
			?>
                <tr>
                    <!--table data here -->
                    <td><?php echo $orderID; ?></td>
                    <td><?php echo $pid; ?></td>
                    <td><?php echo $quantity; ?></td>
                    <td><?php echo $model; ?></td>
                    <td>৳ <?php echo $price; ?>/-</td>
                </tr>
				<?php
					}
	}
		?>
            </table>
		</div>
		
        <h3><p align="right"><b>Total Bill: </b>৳  <?php echo $totalCost; ?>/-</p></h3>
		
            
		
    </div>
</body>
</html>

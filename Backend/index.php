<?php include 'includes/session.php'; ?>

<?php include 'includes/header.php'; ?>
<link href="https://fonts.googleapis.com/css2?family=Poppins&family=Varela+Round&display=swap" rel="stylesheet">
<body class="hold-transition skin-blue layout-top-nav">
	<style>
		.row{
    		display: flex;
    		align-items: center;
    		flex-wrap: wrap;
    		justify-content: space-between;
		}
		.header{
    		/* background: radial-gradient(#f3d4d4,#fff); */
		}
		.container p{
			/* font-family: 'Poppins', sans-serif; */
    		text-align: left;
    		font-weight: 500;
    		font-size: 16px;
			/* font-weight:400; */
		}
		.container{
			font-family: 'Poppins', sans-serif;

    		max-width: 1300px;
    		margin: auto;
    		padding-left: 25px;
    		padding-right: 25px;
		}
		.col-2{
    		flex-basis: 50%;
    		min-width: 300px;
		}
		.col-2 img{
    		max-width: 100%;
    		padding: 50px 0;
		}

		.col-2 h1{
			font-family: 'Poppins', sans-serif;
			font-weight:1000;
    		font-size: 50px;
    		line-height: 60px;
    		margin:25px 0 ;
		}
		p{
			color: #555;
    		margin-top: 3px;
		}

		.title{
			font-weight:600;
    		text-align: center;
   			margin: 25px auto ;
    		position: relative;
    		line-height: 60px;
    		color: #FA8072;
		}
		/* .title::after{
    		content: '';
    		background:#CD5C5C;
    		width: 80px;
    		height: 5px;
    		border-radius: 5px;
    		position: absolute;
    		bottom: 0;
    		/* left: 50%;
    		transform: translateX(-50%); */
			float: left;
		} */

	</style>
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    
		<div class="header">
		<div class="container">
		<div class="row">
		<div class="col-2">
                <img src="images\front.webp"  >
        </div>
        <div class="col-2">
            <h1>Get yourself a Cap<br> Wear Hats with Style!</h1>
            <p> We provide best deals on caps.Get branded or no branded caps as your requirements, Get your self a stylish cap on era of fashion.</p>
        </div>
    </div>
	</div>

	    </div>
		

		<h2 class="title">On Trend</h2>

	  <?php
		       			
		       			$conn = $pdo->open();

		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 6");
						    $stmt->execute();
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row' style='background:#33FFAF; margin:0 25px; border-radius:5px; padding:20px 0 20px 60px;'>";
	       						echo "
	       							<div class='col-sm-4'>
	       								<div class='box box-solid' style = ' width:290px;'>
		       								<div class='box-body prod-body'style=''>
		       									<img src='".$image."' width='100%' height='230px' class='thumbnail'>
		       									<h5><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h5>
		       								</div>
		       								<div class='box-footer'>
		       									<b>Rs. ".number_format($row['price'], 2)."</b>
		       								</div>
	       								</div>
	       							</div>
	       						";
	       						if($inc == 3) echo "</div>";
						    }
						    if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
							if($inc == 2) echo "<div class='col-sm-4'></div></div>";
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?> 

  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>
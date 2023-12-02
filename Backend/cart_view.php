<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<?php
$conn = $pdo->open();



if(isset($_SESSION['user'])){
	if(isset($_SESSION['cart'])){
		foreach($_SESSION['cart'] as $row){
			$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM cart WHERE user_id=:user_id AND product_id=:product_id");
			$stmt->execute(['user_id'=>$user['id'], 'product_id'=>$row['productid']]);
			$crow = $stmt->fetch();
			if($crow['numrows'] < 1){
				$stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
				$stmt->execute(['user_id'=>$user['id'], 'product_id'=>$row['productid'], 'quantity'=>$row['quantity']]);
			}
			else{
				$stmt = $conn->prepare("UPDATE cart SET quantity=:quantity WHERE user_id=:user_id AND product_id=:product_id");
				$stmt->execute(['quantity'=>$row['quantity'], 'user_id'=>$user['id'], 'product_id'=>$row['productid']]);
			}
		}
		unset($_SESSION['cart']);
	}

	try{
		$total = 0;
		$stmt = $conn->prepare("SELECT *, cart.id AS cartid FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE user_id=:user");
		$stmt->execute(['user'=>$user['id']]);
		foreach($stmt as $row){
			$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
			$subtotal = $row['price']*$row['quantity'];
			$total += $subtotal;
			$name = $row['name'];
			$quantity = $row['quantity'];
			$pic = $row['photo'];
			$price = $row['price'];
			$p_id =  $row['id'];
		}

	}
	catch(PDOException $e){
		$output .= $e->getMessage();
	}

}
else{
	if(count($_SESSION['cart']) != 0){
		$total = 0;
		foreach($_SESSION['cart'] as $row){
			$stmt = $conn->prepare("SELECT *, products.name AS prodname FROM products WHERE products.id=:id");
			$stmt->execute(['id'=>$row['productid']]);
			$product = $stmt->fetch();
			$image = (!empty($product['photo'])) ? 'images/'.$product['photo'] : 'images/noimage.jpg';
			$subtotal = $product['price']*$row['quantity'];
			$total += $subtotal;	
			$quantity = $row['quantity'];
			$name = $product['name'];
			$pic = $product['photo'];
			$price = $product['price'];


				
		}
	}
	

	
}
?>

<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
			
	        <div class="row">
	        	<div class="col-sm-9">
	        		<h1 class="page-header">YOUR CART</h1>
					<?php 
			if(isset($_GET['good'])){
				echo '<div id="message" class="classname" style="background:lightgreen; padding:8px 7px;border-left:4px solid green;margin-bottom:12px;"><span style="font-size:17px;font-weight:600;">'.$_GET['good'].'</span></div>';
			}
			elseif(isset($_GET['bad'])){
				echo '<div id="message" class="classname" style="background:#ff4444; color:white;padding:8px 7px;border-left:4px solid red;margin-bottom:12px;"><span style="font-size:17px;font-weight:600;">'.$_GET['bad'].'</span></div>';
			}
			?>
	        		<div class="box box-solid">
	        			<div class="box-body">										
		        		<table class="table table-bordered">
		        			<thead>
		        				<th></th>
		        				<th>Photo</th>
		        				<th>Name</th>
		        				<th>Price</th>
		        				<th width="20%">Quantity</th>
		        				<th>Subtotal</th>
		        			</thead>
		        			<tbody id="tbody">
		        			</tbody>
		        		</table>
	        			</div>
	        		</div>

    <div class="containers" style="padding:16px 18px 5px 18px;margin:12px 0px;width: 100%;height: 550px;border-radius: 3px;background: #ffffff;">
        <div class="space" style="font-size:24px;font-weight: bold; display:flex;">
        <div style=" border-left: 3px solid red;height: 30px;"class="vl"></div>&nbsp;&nbsp;<p>BILLING DETAILS</p>
    </div>
<?php 
$msg = "No"; 
?>
						<!-- if(isset($_SESSION['user'])){
							echo "https://uat.esewa.com.np/epay/main";
							if(isset($_POST["Submit"])){
								if($_POST['method']=="Esewa"){
									echo "esewa.php";
								}
								else{
									echo "cart_post.php";
								}
							}
						}
						else{
							echo "login.php?msg=$msg"; } -->
    <form action= <?php if(isset($_SESSION['user'])){
							echo "cart_post.php";
						}
						else{
							echo "login.php?msg=$msg";
						} ?> method="POST">
        <div class="name1">
                <label for="f_Name" class="label" style="color:black;
				display:block; text-align: left;font-size: 18px;" >Full NAME <span style="color:#ff0000; font-size:13px">*</span></label>
                <input autocomplete = "off" type="text" name="name" class="name"  style=" outline: none;border: 1px rgb(209, 206, 206) solid;background: #f5f5f5;height:35px;border-radius: 3px;width:100%;padding: 10px 12px;font-size: 16px;color:black;font-family: 'Varela Round', sans-serif;" required>
            </div>
            <div class="input-section" style="margin-top:18px;">
                <label for="p_Number" class="label" style="color:black;
				display:block;text-align: left;font-size: 18px;">PHONE NUMBER <span style="color:#ff0000; font-size:13px">*</span></label>
                <input autocomplete = "off" type="text" name="number" class="inputs" style=" outline: none;border: 1px rgb(209, 206, 206) solid;background: #f5f5f5;height:35px;border-radius: 3px;width:100%;padding: 10px 12px;font-size: 16px;color:black;font-family: 'Varela Round', sans-serif;" required>
            </div>
            <div class="input-section" style="margin-top:18px;">
                <label for="Address" class="label" style="color:black;display:block;text-align: left;font-size: 18px;">ADDRESS <span style="color:#ff0000; font-size:13px">*</span></label>
                <input autocomplete = "off" type="text" name="address" class="inputs" style=" outline: none;border: 1px rgb(209, 206, 206) solid;;background: #f5f5f5;height:35px;border-radius: 3px;width:100%;padding: 10px 12px;font-size: 16px;color:black;font-family: 'Varela Round', sans-serif;" required>
            </div>     
            <div class="input-section" style="margin-top:20px;">
                <label for="Email" class="label" style="color:black;display:block;text-align: left;font-size: 18px;">EMAIL <span style="color:#ff0000; font-size:13px">*</span></label>
                <input autocomplete = "off" type="email" name="email" class="inputs" style=" outline: none;border: 1px rgb(209, 206, 206) solid;;background: #f5f5f5;height:35px;border-radius: 3px;width:100%;padding: 10px 12px;font-size: 16px;color:black;font-family: 'Varela Round', sans-serif;" required>
            </div>
			<input type="hidden" id="custId" name="product" value="<?php echo $name;?> ">

			<br>
            <div class="radio" style="margin-left:0;font-size: 16px;">
                <label for="Method" class="label" style="color:black; display:block;font-weight: bold; text-align: left; font-size: 18px;">Payment Method <span style="color:#ff0000; font-size:13px">*</span></label>
            </div>
			

			<input type="hidden" name="photo" value="<?php echo $pic?>">
			<input type="hidden" name="price" value="<?php echo $price?>">
			<input type="hidden" name="quantity" value="<?php echo $quantity;?>">
			<input type="hidden"  name="total" value="<?php echo $total;?>">
			<input type="hidden" name="id" value="<?php echo $user['id'];?>">
			<input type="hidden" name="pid" value="<?php echo $p_id;?>">
			
            <div class="button" style="margin:3px auto;">
                <input type="submit" style="width: 180px;height: 35px;font-weight: 500;font-size: 16px;background: #333333;border-radius: 3px;color: white;border: none;cursor: pointer;" name="method" value="Cash On Delivery">
				<input type="submit" style="margin-left:20px;width: 180px;height: 35px;font-weight: 500;font-size: 16px;background: #333333;border-radius: 3px;color: white;border: none;cursor: pointer;"name = "Submit" form="myform" value="Esewa"/>
				<input type="submit" id="khalti-success" style="border:none;background:#ffffff;color:red;visibility:hidden;" name="method" value="Khalti Paid" >
				
			</div>
			
	</form>
	<input type="submit" style="margin-left:405px;bottom:76px;position: absolute;width: 180px;height: 35px;font-weight: 500;font-size: 16px;background: #333333;border-radius: 3px;color: white;border: none;cursor: pointer;"name = "Submit"  value="Khalti" id="payment-button"/>
	<!-- Esewa				 -->
	<form id="myform" method="get" action=<?php if(isset($_SESSION['user'])){
							echo "https://uat.esewa.com.np/epay/main";
						}
						else{
							echo "login.php?msg=$msg";
						} ?>>
						<?php
						$txAmt = (13/100)*$total;
						$service = 10;
						$delivery = 100;
						$tamount = $total + $txAmt + $service + $delivery;
						?>
			<input value="<?php echo $tamount;?>" name="tAmt" type="hidden">
    		<input value="<?php echo $total;?>" name="amt" type="hidden">
    		<input value="<?php echo $txAmt;?>" name="txAmt" type="hidden">
    		<input value="<?php echo $service;?>" name="psc" type="hidden">
    		<input value="<?php echo $delivery;?>" name="pdc" type="hidden">
    		<input value="EPAYTEST" name="scd" type="hidden">
			<?php $good = "Your Order Has Been Placed.";?>
    		<input value="http://cart_view.php?good=<?php echo $good?>" type="hidden" name="su">
    		<input value="http://cart_view.php?bad=<?php echo $bad?>" type="hidden" name="fu">
			<input type="hidden" name="photo" value="<?php echo $pic?>">
			<input type="hidden" name="price" value="<?php echo $price?>">
			<input type="hidden" name="quantity" value="<?php echo $quantity;?>">
			<input type="hidden"  name="total" value="<?php echo $total;?>">
			<input type="hidden" name="id" value="<?php echo $user['id'];?>">
			<input type="hidden" name="pid" value="<?php echo $p_id;?>"> 
	</form>




</div>

	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  	<?php $pdo->close(); ?>
  	<?php include 'includes/footer.php'; ?>
</div>
<?php
$args = http_build_query(array(
  'token' => 'QUao9cqFzxPgvWJNi9aKac',
  'amount'  => 1000
));

$url = "https://khalti.com/api/v2/payment/verify/";

# Make the call using API.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$headers = ['Authorization: Key test_secret_key_749e3d752e6940489635aff31f8b9aff'];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Response
$response = curl_exec($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
?>


<?php include 'includes/scripts.php'; ?>
<script>
var total = 0;
$(function(){
	$(document).on('click', '.cart_delete', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: 'cart_delete.php',
			data: {id:id},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.minus', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		if(qty>1){
			qty--;
		}
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.add', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		qty++;
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	getDetails();
	getTotal();

});

function getDetails(){
	$.ajax({
		type: 'POST',
		url: 'cart_details.php',
		dataType: 'json',
		success: function(response){
			$('#tbody').html(response);
			getCart();
		}
	});
}

function getTotal(){
	$.ajax({
		type: 'POST',
		url: 'cart_total.php',
		dataType: 'json',
		success:function(response){
			total = response;
		}
	});
}
</script>
<!-- Paypal Express -->
<script>
paypal.Button.render({
    env: 'sandbox', // change for production if app is live,

	client: {
        sandbox:    'ASb1ZbVxG5ZFzCWLdYLi_d1-k5rmSjvBZhxP2etCxBKXaJHxPba13JJD_D3dTNriRbAv3Kp_72cgDvaZ',
        //production: 'AaBHKJFEej4V6yaArjzSx9cuf-UYesQYKqynQVCdBlKuZKawDDzFyuQdidPOBSGEhWaNQnnvfzuFB9SM'
    },

    commit: true, // Show a 'Psay Now' button

    style: {
    	color: 'gold',
    	size: 'small'
    },

    payment: function(data, actions) {
        return actions.payment.create({
            payment: {
                transactions: [
                    {
                    	//total purchase
                        amount: { 
                        	total: total, 
                        	currency: 'USD' 
                        }
                    }
                ]
            }
        });
    },
	
    onAuthorize: function(data, actions) {
        return actions.payment.execute().then(function(payment) {
			window.location = 'sales.php?pay='+payment.id;
        });
    },

}, '#paypal-button');
</script>
    <!-- Place this where you need payment button -->
    <!-- Paste this code anywhere in you body tag -->
	<script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
    <script>
        var config = {
            // replace the publicKey with yours
            "publicKey": "test_public_key_ffb39d9c20614e5c89d6157f4bb0219a",
            "productIdentity": "1234567890",
            "productName": "Dragon",
            "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
            "paymentPreference": [
                "KHALTI",
                "EBANKING",
                "MOBILE_BANKING",
                "CONNECT_IPS",
                "SCT",
                ],
            "eventHandler": {
                onSuccess (payload) {
                    // hit merchant api for initiating verfication
					var button = document.getElementById('khalti-success');
    				button.form.submit();
                    console.log(payload)
                },
                onError (error) {
                    console.log(error);
                },
                onClose () {
                    console.log('widget is closing');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById("payment-button");
        btn.onclick = function () {
            // minimum transaction amount must be 10, i.e 1000 in paisa.
            checkout.show({amount: 1000});
        }
    </script>
<script>
	setTimeout(function() {
    $('#message').remove();
}, 5000); 



</script>
</body>
</html>
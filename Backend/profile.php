<?php include 'includes/session.php'; ?>
<?php
	if(!isset($_SESSION['user'])){
		header('location: index.php');
	}
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='callout callout-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}

	        			if(isset($_SESSION['success'])){
	        				echo "
	        					<div class='callout callout-success'>
	        						".$_SESSION['success']."
	        					</div>
	        				";
	        				unset($_SESSION['success']);
	        			}
	        		?>
	        		<div class="box box-solid">
	        			<div class="box-body">
	        				<div class="col-sm-3">
	        					<img src="<?php echo (!empty($user['photo'])) ? 'images/'.$user['photo'] : 'images/profile.jpg'; ?>" width="100%">
	        				</div>
	        				<div class="col-sm-9">
	        					<div class="row">
	        						<div class="col-sm-3">
	        							<h4>Name:</h4>
	        							<h4>Email:</h4>
	        							<h4>Contact Info:</h4>
	        							<h4>Address:</h4>
	        							<h4>Member Since:</h4>
	        						</div>
	        						<div class="col-sm-9">
	        							<h4><?php echo $user['firstname'].' '.$user['lastname']; ?>
	        								<span class="pull-right">
	        									<a href="#edit" class="btn btn-success btn-flat btn-sm" data-toggle="modal"><i class="fa fa-edit"></i> Edit</a>
	        								</span>
	        							</h4>
	        							<h4><?php echo $user['email']; ?></h4>
	        							<h4><?php echo (!empty($user['contact_info'])) ? $user['contact_info'] : 'N/a'; ?></h4>
	        							<h4><?php echo (!empty($user['address'])) ? $user['address'] : 'N/a'; ?></h4>
	        							<h4><?php echo date('M d, Y', strtotime($user['created_on'])); ?></h4>
	        						</div>
	        					</div>
	        				</div>
	        			</div>
	        		</div>
	        		<div class="box box-solid">
					<?php if(isset($_GET['good'])){
						echo '<div id="message" class="classname" style="background:lightgreen; padding:8px 7px;border-left:4px solid green;margin-bottom:12px;"><span style="font-size:17px;font-weight:600;">'.$_GET['good'].'</span></div>';
			
					}?>
			<?php;?>
	        			<div class="box-header with-border">
	        				<h4 class="box-title"><i class="fa fa-calendar"></i> <b>Pending Products</b></h4>
	        			</div>
	        			<div class="box-body">
	        				<table class="table table-bordered" id="example1" style="text-align:center;">
	        					<thead style="text-align:center;">
	        						<th class="hidden"></th>
	        						<th style="text-align:center;">Date</th>
	        						<th style="text-align:center;">Transaction status</th>
	        						<th style="text-align:center;">Amount</th>
	        						<th style="text-align:center;">Full Details</th>
	        					</thead>
	        					<tbody>
	        					<?php
	        						 $con = mysqli_connect('localhost','root','','ecomm');
									 $id = $user['id'];
									$sql = "SELECT * FROM information WHERE id = $id && status = ''";
									$result = mysqli_query($con,$sql);
									if($result){
										while($row = mysqli_fetch_assoc($result)){
											?>
											<tr>
												<td><?php echo $row['date'];?></td>
												<td><?php if($row['status']==''){echo "Pending";}else{echo $row['status'];}?></td>
												<td><?php echo $row['total'];?></td>
												<td><a href= "view_details.php?sno=<?php echo $row['sno'];?>">View Full Details</a><td>
											</tr>
											<?php
										};
									}

	        					?>
	        					</tbody>
	        				</table>
	        			</div>
	        		</div>
					<div class="box box-solid">
	        			<div class="box-header with-border">
	        				<h4 class="box-title"><i class="fa fa-calendar"></i> <b>Delivered Products</b></h4>
	        			</div>
	        			<div class="box-body">
	        				<table class="table table-bordered" id="example1" style="text-align:center;">
	        					<thead style="text-align:center;">
	        						<th class="hidden"></th>
	        						<th style="text-align:center;">Date</th>
	        						<th style="text-align:center;">Transaction status</th>
	        						<th style="text-align:center;">Amount</th>
	        						<th style="text-align:center;">Full Details</th>
	        					</thead>
	        					<tbody>
	        					<?php
	        						 $con = mysqli_connect('localhost','root','','ecomm');
									 $id = $user['id'];
									$sql = "SELECT * FROM information WHERE id = $id && status = 'Successful'";
									$result = mysqli_query($con,$sql);
									if($result){
										while($row = mysqli_fetch_assoc($result)){
											?>
											<tr>
												<td><?php echo $row['date'];?></td>
												<td><?php if($row['status']==''){echo "Pending";}else{echo $row['status'];}?></td>
												<td><?php echo $row['total'];?></td>
												<td><a href= "view_details.php?sno=<?php echo $row['sno'];?>">View Full Details</a><td>
											</tr>
											<?php
										};
									}

	        					?>
	        					</tbody>
	        				</table>
	        			</div>
	        		</div>
	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
  	<?php include 'includes/profile_modal.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
	$(document).on('click', '.transact', function(e){
		e.preventDefault();
		$('#transaction').modal('show');
		var id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: 'transaction.php',
			data: {id:id},
			dataType: 'json',
			success:function(response){
				$('#date').html(response.date);
				$('#transid').html(response.transaction);
				$('#detail').prepend(response.list);
				$('#total').html(response.total);
			}
		});
	});

	$("#transaction").on("hidden.bs.modal", function () {
	    $('.prepend_items').remove();
	});
});
</script>
<script>
	setTimeout(function() {
    $('#message').remove();
}, 5000); 
</script>
</body>
</html>
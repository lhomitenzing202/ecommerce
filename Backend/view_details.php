<?php include 'includes/session.php'; ?>
<?php
	if(!isset($_SESSION['user'])){
		header('location: index.php');
	}
?>

<?php include 'includes/header.php'; ?>
<style>
    h1{
        font-weight:600;
      }
    .contents{
      border-radius:5px 5px 0 0;
      background: #5b9ad9;
      padding:2px 15px;
    }
    .main_contents{
      border-radius:5px;
      margin:25px auto;
      width:95%;
      background:#dfdfdf;
    }
    h3{
      color:white;
    }
    img{
      width:150px;
      /* border:1px solid black; */
    }
    #img2{
        width:100%;
    }
    .img{
      float:right;

    }
    .desc{
      display: block;
      font-weight:600;
      font-size:14px;
      text-align:center;
    }
    .information{
      padding:10px 20px;
    }
    table td{
      font-size:18px;
      padding:5px;
    }
    .divs{
      
      font-size:20px;
      font-weight:600;
      color:white;
    }
    .grand{
      height:55px;
      padding: 10px 30px;
      background:#708090;
    }
    .contents2{
      border-radius:5px 5px 0 0;
      background:#36ab5f;
      padding:2px 15px;
    }
    b{
      font-weight:600;
    }
    .btn{
      float: right;
    }
    /* .detail p{
        font-size:25px;
    } */
    </style>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
    <?php
        $con = mysqli_connect('localhost','root','','ecomm');
        $sno = $_GET['sno'];
        $sql = "SELECT * FROM information WHERE sno = $sno";
        $result = mysqli_query($con,$sql);
        if($result){
            $row = mysqli_fetch_assoc($result);
            $pid = $row['pid'];
            $sql2 = "SELECT * FROM products WHERE id = $pid";
            $result2 = mysqli_query($con,$sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $cat = $row2['category_id'];
                $sql3 = "SELECT * FROM category WHERE id = $cat";
                $result3 = mysqli_query($con,$sql3);
                $row3 = mysqli_fetch_assoc($result3); 
            
        }
    ?>
    <div class="content-wrapper">
    <section class="content-header">
    </section>
        <div class="main_contents">
        <div class="contents">
        <h3>Order_ID: <?php echo $row['sno'];?></h3>
        </div>
        <div class="information">
          <div class="img">
            <img src = "images/<?php echo $row['photo'];?>" alt="">
            <span class="desc"><?php echo $row['product'];?></span>
          </div>
          <table>
          <tr>
            <td> <b>Product Name </b></td>
            <td> : <?php echo $row['product']; ?>
          </tr>
          <tr>
            <td> <b>Product Price</b> </td>
            <td> : Rs. <?php echo $row['price']; ?>
          </tr>
          <tr>
            <td> <b>Purchase Quantity</b> </td>
            <td> : <?php echo $row['quantity']; ?>
          </tr>
          <tr>
            <td> <b>Purchase Date</b> </td>
            <td> : <?php echo $row['date']; ?>
          </tr>
        </table>
        
        </div>
        <div class="grand">
          <span class="divs">Grand Total : Rs. <?php echo $row['total'];?></span>
          <button class="btn-danger btn " type="submit" form="form1" style="display:<?php if ($row['status']==''){echo "block;";} else {echo "none;";}?>;">Cancel Order</button>
      </div>
      <form action="delete1.php" method="get" id="form1">
        <input type="hidden" name="id" value="<?php echo $row['sno'];?>">
      </form>

    </div>
    <div class="main_contents">
    <div class="contents">
        <h3>Product Details:</h3>
        </div>
    <div class="container">
<!-- Main content -->
<section class="content">
    <div class="row">
      <div class="col-sm-9">
          <div class="callout" id="callout" style="display:none">
              <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
              <span class="message"></span>
          </div>
          <div class="row">
              <div class="col-sm-6">
                  <img id = "img2" src = "images/<?php echo $row['photo'];?>">
                  <br><br>
              </div>
              <div class="col-sm-6 detail" >
                  <h1 style ="font-size:28px;"  class="page-header"><?php echo $row['product']; ?></h1>
                  <h3 style= "color:black;font-size:25px;"><b>Rs. <?php echo $row['price']; ?></b></h3>
                  <p style ="font-size:20px;"><b>Category:</b> <?php echo $row3['name']; ?></a></p>
                  <p style ="font-size:20px;"><b>Description:</b></p>
                  <p style ="font-size:10px;"><?php echo $row2['description']; ?></p>
              </div>
          </div>
          <br>
      </div>
  </div>
</section>

</div>

        
    </div>
    <section class="content-header">
    </section>
    </div>
    
    

  	<?php include 'includes/profile_modal.php'; ?>
      <?php include 'includes/footer.php'; ?>
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
</body>
</html>
<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php
 $con = mysqli_connect('localhost','root','','ecomm');
$id = $_GET['id'];
$sql = "SELECT * FROM information WHERE sno = $id";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);
$sno = $row['sno'];

?>
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
      border:1px solid black;
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
      padding-left:20px;
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
    .btns{
      margin-top:-20px;
      float:right;
      height:35px;
      font-weight:600;
      background-color:<?php 
      if($row['status']==''){
        echo "#dc3545;";
      }
      else {
        echo "#008000;";
      }
      ?>
      color:white;
      outline:none;
      border:none;
      border-radius:3px;
    }
    .btns:hover{
      background:red;
    }
</style>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Order Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sales</li>
      </ol>
      
    </section>
    <div class="main_contents">
      <div class="contents">
        <h3>Order_ID: <?php echo $row['sno'];?></h3>
        </div>
        <div class="information">
          <div class="img">
            <img src = "../images/<?php echo $row['photo'];?>" alt="">
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
        </div>
    </div>
    <div class="main_contents" style="margin-top:-15px;padding-bottom:15px;">
      <div class="contents2">
        <h3>Customer information</h3>
        </div>
        <div class="information">
          <table>
          <tr>
            <td> <b>Customer Name</b> </td>
            <td> : <?php echo $row['name']; ?>
          </tr>
          <tr>
            <td> <b>Phone Number</b> </td>
            <td> : <?php echo $row['phone']; ?>
          </tr>
          <tr>
            <td><b> Email</b> </td>
            <td> : <?php echo $row['email']; ?>
          </tr>
          <tr>
            <td> <b>Address</b> </td>
            <td> : <?php echo $row['address']; ?>
          </tr>
        </table>
        <form action = "update.php" method = "get">
        <input type= "hidden" value = "<?php echo $sno;?>" name="id">
        <button type = "submit" class= "btns" id="button" onclick="color()" value = ""><?php if($row['status']==''){echo "Mark as Delivered";}else{echo "Delivered";}?></button>
        </form>
  </div>

        
        </div>
    </div>
</body>
<?php include 'includes/scripts.php'; ?>
<script>
  function color(){
    const btn = document.getElementById('button');
    btn.innerText = "Delivered";
    btn.style.backgroundColor = "";
  }
  </script>
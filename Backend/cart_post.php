<?php
$con = mysqli_connect('localhost','root','','ecomm');
$name=$_POST['name'];
$number = $_POST['number'];
$address=$_POST['address'];
$email = $_POST['email'];
$product = $_POST['product'];
if($_POST['method']==''){
    $method = "Khalti(Paid)";
}
else{
    $method=$_POST['method'];
}
$photo = $_POST['photo'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$total = $_POST['total'];
$id = $_POST['id'];
$pid = $_POST['pid'];
$sql = "INSERT INTO information (name, phone, address, email, product, method,`photo`,`price`,`quantity`,`total`,`id`,`pid`) VALUES ('$name', '$number', '$address', '$email', '$product', '$method','$photo','$price','$quantity','$total','$id','$pid')";
$result = mysqli_query($con,$sql);
if($result){
    $good = "Your Order Has Been Placed.";
	header("location:cart_view.php?good=$good");

}
else{
    $good = "Your Order is Not Placed";
    header("location:card_view.php?good=$good");
}
?>
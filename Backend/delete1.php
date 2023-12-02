<?php
    $con = mysqli_connect('localhost','root','','ecomm');
    $sno = $_GET['id'];
    $sql="DELETE FROM information WHERE sno = $sno";
    $result = mysqli_query($con,$sql);
    if($result){
        $good = "Your Order Has Been Canceled.";
        header("location:profile.php?good=$good");
    
    }
?>
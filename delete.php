<?php
    $con = mysqli_connect('localhost','root','','ecomm');
    $sno = $_GET['sno'];
    $sql="DELETE FROM information WHERE sno = $sno";
    $result = mysqli_query($con,$sql);
    if($result){
        header("location:sales.php");
    }
?>
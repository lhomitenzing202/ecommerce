<?php
        $con = mysqli_connect('localhost','root','','ecomm');
        $id = $_GET['id'];
        $sql = "UPDATE `information` SET `status` = 'Successful' WHERE `sno` = $id";
        $result = mysqli_query($con,$sql);
        if($result){
            header("location:details.php?id=$id");
        }
?>
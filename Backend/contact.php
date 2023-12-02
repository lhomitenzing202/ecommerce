<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<link href="https://fonts.googleapis.com/css2?family=Poppins&family=Varela+Round&display=swap" rel="stylesheet">
<style>
body{
    font-family: 'Poppins', sans-serif;
}
a{
    text-decoration: none;
    color: #555;
}

p{
    color: #555;
    margin-top: 3px;
}

.container{
    max-width: 1300px;
    margin: auto;
    padding-left: 25px;
    padding-right: 25px;
}

.container .col-1{
    margin: 10px;
    padding: 10px;
    display: flex;
    justify-content: center;
} 

.container p{
    text-align: left;
    font-weight: 500;
    font-size: 16px;
}


.row{
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    justify-content: space-between;
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
    font-size: 50px;
    line-height: 60px;
    margin:25px 0 ;
}

.btn{
    display: inline-block;
    background: #ff523b;
    color:rgb(255, 250, 250);
    padding: 8px 30px;
    margin: 30px 0;
    border-radius: 30px;
    transition: background 0.5s;
}

.btn:hover{
    background:#563434 ;
}

.header{
    /* background: radial-gradient(#f3d4d4,#fff); */
}

.header .row{
    margin-top: 10px;
}

.categories{
    margin: 70px 0;
}

.col-3{
    flex-basis:30%;
    min-width: 250px;
    margin-bottom: 30px;
}

.col-3 img{
    width: 100%;
}

.small-container{
    max-width: 1080px;
    margin: auto;
    padding-left: 25px;
    padding-right: 25px;

}


.col-4{
    flex-basis: 25%;
    padding: 20px;
    min-width: 198px;
    margin-bottom: 50px;
    margin-top: 10px;
    transition: transform 0.5s ;
}

.col-4 img{
    width: 100%;
}

.title{

    text-align: center;
    margin: 0 auto 80px;
    position: relative;
    line-height: 60px;
    color: #FA8072;
    padding:4px;
}

/* .title::after{
    content: '';
    background:#ff523b;
    width: 80px;
    height: 5px;
    border-radius: 5px;
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
} */

h4{
    color: #555;
    font-weight: normal;
    margin-top: 12px;
}

.col-4 p{
    font-size:14px ;
}

.rating .fa{
    color: #ff523b;
}

.col-4:hover{
    transform:translateY(-5px) ;
}

.offer{
    background: radial-gradient(#f3d4d4,#fff);
    margin-top: 80px;
    padding:30px 0; 
}

.col-2 .offer-img{
    padding: 60px;
}

small{
    color: #555;
}

/*------------contact-------------*/

.container .contact i{
    font-size: 50px;
}

</style>
<body class="hold-transition skin-blue layout-top-nav">
<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
        <?php include 'includes/navbar.php'; ?>
        <div class="content-wrapper">
            <div class="header">
                <div class="container">
                <div class="container contact">
        <div class="title">
            <h2>Contact us</h2>
        </div>
        <div class="row">
            <div class="col-1">
                <div class="content">
                <i class="fa fa-envelope-o" > </i>
                <h3>Email</h3>
                <h4>ktmcapseries@gmail.com</h4>
                </div>
            </div>

            <div class="col-1">
                <div class="content">
                <i class="fa fa-phone" > </i>
                <h3>Phone Number</h3>
                <h4>9818858706/01-2231423</h4>
                </div>
            </div>

            <div class="col-1">
                <div class="content">
                <i class="fa fa-location-arrow" > </i>
                <h3>Address</h3>
                <h4>Mangal Bazar, Lalitpur</h4>
                </div>
            </div>

            <div class="col-2">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14133.778689880784!2d85.31618648026739!3d27.672648126245345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19c56e004b3f%3A0xdc3ef252c2febe01!2sMangal%20Bazar!5e0!3m2!1sen!2snp!4v1580364983551!5m2!1sen!2snp" width="1100px" height="600px" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
        </div>
    </div>
                </div>
            </div>
        </div>
        <?php include 'includes/footer.php'; ?>
    <div>   
    <?php include 'includes/scripts.php'; ?>
</body>
</html>
<?php
error_reporting(0);
include('includes/dbcon.php');
include('includes/functions.php');
include('includes/add_to_cart.php');

$sql="select * from categories where status=1 ";
$run=$con->query($sql);

$obj=new add_to_cart();
$totalProduct=$obj->totalProduct();
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>E-com-example ecommerce website</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    

    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Owl Carousel min css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="css/custom.css">


    <!-- Modernizr JS -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    <div class="wrapper">
        <!-- Start Header Style -->
        <header id="htc__header" class="htc__header__area header--one">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="menumenu__container clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5"> 
                                <div class="logo" >
                                     <a href="index.php"><img src="images/logo/4.png" onDblClick="f1()" alt="logo images" ></a>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-7 col-sm-5 col-xs-3">
<!--	start nav bar	-->
                                <nav class="main__menu__nav hidden-xs hidden-sm">
                                    <ul class="main__menu">
                                        <li class="drop"><a href="index.php">Home</a></li>
                                       <?php
										while($data=$run->fetch_assoc())
										{
											?>
												<li><a href="categories.php?id=<?php echo $data['id'];?>"><?php echo $data['name'];?></a></li>
												<?php
										}
											?>
                                        <li><a href="contact.php">contact</a></li>
                                    </ul>
                                </nav>
<!--	End nav bar		-->
<!--	start mobile-view nav bar	-->
                                <div class="mobile-menu clearfix visible-xs visible-sm">
                                    <nav id="mobile_dropdown">
                                        <ul>
                                            <li><a href="index.php">Home</a></li>
                                         <?php
										while($data=$run->fetch_assoc())
										{
											?>
												<li><a href="categories.php?id=<?php echo $data['id'];?>"><?php echo $data['name'];?></a></li>
												<?php
										}
											?>
                                            <li><a href="contact.php">contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
<!--	End mobile-view nav bar	-->
                            </div>
                            <div class="col-md-3 col-lg-3 col-sm-5 col-xs-5">
                                <div class="header__right">
                                    
                                    <div class="header__account">

										<?php if(isset($_SESSION['USER_LOGIN'])){
											echo '<a href="logout.php">Logout</a>  <a href="my_order.php">My Order</a>';
										}else{
											echo '<a href="login.php"><i class="icon-user icons"></i></a>';
										}
										?>
                                    </div>
                                    <div class="htc__shopping__cart">
                                        <a class="cart__menu" href="#"><i class="icon-handbag icons"></i></a>
										<a href="cart.php"><span class="htc__qua"><?php echo $totalProduct; ?></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
            <!-- End Mainmenu Area -->
        </header>
        <!-- End Header Area -->
<script>
	function f1()
	{
		location.replace("admin/index.php");
	}
</script>
<?php 
include('includes/header.php');
include('includes/dbcon.php');
if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']=='yes'){
	?>
<script> 
	window.location.href='index.php';
</script>
<?php
}
$msg="";

if(isset($_POST['login']))
{
$email=$_POST['login_email'];
$password=$_POST['login_password'];
$email_sql="select * from `users` where email='$email'";
$res=$con->query($email_sql);
if($res->num_rows > 0)
{
$sql="select * from `users` where email='$email' and password='$password'";	
$run=$con->query($sql);
if($run->num_rows > 0)
{
	$row=$run->fetch_assoc();
	$_SESSION['USER_LOGIN']='yes';
	$_SESSION['USER_ID']=$row['id'];
	$_SESSION['USER_NAME']=$row['name'];
	?>
<script>
	window.location.href='index.php?userid=<?php echo $row['id']; ?>';
</script>	
<?php
}

	else
	{
		$msg="inserted password is wrong";
	}
}
else
{
	$msg="inserted email is wrong";
}	
}

if(isset($_POST['register']))
{
$name=$_POST['name'];
$email=$_POST['email'];
$mobile=$_POST['mobile'];
$password=$_POST['password'];
$sql="SELECT * FROM `users` where email='$email'";
$run=$con->query($sql);
if($run->num_rows > 0)
{
	$msg="email_present";
}
else
{
	$added_on=date('Y-m-d h:i:s');
	$insert_sql="insert into `users`(name,password,email,mobile,added_on) values('$name','$password','$email','$mobile','$added_on')";
	$run1=$con->query($insert_sql);
	$msg1="registeretion is done, Now you can login";
}
}


?>
<div class="body__overlay"></div>
<!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
           
            <!-- Start Cart Panel -->
            <div class="shopping__cart">
                <div class="shopping__cart__inner">
                    <div class="offsetmenu__close__btn remove__btn1">
                        <a href=""><i class="zmdi zmdi-close"></i></a>
                    </div>
                    <div class="shp__cart__wrap">
						<?php
						$total="";
								if(isset($_SESSION['cart'])){
											foreach($_SESSION['cart'] as $key=>$val){
												$sql1="select * from product where product.status=1 and id='$key' ";
												$run1=$con->query($sql1);
												$data1=$run1->fetch_assoc();	
												$pname=$data1['pname'];
												$price=$data1['price'];
												$image=$data1['image'];
												$qty=$val['qty'];
												$total=$total+($price*$qty);
											?>
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
								
                                <a href="#">
                                    <img src="admin/images/product/<?php echo $image;?>" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href="product.php"><?php echo $pname; ?></a></h2>
                                <span class="quantity">QTY: <?php echo $qty; ?></span>
                                <span class="shp__price"><?php echo $price*$qty." ₹"; ?></span>
                            </div>
                            <div class="remove__btn">
                                <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key;?>','remove')" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                            </div>
                        </div>
                        	<?php 
							} } ?>
						
                    </div>
                    <ul class="shoping__total">
                        <li class="subtotal">Subtotal:</li>
                        <li class="total__price"><?php echo $total." ₹"; ?></li>
                    </ul>
                    <ul class="shopping__btn">
                        <li><a href="cart.php">View Cart</a></li>
                        <li class="shp__checkout"><a href="checkout.html">Checkout</a></li>
                    </ul>
                </div>
            </div>
            <!-- End Cart Panel -->
        </div>
        <!-- End Offset Wrapper -->

<!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(admin/images/slider/291762.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Login/Register</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        
		<!-- Start Contact Area -->
        <section class="htc__contact__area ptb--100 bg__white">
            <div class="container">
                <div class="row">
					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Login</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="login-form" method="post">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="email" name="login_email" id="login_email" placeholder="Your Email*" style="width:100%" required>
										</div>
										<span class="field_error" id="login_email_error"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="password" name="login_password" id="login_password" placeholder="Your Password*" style="width:100%" required>
										</div>
										<span class="field_error" id="login_password_error"></span>
									</div>
									
									<div class="contact-btn">
										<button type="submit" name="login" class="fv-btn" onclick="">Login</button>
									</div>
								</form>
								<div class="form-output login_msg">
									<p class="form-messege field_error"><?php echo $msg; ?></p>
								</div>
							</div>
						</div> 
                
				</div>
				

					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Register</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="register-form" method="post">
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%" required>
										</div>
										<span class="field_error" id="name_error"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="email" name="email" id="email" placeholder="Your Email*" style="width:100%" required>
										</div>
										<span class="field_error" id="email_error"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="tel" name="mobile" id="mobile" max="10" min="10" placeholder="Your Mobile*" style="width:100%" required>
										</div>
										<span class="field_error" id="mobile_error"></span>
									</div>
									<div class="single-contact-form">
										<div class="contact-box name">
											<input type="password" name="password" id="password" placeholder="Your Password*" style="width:100%" required>
										</div>
										<span class="field_error" id="password_error"></span>
									</div>
									
									<div class="contact-btn">
										<button type="submit" name="register" class="fv-btn" >Register</button>
									</div>
								</form>
								<div class="form-output register_msg">
									<p class="form-messege field_error"><?php echo $msg1; ?></p>
								</div>
							</div>
						</div> 
                
				</div>
					
            </div>
        </section>
			
<?php include('includes/footer.php')?>        
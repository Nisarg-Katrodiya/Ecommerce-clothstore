<?php 
include('includes/header.php');
if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0){
	?>
	<script>
		window.location.href='index.php';
	</script>
	<?php
}
$msg="";
$cart_total=0;

if(isset($_POST['submit']))
{
	$user_id=$_SESSION['USER_ID'];
	$address=$_POST['address'];
	$city=$_POST['city'];
	$pincode=$_POST['pin'];
	$state=$_POST['state'];
	$country=$_POST['country'];
	$payment_type=$_POST['payment_type'];
	foreach($_SESSION['cart'] as $key=>$val){
		$sql="select * from product where product.status=1 and id='$key' ";
		$run=$con->query($sql);
		$data=$run->fetch_assoc();
		$price=$data['price'];
		$qty=$val['qty'];
		$cart_total=$cart_total+($price*$qty); 
	}
	$total_price=$cart_total;
	$payment_status='pending';
	if($payment_type=='cod'){
		$payment_status='success';
	}
	$order_status='1';
	$added_on=date('Y-m-d h:i:s');
	$order_sql="insert into `order`(user_id,address,city,pincode,state,country,payment_type,total_price,payment_status,order_status,added_on) values('$user_id','$address','$city','$pincode','$state','$country','$payment_type','$total_price','$payment_status','$order_status','$added_on')";
	$run1=$con->query($order_sql);
	
	$order_id=$con->insert_id;
	
	foreach($_SESSION['cart'] as $key=>$val){
		$sql2="select * from product where product.status=1 and id='$key' ";
		$run2=$con->query($sql2);
		$data2=$run2->fetch_assoc();
		$price=$data2['price'];
		$qty=$val['qty'];
		
		$order_detail="insert into `order_detail`(order_id,product_id,qty,price) values('$order_id','$key','$qty','$price')";
		$run3=$con->query($order_detail);
	}
	
	unset($_SESSION['cart'])
	?>
	<script>
		window.location.href='thank_you.php';
	</script>
	<?php
	
	
}
if(isset($_POST['login']))
{
$email=$_POST['login_email'];
$password=$_POST['login_password'];
$login_sql="select * from `users` where email='$email' and password='$password'";
$login_run=$con->query($login_sql);
if($login_run->num_rows > 0)
{
	$row=$login_run->fetch_assoc();
	$_SESSION['USER_LOGIN']='yes';
	$_SESSION['USER_ID']=$row['id'];
	$_SESSION['USER_NAME']=$row['name'];
	?>
<script>
	window.open('checkout.php?userid=<?php echo $row['id']; ?>','_self');
</script>	
<?php
}
else
{
	$msg="inserted data is wrong";
}
}


if(isset($_POST['register']))
{
$name=$_POST['name'];
$email=$_POST['email'];
$mobile=$_POST['mobile'];
$password=$_POST['password'];
$register_sql="SELECT * FROM `users` where email='$email'";
$register_run=$con->query($register_sql);
if($register_run->num_rows > 0)
{
	$msg="email_present";
}
else
{
	$added_on=date('Y-m-d h:i:s');
	$insert_sql="insert into `users`(name,password,email,mobile,added_on) values('$name','$password','$email','$mobile','$added_on')";
	$insert_run=$con->query($insert_sql);
	$msg="insert";
}
}

?> 

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
                                  <span class="breadcrumb-item active">checkout</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="checkout-wrap ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="checkout__inner">
                            <div class="accordion-list">
                                <div class="accordion">
                                <?php 
									if(!isset($_SESSION['USER_LOGIN']))
									{
									$accordion_class='accordion__hide';
									?>    
									<div class="accordion__title">
                                        Checkout Method
                                    </div>
                                    <div class="accordion__body">
                                        <div class="accordion__body__form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="checkout-method__login">
														<form id="login-form" method="post">
                                                            <h5 class="checkout-method__title">Login</h5>
                                                            <div class="single-input">
                                                                <input type="text" name="login_email" id="login_email" placeholder="Your Email*">
                                                            
																<span class="field_error" id="login_email_error"></span>
															</div>	
                                                            <div class="single-input">
                                                                <input type="password" name="login_password" id="login_password" placeholder="Your Password*">
                                                            
																<span class="field_error" id="login_password_error"></span>
															</div>	
                                                            <p class="require">* Required fields</p>
                                                            <div class="dark-btn">
                                                                <button type="submit" name="login" class="blk-btn" >Login</button>
                                                            </div>
                                                      
														<div class="form-output login_msg">
															<p class="form-messege field_error"><?php echo $msg; ?></p>
														</div>
														</form>	
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="checkout-method__login">
														<form id="register-form" method="post">
                                                            <h5 class="checkout-method__title">Register</h5>
                                                            <div class="single-input">
                                                                <input type="text" name="name" id="name" placeholder="Your Name*"  required>
																<span class="field_error" id="name_error"></span>
															</div>	
															<div class="single-input">
                                                                <input type="text" name="email" id="email" placeholder="Your Email*"  required>
																<span class="field_error" id="email_error"></span>
															</div>
                                                            <div class="single-input">
                                                                <input type="text" name="mobile" id="mobile" placeholder="Your Mobile*" required>
																<span class="field_error" id="mobile_error"></span>
															</div>	
															 <div class="single-input">
                                                                <input type="password" name="password" id="password" placeholder="Your Password*" required>
																<span class="field_error" id="password_error"></span>
															</div>	 
                                                            <div class="dark-btn">
                                                                <button type="submit" name="register" class="blk-btn" >Register</button>
                                                            </div>
                                                        
														<div class="form-output register_msg">
															<p class="form-messege field_error"><?php echo $msg; ?></p>
														</div>
													</form>	
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									<?php }
									else
									{
										$accordion_class='accordion__title';
									}?>
                                    <div class="<?php echo $accordion_class;?>">
                                        Address Information
                                    </div>
									 <form method="POST">
                                    <div class="accordion__body">
                                        <div class="bilinfo">
                                               
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="single-input">
                                                            <input type="text" name="address" placeholder="Address" required>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="city" placeholder="City" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="pin" placeholder="Post code/ zip" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="state" placeholder="State" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="country" placeholder="Country" required>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
									<div class="<?php echo $accordion_class;?>">
											payment information
									</div>
                                    	<div class="accordion__body">
											<div class="paymentinfo">
												<div class="single-method">
													COD <input type="radio" name="payment_type" value="COD" required/>
													&nbsp;&nbsp;PayU <input type="radio" name="payment_type" value="payu" required/>
												</div>
												
											</div>
										</div>
										<button type="submit" name="submit" class="blk-btn" >Submit</button>  
									</form>	
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="order-details">
                            <h5 class="order-details__title">Your Order</h5>
                            <div class="order-details__item">
                                <?php
								$cart_total=0;
								foreach($_SESSION['cart'] as $key=>$val){
								$sql="select * from product where product.status=1 and id='$key' ";
								$run=$con->query($sql);
								$data=$run->fetch_assoc();	
								$pname=$data['pname'];
								$mrp=$data['mrp'];
								$price=$data['price'];
								$image=$data['image'];
								$qty=$val['qty'];
								$cart_total=$cart_total+($price*$qty);
								$service=30;	
								?>
								<div class="single-item">
                                    <div class="single-item__thumb">
                                        <img src="admin/images/product/<?php echo $image?>"  />
                                    </div>
                                    <div class="single-item__content">
                                        <a href="#"><?php echo $pname;?></a>
                                        <span class="price"><?php echo $price*$qty." ₹";?></span>
                                    </div>
                                    <div class="single-item__remove">
                                        <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','remove')"><i class="icon-trash icons"></i></a>
                                    </div>
                                </div>
								<?php } ?>
                            </div>
                            <div class="order-details__count">
                                <div class="order-details__count__single">
                                    <h5>sub total</h5>
                                    <span class="price"><?php echo $cart_total." ₹";?></span>
                                </div>
                                <div class="order-details__count__single">
                                    <h5>Service Tax</h5>
                                    <span class="price"><?php echo $service." ₹";?></span>
                                </div>
                            </div>
                             <div class="ordre-details__total">
                                <h5>Order total</h5>
                                <span class="price"><?php echo $cart_total+$service." ₹";?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cart-main-area end -->
<?php
include('includes/footer.php');
?>
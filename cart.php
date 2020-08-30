<?php 
include('includes/header.php');
$obj=new add_to_cart();
$totalProduct=$obj->totalProduct();
?>

 <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(admin/images/slider/291762.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">shopping cart</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <form action="#">               
                            <div class="table-content table-responsive">
                                <table>
									<?php   
										if(isset($_SESSION['cart'])){
										if(count($_SESSION['cart'])>0){
									?>
                                        <tr>
                                            <th class="product-thumbnail">products</th>
                                            <th class="product-name">name of products</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
											<tr>
												<?php
												foreach($_SESSION['cart'] as $key=>$val){
												$sql="select * from product where product.status=1 and id='$key' ";
												$run=$con->query($sql);
												
												$data=$run->fetch_assoc();	
												$pname=$data['pname'];
												$mrp=$data['mrp'];
												$price=$data['price'];
												$image=$data['image'];
												$qty=$val['qty'];	
												?>
												<td class="product-thumbnail"><a href="#"><img src="admin/images/product/<?php echo $image;?>" alt="product images" /></a></td>
												<td class="product-name"><a href="#"><?php echo $pname;?></a>
													<ul  class="pro__prize">
														<li class="old__prize"><del><?php echo $mrp."₹";?></del></li>
														<li><?php echo $price."₹";?></li>
													</ul>
												</td>
												<td class="product-price"><span class="amount"><?php echo $price."₹";?></span></td>
												<td class="product-quantity"><input type="number" id="<?php echo $key;?>qty" value="<?php echo $qty;?>" min="1" max="5" />
												<br/><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key;?>','update')">update</a>
												</td>
												<td class="product-subtotal"><?php echo $qty*$price."₹";?></td>
												<td class="product-remove"><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key;?>','remove')"><i class="icon-trash icons"></i></a></td>
											</tr>
											<?php }  
											} else
											{
												echo "Product is not inserted in cart";
											}	
											} else
											{
												echo "Product is not inserted in cart";
											}
													
									?>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="buttons-cart--inner">
                                        <div class="buttons-cart">
                                            <a href="index.php">Continue Shopping</a>
                                        </div>
										<?php if(count($_SESSION['cart'])>0){ ?>
                                        <div class="buttons-cart checkout--btn">
                                            <a href="checkout.php">checkout</a>
                                        </div>
										<?php } ?>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
        
										
<?php include('includes/footer.php')?>        
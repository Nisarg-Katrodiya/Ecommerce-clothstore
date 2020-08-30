<?php 
require('includes/header.php');
$cat_id=$_GET['id'];
if($cat_id>0)
{
	$sql="select product.*,categories.name from product,categories where product.categories_id=categories.id and product.status=1 and categories_id='$cat_id' ";
	$run=$con->query($sql);
	
}
else
{
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
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
                    <div class="shp__cart__wrap">
						
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
                        	
						
                    </div>
                    <ul class="shoping__total">
                        <li class="subtotal">Subtotal:</li>
                        <li class="total__price"><?php echo $total." ₹"; ?></li>
                    </ul>
					<?php 
							} } ?>
			
                                        
										
                    <ul class="shopping__btn">
                        <li><a href="cart.php">View Cart</a></li>
                       		<?php if(count($_SESSION['cart'])>0){ ?> <li class="shp__checkout"><a href="checkout.php">Checkout</a></li>	<?php } ?>
                    </ul>
				
                </div>
            </div>
            <!-- End Cart Panel -->
        </div>
        <!-- End Offset Wrapper -->       
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0.40) url(admin/images/slider/291762.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Products</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Product Grid -->
        <section class="htc__product__grid bg__white ptb--100">
            <div class="container">
                <div class="row">
					<?php if($run->num_rows > 0)
							{
					?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="htc__product__rightidebar">
                            <div class="htc__grid__top">
                                <div class="htc__select__option">
                                    <select class="ht__select">
                                        <option>Default softing</option>
                                        <option>Sort by popularity</option>
                                        <option>Sort by average rating</option>
                                        <option>Sort by newness</option>
                                    </select>
                                </div>
                               
                            </div>
                            <!-- Start Product View -->
                            <div class="row">
                                <div class="shop__grid__view__wrap">
                                    <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
                                        <?php
											while($data=$run->fetch_assoc())
											{										
										?>
										<!-- Start Single Category -->
										<div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
											<div class="category">
												<div class="ht__cat__thumb">
													<a href="product.php?id=<?php echo $data['id']?>">
														<img src="admin/images/product/<?php echo $data['image']?>" alt="product images">
													</a>
												</div>
												
												<div class="fr__product__inner">
													<h4><a href="product-details.html"><?php echo $data['pname']?></a></h4>
													<ul class="fr__pro__prize">
														<li class="old__prize"><del><?php echo $data['mrp']."₹"; ?></del></li>
														<li><?php echo $data['price']."₹"; ?></li>
													</ul>
												</div>
											</div>
										</div>
									<?php } ?>
                                    </div>
							   </div>
                            </div>
                        </div>
                    </div>
						<?php } 
						else
						{ 
							echo "Data not found";
						} 
					?>
                
				</div>
            </div>
        </section>
        <!-- End Product Grid -->
        <!-- End Banner Area -->
<?php require('includes/footer.php')?>        
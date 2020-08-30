<?php 
include('includes/header.php');
$p_id=$_GET['id'];
if($p_id>0)
{
	$sql="select product.*,categories.name from product,categories where product.categories_id=categories.id and product.status=1 and product.id='$p_id' ";
	$run=$con->query($sql);
	$data=$run->fetch_assoc();
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
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0.40) url(admin/images/slider/291762.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <a class="breadcrumb-item" href="categories.php?id=<?php echo $data['categories_id']?>"><?php echo $data['name']?></a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active"><?php echo $data['pname']?></span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Product Details Area -->
        <section class="htc__product__details bg__white ptb--100">
            <!-- Start Product Details Top -->
            <div class="htc__product__details__top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                            <div class="htc__product__details__tab__content">
                                <!-- Start Product Big Images -->
                                <div class="product__big__images">
                                    <div class="portfolio-full-image tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="img-tab-1">
                                            <img src="admin/images/product/<?php echo $data['image'];?>" alt="full-image">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Product Big Images -->
                                
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 smt-40 xmt-40">
                            <div class="ht__product__dtl">
                                <h2><?php echo $data['pname'];?></h2>
                                <ul  class="pro__prize">
                                    <li class="old__prize"><del><?php echo $data['mrp']."₹";?></del></li>
                                    <li><?php echo $data['price']."₹";?></li>
                                </ul>
                                <p class="pro__info"><?php echo $data['short_desc'];?></p>
                                <div class="ht__pro__desc">
                                    <div class="sin__desc">
                                        <p><span>Availability:</span> In Stock</p>
                                    </div>
									<div class="sin__desc">
                                        <p><span>Qty:</span><br>
										<input type="number" class="pqty" id="qty" min="1" max="5" value="1" />
										</p>
                                    </div>
                                    <div class="sin__desc align--left">
                                        <p><span>Categories:</span></p>
                                        <ul class="pro__cat__list">
                                            <li><a href="#"><?php echo $data['name'];?></a></li>
                                        </ul>
                                    </div>
                                    
                                    </div>
									
                                </div>
								<a class="fr__btn" href="javascript:void(0)" onclick="manage_cart('<?php echo $data['id'];?>','add')">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Product Details Top -->
        </section>
        <!-- End Product Details Area 
		<!-- Start Product Description -->
        <section class="htc__produc__decription bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- Start List And Grid View -->
                        <ul class="pro__details__tab" role="tablist">
                            <li role="presentation" class="description active"><a href="#description" role="tab" data-toggle="tab">description</a></li>
                        </ul>
                        <!-- End List And Grid View -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="ht__pro__details__content">
                            <!-- Start Single Content -->
                            <div role="tabpanel" id="description" class="pro__single__content tab-pane fade in active">
                                <div class="pro__tab__content__inner">
                                    <?php echo $data['description'];?>
                                </div>
                            </div>
                            <!-- End Single Content -->
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Product Description -->
        
										
<?php 
include('includes/footer.php');
?>        
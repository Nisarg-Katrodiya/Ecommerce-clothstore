<?php 
include('includes/header.php');
$order_id=$_GET['orderid'];
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
                                  <span class="breadcrumb-item active">Thank You</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="wishlist-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="wishlist-content">
                            <form action="#">
                                <div class="wishlist-table table-responsive">
                                    <table>
                                            <tr>
                                                <th class="product-thumbnail">Product Name</th>
												<th class="product-thumbnail">Product Image</th>
                                                <th class="product-name">Qty</th>
                                                <th class="product-price">Price</th>
                                                <th class="product-price">Total Price</th>
                                            </tr>
											<?php
											$uid=$_SESSION['USER_ID'];
											$sql="select `order_detail`.*,`product`.pname,`product`.image from `order_detail` inner join `product` on `order_detail`.product_id=`product`.id where `order_detail`.order_id='$order_id'";
											$run=$con->query($sql);
											$total_price=0;
											while($data=$run->fetch_assoc()){
											$total_price=$total_price+($data['qty']*$data['price']);
											?>
                                            <tr>
												<td class="product-name"><?php echo $data['pname'];?></td>
                                                <td class="product-name"> <img src="admin/images/product/<?php echo $data['image'];?>"></td>
												<td class="product-name"><?php echo $data['qty'];?></td>
												<td class="product-name"><?php echo $data['price'];?></td>
												<td class="product-name"><?php echo $data['qty']*$data['price'];?></td>
                                                
                                            </tr>
                                            <?php } ?>
											<tr>
												<td colspan="3"></td>
												<td class="product-name">Total Price</td>
												<td class="product-name"><?php echo $total_price;?></td>
                                                
                                            </tr>
                                        
                                    </table>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        						
<?php include('includes/footer.php')?>        
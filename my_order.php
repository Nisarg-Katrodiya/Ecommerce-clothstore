<?php 
include('includes/header.php');
$uid=$_SESSION['USER_ID'];
$sql="select `order`.*,`order_status`.name as order_status_str from `order` inner join `order_status` on `order_status`.id=`order`.order_status where `order`.user_id='$uid' ";
$run=$con->query($sql);
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
                                    <table><?php
										if($run->num_rows > 0)
											{
										?>
                                            <tr>
                                                <th class="product-thumbnail">Order ID</th>
                                                <th class="product-name"><span class="nobr">Order Date</span></th>
                                                <th class="product-price"><span class="nobr"> Address </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> Payment Type </span></th>
												<th class="product-stock-stauts"><span class="nobr"> Payment Status </span></th>
												<th class="product-stock-stauts"><span class="nobr"> Order Status </span></th>
                                            </tr>
											<?php
											
											while($data=$run->fetch_assoc()){
											?>
                                            <tr>
												<td class="product-add-to-cart"><a href="my_order_details.php?orderid=<?php echo $data['id']?>"> <?php echo "#".$data['id']?></a></td>
                                                <td class="product-name"><?php echo $data['added_on']?></td>
                                                <td class="product-name">
												<?php echo $data['address'].","?><br/>
												<?php echo $data['city'].","?><br/>
												<?php echo $data['pincode']?>
												</td>
												<td class="product-name"><?php echo $data['payment_type']?></td>
												<td class="product-name"><?php echo $data['payment_status']?></td>
												<td class="product-name"><?php echo $data['order_status_str']?></td>
                                                
                                            </tr>
                                            <?php }
											} else
											{	
												echo "Order is not placed";
											}
											
											?>
                                        
                                    </table>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        						
<?php include('includes/footer.php')?>        
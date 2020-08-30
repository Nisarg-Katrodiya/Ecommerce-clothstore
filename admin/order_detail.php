<?php
include('includes/header.php');
$order_id=$_GET['id'];
if(isset($_POST['update_order_status'])){
	$update_order_status=$_POST['update_order_status'];
	$update_sql="update `order` set order_status='$update_order_status' where id='$order_id'";
	$up_run=$con->query($update_sql);
}
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
					<h4 class="box-title">Order Detail </h4>
					<h4 class="badge-link badge-link-complate"><a href="order.php">Back to Order</a> </h4>
				</div>
				<div class="card-body">
				   <div class="table-stats order-table ov-h">
					  <table class="table">
								<thead>
									<tr>
										<th class="product-thumbnail">Product Name</th>
										<th class="product-thumbnail">Product Image</th>
										<th class="product-name">Qty</th>
										<th class="product-price">Price</th>
										<th class="product-price">Total Price</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sql="select order_detail.*,product.pname,product.image,`order`.address,`order`.city,`order`.pincode from order_detail,product ,`order` where order_detail.order_id='$order_id' and  order_detail.product_id=product.id GROUP by order_detail.id";
									$run=$con->query($sql);
									$total_price=0;
									while($row=$run->fetch_assoc()){
									$address=$row['address'];
									$city=$row['city'];
									$pincode=$row['pincode'];
									$total_price=$total_price+($row['qty']*$row['price']);
									?>
									<tr>
										<td class="product-name"><?php echo $row['pname']?></td>
										<td class="product-name"> <img src="images/product/<?php echo $row['image'];?>"></td>
										<td class="product-name"><?php echo $row['qty']?></td>
										<td class="product-name"><?php echo $row['price']?></td>
										<td class="product-name"><?php echo $row['qty']*$row['price']?></td>
										
									</tr>
									<?php } ?>
									<tr>
										<td colspan="3"></td>
										<td class="product-name">Total Price</td>
										<td class="product-name"><?php echo $total_price?></td>
										
									</tr>
								</tbody>
							
						</table>

							<div id="address_details">
								<strong>Address:</strong>
								<?php echo $address?>, <?php echo $city?>, <?php echo $pincode?><br/><br/>
								<strong>Order Status:</strong>
								<?php
								$sql1="select order_status.name from order_status,`order` where `order`.id='$order_id' and `order`.order_status=order_status.id";
								$run1=$con->query($sql1);
								$data=$run1->fetch_assoc();			
								echo $data['name'];
								?>

								<div>
									<form method="post" class="mt-3">
										<select class="form-control" name="update_order_status">
											<option>Select Status</option>
											<?php
											$select_sql="select * from order_status";
											$run2=$con->query($select_sql);
											while($row=$run2->fetch_assoc()){
												if($row['id']==$categories_id){
													echo "<option selected value=".$row['id'].">".$row['name']."</option>";
												}else{
													echo "<option value=".$row['id'].">".$row['name']."</option>";
												}
											}
											?>
										</select>
										<input type="submit" class="form-control mt-5"/>
									</form>
								</div>
							</div>

				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
<?php
include('includes/footer.php');
?>
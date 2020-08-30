<?php
require('includes/header.php');

if(isset($_GET['type']) && $_GET['type']!='')
{
	$type=$_GET['type'];
	if($type=='status')
	{
		$operation=$_GET['operation'];
		$id=$_GET['id'];
		if($operation=='active')
		{
			$status='1';
		}else{
			$status='0';
		}
		$update_sql="update product set status='$status' where id='$id'";
		$run=$con->query($update_sql);
	}
	
	if($type=='delete'){
		$id=$_GET['id'];
		$delete_sql="delete from product where id='$id'";
		$run1=$con->query($delete_sql);
	}
}

$sql="select product.*,categories.name from product,categories where product.categories_id=categories.id order by product.id asc";
$run2=$con->query($sql);
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Products </h4>
				   <h4 class="badge-link badge-link-complate"><a href="edit_product.php">Add Product</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>ID</th>
							   <th>Categories</th>
							   <th>Name</th>
							   <th>Image</th>
							   <th>MRP</th>
							   <th>Price</th>
							   <th>Qty</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($data=$run2->fetch_assoc())
							{?>
							<tr>
							   <td class="serial"><?php echo $i; $i++;?></td>
							   <td><?php echo $data['id'];?></td>
							   <td><?php echo $data['name'];?></td>
							   <td><?php echo $data['pname'];?></td>
							   <td><img src="images/product/<?php echo $data['image'];?>"/></td>
							   <td><?php echo $data['mrp'];?></td>
							   <td><?php echo $data['price'];?></td>
							   <td><?php echo $data['qty'];?></td>
							   <td>
								<?php
								if($data['status']==1)
								{
									echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$data['id']."'>Active</a></span>&nbsp;";
								}
							 	else
								{
									echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$data['id']."'>Deactive</a></span>&nbsp;";

							 	}
								echo "<span class='badge badge-edit'><a href='edit_product.php?id=".$data['id']."'>Edit</a></span>&nbsp;";
								
								echo "<span class='badge badge-delete'><a href='?type=delete&id=".$data['id']."'>Delete</a></span>";
								
								?>
							   </td>
							</tr>
							<?php 
							} ?>
						 </tbody>
					  </table>
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
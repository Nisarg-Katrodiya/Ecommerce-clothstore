<?php
require('includes/header.php');

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=$_GET['type'];
	if($type=='delete'){
		$id=$_GET['id'];
		$sql="delete from contact_us where id='$id'";
		$run=$con->query($sql);
	}
}

$sql1="select * from contact_us order by id desc";
$run1=$con->query($sql1);
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Contact Us </h4>
				</div>
				<div class="card-body">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>ID</th>
							   <th>Name</th>
							   <th>Email</th>
							   <th>Mobile</th>
							   <th>Query</th>
							   <th>Date</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($data=$run1->fetch_assoc()){?>
							<tr>
							   <td class="serial"><?php echo $i; $i++; ?></td>
							   <td><?php echo $data['id']?></td>
							   <td><?php echo $data['name']?></td>
							   <td><?php echo $data['email']?></td>
							   <td><?php echo $data['mobile']?></td>
							   <td><?php echo $data['comment']?></td>
							   <td><?php echo $data['added_on']?></td>
							   <td>
								<?php
								echo "<span class='badge badge-delete'><a href='?type=delete&id=".$data['id']."'>Delete</a></span>";
								?>
							   </td>
							</tr>
							<?php } ?>
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
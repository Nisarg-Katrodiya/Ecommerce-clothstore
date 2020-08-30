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
		$update_sql="update categories set status='$status' where id='$id'";
		$run1=$con->query($update_sql);
	}
	
	if($type=='delete')
	{
		$id=$_GET['id'];
		$delete_sql="delete from categories where id='$id'";
		$run2=$con->query($delete_sql);
	}
}

	$sql="SELECT * FROM `categories` WHERE 1 ";
	$run=$con->query($sql);
?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Categories </h4>
							<h4 class="badge-link badge-link-complate"><a href="edit_categories.php">Add Categories</a> </h4>	
                        </div>
                        <div class="card-body">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                    <tr>
                                       <th class="serial">#</th>
                                       <th>ID</th>
                                       <th>Name</th>
                                       <th>Status</th>
                                    </tr>
								 	<?php 
								  	$i=1;
									while($row=$run->fetch_assoc()){
								  ?>
                                    <tr>
                               <td class="serial"><?php echo $i;?></td>
							   <td><?php echo '#'.$row['id']?></td>
							   <td><?php echo $row['name']?></td>
                               <td>
								<?php
								if($row['status']==1){
									echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";         
								}else{
									echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
								}
								echo "<span class='badge badge-edit'><a href='edit_categories.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
								
								echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";
								$i++;
								?>		
										
								</td>
                                    </tr>
                              <?php
									}
								?>	   
                                    
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
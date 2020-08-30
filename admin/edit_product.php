<?php
require('includes/header.php');
$cid='';
$name='';
$mrp='';
$price='';
$qty='';
$image='';
$short_desc='';
$description='';
$meta_title='';
$meta_description='';
$meta_keyword='';

$msg='';
$image_required='required';
if(isset($_GET['id']) && $_GET['id']!='')
{
	$image_required='';
	$id=$_GET['id'];
	$sql="select * from `product` where id='$id'";
	$run=$con->query($sql);
	if($run->num_rows > 0)
	{
		$data=$run->fetch_assoc();
		$cid=$data['categories_id'];
		$name=$data['pname'];
		$mrp=$data['mrp'];
		$price=$data['price'];
		$qty=$data['qty'];
		$short_desc=$data['short_desc'];
		$description=$data['description'];
		$meta_title=$data['meta_title'];
		$meta_desc=$data['meta_desc'];
		$meta_keyword=$data['meta_keyword'];
	}
	else
	{
		header('location:product.php');
		die();
	}
}

if(isset($_POST['submit']))
{
	$cid=$_POST['categories_id'];
	$name=$_POST['pname'];
	$mrp=$_POST['mrp'];
	$price=$_POST['price'];
	$qty=$_POST['qty'];
	$short_desc=$_POST['short_desc'];
	$description=$_POST['description'];
	$meta_title=$_POST['meta_title'];
	$meta_desc=$_POST['meta_desc'];
	$meta_keyword=$_POST['meta_keyword'];
	$sql1="select * from `product` where pname='$name'";
	$run1=$con->query($sql1);
	if($run1->num_rows > 0)
	{
		if(isset($_GET['id']) && $_GET['id']!='')
		{
			$data1=$run1->fetch_assoc();
			if($id==$data1['id'])
			{
			
			}
			else
			{
				$msg="Product already exist";
			}
		}
		else
		{
			$msg="Product already exist";
		}
	}
	
	if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg')
	{
		$msg="Please select only png,jpg and jpeg image formate";
	}
	
	if($msg=='')
	{
		if(isset($_GET['id']) && $_GET['id']!='')
		{
			if($_FILES['image']['name']!='')
			{
				$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'],"images/product/$image");
				$update_sql="update `product` set categories_id='$cid',pname='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',image='$image' where id='$id'";
			}
			else
			{
				$update_sql="update `product` set categories_id='$cid',pname='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword' where id='$id'";
			}
			$run3=$con->query($update_sql);
		}
		else
		{
			$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'],"images/product/$image");
			$insert_sql="insert into `product` (categories_id,pname,mrp,price,qty,short_desc,description,meta_title,meta_desc,meta_keyword,status,image) values('$cid','$name','$mrp','$price','$qty','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword',1,'$image')";
			$run4=$con->query($insert_sql);
		}
		header('location:product.php');
		die();
	}
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong><h2>Product Form</h2></strong></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="categories" class=" form-control-label">Categories</label>
									<select class="form-control" name="categories_id" required>
										<option>Select Category</option>
										<?php
										$sql2="select * from `categories` where 1";
										$run5=$con->query($sql2);
										while($data2=$run5->fetch_assoc())
										{
											if($data2['id']==$cid){
												echo "<option selected value=".$data2['id'].">".$data2['name']."</option>";
											}else{
												echo "<option value=".$data2['id'].">".$data2['name']."</option>";
											}
											
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">Product Name</label>
									<input type="text" name="pname" placeholder="Enter product name" class="form-control" required value="<?php echo $name;?>">
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">MRP</label>
									<input type="text" name="mrp" placeholder="Enter product mrp" class="form-control" required value="<?php echo $mrp;?>">
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Price</label>
									<input type="text" name="price" placeholder="Enter product price" class="form-control" required value="<?php echo $price;?>">
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Qty</label>
									<input type="text" name="qty" placeholder="Enter qty" class="form-control" required value="<?php echo $qty;?>">
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Image</label>
									<input type="file" name="image" class="form-control" <?php echo  $image_required;?> >
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Short Description</label>
									<textarea name="short_desc" placeholder="Enter product short description" class="form-control" required><?php echo $short_desc;?></textarea>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Description</label>
									<textarea name="description" placeholder="Enter product description" class="form-control" required><?php echo $description;?></textarea>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Meta Title</label>
									<textarea name="meta_title" placeholder="Enter product meta title" class="form-control"><?php echo $meta_title;?></textarea>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Meta Description</label>
									<textarea name="meta_desc" placeholder="Enter product meta description" class="form-control"><?php echo $meta_description;?></textarea>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Meta Keyword</label>
									<textarea name="meta_keyword" placeholder="Enter product meta keyword" class="form-control"><?php echo $meta_keyword;?></textarea>
								</div>
								
								
							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   <div class="field_error"><?php echo $msg;?></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
<?php
	 include('includes/footer.php');
?>
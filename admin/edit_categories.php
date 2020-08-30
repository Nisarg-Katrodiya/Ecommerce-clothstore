<?php
require('includes/header.php');
$categories='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$id=$_GET['id'];
	$qry="select * from categories where id='$id'";
	$run=$con->query($qry);
	if($run->num_rows > 0){
		$row=$run->fetch_assoc();
		$categories=$row['name'];
	}else{
		header('location:categories.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$categories=$_POST['categories'];
	$qry1="select * from categories where name='$categories'";
	$run1=$con->query($qry1);
	if($run1->num_rows > 0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=$run1->fetch_assoc();
			if($id==$getData['id']){
			
			}else{
				$msg="Categories already exist";
			}
		}else{
			$msg="Categories already exist";
		}
	}
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$qry3="update categories set name='$categories' where id='$id'";
			$run2=$con->query($qry3);
		}else{
			$qry4="insert into categories(name,status) values('$categories','1')";
			$run3=$con->query($qry4);
		}
		header('location:categories.php');
		die();
	}
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Categories</strong><small> Form</small></div>
                        <form method="POST">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="categories" class=" form-control-label">Categories</label>
									<input type="text" name="categories" placeholder="Enter categories name" class="form-control" value="<?php echo $categories;?>" required>
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
require('includes/footer.php');
?>
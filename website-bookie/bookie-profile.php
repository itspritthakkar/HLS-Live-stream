<br><br>
<div class="content-box">
		<?php
if($_GET['subcat']=='add-bookie-profile'){

	if(!empty($_GET['edit'])){

   $editId= $_GET['edit'];
   $query="SELECT * FROM bookie_profile WHERE id=$editId";
   $res= $conn->query($query);
   $editData=$res->fetch_assoc();
   $fullName=$editData['full_name'];
   $email=$editData['email'];
   $balance=$editData['balance'];
   $mobile=$editData['mobile'];
   $address=$editData['address'];
   $password=$editData['password'];

   
   $idAttr="updateBookieForm";
   
}else{
	$fullName="";
   $email="";
   $balance="";
   $mobile="";
   $address="";
   $password="";

  
   $editId='';
    $idAttr="bookieForm";

}
?>

	<div class="row">
		<div class="col">
			<h3>Bookie Profile</h3>
		</div>
		<div class="col text-right">
			<a href="dashboard.php?cat=website-bookie&subcat=bookie-profile" class="btn btn-secondary content-link"> View</a>
		</div>
	</div>
<br>
<form id="<?php echo $idAttr; ?>" rel="<?php echo $editId; ?>" name="bookie_profile">
<div class="row">
	<div class="col">
		<div class="form-group">
			<label>Full Name</label>
			<input type="text" placeholder="Full Name" class="form-control" name="full_name" value="<?php echo $fullName; ?>">
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<label>Email</label>
			<input type="text" placeholder="Email" class="form-control" name="email" value="<?php echo $email; ?>">
		</div>
	</div>
</div>
<div class="row">
<div class="col">
		<div class="form-group">
			<label>Address</label>
			<input type="text" placeholder="City" class="form-control" name="address" value="<?php echo $address; ?>">
		</div>
	</div>
</div>
<div class="row">
	<div class="col">
		<div class="form-group">
			<label>Mobile Number</label>
			<input type="text" placeholder="Mobile Number" class="form-control" name="mobile" value="<?php echo $mobile; ?>">
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<label>Balance</label>
			<input type="text" placeholder="Amount" class="form-control" name="balance" value="<?php echo $balance; ?>">
		</div>
	</div>
</div>
<div class="row">
	<div class="col">
		<div class="form-group">
			<label>Password</label>
			<input type="password" placeholder="Password" class="form-control" name="password">
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<label>Confirm Password</label>
			<input type="password" placeholder="Password" class="form-control" name="cpassword">
		</div>
	</div>
	
</div>
<div class="row">
	<div class="col">
		<div class="form-group">
			<button class="btn btn-secondary">Save</button>
		</div>
	</div>
	<div class="col">
		
	</div>
</div>
</form>
<?php } elseif (!empty($_GET['view'])) {?>
	
	<?php 

    $id= $_GET['view'];
   $query="SELECT * FROM bookie_profile WHERE id=$id";
   $res= $conn->query($query);
   $viewData=$res->fetch_assoc();
   $backId=$viewData['id']-1;
   $fullName=$viewData['full_name'];
   $email=$viewData['email'];
   $balance=$viewData['balance'];
   $mobile=$viewData['mobile'];
   $address=$viewData['address'];
   $password=$viewData['password'];
   ?>
<div class="row">
	<div class="col">
	</div>
	<div class="col text-right">
		<a href="dashboard.php?cat=website-bookie&subcat=bookie-profile" class="btn btn-secondary content-link">Back</a>
	</div>
</div>
<br>
<div class="table-responsive">
	<table class="table">
		<tr>
			<th>Full Name -</th><td><?php echo $fullName; ?></td>
		</tr>
		<tr>
			<th>Email -</th><td><?php echo $email; ?></td>
		</tr>
		<tr>
			<th>Balance -</th><td><?php echo $balance; ?></td>
		</tr>
		<tr>
			<th>Mobile Number -</th><td><?php echo $mobile; ?></td>
		</tr>
		<tr>
			<th>Address -</th><td><?php echo $address; ?></td>
		</tr>
		<tr>
			<th>Password -</th><td><?php echo $password; ?></td>
		</tr>
	</table>
</div>
   <?php
   
	

 }else {?>


<!-----=================table content start=================-->
	
	<div class="row">
		<div class="col">
			<h4>Bookie Profile</h4>
		</div>
		<div class="col text-right">
			<a href="dashboard.php?cat=website-bookie&subcat=add-bookie-profile" class="btn btn-secondary content-link"> Add New</a>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col">
	<div class="table-responsive">
		<table class="table">
			<tr>
				<th>S.N</th>
				<th>Full Name</th>
				<th>email</th>
				<th>Balance</th>
				<th>Status</th>
				<th>View</th>
				<th>Edit</th>
				<th>Delete</th>
				
			</tr>
			<?php
  $sql1="SELECT * FROM bookie_profile ORDER BY id DESC";
  $res1= $conn->query($sql1);
  if($res1->num_rows>0)
  {$i=1;
   while($data=$res1->fetch_assoc()){
   	?>
   	<tr>
   		<td><?php echo $i; ?></td>
   		<td><?php echo $data['full_name']; ?></td>
   		
   		<td><?php echo $data['email']; ?></td>

		<td><?php echo $data['balance']; ?></td>
   
   		<td>
   			
   			<?php
   			if($data['status']==0){
   			?>
   			<a href="javascript:void(0)" name="bookie_profile" class=" text-secondary bookieRole"  rel="<?php echo $data['id']; ?>">
   			<i class='fas fa-user-alt-slash iconRole' ></i>
   		<?php } else{ ?>
   			<a href="javascript:void(0)" name="bookie_profile" class=" text-success bookieRole"  rel="<?php echo $data['id']; ?>">
              <i class='fas fa-user-alt iconRole'></i>
   		<?php } ?>
   	
   		</a></td>
   		<td><a  href="dashboard.php?cat=website-bookie&subcat=bookie-profile&view=<?php echo $data['id']; ?>" class="text-secondary content-link"><i class='far fa-eye'></i></a></td>
        <td><a href="dashboard.php?cat=website-bookie&subcat=add-bookie-profile&edit=<?php echo $data['id']; ?>" class="text-success content-link"><i class=' far fa-edit'></i></a></td>
        <td><a href="javascript:void(0)" class="text-danger delete"  name="bookie_profile" id="<?php echo $data['id']; ?>"><i class='far fa-trash-alt'></i></a></td>

   	</tr>
   	<?php
   $i++;}
}else{

?>
<tr>
	<td colspan="6">No Bookie Profile Data</td>
</tr>
<?php } ?>
			
		</table>
	</div>
</div>
</div>
	<!-----==================table content end===================-->
<?php } ?>

</div>
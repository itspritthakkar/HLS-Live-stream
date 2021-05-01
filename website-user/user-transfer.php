<br><br>
<div class="content-box">
<?php
$email_address= $_SESSION['email'];
$usertype= $_SESSION['usertype'];
$userid= $_SESSION['id'];
include('config/database.php');
if(empty($email_address) || empty($usertype) || empty($userid))
{
  header("location:index.php");
}
include('../config/database.php');
// ======== balance transfer ===========//
if(isset($_POST['transfer']))
{
	extract($_POST);
	//Get user balance
	function legal_input($value) {
		$value = trim($value);
		$value = stripslashes($value);
		$value = htmlspecialchars($value);
		return $value;
	}

    function make_transaction($db,$id,$transferamount){

		// checking valid user
		$bookie_id=$_SESSION['id'];
		$bookie_balance="SELECT balance FROM bookie_profile WHERE id='$bookie_id'";
		$run_bb=mysqli_query($db,$bookie_balance);
		$result_bb = mysqli_fetch_array($run_bb);
		if($result_bb['balance'] >= $transferamount){
			$user_balance="SELECT balance FROM user_profile WHERE id='$id'";
			$run_ub=mysqli_query($db,$user_balance);
			$result_ub = mysqli_fetch_array($run_ub);
			$ub_updated = $result_ub['balance'] + $transferamount;
			$bb_updated = $result_bb['balance'] - $transferamount;
			$update_ub="UPDATE user_profile SET balance = '$ub_updated' WHERE id = '$id'";
         	$res_ub= mysqli_query($db,$update_ub);
			if(!$res_ub){
				return "<span class='fail'>User balance update query failed</span>";
			}
			$update_bb="UPDATE bookie_profile SET balance = '$bb_updated' WHERE id = '$bookie_id'";
         	$res_bb= mysqli_query($db,$update_bb);
			if(!$res_bb){
				return "<span class='fail'>Bookie balance update query failed</span>";
			}
			if ($res_ub && $res_bb) {
				$update_tr="INSERT INTO transactions SET bookie_id = '$bookie_id', user_id='$id', transaction_amount='$transferamount'";
         		$res_ub= mysqli_query($db,$update_tr);
				return "<span class='success'>Transfer successful!</span>";
			}
		}
		else {
			return $db->error;
			// echo "<span class='fail'>Not enough balance</span>";
		}
 	}
	$id=     legal_input($id);
	$transferamount=  legal_input($transferamount);

	$db=$conn;// database connection 
	// print_r($db);
   	$transaction=make_transaction($db,$id,$transferamount);
}
?>
<?php if (!empty($_GET['view'])) {?>
	
	<?php 
    $id= $_GET['view'];
   $query="SELECT * FROM user_profile WHERE id=$id";
   $res= $conn->query($query);
   $viewData=$res->fetch_assoc();
   $backId=$viewData['id']-1;
   $fullName=$viewData['full_name'];
   $email=$viewData['email'];
   $balance=$viewData['balance'];
   $address=$viewData['address'];
   ?>
<div class="row">
	<div class="col">
	</div>
	<div class="col text-right">
		<a href="dashboard.php?cat=website-user&subcat=user-transfer" class="btn btn-secondary content-link">Back</a>
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
			<th>Address -</th><td><?php echo $address; ?></td>
		</tr>
	</table>
</div>
   <?php
   
	

 }else {?>


<!-----=================table content start=================-->
	
	<div class="row">
		<div class="col">
			<h4>User Fund Transfer</h4>
		</div>
	</div>
	<?php if(!empty($transaction)){echo $transaction;} ?>
	<br>
	<div class="row">
		<div class="col">
	<div class="table-responsive">
		<table class="table">
			<tr>
				<th>S.N</th>
				<th>Full Name</th>	
				<th>email</th>
				<th>balance</th>
				<th>Transfer</th>
				<th>View</th>
				
			</tr>
			<?php
  $sql1="SELECT * FROM user_profile ORDER BY id DESC";
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
		   <td><form ation="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST"><input type="hidden" name="id" class="form-control" value="<?php echo $data['id']; ?>">
		   		<input type="text" name="transferamount" class="form-control">
				<button type="submit" class="form-control" name="transfer">Transfer</form></td>
   
   		<td><a  href="dashboard.php?cat=website-user&subcat=user-transfer&view=<?php echo $data['id']; ?>" class="text-secondary content-link"><i class='far fa-eye'></i></a></td>

   	</tr>
   	<?php
   $i++;}
}else{

?>
<tr>
	<td colspan="6">No user Profile Data</td>
</tr>
<?php } ?>
			
		</table>
	</div>
</div>
</div>
	<!-----==================table content end===================-->
<?php } ?>

</div>
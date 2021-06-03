<?php 
session_start();
$pop = $_SESSION['info']; 
$pid=$_POST['pid'];
$name=$_POST['name'];
$blood=$_POST['blood'];
$organ=$_POST['organ'];
$state=$_POST['state'];
$random=$_POST['random'];
$con=mysqli_connect("localhost","root","","login");
$result=mysqli_query($con,"select * from recipient WHERE name='$name' AND pid='$pid' AND state='$state' AND random='$random' limit 1");
$res=mysqli_query($con,"select * from donor WHERE organ='$organ' AND blood='$blood' AND state='$state' AND validate=1 limit 1");


?>
<!DOCTYPE html>
<html>
<head>
	<title>HOSPITALS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script></title>

  <style>

   	body{
  		background: #343A40;
  		overflow-y: scroll;
  	
  	}

  	table{
  		border-right: 1px solid grey;
  		border-left: 1px solid grey;
  		border-top: 1px solid grey;
  		border-bottom: 1px solid grey;
  		font-weight: bold;
  	}

  	img{
  		margin-left: -95%;
  		margin-top: 25px;
  	}

  	.mmj{
  		margin-left: 25%;
  		height: 300px;
  		width: 50%;
  		border-radius:10px;
  		margin-right: 25%;
  	}


::-webkit-scrollbar{
	width: 10px;
}
::-webkit-scrollbar-track{
	border: 5px solid transparent;
	box-shadow: inset 0 0 2.5px 2px rgba(0,0,0,0.5);
}
::-webkit-scrollbar-thumb{
	background:linear-gradient(45deg,#06dee1,#79ff6c);
	border-radius: 5px;
}

  </style>

</head>
<body>
	<img src="CSS\logo.png" height="100px" width="350px" alt="LOGO">
	<table class="table table-dark table-striped" id="table" align="left" style="width: 46%; line-height: 50px; color: #FFF; text-align: left;padding: 50px; margin-top: 150px; margin-left: 3%;">		
		<thead class="thead-dark">
		<t>
			<th>RECIPIENT DETAILS</th>
		</t></thead>
		</t></thead>
		<?php 
				
			while($row=mysqli_fetch_assoc($result)){
				 ?>
				 <tbody>
				<tr>
					<td align="left">
					<?php 

					if ($row['validate']==0) {

						echo ' <script type="text/javascript"> alert("RECIPIENT NOT VALIDATED")</script> ';
						header("refresh:0; url=error.html");
					}


					?>
					<?php echo '<img class="mmj" src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/>'; ?>
					<?php echo "NAME OF RECIPIENT : " .$row['name'];?>
					<?php echo "<br> BLOOD GROUP : " .$row['blood']; ?>
					<?php echo "<br> GENDER : " .$row['gender']; ?>
					<?php echo "<br> AGE : " .$row['age']; ?>
					<?php echo "<br> PATIENT ID : " .$row['pid']; ?>					
					<?php echo "<br> HOSPITAL NAME : " .$row['hname']; ?>
					<?php echo "<br> HOSPITAL ID : " .$row['hid']; ?>
					<?php echo "<br> ORGAN : " .$row['organ']; ?>

					<?php 

					$reso=mysqli_query($con,"select * from hospital WHERE hname='$pop'");
					$resa=mysqli_fetch_array($reso);
					echo "<br> PHONE NO. : " .$resa['phone'];

					?>

				</td></tr>
				</tbody>
			<?php 
			}


			 ?>
		
	</table></div>

	<table class="table table-dark table-striped" id="table" align="left" style="width: 46%; line-height: 50px; color: #FFF; text-align: left;padding: 50px; margin-top: 150px;margin-left: 1%;">		
		<thead class="thead-dark">
		<t>
			<th>DONOR DETAILS</th>
		</t></thead>
		</t></thead>
		<?php 

			while($row=mysqli_fetch_assoc($res)){
				 ?>
				 <tbody>
				<tr>
					<td align="left">
					<?php echo '<img class="mmj" src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'"/>'; ?>
					<?php echo "NAME OF DONOR : " .$row['name']; ?>
					<?php echo "<br> BLOOD GROUP : " .$row['blood']; ?>
					<?php echo "<br> GENDER : " .$row['gender']; ?>
					<?php echo "<br> AGE : " .$row['age']; ?>
					<?php echo "<br> PATIENT ID : " .$row['pid']; ?>					
					<?php echo "<br> HOSPITAL NAME : " .$row['hname']; ?>
					<?php echo "<br> HOSPITAL ID : " .$row['hid']; ?>
					<?php echo "<br> ORGAN : " .$row['organ']; 

					
					$band=rand(10000,99999);
					$nam=$row['name'];
					$pi=$row['pid'];
					$sql="UPDATE donor SET random='$band' WHERE name='$nam' AND pid='$pi'";
					$lqs="UPDATE recipient SET random='$band' WHERE name='$name' AND pid='$pid'";

					$query_run=mysqli_query($con,$sql);
					$query=mysqli_query($con,$lqs);

					if ($query_run && $query) {

						echo ' <script type="text/javascript"> alert("DATA SAVED")</script> ';
					}
					
					?>
					
					<?php 

					$reso=mysqli_query($con,"select * from hospital WHERE hname='$row[hname]'");
					$resa=mysqli_fetch_array($reso);
					echo "<br> PHONE NO. : " .$resa['phone'];

					?>

				</tr></tbody>
			<?php 
			}

			 ?>
		
	</table></div>
	</body>
</html>

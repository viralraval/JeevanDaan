<?php  
session_start();
$pop = $_SESSION['info'];
$con=mysqli_connect("localhost","root","","login");
$result=mysqli_query($con,"select * from recipient where hname='$pop'");
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="CSS/style.css">
	<title>RECORDS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <style> h1 { color: #FFF;  text-align: center;margin-bottom: 50px;} 
  
  .box{
	transform: translate(-50%,-50%);
	width: 1200px;
	height: 650px;
	background: rgba(0,0,0,.8);
	box-sizing: border-box;
	box-shadow: 0 15px 25px rgba(0,0,0,.5);
	border-radius: 10px;
	align-items: center;
  }

  .box input {
  	width: 300px;
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
		border-radius: 10px;
	}

	.gogo{
		border: 2px solid #FFF;
		border-radius: 10px;
	}

  </style>
</head>
<body>	
		<div class="box">
		<div class="inputbox">
		<h1>JEEVANDAAN RECIPIENT LIST</h1><div class="gogo" style="height: 450px;width: 765px;overflow-y:scroll;">
		<table class="table" id="table" align="left" style="width: auto; line-height: 20px; color: #000; background: #FFF; text-align: center;">
		<thead class="thead-light"><tr></tr>
		<t>
			<th>PHOTO</th>
			<th>NAME</th>
			<th>PATIENT ID</th>
			<th>BLOOD GROUP</th>
			<th>GENDER</th>
			<th>ORGAN</th>
			<th>STATE</th>
			<th>UNIQUE ID</th>
		</t></thead>
		<?php 

			$s1;

			while($row=mysqli_fetch_assoc($result)){
				 ?>
				 <tbody>
				<tr>
					<td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['photo'] ).'" height="75" width="75"/>'; ?></td>
					<td align="center"><?php echo "" .$row['name']; ?></td>
					<td align="center"><?php echo "" .$row['pid']; ?></td>
					<td align="center"><?php echo "" .$row['blood']; ?></td>
					<td align="center"><?php echo "" .$row['gender']; ?></td>
					<td align="center"><?php echo "" .$row['organ']; ?></td>
					<td align="center"><?php echo "" .$row['state']; ?></td>
					<td align="center"><?php echo "" .$row['random']; ?></td>
				</tr></tbody>
			<?php 
			}

			 ?>
		
	</table></div>
	<div style="width: 275px; margin-left: 825px; margin-top: -44%;">
	<td align="center"><form action="match.php" method="post">
	<input type="number" name="pid" id="pid" placeholder="PATIENT ID" size="30">
	<input type="text" name="name" id="name" placeholder="NAME" size="30">
	<input type="text" name="organ" id="organ" placeholder="ORGAN" size="30">
	<input type="text" name="blood" id="blood" placeholder="BLOOD GROUP" size="30">
	<input type="text" name="state" id="state" placeholder="STATE" size="30">
	<input type="text" name="random" id="random" placeholder="UNIQUE ID" size="30" readonly>
	<br>
	<input type="submit" name="login" value="VIEW STATUS">
	<br>
	</form></td>


	<script>
		var table = document.getElementById('table'),rIndex;
		for(var i=0;i<table.rows.length;i++)
		{
			table.rows[i].onclick = function()
			{
				rIndex=this.rowIndex;
				document.getElementById("pid").value = this.cells[2].innerHTML;
				document.getElementById("name").value = this.cells[1].innerHTML;
				document.getElementById("organ").value = this.cells[5].innerHTML;
				document.getElementById("blood").value = this.cells[3].innerHTML;
				document.getElementById("state").value = this.cells[6].innerHTML;
				document.getElementById("random").value = this.cells[7].innerHTML;
			};
		}
	</script>
</body>
</html>


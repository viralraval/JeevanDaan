 <?php 	
			$con=mysqli_connect("localhost","root","");
			$db=mysqli_select_db($con,'login');

			$pid=$_POST['pid'];
			$name=$_POST['name'];

			$sql="UPDATE donor SET validate=1 WHERE name='$name' AND pid='$pid'";

			$query_run=mysqli_query($con,$sql);

			if ($query_run) {

				echo ' <script type="text/javascript"> alert("DONOR VALIDATED")</script> ';
				header("refresh:0; url=success3.html");
			}




			else {

				echo ' <script type="text/javascript"> alert("DONOR VALIDATION UNSUCCESFUL")</script> ';

			}


	?>
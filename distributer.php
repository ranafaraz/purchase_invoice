<?php include_once "db_connection.php" ?>
<!DOCTYPE html>
<html>
<head>
	<title>Distributers </title>	
</head>
<body>
	<!--form start -->
	<form action="#" method="POST" >
		Name:		<input type="text" name="name" />
		Father Name:<input type="text" name="father_name" />
		CNIC:		<input type="text" name="cnic" />
		Phone No:	<input type="text" name="phone_no">	
		Address:	<textarea name="address"></textarea><br/><br/>
		
					<input type="submit" name="submit" value="submit" />
	</form>
		<?php
			if(isset($_POST["submit"])) {
				$name     = $_POST["name"];
				$f_name   = $_POST["father_name"];
				$cnic     = $_POST["cnic"];
				$phone_no = $_POST["phone_no"];
				$address  = $_POST["address"];
				$sql = "INSERT INTO distributors(name, father_name,cnic,phone_no, address)VALUES('{$name}','{$f_name}','{$cnic}','{$phone_no}','{$address}')";
				
				$retreval = mysqli_query($connection, $sql);
				
				if(!$retreval) {
					echo "something went wrong";
				}
			}
		?>
		

</body>
</html>
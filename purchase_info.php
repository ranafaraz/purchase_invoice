<?php include_once "db_connection.php" ?>
<?php		
		//values received from "puchase_invoice" page and store in php variables 
			$distributer_id = $_POST['distributerId'];
			$date = $_POST['date'];
			$amount_paid = $_POST['amountPaid'];
			$amount_payable = $_POST['amountPayable'];
			$discount_received = $_POST['discountReceived'];	
			$net_total= $_POST['netTotal'];
				
		//insert query
			$query = "INSERT INTO purchase_invoice VALUES(null,$distributer_id,'$date',$amount_paid,$amount_payable, $discount_received,$net_total)";
			$result = mysqli_query($connection,$query);
		
		//select query 	
			$select  = "SELECT * FROM purchase_invoice WHERE distributer_id='".$distributer_id."'AND date='".$date."'AND 
			amount_paid='".$amount_paid."'AND amount_payable='".$amount_payable."'AND discount_received ='".$discount_received."' 
			AND net_total='".$net_total."'";
			$result1 = mysqli_query($connection,$select);
			$row     = mysqli_fetch_array($result1);
			echo json_encode($row);
?>

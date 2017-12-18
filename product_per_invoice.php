<?php include_once "db_connection.php" ?>
<?php		
		$invoice_id     = $_POST['invoice_id'];
		$product_id     = $_POST['product_id'];
		$exp_starting   = $_POST['exp_starting'];
	    $exp_ending     = $_POST['exp_ending'];
		$purchase_price = $_POST['purchase_price'];	
		$sale_price     = $_POST['sale_price'];
		$imei           = $_POST['imei_no'];
		  
			echo $invoice_id;

		//count function count the length of the array
		$length = count($product_id);
				
		//insert query
		
        for($i=0; $i< $length; $i++)
		{
		$query = "INSERT INTO products_per_invoice VALUES(null,'$invoice_id','$product_id[$i]','$imei[$i]','$exp_starting[$i]','$exp_ending[$i]','$purchase_price[$i]','$sale_price[$i]')";
		$result = mysqli_query($connection,$query);
		}
		if(!$result)
			{
				echo "<br>";
				echo "something wrong!";	
			}else{echo "data inserted";}
		
    		
?>

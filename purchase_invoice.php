<?php include_once "db_connection.php" ?>
<!DOCTYPE html>
<html>
<head>
	<title>Purchase_invoice</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<style>
		#formData {

		display:none;

		}
		#mydata {

		display:none;

		}
		#displayInvoiceId{
			margin-top: 30px;
			color:red;
		}
    </style>
</head>
<body>
	<div id="displayData"></div>
	<!--form start -->
	<form>
		Distributors:
			<select name="distributer_id" id="distributer_id">
				<?php
					$query  = "SELECT * FROM distributors";
					$result = mysqli_query($connection, $query);
					
					while($row	=mysqli_fetch_array($result)){
				?>
					<option value="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>	
					
				<?php } ?>
			</select>
		Date:				<input type="Date"   name="date" id="date"/>
		Amount Paid:	    <input type="text"   name="amount_paid" id="amount_paid" />
		Amount Payable:	    <input type="text"   name="amount_payable"id="amount_payable" /><br/><br/>
		Discount Received:	<input type="text"   name="discount_received" id="discount_received">
		Net Total:	        <input type="text"   name="net_total" id="net_total"><br/><br/>
							<button name="button" id="submit">
							Submit
							</button>  
	</form>
	<p id="displayInvoiceId"></p>
	<!--product_per_invoice form -->
	<div id="formData">
		<!-- this form is "product-per-invoice" and display after submit the data of first form -->	
		
				
					Product Name:
											<select name="product_id" id="product_id">
												<?php
													$query  = "SELECT * FROM products";
													$result = mysqli_query($connection, $query);
													
													while($row	=mysqli_fetch_array($result)){
												?>
													<option value="<?php echo $row["id"]; ?>"><?php echo $row["product_name"]; ?></option>	
													
												<?php } ?>
																				
											</select>
					Expiry Starting Date:   <input type="date" name="expiry_starting_date" id="expiry_starting_date" />
					Expiry Ending Date:     <input type="date" name="expiry_ending_date" id="expiry_ending_date" /><br/><br/>
					Purchase Price :        <input type="text" name="purchase_price" id="purchase_price" />
					Sale Price :            <input type="text" name="sale_price" id="sale_price" />
					Imei:                   <input type="text" name="imei" id="imei" value= "" onchange="imeiFunction();"/>
										    
											<br /><br /><button  id="table_heading" onclick="insert();"> Store Array </button><br><br>
											
											<input type="submit" name="submit" id="click"  value="Submit" onclick="objVariables();" />
		`	
	</div>
	<!-- table start tha print the headings and the remaining part of table are defined in the end of this page -->
	<div id="mydata"  style="margin-left : 100px;">
	    <table  border="1"  id="myTableData" cellpadding="2" >
		    <tr>
			    <th> Index_No              </th>
			    <th> Product_Name          </th>
				<th> Expiry_starting       </th>
				<th> Expiry_ending         </th>
				<th> Purchase_price        </th>
				<th> Selling_price         </th>
				<th> IMEI                  </th>
			</tr>
		</table>
		<br/>
    </div>
	<script>
		  //jquery show function that print the table 
		   $("#submit").click(function(){
				$("#formData").show();
			});
			
			//this method print the table heading
			$("#table_heading").click(function(){
				$("#mydata").show();
			});
		
		//variable declare invoice_id 
			let invoiceId;
			let val;
		//Ajax code to send data to php page
		$('#submit').click(function(event){
			//variable declaration
			let disributerId, date, amountPaid, amountPayable, discountReceived, netTotal;
				
				//get values from form and store in javascript variables
					distributerId    = document.getElementById("distributer_id").value;
					date             = document.getElementById("date").value;
					amountPaid       = document.getElementById("amount_paid").value;
					amountPayable    = document.getElementById("amount_payable").value;
					discountReceived = document.getElementById("discount_received").value;
					netTotal		 = document.getElementById("net_total").value;
					
					// this function is used to send data without page reloade
					event.preventDefault();
					
					$.ajax({
					url: "purchase_info.php",
					method: "POST",
					data: {distributerId:distributerId, date:date, amountPaid:amountPaid,amountPayable:amountPayable,
					       discountReceived:discountReceived, netTotal:netTotal},
					})
					//after success 
				  .done(function( data ) {
					  //parseJSON convert the string data into javascript object
					  //"data" include all the data that we recieve
						let json = JSON.stringify(eval('(' + data + ')'));					  
							data = $.parseJSON(json);
					  
						  //we get the invoice id from the object(data)
						   invoiceId = data.id;			
						  //insert the coulmn against the row
						document.getElementById('displayInvoiceId').innerHTML= "Purchase Invoice Id:" + invoiceId;
				  });
				}); // click event

			//product_per_invoice code
			//Arrays are declare
			let productIdArr = new Array();
			let expStartingArr = new Array();
			let expEndingArr = new Array();
			let purchasePriceArr = new Array();
			let salePriceArr = new Array();
			let imeiArr = new Array();
			
		    var productName, expStarting, expEnding, purchasePrice, salePrice, imei;
			
		   function getImeiValue()
			{    
			  let imeiValue = document.getElementById("imei").value;
			  return imeiValue;
			}
			
			
			function imeiFunction()
			{  
					val = getImeiValue();
					imeiArr.push(val);  
					document.getElementById("imei").value = "";
					
			}
			function insert()
			{
				//get the value from the "form" through specific id that are define in form fields then store in variable
				productId      = document.getElementById("product_id").value;
				expStarting      = document.getElementById("expiry_starting_date").value;
				expEnding        = document.getElementById("expiry_ending_date").value;
				purchasePrice    = document.getElementById("purchase_price").value;
				salePrice        = document.getElementById("sale_price").value;
	
				// push is the method of array in javascript ,..and this method push the new value in array 
					productIdArr.push(productId);
					expStartingArr.push(expStarting);
					expEndingArr.push(expEnding);
					purchasePriceArr.push(purchasePrice); 
					salePriceArr.push(salePrice);
					imeiArr.push(imei);
				   
					let table = document.getElementById("myTableData");
					
					//count the table row
					let rowCount = table.rows.length;
					
					//insert the new row
					let row = table.insertRow(rowCount);
					
					//insert the coulmn against the row
					row.insertCell(0).innerHTML= rowCount;
					row.insertCell(1).innerHTML= productId;
					row.insertCell(2).innerHTML= expStarting;
					row.insertCell(3).innerHTML= expEnding;
					row.insertCell(4).innerHTML= purchasePrice;	 
					row.insertCell(5).innerHTML= salePrice;	 
					row.insertCell(6).innerHTML= val;							    				       					
			}
			let product,expS, expE, pPrice, sPrice,imeiNo;
			function objVariables(){
			            product = productIdArr;
						expS = expStartingArr;
						expE = expEndingArr;
						pPrice = purchasePriceArr;
						sPrice = salePriceArr;
						imeiNo = imeiArr;			
			}	
		
			//let model = JSON.stringify(mobileArr);		
				$(document).ready(function(){
					$('#click').click(function(){
					        $.ajax({
							url:"product_per_invoice.php",
							method: "POST",
							data: { invoice_id:invoiceId, product_id:product, exp_starting:expS, exp_ending:expE, purchase_price:pPrice,sale_price:sPrice,imei_no:imeiNo },
                            success:function(message){
								$('#displayData').html(message);
							}
							}); 						
				        }); // click event
				});// ready 
	</script>	
</body>
</html>
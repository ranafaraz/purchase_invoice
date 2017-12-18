<!-- database connection -->
<?php
    define("DB_SERVER","localhost");
	define("DB_USER","root");
	define("DB_PASSWORD","");
	define("DB_NAME","mobile_app");
	$connection=mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
	if(mysqli_connect_errno()) {
		                         die("connection faild!".
								 mysqli_connect_error().
								 "(". mysqli_connect_errno() .")"
								 );
	}
?>
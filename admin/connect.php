 <?php		
	 
    $conn = mysqli_connect(  //Hàm mysqli_connect được sử dụng để kết nối với một MySQL database server. 
	    "localhost",
	    "root",
	    "", 
	    "vietpromoblieshop" 
    );
    mysqli_query($conn, "SET NAMES 'utf8'"); // hàm mysqli_query() thực hiện một truy vấn đến database

?> 

<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' /> 
		<title>录入用户信息</title>
	</head>
	<body>
		<form action="insertcheck.php" method="post">  
			药品名：<input type="text" name="medic_name" />  
			<br />  
			药品生产日期：<input type="text" name="medic_bulid_time" />  
			<br />  
			药品到期日期：<input type="text" name="medic_stay_time" />  
			<br />  
			药品功能：<input type="text" name="medic_function" />  
			<br />  
			<input type="submit" name="submit" value="录入" />  

			<a href="index.php">主界面</a>  
		</form> 
	</body>
</html>
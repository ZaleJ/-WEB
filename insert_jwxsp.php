<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' /> 
		<title>录入药品信息</title>
	</head>
	<body>
		<form action="insertcheck.php" method="post">  
			药品名：<input readOnly="true" name="medic_name" value="健胃消食片" />  
			<br />  
			药品生产日期：<input type="date" name="medic_bulid_time" />  
			<br />  
			药品到期日期：<input type="date" name="medic_stay_time" />  
			<br />  
			药品功能：<input readOnly="true"  name="medic_function" style="width:320px;" value="健胃消食。用于脾胃虚弱所致的食积。" />  
			<br />  
			<input type="submit" name="submit" value="录入" />  

			<a href="index.php">主界面</a>  
		</form> 
	</body>
</html>
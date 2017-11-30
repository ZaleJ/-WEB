<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' /> 
		<title>录入药品信息</title>
	</head>
	<body>
		<form action="insertcheck.php" method="post">  
			药品名：<input readOnly="true" name="medic_name" value="复方黄连素片" />  
			<br />  
			药品生产日期：<input type="date" name="medic_bulid_time" />  
			<br />  
			药品到期日期：<input type="date" name="medic_stay_time" />  
			<br />  
			药品功能：<input readOnly="true"  name="medic_function" style="width:320px;" value="清热燥湿，止气止痛。用于大肠湿热，里急后重或暴注下泄。" />  
			<br />  
			<input type="submit" name="submit" value="录入" />  

			<a href="index.php">主界面</a>  
		</form> 
	</body>
</html>
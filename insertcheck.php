<?php
header("Content-Type: text/html; charset=utf8");

    // error_reporting(E_ALL);  
    // error_reporting(E_ALL || ~E_NOTICE); //显示除去 E_NOTICE 之外的所有错误信息 


	// mysql_connect("localhost","root","");   //连接数据库  
	// mysql_select_db("medics");  //选择数据库  
	// mysql_query("set names 'utf8'"); //设定字符集  


	// $sql_insert = "insert into medic (name,functions) values('辅导员药','变成辅导员')";  
	// $res_insert = mysql_query($sql_insert);
	// if ($res_insert) {
	// 	echo "success";
	// }
	// else{
	// 	die("失败".mysql_error());
	// }

	if(isset($_POST["submit"]) && $_POST["submit"] == "录入")  
	{
	    $name = $_POST["medic_name"];  
	    $bulid = $_POST["medic_bulid_time"];  
	    $stay = $_POST["medic_stay_time"];
	    if($name == "" || $bulid == "" || $stay == "")
	    {  
	        echo "<script>alert('请输入药品名和生产日期与到期日期！');window.location.href='insertcheck.php'</script>";  
	    }  
	    else  
	    {  
	        mysql_connect("localhost","zalej","952440");  
	        mysql_select_db("zalej");  
	        mysql_query("set names 'utf8'");
	        $sql = "select name from medic where name = '$_POST[medic_name]'";  
	        $result = mysql_query($sql);
	        $num = mysql_num_rows($result);
	        if($num)  
	        {  
	            // $row = mysql_fetch_array($result);  //将数据以索引方式储存在数组中  
	            // echo $row[0];  
	            // session_start();  
	            // $_SESSION['ID']=$user;  

	            // header("Location: http://localhost/WPM/logsystem/personalcenter.php"); 

	        	$updatesql0 = "update medic set bulid_time = '$_POST[medic_bulid_time]',stay_time = '$_POST[medic_stay_time]' 
							where name = '$_POST[medic_name]'";
	        	//$updatesql1 = "update medic set stay_time = '$_POST[medic_stay_time]' where name = '$_POST[medic_name]'";
	        	//$result0 = mysql_query($updatesql0) or die(mysql_error($result0));;
	        	//$result1 = mysql_query($updatesql1);
	        	//$num0 = mysql_num_rows($result0);
	        	//echo mysql_error($result0);
	        	$result0 = mysql_query($updatesql0);
	        	$checksql = "select name from medic where bulid_time = '$_POST[medic_bulid_time]' and stay_time = '$_POST[medic_stay_time]'";
	        	$checkresult = mysql_query($checksql);
		        $checknum = mysql_num_rows($checkresult);
		        if($checknum)  {
		        	echo "修改成功";
		        }else{
		        	echo "日期格式不正确";
		        }


	        }  
	        else  
	        {  
	            echo "<script>alert('药品名不正确！');history.go(-1);</script>";  
	        }  
	    }  
	}  
	else  
	{  
	    echo "<script>alert('提交未成功！'); history.go(-1);</script>";  
	}  

 ?>

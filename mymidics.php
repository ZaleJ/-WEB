<?php 
	header("Content-Type: text/html; charset=utf8");
	header('<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">');

	echo '<style type="text/css">







	body {
font: normal 11px auto "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
color: #4f6b72; 
background: #E6EAE9; 
} 

a { 
color: #c75f3e; 
} 

#mytable { 
width: 700px; 
padding: 0; 
margin: 0; 
} 

caption { 
padding: 0 0 5px 0; 
width: 700px; 
font: italic 11px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
text-align: right; 
} 

th { 
font: bold 11px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
color: #4f6b72; 
border-right: 1px solid #C1DAD7; 
border-bottom: 1px solid #C1DAD7; 
border-top: 1px solid #C1DAD7; 
letter-spacing: 2px; 
text-transform: uppercase; 
text-align: left; 
padding: 6px 6px 6px 12px; 
background: #CAE8EA  no-repeat; 
} 

th.nobg { 
border-top: 0; 
border-left: 0; 
border-right: 1px solid #C1DAD7; 
background: none; 
} 

td { 
border-right: 1px solid #C1DAD7; 
border-bottom: 1px solid #C1DAD7; 
background: #fff; 
font-size:11px; 
padding: 6px 6px 6px 12px; 
color: #4f6b72; 
} 


td.alt { 
background: #F5FAFA; 
color: #797268; 
} 

th.spec { 
border-left: 1px solid #C1DAD7; 
border-top: 0; 
background: #fff no-repeat; 
font: bold 10px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
} 

th.specalt { 
border-left: 1px solid #C1DAD7; 
border-top: 0; 
background: #f5fafa no-repeat; 
font: bold 10px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
color: #797268; 
} 
/*---------for IE 5.x bug*/ 
html>body td{ font-size:11px;} 
body,td,th { 
font-family: ËÎÌå, Arial; 
font-size: 12px; 
} 

.wrap{  
width: 250px; //设置需要固定的宽度  
white-space: nowrap; //不换行  
text-overflow: ellipsis; //超出部分用....代替  
overflow: hidden; //超出隐藏  
}  








	</style>';
	error_reporting(0);










	function  substr_cn($string_input,$start,$length) 
{ 
    /* 功能: 
     * 此算法用于截取中文字符串 
     * 函数以单个完整字符为单位进行截取,即一个英文字符和一个中文字符均表示一个单位长度 
     * 参数: 
     * 参数$string为要截取的字符串, 
     * 参数$start为欲截取的起始位置, 
     * 参数$length为要截取的字符个数(一个汉字或英文字符都算一个) 
     * 返回值: 
     * 返回截取结果字符串 
     * */ 
    $str_input=$string_input; 
    $len=$length; 
    $return_str=""; 
    //定义空字符串 
    for ($i=0;$i<2*$len+2;$i++) 
        $return_str=$return_str." "; 
    $start_index=0; 
    //计算起始字节偏移量 
    for ($i=0;$i<$start;$i++) 
    { 
        if (ord($str_input{$start_index}>=161))          //是汉语      
        { 
            $start_index+=2; 
        } 
        else                                          //是英文 
        { 
            $start_index+=1; 
        }         
    }     
    $chr_index=$start_index; 
    //截取 
    for ($i=0;$i<$len;$i++) 
    { 
        $asc=ord($str_input{$chr_index}); 
        if ($asc>=161) 
        { 
            $return_str{$i}=chr($asc); 
            $return_str{$i+1}=chr(ord($str_input{$chr_index+1})); 
            $len+=1; //结束条件加1 
            $i++;    //位置偏移量加1 
            $chr_index+=2; 
            continue;             
        } 
        else  
        { 
            $return_str{$i}=chr($asc); 
            $chr_index+=1; 
        } 
    }     
    return trim($return_str); 
}//end of substr_cn 

	





	function show_my_medics(){
		$MEDIC_TAG=0;

		$conn=mysql_connect("localhost","zalej","952440");  
 		mysql_query("set names 'utf8'");
 		if(!$conn){
		die("数据库连接失败".mysql_error());
		}


		mysql_select_db("zalej");
		$sql="select * from medic";
		$res=mysql_query($sql,$conn);
		if(!$res){
		die("查询失败".mysql_error());
		}

		echo "<table id='mytable' cellspacing='0' border='1'>";
		//$field_infor=mysql_fetch_field($res);
		while($field_infor=mysql_fetch_field($res)){
			//输出属性名
			//echo "<th>".$field_infor->name."</th>";


		}

		echo "<th class='wrap'>药品名</th>";
		echo "<th class='wrap'>生产日期</th>";
		echo "<th class='wrap'>到期时间</th>";
		echo "<th class='wrap'>药品功能</th>";

		echo "<th class='wrap'>药品剩余时间</th>";		//输出药品剩余可用时间

		//逐行输出数据库中内容
		while ($row=mysql_fetch_row($res)){
			echo "<tr>";
			// foreach ($row as $key=>$val){
			// 		echo "<td>$val</td>";
				
			// }

			//输出具有生产日期和到期日期的药品
			if ($row[1]!=NULL && $row[2]!=NULL) {
				//输出药品相关信息
				for ($i=0; $i < 4 ; $i++) {
					//$MEDIC_TAG
					$MYDICS[$MEDIC_TAG][$i]=$row[$i];
					//echo "<td class='wrap'>$row[$i]</td>";
					if ($i%3==0 && $i!=0) {
						$MEDIC_TAG++;
					}
				}

				//$row[1]为生产日期的值，$row[2]为到期日期的值
				//last_time = stay_time.year * 360 + stay_time.month*30 + stay_time.day-bulid_time.year * 360 - bulid_time.month*30 - bulid_time.day
				
				//TODO-DONE 分别获取生产日期和到期日期的年月日
				$bulidYear = $row[1][0]*1000 + $row[1][1]*100 + $row[1][2]*10 + $row[1][3];
				$bulidMonth = $row[1][5]*10 + $row[1][6];
				$bulidDay = $row[1][8]*10 + $row[1][9];
				// echo $bulidYear; 
				// echo $bulidMonth;
				// echo $bulidDay;

				$stayYear = $row[2][0]*1000 + $row[2][1]*100 + $row[2][2]*10 + $row[2][3];
				$stayMonth = $row[2][5]*10 + $row[2][6];
				$stayDay = $row[2][8]*10 + $row[2][9];
				// echo $stayYear; 
				// echo $stayMonth;
				// echo $stayDay;


				$nowYear = date("Y");
				$nowMonth = date("m");
				$nowDay = date("d");

				// echo $nowYear;
				// echo $nowMonth;
				// echo $nowDay;


				$LASTED = $stayYear*365 + $stayMonth*30 + $stayDay - ($nowYear*365 + $nowMonth*30 + $nowDay);
				// if ($LASTED < 0) {
				// 	$LASTED = 0;
				// }


				if($LASTED >= -15){
					for ($i=0; $i < 4; $i++) {
						echo "<td class='wrap'>$row[$i]</td>";
					}
					if ($LASTED <= 0) {
						echo "<script>alert('$row[0]已过期')</script>";
						echo "<td class='wrap'>$LASTED 天(已过期)</td>";
					}else if ($LASTED < 15) {
						echo "<script>alert('$row[0]即将过期')</script>";
						echo "<td class='wrap'>$LASTED 天(即将过期)</td>";
					}else
						echo "<td class='wrap'>$LASTED 天</td>";
				}


				
			}
			
			echo "</tr>";
		}


		echo "</table>";



		
		// echo $MYDICS[1][0];
		// echo $MYDICS[1][1];
		// echo $MYDICS[1][2];
		// echo $MYDICS[1][3];

		return $MYDICS;






	}

	function searchValueIn($MedicName,$MedicInfo, $SearchValue){
		for ($i=0; $i <= mb_strlen($MedicInfo, 'UTF-8')-mb_strlen($SearchValue, 'UTF-8'); $i++) { 
			// echo mb_substr($MedicInfo, $i, mb_strlen($SearchValue, 'UTF-8'), 'UTF-8'); 
			// echo "next";
			// if (mb_substr($MedicInfo, $i, mb_strlen($SearchValue, 'UTF-8'), 'UTF-8')==$SearchValue) {
			// 	echo "fuck you chinese characteristic";
			// }

			if (mb_substr($MedicInfo, $i, mb_strlen($SearchValue, 'UTF-8'), 'UTF-8')==$SearchValue && $SearchValue != "") {
				echo $MedicName;
				echo "  ";
				break;
			}
		}

	}

	




	$showResult=show_my_medics();
	echo '<form action="#" method="post"><p><input type="text" name="searchMedic" value="" id="" class="one" placeholder="输入症状" /><input type="submit" class="one1" value="搜索"></input></p></form>';
	//echo $showResult[0][3];
	//$showResulte = $showResult[0][3];


	//echo count($showResult);

	for ($i=0; $i < count($showResult); $i++) {
		searchValueIn($showResult[$i][0], $showResult[$i][3], $_POST['searchMedic']);
	}

	//searchValueIn($showResulte, $_POST['searchMedic']);






 ?>

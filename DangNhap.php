<!DOCTYPE html>
<html>
<?php
	include 'lb.php';
?>
<head>
	<title>Trường THCS &amp; THPT Nguyễn Tất Thành - Hà Nội</title>
	<link rel="shortcut icon" href="img/LogoNTT.png">
	<link rel="stylesheet" type="text/css" href="css/layout.css">
</head>
<style type="text/css">
	.content{
		border: 1px solid; 
		border-color:lightgray; 
		width: 35%; 
		background-color: white; 
		border-radius: 10px;
		/*vertical-align: middle;*/
	}
	.text1{
		margin-top: 8px;
		border-radius: 5px;
		height: 40px;
		width: 70%;
		font-size: 20px;

		background-color: rgb(232, 240, 254);
	}
	.submitDN{
		width: 71%;
		height: 40px;
		margin-top: 8px;
		font-size: 17px;
		color: white;
		border-radius: 5px;
		border: none;
		background-color: blue;
	}
</style>
<script type="text/javascript">
	function Home() {
		location.href = "index.php"
	}
</script>
<?php
	function checkAccount($id,$pw){
		session_start();
		$conn=mysqli_connect('localhost','root','','quanlyts') or die("Không thể kết nối tới cơ sở dữ liệu");
        if($conn)
        {
        	mysqli_query($conn,"SET NAMES 'utf8'");
        	$query = "select * FROM taikhoan WHERE UserName='$id' and Password='$pw'";
        	$data=mysqli_query($conn,$query);
        	if (mysqli_num_rows($data)==1){
        		$_SESSION['GV']=1;
        		return true;
        	}
        	else{
        		return false;
        	}
        }else{
            echo "Bạn đã kết nối thất bại".mysqli_connect_erro();
        }
	}
?>
<?php 
	if (isset($_POST['dn'])) {
		if (trim($_POST['id']=='')){
			showPopup("Bạn chưa nhập Tên Đăng nhập");
		}else{
			if (checkAccount($_POST['id'],$_POST['pw'])!=false){
				showTB("Đăng nhập thành công!","index.php");
				// showPopup("Đăng nhập thành công!");
				// header("location: index.php");
				//echo $_SESSION['user']." ".$_SESSION['name'];
			}
			else{
				showPopup("Username hoặc password không đúng");
			}
		}
	}
?>
<body bgcolor="#f3f5f7">
<form action="#" method="POST">
	<div align="center" style="margin-top:10%">
		<div align="center" class="content">
			<table>
				<tr>
					<td>
						<img src="img/LogoNTT.png" onclick="Home()" style="width: 120px;">	
					</td>
					<td>
						<p align="center" style="color:blue; font-size: 20px">Trường THCS và THPT</p>
						<p align="center" style="color:red; font-size:30px">Nguyễn Tất Thành</p>
					</td>
				</tr>
			</table>
			<div style="margin-top:4%">
				<input type="text" name="id" placeholder="Tên đăng nhập" size="40" class="text1">
				<input type="password" name="pw" placeholder="Mật khẩu" size="40" class="text1">
				<p></p>
				<input type="submit" name="dn" value="Đăng nhập" class="submitDN">
				<p style="margin: 5px 0px">*Đăng nhập chỉ dành cho giáo viên</p>
			</div>
		</div>	
		</div>
		<!-- <div style="height: 2000px; "> -->
		</div>
	</div>
</form>
</body>
</html>
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
	.menu{
	background-color: white;
	width: 100%;
	height: 60px;
	list-style: none;
}
</style>
<script type="text/javascript">
	function Home() {
		location.href = "index.php"
	}
	function DK(){
		location.href = "DangKy.php";
	}
	function tracuuTT() {
		location.href = "TraCuuTT.php";
	}
	function tracuuDT() {
		location.href = "TraCuuDT.php";
	}
	function DangNhap(){
		location.href = "DangNhap.php"
	}
	function DangXuat(){
		location.href = "DangXuat.php"
	}
	function QLTS() {
		location.href = "QuanLyTS.php"
	}
</script>
<body bgcolor="#f3f5f7">
	<div>
		<div style="position: fixed;top: 0px; width: 100%; border-bottom: 1px solid; border-color: lightgray;" align="center">
			<ul class="menu">
				<li style="margin-left:18%"><img src="img/LogoNTT.png" height="50px" onclick="Home()"></li>
				<li style="margin-left:30%;"><input type="submit" name="" value="Tuyển sinh" onclick="DK()" class="dm"></li>
				<li>
					<input type="submit" name="" value="Danh mục" class="dm">
					<ul class="menu1">
						<li><input type="submit" name="" value="Tra cứu thông tin" onclick="tracuuTT()"></li>
						<li><input type="submit" name="" value="Tra cứu điểm thi" onclick="tracuuDT()"></li>
						<?php
						 	session_start();
							if (isset($_SESSION['GV'])) {
								if ($_SESSION['GV'] == 1) {
									echo '<li><input type="submit" name="" value="Quản lý tuyển sinh" onclick="QLTS()"></li>';
								}
							}
						?>
					</ul>
				</li>
				<?php
					if (isset($_SESSION['GV'])) {
						if ($_SESSION['GV']==1)
						echo '<li style="border-left: 2px solid; border-color: lightgray;"><input type="submit" name="" value="Đăng xuất" style="color: blue;" class="dn" onclick="DangXuat();"></li>';
					}
					else
						echo '<li style="border-left: 2px solid; border-color: lightgray;"><input type="submit" name="" value="Đăng nhập" style="color: blue;" class="dn" onclick="DangNhap();"></li>';
				?>
			</ul>
		</div>
	</div>
	<div>
		<img src="img/Background.png" style="margin-top: 4%;">
		<div style="background-color:#002699; width: 100%; height:80px; color:white; margin-top: 60px;" align="center">
		<div style="height:10px"></div>
		<p>Trường THCS & THPT Nguyễn Tất Thành - Đại học Sư phạm Hà Nội</p>
		<p>Địa chỉ: 136 Đường Xuân Thuỷ, Quận Cầu Giấy, Hà Nội - Điện thoại : Văn phòng (+84)-24-6684-9823; Tài vụ (+84)-24-6684-9824</p>
		<p> Website: https://ntthnue.edu.vn - Email: info@ntthnue.edu.vn. Ghi rõ nguồn https://ntthnue.edu.vn khi trích dẫn thông tin từ website này</p>
	</div>
	</div>
</body>
</html>
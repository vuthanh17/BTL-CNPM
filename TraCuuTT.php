<!DOCTYPE html>
<html>
<?php 
	include("lb.php");
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
.FTraCuu{
	font-size: 15px;
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
		<form action="#" method="POST">
		<div>
			<div class="title1" >
				<h1>Tra cứu thông tin thí sinh</h1>
			</div>
			<div align="center">
				<table class="FTraCuu">
					<tr>
						<td colspan="3"><div align="center" style="font-size:20px">Thí sinh nhập căn cước công dân vào ô dưới đây:</div></td>
					</tr>
					<tr align="center" style="border: 1px solid;">
						<td colspan="5" >
							<div align="center" style="">
								<input type="text" name="txtTimKiem" size="30">
								<input type="submit" name="TimKiem" value="Tìm kiếm" style="background-color:blue; color: white; height: 20px; border:none; width: 80px;">
							</div>
						</td>
					</tr>
					<tr><td height="80px"></td></tr>
				<?php
					if (isset($_POST['TimKiem'])) {

						$txtTimKiem = $_POST['txtTimKiem'];

						$conn=mysqli_connect('localhost','root','','quanlyts') or die("Không thể kết nối tới cơ sở dữ liệu");
				        if($conn){
				        	mysqli_query($conn,"SET NAMES 'utf8'");
				        }else{
				            echo "Bạn đã kết nối thất bại".mysqli_connect_erro();
				        }
						$qrTimKiem="SELECT thisinh.CCCD, HoTen, NgaySinh, GioiTinh, DanToc, NoiSinh, DCThuongTru, DCHienTai, DCThi, DCNghe, Anh, TTThi, sobaodanh.SBD, sobaodanh.PhongThi  FROM thisinh LEFT JOIN sobaodanh ON thisinh.CCCD=sobaodanh.CCCD WHERE thisinh.CCCD = '$txtTimKiem'";
						$acTimKiem = mysqli_query($conn,$qrTimKiem);
						if (is_numeric($txtTimKiem) && strlen(trim($txtTimKiem))==12) {
							if (mysqli_num_rows($acTimKiem)>0) {
								$row = mysqli_fetch_array($acTimKiem)
								?>
								<tr>
									<td rowspan="7" style="border-right: 1px solid;"><div align="center"><img style="height: 200px;" src="<?php echo $row[10] ?>"></div></td>
									<td>Họ tên: <?php echo $row[1] ?></td>
									<td>CCCD: <?php echo $row[0] ?></td>
								</tr>
								<tr>
									<td>Ngày sinh: <?php echo $row[2] ?></td>
									<td>Giới tính: <?php echo $row[3] ?></td>
								</tr>
								<tr>
									<td>Dân tộc: <?php echo $row[4] ?></td>
									<td>Nơi sinh: <?php echo $row[5] ?></td>
								</tr>
								<tr>
									<td colspan="3">Địa chỉ thường trú: <?php echo $row[6] ?></td>
								</tr>
								<tr>
									<td colspan="3">Địa chỉ hiện tại: <?php echo $row[7] ?></td>
									<!-- <td><input type="submit" name="Sua" value="Sửa"></td> -->
								</tr>
								<tr>
									<td>Điểm cộng thi học sinh giỏi: <?php switch ($row[8]) {
										case 0:
											echo "Không có";
											break;
										case 1:
											echo "Giải ba: +1";
											break;
										case 1.5:
											echo "Giải nhì: +1.5";
											break;
										case 2:
											echo "Giải nhất: +2";
											break;
									} ?>
									</td>
								</tr>
								<tr>
									<td colspan="2">Đối tượng ưu tiên: <?php switch ($row[9]) {
										case 0:
											echo "Không có";
											break;
										case 0.5:
											echo "Loại trung bình: +0.5";
											break;
										case 1:
											echo "Loại khá: +1";
											break;
										case 1.5:
											echo "Loại giỏi: +1.5";
											break;
									} ?>
									</td>
								</tr>
								<tr>
									<td colspan="3">
										<fieldset>
											<legend>Thông tin dự thi</legend>
											<table>
												<tr>
													<td width="65%">
														Trạng thái thi: 
														<?php
														switch ($row[11]) {
															case 0:
																echo "Đang chờ xét duyệt";
																break;
															case 1:
																echo "Đã duyệt - Đủ diều kiện dự thi";
																break;
															case 3:
																echo "Đã duyệt - Không đạt điều kiện thi";
																break;
														}
														?>
														</td>
													<td width="22%">Số báo danh: <?php echo $row[12] ?></td>
													<td>Phòng thi: <?php echo $row[13] ?></td>
												</tr>
											</table>
										</fieldset>
									</td>
								</tr>
								
				<?php
							}else{
								echo'<tr>
									<td><div align="center" style="color:red">Không tìm thấy thí sinh</div></td>
								</tr>';
							}
						}
						else echo'<tr>
									<td><div align="center" style="color:red">Căn cước công dân chưa nhập đúng</div></td>
								</tr>';
					}
				?>
					
				</table>
			</div>
		</div>
		</form>
	</div>
	<div style="background-color:#002699; width: 100%; height:80px; color:white; margin-top: 60px;" align="center">
		<div style="height:10px"></div>
		<p>Trường THCS & THPT Nguyễn Tất Thành - Đại học Sư phạm Hà Nội</p>
		<p>Địa chỉ: 136 Đường Xuân Thuỷ, Quận Cầu Giấy, Hà Nội - Điện thoại : Văn phòng (+84)-24-6684-9823; Tài vụ (+84)-24-6684-9824</p>
		<p> Website: https://ntthnue.edu.vn - Email: info@ntthnue.edu.vn. Ghi rõ nguồn https://ntthnue.edu.vn khi trích dẫn thông tin từ website này</p>
	</div>
</body>
</html>
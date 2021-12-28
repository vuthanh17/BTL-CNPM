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
				<h1>Tra cứu điểm thi</h1>
			</div>
			<div align="center">
				<table class="FTraCuu">
					<tr>
						<td colspan="5"><div align="center" style="font-size:20px">Thí sinh tra cứu theo số báo danh hoặc căn cước công dân</div></td>
					</tr>
					<tr>
						<td width="30%"><div style="margin-left:50%">CCCD:</div></td>
						<td  colspan="2" width="40%">
							<input type="text" name="txtCCCD" size="32">
						</td>
						<td rowspan="2"><input type="submit" name="TimKiem" value="Tra cứu" style="height: 41px; width: 70px; background-color:blue; color: white; border:none;"></td>
					</tr>
					<tr>
						<td><div style="margin-left:50%">Số báo danh:</div></td>
						<td colspan="2"><input type="text" name="txtSBD" size="32"></td>
					</tr>
					<tr><td height="80px"></td></tr>
				<?php
					$TB="";
					if (isset($_POST['TimKiem'])) {

						$txtCCCD = $_POST['txtCCCD'];
						$txtSBD = $_POST['txtSBD'];

						$conn=mysqli_connect('localhost','root','','quanlyts') or die("Không thể kết nối tới cơ sở dữ liệu");
				        if($conn){
				        	mysqli_query($conn,"SET NAMES 'utf8'");
				        }else{
				            echo "Bạn đã kết nối thất bại".mysqli_connect_erro();
				        }
				        if (trim($txtCCCD)=="" && trim($txtSBD)==""){
				        	$TB= "Không tìm thấy thí sinh" ;
				        	goto TB;
				        }
				        if (trim($txtCCCD)!="" && trim($txtSBD)!=""){
				        	$TB= "Chỉ tra cứu theo một tiêu chí" ;
				        	goto TB;
				        }
				        if (trim($txtCCCD) !="" ){
				        	$qrTraCuu = "SELECT HoTen, Mon1, Mon2, Mon3, Mon4, TongDiem ,TTDO FROM thisinh,sobaodanh,diem WHERE thisinh.CCCD = sobaodanh.CCCD AND sobaodanh.SBD = diem.SBD AND thisinh.CCCD = '$txtCCCD'";
				        }
				        if (trim($txtSBD) !="" ){
				        	$qrTraCuu = "SELECT HoTen, Mon1, Mon2, Mon3, Mon4, TongDiem ,TTDO FROM thisinh,sobaodanh,diem WHERE thisinh.CCCD = sobaodanh.CCCD AND sobaodanh.SBD = diem.SBD AND sobaodanh.SBD = '$txtSBD'";
				        }
						$acTraCuu = mysqli_query($conn,$qrTraCuu);
						if (mysqli_num_rows($acTraCuu)>0) {
							$row = mysqli_fetch_array($acTraCuu)
							?>
							<tr>
								<td>Họ tên: <?php echo $row[0] ?></td>
								<td>Tổng điểm: <?php echo $row[5] ?></td>
								<td>Đỗ/trượt: 
									<?php
										if($row[6]==1)
											echo "Đỗ";
										else
											echo "Trượt";
									?>
									</td>
							</tr>
							<tr>
								<td>Điểm thi các môn:</td>
							</tr>
							<tr>
								<td colspan="5">
									<table cellspacing="20px">
										<tr>
											<td>Điểm Toán: <?php echo $row[1] ?></td>
											<td>Điểm Ngữ Văn: <?php echo $row[2] ?></td>
											<td>Điểm Ngoại Ngữ: <?php echo $row[3] ?></td>
											<td>Điểm Môn tự chọn: <?php echo $row[4] ?></td>
										</tr>
									</table>
								</td>
								
							</tr>
				<?php
						}else{
							$TB="Không tìm thấy thí sinh";
							goto TB;
						}
					}
					TB:
						echo "<tr>
								<td colspan='4'><div align='center' style='color:red'>$TB</div></td>
							</tr>";
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
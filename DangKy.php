<!DOCTYPE html>
<html>
<?php
	include 'lb.php';
?>
<head>
	<title>Trường THCS &amp; THPT Nguyễn Tất Thành - Hà Nội</title>
	<link rel="shortcut icon" href="img/LogoNTT.png">
	<link rel="stylesheet" type="text/css" href="layout.css">
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
		<div>
			<form action="#" method="POST" enctype="multipart/form-data">
			<?php 
			    $conn=mysqli_connect('localhost','root','','quanlyts') or die("Không thể kết nối tới cơ sở dữ liệu");
			        if($conn){
			        	mysqli_query($conn,"SET NAMES 'utf8'");
			        }else{
			            echo "Bạn đã kết nối thất bại".mysqli_connect_erro();
			        }
				$qrLoaiSP = "SELECT * FROM loai_dien_thoai";
				$acLoaiSP = mysqli_query($conn,$qrLoaiSP);
			?>
			<?php
				$CCCD="";
				$hoten="";
				$ngaysinh="";
				$gioitinh="";
				$dantoc="";
				$noisinh="";
				$DCThi="";
				$DCNghe="";
				$DCthuongtru="";
				$DChientai="";
				$TB="";
				if (isset($_POST['DangKy'])) {
					$CCCD=$_POST['CCCD'];
					$hoten=$_POST['hoten'];
					$ngaysinh = date('Y-m-d', strtotime($_POST['ngaysinh']));
					// $ngaysinh=$_POST['ngaysinh'];
					$gioitinh=$_POST['gioitinh'];
					$dantoc=$_POST['dantoc'];
					$noisinh=$_POST['noisinh'];
					$DCThi=$_POST['DCThi'];
					$DCNghe=$_POST['DCNghe'];
					$DCthuongtru=$_POST['DCthuongtru'];
					$DChientai=$_POST['DChientai'];
					$anh="img/".$_FILES['anh']['name'];
					$insertThiSinh="insert into thisinh values('$CCCD','$hoten','$ngaysinh
					','$gioitinh','$dantoc','$noisinh','$DCthuongtru','$DChientai','$DCThi','$DCNghe','$anh','0','0')";
					if (strlen(trim($CCCD))==12 && is_numeric($CCCD)) {
					}
					else{
						$TB = "Căn cước công dân nhập chưa đúng";
						goto TB;
					}
					if (trim($hoten)=="") {
						$TB = "Bạn chưa nhập Họ và tên";
						goto TB;
					}
					if ($ngaysinh=="") {
						$TB = "Bạn chưa nhập Ngày sinh";
						goto TB;
					}
					if (trim($dantoc)=="") {
						$TB = "Bạn chưa nhập Dân tộc";
						goto TB;
					}
					if (trim($noisinh)=="") {
						$TB = "Bạn chưa nhập Nơi sinh";
						goto TB;
					}
					if (trim($DCthuongtru)=="") {
						$TB = "Bạn chưa nhập Địa chỉ thường trú";
						goto TB;
					}
					if (trim($DChientai)=="") {
						$TB = "Bạn chưa nhập Địa chỉ hiện tại";
						goto TB;
					}
					if ($anh=="img/") {
						$TB = "Bạn chưa tải ảnh lên";
						goto TB;
					}
					if (insert_db($insertThiSinh)) {
						$TB = "Đăng ký thành công";
					}
					else $TB="Đăng ký thất bại!";
					TB:
					showPopup("$TB");
				}
			?>
			<div class="title1" >
				<h1>Đăng ký thi tuyển</h1>
			</div>
			<div align="center">
				<table class="FXetTuyen">
					<tr>
						<td>Căn cước công dân</td>
						<td><input type="text" name="CCCD" class="txtDK" value="<?php echo $CCCD ?>"></td>
					</tr>
					<tr>
						<td>Họ và tên</td>
						<td><input type="text" name="hoten" class="txtDK" value="<?php echo $hoten ?>"></td>
					</tr>
					<tr>
						<td>Ngày sinh</td>
						<!-- <td><input type="text" name="ngaysinh" class="txtDK" value="<?php echo $ngaysinh ?>"></td> -->
						<td><input type="date" name="ngaysinh" value="<?php echo $ngaysinh ?>"></td>
					</tr>
					<tr>
						<td>Giới tính</td>
						<td>
							<input type="radio" name="gioitinh" value="Nam" <?php if ($gioitinh == "Nam" || $gioitinh=="") echo 'checked = true' ?> >Nam
							<input type="radio" name="gioitinh" value="Nữ" style="margin-left:25%" <?php if ($gioitinh == "Nữ") echo 'checked = true' ?> >Nữ
						</td>
					</tr>
					<tr>
						<td>Dân tộc</td>
						<td><input type="text" name="dantoc" class="txtDK" value="<?php echo $dantoc ?>"></td>
					</tr>
					<tr>
						<td>Nơi sinh</td>
						<td><input type="text" name="noisinh" class="txtDK" value="<?php echo $noisinh ?>"></td>
					</tr>
					<tr>
						<td>Điểm cộng thi học sinh giỏi</td>
						<td>
							<select name="DCThi">
								<option value="0">Không thuộc dạnh nào</option>
								<option value="2">Giải nhất +2</option>
								<option value="1.5">Giải nhì +1.5</option>
								<option value="1">Giải ba +1</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Đối tượng học sinh ưu tiên</td>
						<td>
							<select name="DCNghe">
								<option value="0">Không thuộc dạng nào</option>
								<option value="1.5">Loại một +1.5</option>
								<option value="1">Loại hai +1</option>
								<option value="0.5">Loại ba +0.5</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Địa chỉ thường trú:</td>
					</tr>
					<tr>
						<td colspan="2"><textarea name="DCthuongtru" style="width: 100%;" rows="4"><?php echo $DCthuongtru ?></textarea></td>
					</tr>
					<tr>
						<td>Địa chỉ hiện tại:</td>
					</tr>
					<tr>
						<td colspan="2"><textarea name="DChientai" style="width: 100%;" rows="4"><?php echo $DChientai ?></textarea></td>
					</tr>
					<?php
						if (isset($_FILES["anh"])) {
							move_uploaded_file($_FILES['anh']['tmp_name'],"img/".$_FILES['anh']['name']);
						}
					?>
					<tr>
						<td>Ảnh cá nhân</td>
						<td><input type="file" name="anh"></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input type="submit" name="DangKy" value="Đăng ký" class="submitDK"></td>
					</tr>
				</table>
			</div>
		</div>
		</form>
	</div>
	<div></div>
	<div style="background-color:#002699; width: 100%; height:80px; color:white; margin-top: 60px;" align="center">
		<div style="height:10px"></div>
		<p>Trường THCS & THPT Nguyễn Tất Thành - Đại học Sư phạm Hà Nội</p>
		<p>Địa chỉ: 136 Đường Xuân Thuỷ, Quận Cầu Giấy, Hà Nội - Điện thoại : Văn phòng (+84)-24-6684-9823; Tài vụ (+84)-24-6684-9824</p>
		<p> Website: https://ntthnue.edu.vn - Email: info@ntthnue.edu.vn. Ghi rõ nguồn https://ntthnue.edu.vn khi trích dẫn thông tin từ website này</p>
	</div>
</body>
</html>
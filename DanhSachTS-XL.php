<!DOCTYPE html>
<html>
<?php
	include 'lb.php';
?>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="layout.css">
	<title></title>
</head>
<body>
	<form action="#" method="POST">
	<a href="DanhSachTS.php">Quay lại</a>
<?php
if (isset($_POST['TimKiem'])) {
	$txtTimKiem = $_POST['txtTimKiem'];
	$conn=mysqli_connect('localhost','root','','quanlyts') or die("Không thể kết nối tới cơ sở dữ liệu");
        if($conn){
        	mysqli_query($conn,"SET NAMES 'utf8'");
        }else{
            echo "Bạn đã kết nối thất bại".mysqli_connect_erro();
        }
        if ($_POST['Loai']==1) {
        	$qrDSThiSinh = "SELECT CCCD, HoTen, NgaySinh, GioiTinh, DanToc, NoiSinh, DCThuongTru, DCHienTai, DCThi, DCNghe, Anh, TTThi FROM thisinh WHERE CCCD like '%$txtTimKiem%' ";
        }
        else
        	$qrDSThiSinh = "SELECT CCCD, HoTen, NgaySinh, GioiTinh, DanToc, NoiSinh, DCThuongTru, DCHienTai, DCThi, DCNghe, Anh, TTThi FROM thisinh WHERE HoTen like '%$txtTimKiem%' ";
	$acDSThiSinh = mysqli_query($conn,$qrDSThiSinh);
	if (mysqli_num_rows($acDSThiSinh)>0) {
?>
		<table>
			<tr>
				<td><div align="center" style="border: 1px solid;"><b style="font-size:20px">Ảnh</b></div></td>
				<td colspan="2" width="100%"><div align="center" style="border: 1px solid;"><b style="font-size:20px">Thông tin thí sinh</b></div></td>
			</tr>
	<?php
		while ($row = mysqli_fetch_array($acDSThiSinh)){ ?>
			<tr>
				<td rowspan="7" style="border-right: 1px solid;"><div align="center"><img style="height: 200px;" src="<?php echo $row[10] ?>"></div></td>
				<td>Họ tên: <?php echo $row[1] ?></td>
				<td>CCCD: <?php echo $row[0] ?></td>
				<td rowspan="8">
					<input type="submit"
						<?php $n1 = 'name="Sua'.$row[0].'"'; echo $n1 ?> value="Sửa">
				</td>
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
				<td colspan="2">Địa chỉ thường trú: <?php echo $row[6] ?></td>
			</tr>
			<tr>
				<td colspan="2">Địa chỉ hiện tại: <?php echo $row[7] ?></td>
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
			<tr><td colspan="3"><div style="border: 1px solid;"></div></td></tr>
	<?php
		}
	?>
		</table>
<?php
	}
	else
		echo "<div align='center'>Không tìm thấy kết quả nào</div>";
	goto end;
}
session_start();
//Sua
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
$CC="";
$conn=mysqli_connect('localhost','root','','quanlyts') or die("Không thể kết nối tới cơ sở dữ liệu");
    if($conn){
    	mysqli_query($conn,"SET NAMES 'utf8'");
    }else{
        echo "Bạn đã kết nối thất bại".mysqli_connect_erro();
    }
$qrDSThiSinh = "SELECT CCCD,HoTen,NgaySinh,GioiTinh,DanToc,NoiSinh,DCThuongTru,DCHienTai,DCThi,DCNghe,Anh FROM thisinh";
$acDSThiSinh = mysqli_query($conn,$qrDSThiSinh);
while ($row = mysqli_fetch_array($acDSThiSinh)){ 
	$Sa = "Sua".$row[0];
	if (isset($_POST["$Sa"])) {
		$_SESSION['CC']=$row[0];
		$hoten=$row[1];
		$ngaysinh=$row[2];
		$gioitinh=$row[3];
		$dantoc=$row[4];
		$noisinh=$row[5];
		$DCthuongtru=$row[6];
		$DChientai=$row[7];
		$DCThi=$row[8];
		$DCNghe=$row[9];
		break;
	}
}
$qrSua = "SELECT CCCD,HoTen,NgaySinh,GioiTinh,DanToc,NoiSinh,DCThuongTru,DCHienTai,DCThi,DCNghe FROM thisinh WHERE CCCD = '$CC'";

$acSua= mysqli_query($conn,$qrSua);
$row = mysqli_fetch_array($acSua);
if (isset($_POST['SuaTT'])) {
	$CCCD = $_SESSION['CC'];
	$hoten=$_POST['hoten'];
	$ngaysinh = date('Y-m-d', strtotime($_POST['ngaysinh']));
	$gioitinh=$_POST['gioitinh'];
	$dantoc=$_POST['dantoc'];
	$noisinh=$_POST['noisinh'];
	$DCThi=$_POST['DCThi'];
	$DCNghe=$_POST['DCNghe'];
	$DCthuongtru=$_POST['DCthuongtru'];
	$DChientai=$_POST['DChientai'];
	$qrUpdateTT="UPDATE thisinh SET HoTen='$hoten',NgaySinh='$ngaysinh',GioiTinh='$gioitinh',DanToc='$dantoc',NoiSinh='$noisinh',DCThuongTru='$DCthuongtru',DCHienTai='$DChientai',DCThi = '$DCThi', DCNghe = '$DCNghe' WHERE CCCD='$CCCD'";
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
	if (insert_db($qrUpdateTT)) {
		$TB = "Sửa thành công";
	}
	else $TB="Sửa ký thất bại!";
	TB:
	showPopup("$TB");
}
?>
		<div align="center">
		<table class="FXetTuyen" style="width:100%">
			<tr>
				<td>Căn cước công dân</td>
				<td>
					<input type="text" name="CCCDsua" disabled=true class="txtDK" value="<?php echo $_SESSION['CC'] ?>">
				</td>
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
					<input type="radio" name="gioitinh" value="Nam" <?php if ($gioitinh == "Nam") echo 'checked = true' ?> >Nam
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
				<td>Điểm cộng trong kỳ thi học sinh giỏi</td>
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
			<tr>
				<td colspan="2" align="center"><input type="submit" name="SuaTT" value="Sửa" class="submitDK"></td>
			</tr>
		</table>
		</div>
<?php
end:
?>
</form>
</body>
</html>

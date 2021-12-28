<!DOCTYPE html>
<html>
<?php
	include 'lb.php';
?>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<form action="#" method="POST">
	<?php 
	    $conn=mysqli_connect('localhost','root','','quanlyts') or die("Không thể kết nối tới cơ sở dữ liệu");
	        if($conn){
	        	mysqli_query($conn,"SET NAMES 'utf8'");
	        }else{
	            echo "Bạn đã kết nối thất bại".mysqli_connect_erro();
	        }
		$qrDSThiSinh = "SELECT CCCD,HoTen,NgaySinh,GioiTinh,DanToc,NoiSinh,DCThuongTru,DCHienTai,DCThi,DCNghe,Anh,TTThi FROM thisinh";
		$acDSThiSinh = mysqli_query($conn,$qrDSThiSinh);
	?>
	<?php
		$qrSBD = "SELECT CCCD,TTThi FROM thisinh";
		$acSBD = mysqli_query($conn,$qrSBD);
		$SBD = 0;
		$phongthi = 1;
		$checkF = 0;
		function checkSBD($CheckSBD){
			$conn=null;
			$conn=mysqli_connect('localhost','root','','quanlyts') or die("Không thể kết nối tới cơ sở dữ liệu");
	        if($conn)
	        {
	        	mysqli_query($conn,"SET NAMES 'utf8'");
	        	$qrCheckSBD = "select * FROM sobaodanh WHERE SBD='$CheckSBD'";
	        	$acCheckSBD=mysqli_query($conn,$qrCheckSBD);
	        	if (mysqli_num_rows($acCheckSBD)==1){
	        		return true;
	        	}
	        	else{
	        		return false;
	        	}
	        }else{
	            echo "Bạn đã kết nối thất bại".mysqli_connect_erro();
	        }
		}
		if (isset($_POST['taoSBD'])) {
			while($row1 = mysqli_fetch_array($acSBD)){
				if ($row1[1]==1) {
					$SBD = $SBD+1;
						if ($SBD%24==0) {
							$phongthi = $phongthi + 1;
					}
					if (CheckSBD($SBD)) {
						continue;
					}
					else{
						$qrInsertSBD = "insert into sobaodanh values($SBD,$row1[0],$phongthi)";
						$qrInsertDiem = "INSERT INTO diem(`SBD`) VALUES ($SBD)";
						if(insert_db($qrInsertSBD)){
						}
						else{
							$checkF= $checkF + 1;
						}
						if(insert_db($qrInsertDiem)){
						}
						else{
							$checkF= $checkF + 1;
						}
					}
				}
			}
			if ($checkF ==0 ) 
				showPopup("Tạo số báo danh thành công");
			else
				showPopup("Có $checkF thí sinh chưa được tạo số báo danh");
		}
	?>
	<table>
		<tr>
			<td><input type="submit" name="taoSBD" value="Tạo số báo danh"></td>
</form>
<form action="DanhSachTS-XL.php" method="POST">
			<td width="45%"></td>
			<td>
				<select name="Loai">
					<option value="1">CCCD</option>
					<option value="2">Họ tên</option>
				</select>
			</td>
			<td><input type="text" name="txtTimKiem"></td>
			<td><input type="submit" name="TimKiem" value="Tìm kiếm"></td>
		</tr>
	</table>
	<?php
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
	?>
	</form>
</body>
</html>
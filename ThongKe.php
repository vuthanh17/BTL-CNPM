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
<script type="text/javascript">
	function test(argument) {
		
	}
</script>
<body>
	<form action="#" method="POST">
	<div>
		<table>
			<tr>
				<td>
					<select name="Loai">
						<option value="1" onclick="test()">Sắp xếp theo số lượng thí sinh</option>
						<option value="2">Sắp xếp theo điểm</option>
					</select>
				</td>
				<!-- <td>
					<select name="SX">
						<option value="DESC">Sắp xếp giảm dần</option>
						<option value="ASC">Sắp xếp tăng dần</option>
					</select>
				</td> -->
				<?php
						$conn=mysqli_connect('localhost','root','','quanlyts') or die("Không thể kết nối tới cơ sở dữ liệu");
			        if($conn){
			        	mysqli_query($conn,"SET NAMES 'utf8'");
			        }else{
			            echo "Bạn đã kết nối thất bại".mysqli_connect_erro();
			        }
			        $acSapXep="";
					$txtDK = "";
					$TongTS = 0;
					$DiemThapNhat= 0;
					if (isset($_POST['thuchien'])) {
						$txtDK=$_POST['txtDK'];
					}
				?>
				<td>
					<input type="text" name="txtDK" value="<?php echo $txtDK ?>">
				</td>
				<td><input type="submit" name="thuchien" value="Thực hiện"></td>
			<?php
			if (isset($_POST['thuchien'])) {
				$txtDK=$_POST['txtDK'];
				if (trim($txtDK)=="") {
					goto TB;
				}
				$Loai=$_POST['Loai'];
				// $SX=$_POST['SX'];
				if ($Loai == 1) {
					// if($SX == "ASC"){
					// 	$qrSapXep="SELECT diem.SBD,hoten,Mon1,Mon2,Mon3,Mon4,TongDiem FROM diem,thisinh,sobaodanh WHERE thisinh.CCCD = sobaodanh.CCCD and sobaodanh.SBD = diem.SBD ORDER BY TongDiem ASC LIMIT $txtDK";
					// }
					// else{
						$qrSapXep="SELECT diem.SBD,hoten,Mon1,Mon2,Mon3,Mon4,TongDiem FROM diem,thisinh,sobaodanh WHERE thisinh.CCCD = sobaodanh.CCCD and sobaodanh.SBD = diem.SBD ORDER BY TongDiem DESC LIMIT $txtDK";
					// }
				}
				else{
					// if ($SX == "ASC") {
					// 	$qrSapXep="SELECT diem.SBD,hoten,Mon1,Mon2,Mon3,Mon4,TongDiem FROM diem,thisinh,sobaodanh WHERE thisinh.CCCD = sobaodanh.CCCD and sobaodanh.SBD = diem.SBD AND TongDiem>=$txtDK ORDER BY TongDiem ASC";
					// }else{
						$qrSapXep="SELECT diem.SBD,hoten,Mon1,Mon2,Mon3,Mon4,TongDiem FROM diem,thisinh,sobaodanh WHERE thisinh.CCCD = sobaodanh.CCCD and sobaodanh.SBD = diem.SBD AND TongDiem>=$txtDK ORDER BY TongDiem DESC";
					// }
				}
				$acSapXep = mysqli_query($conn,$qrSapXep);
				while ($row1 = mysqli_fetch_array($acSapXep)) {
					$TongTS = $TongTS+1;
					$DiemThapNhat=$row1[6];
				}
			?>
				<td></td>
				<td>
					<?php
					if ($Loai==2) {
						echo "Tổng thí sinh:";
					}
					else
						echo "Điểm thấp nhất:";
					?>
				</td>
				<td>
					<?php
					if ($Loai==2) {
						echo "$TongTS";
					}
					else
						echo "$DiemThapNhat";
					?>
					
				</td>
			<?php
			}
			?>
			</tr>
			</table>
			<?php
			if (isset($_POST['thuchien'])) {
				$txtDK=$_POST['txtDK'];
				if (trim($txtDK)=="") {
					goto TB;
				}
				$Loai=$_POST['Loai'];
				// $SX=$_POST['SX'];
				if ($Loai == 1) {
					// if($SX == "ASC"){
					// 	$qrSapXep="SELECT diem.SBD,hoten,Mon1,Mon2,Mon3,Mon4,TongDiem FROM diem,thisinh,sobaodanh WHERE thisinh.CCCD = sobaodanh.CCCD and sobaodanh.SBD = diem.SBD ORDER BY TongDiem ASC LIMIT $txtDK";
					// }
					// else{
						$qrSapXep="SELECT diem.SBD,hoten,Mon1,Mon2,Mon3,Mon4,TongDiem FROM diem,thisinh,sobaodanh WHERE thisinh.CCCD = sobaodanh.CCCD and sobaodanh.SBD = diem.SBD ORDER BY TongDiem DESC LIMIT $txtDK";
					// }
				}
				else{
					// if ($SX == "ASC") {
					// 	$qrSapXep="SELECT diem.SBD,hoten,Mon1,Mon2,Mon3,Mon4,TongDiem FROM diem,thisinh,sobaodanh WHERE thisinh.CCCD = sobaodanh.CCCD and sobaodanh.SBD = diem.SBD AND TongDiem>=$txtDK ORDER BY TongDiem ASC";
					// }else{
						$qrSapXep="SELECT diem.SBD,hoten,Mon1,Mon2,Mon3,Mon4,TongDiem FROM diem,thisinh,sobaodanh WHERE thisinh.CCCD = sobaodanh.CCCD and sobaodanh.SBD = diem.SBD AND TongDiem>=$txtDK ORDER BY TongDiem DESC";
					// }
				}
				$acSapXep = mysqli_query($conn,$qrSapXep);
				if (mysqli_num_rows($acSapXep)>0){
				?>
			<table border="2">
				<tr>
					<td><div class="lbTitle" align="center">Số báo danh</div></td>
					<td><div class="lbTitle" align="center">Họ tên</div></td>
					<td><div class="lbTitle" align="center">Điểm Toán</div></td>
					<td><div class="lbTitle" align="center">Điểm Ngữ văn</div></td>
					<td><div class="lbTitle" align="center">Điểm Anh</div></td>
					<td><div class="lbTitle" align="center">Điểm môn tự chọn</div></td>
					<td><div class="lbTitle" align="center">Tổng điểm</div></td>
				</tr>
			<?php
					while ($row = mysqli_fetch_array($acSapXep)) {
						?>
						<tr>
						<td width="8%"><div align="center"><?php echo $row[0] ?></div></td>
						<td><?php echo $row[1] ?></td>
						<td width="15%"><div align="center"><?php echo $row[2] ?></div></td>
						<td width="15%"><div align="center"><?php echo $row[3] ?></div></td>
						<td width="15%"><div align="center"><?php echo $row[4] ?></div></td>
						<td width="15%"><div align="center"><?php echo $row[5] ?></div></td>
						<td width="15%"><div align="center"><?php echo $row[6] ?></div></td>
					</tr>
				<?php
					}
				}
			}
			TB:
			?>
		</table>
		
	</div>
	<div></div>
	</form>
</body>
</html>
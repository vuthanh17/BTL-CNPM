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
<style type="text/css">
	.txtDT{
		width: 97%;
		/*height: 100%;*/
		border: none;
	}
</style>
<body>
	<form action="#" method="POST">
		<?php
			$conn=mysqli_connect('localhost','root','','quanlyts') or die("Không thể kết nối tới cơ sở dữ liệu");
	        if($conn){
	        	mysqli_query($conn,"SET NAMES 'utf8'");
	        }else{
	            echo "Bạn đã kết nối thất bại".mysqli_connect_erro();
	        }
	        $qrDSThiSinh = "SELECT diem.SBD,hoten,Mon1,Mon2,Mon3,Mon4,thisinh.DCThi,thisinh.DCNghe,TongDiem FROM diem,thisinh,sobaodanh WHERE thisinh.CCCD = sobaodanh.CCCD and sobaodanh.SBD = diem.SBD";
	        $acDSThiSinh = mysqli_query($conn,$qrDSThiSinh);
	        // <?php
	        $check1 = 0;
	        $check2 = 0;
	        $TB = "";
	        $txtdiemchuan="";
			if (isset($_POST['subDiem'])) {
				while($row1 = mysqli_fetch_array($acDSThiSinh)){
					$check1= $check1 +1;
					$d1="T".$row1[0];
					$dm1=$_POST["$d1"];
					if ($dm1=="") {
						$dm1="null";
					}
					$d2="V".$row1[0];
					$dm2=$_POST["$d2"];
					if ($dm2=="") {
						$dm2="null";
					}
					$d3="A".$row1[0];
					$dm3=$_POST["$d3"];
					if ($dm3=="") {
						$dm3="null";
					}
					$d4="TC".$row1[0];
					$dm4=$_POST["$d4"];
					if ($dm4=="") {
						$dm4="null";
					}
					$DC = $row1[6] + $row1[7];
					$TD = $dm1 + $dm2 + $dm3 + $dm4 + $DC;
					// $TD = cong($dm1,$dm2,$dm3,$dm4,$DC)
					if (is_numeric($dm1) || $dm1=="null") {
						if ($dm1>10 ||$dm1<0) {
							$TB="Nhập sai dữ liệu";
							goto TB;
						}
					}else{
						$TB="Nhập sai dữ liệu";
						goto TB;
					}
					if (is_numeric($dm2) || $dm2=="null") {
						if ($dm2>10 ||$dm2<0) {
							$TB="Nhập sai dữ liệu";
							goto TB;
						}
					}else{
						$TB="Nhập sai dữ liệu2";
						goto TB;
					}
					if (is_numeric($dm3) || $dm3=="null") {
						if ($dm3>10 || $dm3<0) {
							$TB="Nhập sai dữ liệu";
							goto TB;
						}
					}else{
						$TB="Nhập sai dữ liệu";
						goto TB;
					}
					if (is_numeric($dm4) || $dm4=="null") {
						if ($dm4>10 ||$dm4<0) {
							$TB="Nhập sai dữ liệu";
							goto TB;
						}
					}else{
						$TB="Nhập sai dữ liệu";
						goto TB;
					}
					$qrUpdateDiem = "UPDATE `diem` SET Mon1=$dm1,Mon2=$dm2,Mon3=$dm3,Mon4=$dm4,TongDiem=$TD WHERE SBD = $row1[0]";
					if (insert_db ("$qrUpdateDiem")) {
					 	$check2 = $check2 + 1;
					}
				}
				if ($check1==$check2) {
						$TB="Thành công";
					}
				TB:
				showTB("$TB","DanhSachDT.php");
			}
			if (isset($_POST['diemchuan'])) {
				$txtdiemchuan = $_POST['txtdiemchuan'];
				if (is_numeric($txtdiemchuan) && $txtdiemchuan>0) {
				}
				else{
					$TB = "Nhập sai định dạng";
					goto TBDC;
				}
				if (trim($txtdiemchuan) =="") {
					$TB = "Bạn chưa nhập điểm chuẩn";
					goto TBDC;
				}
				$qrSLTStren="SELECT sobaodanh.CCCD,diem.SBD, diem.TongDiem  FROM sobaodanh,diem WHERE sobaodanh.SBD=diem.SBD AND TongDiem>= '$txtdiemchuan'";
				$qrSLTSduoi="SELECT sobaodanh.CCCD,diem.SBD, diem.TongDiem  FROM sobaodanh,diem WHERE sobaodanh.SBD=diem.SBD AND TongDiem< '$txtdiemchuan'";
				$acqrSLTStren = mysqli_query($conn,$qrSLTStren);
				$acqrSLTSduoi = mysqli_query($conn,$qrSLTSduoi);
				while ($rowT = mysqli_fetch_array($acqrSLTStren)) {
					$CCCDT = $rowT[0];
					$qrUpdateT = "UPDATE thisinh SET TTDo=1 WHERE CCCD = '$CCCDT'";
					mysqli_query($conn,$qrUpdateT);
				}
				while ($rowD = mysqli_fetch_array($acqrSLTSduoi)) {
					$CCCDD = $rowD[0];
					$qrUpdateD = "UPDATE thisinh SET TTDo=2 WHERE CCCD = '$CCCDD'";
					mysqli_query($conn,$qrUpdateD);
				}
				$TB="Nhập điểm chuẩn thành công";
				TBDC:
				showPopup("$TB");
			}
			if (mysqli_num_rows($acDSThiSinh)>0) {
		?>
			<div style="margin-bottom:10px">
				<div style="display:inline-block;"><input type="submit" name="subDiem" value="Nhập điểm"></div>
				<div style="display: inline-block; float: right;"><input type="text" name="txtdiemchuan" value="<?php echo $txtdiemchuan ?>"> <input type="submit" name="diemchuan" value="Nhập điểm chuẩn"></div>
			</div>
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
				while ($row = mysqli_fetch_array($acDSThiSinh)){ ?>
					<tr>
						<td width="8%"><div align="center"><?php echo $row[0] ?></div></td>
						<td><?php echo $row[1] ?></td>
						<td width="13%">
							<input type="text" class="txtDT" 
								<?php $n1 = 'name="T'.$row[0].'"'; echo $n1 ?>
								<?php 
									if ($row[2]==null) {
										echo "placeholder='Chưa có điểm'";
									} else echo "value='$row[2]'";
								?>
							>
						</td>
						<td width="15%">
							<input type="text"  class="txtDT" 
								<?php $n2 = 'name="V'.$row[0].'"'; echo $n2 ?>
								<?php 
									if ($row[3]==null) {
										echo "placeholder='Chưa có điểm'";
									}else echo "value='$row[3]'";
								?>
							>
						</td>
						<td width="15%">
							<input type="text"  class="txtDT" 
								<?php $n3 = 'name="A'.$row[0].'"'; echo $n3 ?>
								<?php 
									if ($row[4]==null) {
										echo "placeholder='Chưa có điểm'";
									}else echo "value='$row[4]'";
								?>
							>
						</td>
						<td width="15%">
							<input type="text"  class="txtDT" 
								<?php $n4 = 'name="TC'.$row[0].'"'; echo $n4 ?>
								<?php 
									if ($row[5]==null) {
										echo "placeholder='Chưa có điểm'";
									}else echo "value='$row[5]'";
								?>
							>
						</td>
						<td width="12%" align="center"><?php echo $row[8] ?></td>
					</tr>
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
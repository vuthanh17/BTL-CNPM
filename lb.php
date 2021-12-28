<?php
	function insert_db($query){
		$conn=null;
		$conn=mysqli_connect('localhost','root','','quanlyts') or die("Không thể kết nối tới cơ sở dữ liệu");
        if($conn)
        {
        	mysqli_query($conn,"SET NAMES 'utf8'");
        	$data=mysqli_query($conn,$query);
        	if ($data>0){
        		return true;
        	}
        	else{
        		return false;
        	}
        }else{
            echo "Bạn đã kết nối thất bại".mysqli_connect_erro();
        }	
	}
	function showPopup($mess){
		echo "<script type='text/javascript'>alert('$mess');</script>";
	}
	function showTB($tb,$location)
	{
		echo"<script type='text/javascript'>
				if (window.confirm('$tb')) {
                	window.location = '$location';
            	}
            	else
            		window.location = '$location';
            </script>";
	}
?>
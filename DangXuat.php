<?php
	session_start();
	unset($_SESSION['GV']);
	header('location: index.php');
?>
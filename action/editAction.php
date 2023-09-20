<?php
// koneksi database
require_once("../koneksi/dbConnection.php");

if (isset($_POST['update'])) {
	// deklarasi item data
	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	$nama_akun = mysqli_real_escape_string($mysqli, $_POST['nama_akun']);
	$email_akun = mysqli_real_escape_string($mysqli, $_POST['email_akun']);
	$password_akun = mysqli_real_escape_string($mysqli, $_POST['password_akun']);	
	
	// pengkondisian agar semua field disi semua
	if (empty($email_akun) || empty($password_akun)) {
		if (empty($email_akun)) {
			echo "<font color='red'>email_akun field is empty.</font><br/>";
		}
		
		if (empty($password_akun)) {
			echo "<font color='red'>password_akun field is empty.</font><br/>";
		}
	} else {
		// query update data
		$result = mysqli_query($mysqli, "UPDATE akun SET `nama_akun` = '$nama_akun', `email_akun` = '$email_akun', `password_akun` = '$password_akun' WHERE `id` = $id");
		
		// notifikasi sukses
		echo "<p><font color='green'>Data updated successfully!</p>";
		echo "<a href='../index.php'>Kembali</a>";
	}
}

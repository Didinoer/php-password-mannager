<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
// Include the database connection file
require_once("../koneksi/dbConnection.php");

if (isset($_POST['submit'])) {
	// Escape special characters in string for use in SQL statement	
	$nama_akun = mysqli_real_escape_string($mysqli, $_POST['nama_akun']);
	$email_akun = mysqli_real_escape_string($mysqli, $_POST['email_akun']);
	$password_akun = mysqli_real_escape_string($mysqli, $_POST['password_akun']);
		
	// Check for empty fields
	
		$result = mysqli_query($mysqli, "INSERT INTO akun (`nama_akun`, `email_akun`, `password_akun`) VALUES ('$nama_akun', '$email_akun', '$password_akun')");
		echo "<p><font color='green'>Data added successfully!</p>";
		echo "<a href='../index.php'>Kembali</a>";
}
?>
</body>
</html>

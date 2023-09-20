<?php
// koneksi database
require_once("koneksi/dbConnection.php");

// dapatkan id dari index.php
$id = $_GET['id'];

// query mendapatkan data spesifik parameter id
$result = mysqli_query($mysqli, "SELECT * FROM akun WHERE id = $id");

// Fetch the next row of a result set as an associative array
$resultData = mysqli_fetch_assoc($result);

$nama_akun = $resultData['nama_akun'];
$email_akun = $resultData['email_akun'];
$password_akun = $resultData['password_akun'];
?>
<html>
<head>	
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="library/bootstrap/css/bootstrap.css">
</head>

<body>
	<div class="container m-5">
		<div class="row text-center">
			<h2>Edit Data</h2>
		</div>
  
	 <div class="row">
		<form name="edit" method="post" action="action/editAction.php">
			
			<input type="hidden" name="nama_akun" class="form-control" value="<?php echo $nama_akun; ?>"> 
					<label for="" class="form-label">email_akun</label>
					<input type="text" name="email_akun" class="form-control" value="<?php echo $email_akun; ?>"> 
					<br>
					<label for="" class="form-label">password_akun</label>
					<input type="text" name="password_akun" class="form-control" value="<?php echo $password_akun; ?>">
					<input type="hidden" name="id" class="form-control" value=<?php echo $id; ?>>
					<br>

					<div class="row text-center">
						<button type="submit" value="update" name="update" class="btn btn-primary">update</button>
					</div>
			</table>
		</form>
	</div>
	<div class="row">
		<p>
			<button class="btn btn-dark"><a href="index.php">back to Home</a></button>
		</p>
	</div>
	
	</div>
 <!-- bootstrap js -->
 <script src="library/bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>

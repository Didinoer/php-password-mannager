<?php
// koneksi database
require_once("../koneksi/dbConnection.php");

// id dari index.php
$id = $_GET['id'];

// query delete data
$result = mysqli_query($mysqli, "DELETE FROM akun WHERE id = $id");

// notifikasi berhasil
echo "<p><font color='green'>Data deleted successfully!</p>";
echo "<a href='../index.php'>Kembali</a>";

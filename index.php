<?php
    require_once('koneksi/dbConnection.php');
    
    // function generatePassword() berguna untuk membuatkan password random
    function generatePassword($length = 12) {
        // Karakter yang diizinkan dalam password
        //74 karakter
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$^*()_';
        
        $password = '';
        $charCount = strlen($characters);

        
        // Menghasilkan karakter acak untuk password
        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, $charCount - 1);
            //satu persatu character akan memasuki $password hingga mencapa batass $length
            $password .= $characters[$index];
        }
        
        return $password;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password mannager</title>
    <link rel="stylesheet" href="library/bootstrap/css/bootstrap.css">
</head>
<body>

<!-- javascript untuk menambahkan value yand dibuat oleh function generatePassword() kedalam text input password -->
<script>
        function generatingPassword() {
            // newValue adalah string password yg dibuat oleh function generatePassword()
            var newValue = "<?php echo generatePassword(); ?>";
            //text input yang memiliki id 'password' isinya akan diubah menjadi apa yang dimiliki new Value
            document.getElementById('password').value = newValue;
        }
</script>




<!-- alur program dibawah ini adalah
1. form penyimpanan data 
2. algoritma pembuatan password menggunakan function passwordGenerator().
4. algoritma penyimpanan data menggunakan function saveDataJson() -->

<!-- form utama -->
<div class="form-utama">
    <!-- container untuk menampung row -->
    <div class="container m-5">
        <!-- row yang berisi judul utama -->
        <div class="row text-center">
        <div class="col-12 text-center">
                <img src="img/data.jpg" width="200px" class="img-fluid ">
                <h1 class="text-center">PASSWORD MANNAGER</h1>
            </div>           
        </div>
        <!-- row yang berisi form -->
        <div class="row">
            <!-- col-12 agar lebarnya item memenuhi layar  -->
            <div class="col-12">
                <form action="action/addAction.php" method="post">
                    <label for="nama" class="form-label"> Masukan Nama Akun</label>
                    <input type="text" name="nama_akun" class="form-control" placeholder="masukan platform akun yang akan disimpan. ex : facebook, github, twitter">
                    <br>
                    <label for="nama" class="form-label"> Masukan email/ID akun</label>
                    <input type="text" name="email_akun" class="form-control" placeholder="masukan email/ID akun yang akan disimpan. ex : example@gmail.com, example123">
                    <br>
                    <label for="nama" class="form-label"> Masukan password Akun</label>
                    <!-- didalam col-12 ditambahkan row, yang didalamnya terdapat col-8 dan col-4 agar item dapat bersebelahan  -->
                    <div class="row">
                        <div class="col-8">
                            <input type="text" name="password_akun" id="password" class="form-control" placeholder="masukan password untuk disimpan atau jika kamu ingin dibuatkan password klik tombol generate">
                        </div>
                        <div class="col-4">
                            <!-- jika tombol Generate Password di klik maka text input akan terisi 
                            pasword yang dibuatkan oleh function passwordGenerator() -->
                            <button type="button" onclick="generatingPassword()" class="btn btn-primary">Generate Password</button>
                        </div>
                    </div>   
                <br>     
                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
        
 <br><br>


<!-- alur program dibawah ini adalah
1. form pencarian data 
2. algoritma pencarian datanya
3. tampilan table untuk data yang dicari 
4. algoritma penghapusan data jika dipilih -->


<!-- setelah form utama, maka dibuatlah form pencarian -->
<div class="form-pencarian">
    <!-- container untuk menyimpan form -->
    <div class="container m-5">
        <form action="" method="post">
        <label for="search_email" class="form-label">Pencarian data password</label>
        <!-- didalam container ditambahkan row, yang didalamnya terdapat col-8 dan col-4 agar item dapat bersebelahan  -->
        <div class="row">
            <div class="col-8">
                <input type="text" name="cari_nama_akun" id="search_email" class="form-control" placeholder="masukan platform akun yang akan dicari. ex : facebook, github, twitter">
            </div>
            <div class="col-4">
                <button type="submit" name="submit2" class="btn btn-primary">Cari</button>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>
<?php
    // jika tombol submit ditekan maka,  
    // ket :penulis menggunakan name submit2 
    // untuk membedakan tombol submit yang ada pada form utama
    if (isset($_POST['submit2'])) {
        //maka akan melalui sebuah kondisi jika input form pencarian belum terisi maka akan dilakukan
        //peringatan agar input form pencarian diisi agar dapat melakukan pencarian
       if ((empty($_POST['cari_nama_akun'])) ){
        echo '<div class="container text-center">masukan password akun apa yang kamu cari</div>';
       }
       else {
        $nama = $_POST['cari_nama_akun'];
        //query pencarian data
        $result = mysqli_query($mysqli,"SELECT * FROM `akun` WHERE `nama_akun` LIKE '$nama'");
   
    ?> 

    <!-- menampilkan data yang dicari -->
        <div class="container m-5">
            <div class="row text-center">
                <h3>Hasil Pencarian</h3>
            </div>
            <div class="row">
                <table border="1" class="table table-primary table-striped">
                    <tr>
                        <th>Nama Akun</th>
                        <th>Email Akun</th>
                        <th>Password Akun</th>
                        <th>action</th>
                    </tr>
                    <?php
                    while ($res = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$res['nama_akun']."</td>";
                    echo "<td>".$res['email_akun']."</td>";
                    echo "<td>".$res['password_akun']."</td>";
                    //deklarasi aksi untuk edit dan hapus data dengan parameter id 	
                    echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | 
                    <a href=\"action/delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
                    }
        ?>
                </table>
            </div>
        </div>
    <?php
       }
    }
?>




    <!-- bootstrap js -->
    <script src="library/bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>
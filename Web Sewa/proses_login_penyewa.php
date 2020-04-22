<?php
  session_start();
  // session_start() digunakan sebagai tanda kalau kita akan menggunakan session pada halaman ini
  //  session_start() harus diletakkan pada baris pertama.
  include("configsewa.php");

  // tampung data username dsn passwordnya
  $username = $_POST["username"];
  $password = $_POST["password"];

  if (isset($_POST["login_penyewa"])) {
    $sql = "select * from penyewa where username = '$username' and password = '$password'";
    // eksekusi query
    $query = mysqli_query($connect, $sql);
    $jumlah = mysqli_num_rows($query);
    // digunakan untuk menghitung jumlah data ahasil dary $query
    if ($jumlah > 0) {
      // jika jumlahnya lebih dari nol, artinya terdapat data admin yang sesuai dengan username dan password yang diinputkan
      // ini blok kode jika login berhasil
      // kita ubah hasil query ke array
      $penyewa = mysqli_fetch_array($query);

      // membuat session
      $_SESSION["id_penyewa"] = $penyewa["id_penyewa"];
      $_SESSION["nama"] = $penyewa["nama"];
      $_SESSION["d_sewa"] = array();

      header("location:tampilan.php");
    }else {
      // jika nol, aritnya tidak ada data admin yg sesuai dengan username dan password yang diinputkan
      // ini blok kode jika loginnya gagal / salah
      header("location:login_penyewa.php");
    }
  }


  if (isset($_GET["logout"])) {
    // proses logout
    // menghapus data session yang telah dibuat.
    session_destroy();
    header("location:login.php");
  }
 ?>

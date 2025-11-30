<?php 

  date_default_timezone_set("Asia/Jakarta");
  $tanggalSekarang = date("Y-m-d");
  $jamSekarang = date("h:i a");

  // Pengecekan sesi (diasumsikan sudah dilakukan di file utama yang memanggil title.php)
  // Saya tidak akan menambahkan pengecekan sesi di sini karena ini adalah file konten,
  // namun saya pastikan logic pengambilan data petugas tetap ada.
  
  // Jika variabel $judul belum diset, berikan nilai default
  $judul = isset($judul) ? $judul : "Data Barang Masuk";
  ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $judul ?></title>

    <link href="../vendor/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/css/bootstrap/bootstrap.css" rel="stylesheet">

    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="../css/tampilanadmin.css" rel="stylesheet">

    <style>
      /* Reset Margin dan Padding */
      body {
          background-color: #f8f8f8; /* Warna latar belakang body */
      }
      #wrapper {
          padding-left: 250px; /* Lebar sidebar disesuaikan */
      }

      /* 1. Kustomisasi Navbar (Header) dan Sidebar (Warna Gelap) */
      .navbar-default {
          background-color: #2c3e50; /* Dark Blue/Navy - Warna Header */
          border-color: #2c3e50;
          height: 50px; /* Tinggi navbar standar */
          margin-bottom: 0;
          border-radius: 0;
      }
      .navbar-default .navbar-header .navbar-brand {
          color: #ecf0f1; /* Light text for logo */
          font-weight: 500;
          font-size: 1.2em;
      }
      /* NAV KANAN: Tombol ADMIN & LOGOUT */
      .navbar-top-links {
          margin-right: 15px;
      }
      .navbar-top-links li {
          float: left;
      }
      .navbar-top-links li a {
          color: #ecf0f1; 
          padding: 15px; 
          line-height: 20px;
          text-transform: uppercase;
          font-size: 12px;
          font-weight: 500;
      }
      .navbar-top-links li a:hover {
          background-color: transparent; 
          color: #ffffff;
      }
      /* Sesuaikan tombol logout di dropdown agar tampak seragam dengan navbar kanan */
      .dropdown-user .btn-default {
          border: none;
          background: none;
          color: #333;
          width: 100%;
          text-align: left;
          padding: 3px 20px;
      }

      /* 2. Kustomisasi Sidebar */
      .navbar-default .sidebar {
          background-color: #34495e; /* Warna Sidebar (Lebih gelap dari panel) */
          position: fixed;
          top: 0;
          bottom: 0;
          left: 0;
          width: 250px; /* Lebar sidebar */
          z-index: 1000;
          padding-top: 50px; /* Turunkan menu di bawah navbar */
          border: none;
      }
      .sidebar-nav.navbar-collapse {
          padding-right: 0;
          padding-left: 0;
      }
      #side-menu {
          margin-top: 15px;
      }
      #side-menu li a {
          color: #ecf0f1; /* Light text for menu items */
          text-transform: uppercase;
          padding: 10px 15px;
          font-size: 13px;
          border-left: 3px solid transparent;
      }
      #side-menu li a:hover {
          background-color: #4a637c; /* Warna hover */
          color: #ffffff;
          border-left: 3px solid #3498db; /* Blue accent on hover */
      }
      /* Set Data Barang Masuk sebagai menu aktif */
      #side-menu li a[href*="barangMasuk"] {
          background-color: #4a637c; 
          border-left: 3px solid #3498db; 
          color: #ffffff;
      }
      
      /* 3. Page Wrapper & Header */
      #page-wrapper {
          padding: 20px 30px;
          min-height: calc(100vh - 50px); 
      }
      .page-header {
          margin-top: 0;
          font-size: 28px;
          border-bottom: 1px solid #eeeeee;
          padding-bottom: 9px;
          margin-bottom: 20px;
          text-transform: uppercase; /* Agar judul H1 uppercase */
      }
      
      /* 4. Styling Tabel (Disamakan dengan gaya admin) */
      .table-earning {
          border-collapse: collapse;
          width: 100%;
          margin-top: 20px;
      }
      .table-earning thead th {
          background-color: #34495e; /* Warna header tabel gelap */
          color: #fff;
          padding: 10px;
          text-align: left;
          font-weight: 500;
          text-transform: uppercase;
      }
      .table-earning tbody tr:nth-child(even) {
          background-color: #f2f2f2;
      }
      .table-earning tbody td {
          padding: 10px;
          border-bottom: 1px solid #ddd;
      }
      
      /* 5. Footer Bawah */
      footer {
          background-color: #f8f8f8;
          border-top: 1px solid #e7e7e7;
          /* Menggunakan margin-left agar tampak menyatu dengan page-wrapper */
          margin-left: -30px; 
          padding: 10px 0;
          text-align: center;
          width: calc(100% + 60px); /* Melebar selebar page-wrapper */
          position: relative;
          clear: both;
      }
      .footer-below p {
          margin: 0;
          font-size: 14px;
      }
      
    </style>

  </head>
  <body>
    <div id="wrapper">

<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand">INVENTORY</a>
          </div>
          <?php 
          $id = $_SESSION['idinv2'];
           include '../koneksi.php';
           $sql = "SELECT * FROM tb_petugas WHERE id_petugas = '$id'";
           $query = mysqli_query($koneksi, $sql);
            $r = mysqli_fetch_array($query);

           ?>
            <ul class="nav navbar-top-links navbar-right">
            <li>
                <a href="#">
                 <i class="fa fa-user fa-fw"></i> <?php echo strtoupper($r['nama']); ?>
                </a>
            </li>
             <li>
                <form action="logout.php" onclick="return confirm('yakin ingin logout?');" method="post" style="display: inline;">
                    <button class="btn btn-link" type="submit" name="keluar" style="color: #ecf0f1; text-decoration: none; padding: 15px; text-transform: uppercase; font-size: 12px; font-weight: 500;">
                        <i class="fa fa-sign-out fa-fw"></i> LOGOUT
                    </button>
                </form>
            </li>
          </ul>

        <div class="navbar-default sidebar" role="navigation">
          <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
              <li>
                <a href="?m=awal.php">
                  <i class="fa fa-dashboard fa-fw"></i> BERANDA
                </a>
              </li>
              <li>
                <a href="?m=barangMasuk&s=awal">
                  <i class="fa fa-cart-arrow-down fa-fw"></i> DATA BARANG MASUK
                </a>
              </li>
                            
              <li>
                <a href="?m=ajuan&s=awal">
                  <i class="fa fa-gift fa-fw"></i> DATA AJUAN
                </a>
              </li>
              <li>
                <a href="logout.php" onclick="return confirm('yakin ingin logout?');">
                  <i class="fa fa-sign-out fa-fw"></i> LOGOUT
                </a>
              </li>
              
            </ul>
          </div>
        </div>
      </nav>

      <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">Data Barang Masuk</h1>
          </div>
        </div>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Tambah data
</button>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah barang masuk</h5>
      </div>
      <div class="modal-body">
        <form action="?m=barangMasuk&s=simpan" method="POST" enctype="multipart/form-data">
        <div class="form-group">
    <label for="tanggal">Tanggal</label>
    <input type="text" class="form-control" value="<?php echo $tanggalSekarang; ?>" id="tanggal" name="tanggal" aria-describedby="emailHelp" placeholder="Masukkan Tanggal">
    <small id="emailHelp" class="form-text text-muted">Masukkan Tanggal</small>
  </div>
          <div class="form-group">
    <label for="noinv">No. Invoice</label>
    <input type="text" class="form-control" id="noinv" name="noinv" aria-describedby="emailHelp" placeholder="Masukkan Nomor Invoice">
    <small id="emailHelp" class="form-text text-muted">Masukkan Nomor Invoice</small>
  </div>
     
          <div class="form-group">
    <label for="kode_brg">Kode Barang</label>
    
    <?php 
            include ("../koneksi.php");
            $supp = ("SELECT * FROM tb_barang");
            $result = mysqli_query($koneksi, $supp);

            $jsArray = "var prdName = new Array();";

            echo '<select name="kode_brg" onchange="changeValue(this.value)" class="form-control">'; // Tambahkan class form-control
            echo '<option>--- PILIH ---</option>';

            while ($row = mysqli_fetch_array($result)) {
              echo '<option value="'. $row['kode_brg'] .'">KDB'.$row['kode_brg'].'</option>';
              $jsArray .= "prdName['". $row['kode_brg'] ."'] 
              = {nama_brg:'". addslashes($row['nama_brg']) ."',
                stok:'". addslashes($row['stok']) ."', supplier:'". addslashes($row['supplier']) ."'
              };";
            }


            echo '</select>';
          ?>
          <script type="text/javascript">
            <?php echo $jsArray; ?>
            function changeValue(id){
              
              document.getElementById('prd_nmbrg').value = prdName[id].nama_brg;
              document.getElementById('prd_stk').value = prdName[id].stok;
               document.getElementById('prd_sup').value = prdName[id].supplier;
            }
          </script>
          
  </div>
          <div class="form-group">
    <label for="prd_nmbrg">Nama Barang</label>
    <input type="text" class="form-control" name="nama_brg" readonly="" id="prd_nmbrg" size="67">

  </div>

  <div class="form-group">
    <label for="prd_sup">Supplier</label>
    <input type="text" class="form-control" id="prd_sup" name="supplier" aria-describedby="emailHelp">

  </div>
          <div class="form-group">
    <label for="prd_stk">Stok</label>
    <input type="text" class="form-control" id="prd_stk" name="stok" aria-describedby="emailHelp" placeholder="Masukkan Stok Barang">

  </div>
          <div class="form-group">
    <label for="jml_masuk">Jumlah Masuk</label>
    <input type="text" class="form-control" id="jml_masuk" name="jml_masuk" aria-describedby="emailHelp" placeholder="Masukkan Jumlah Masuk">
    <small id="emailHelp" class="form-text text-muted">Masukkan Jumlah Masuk</small>
  </div>
          <div class="form-group">
    <label for="jam">Jam</label>
    <input type="text" class="form-control" id="jam" value="<?php echo $jamSekarang; ?>" name="jam" aria-describedby="emailHelp" placeholder="Masukkan Jam">
    <small id="emailHelp" class="form-text text-muted">Masukkan Jam</small>
  </div>
          <div class="form-group">
    <label for="petugas">Petugas</label>
    <input type="text" class="form-control" id="petugas" value="<?php echo $r['nama']; ?>" readonly="" name="petugas" aria-describedby="emailHelp" placeholder="Masukkan Nama Admin">
    <small id="emailHelp" class="form-text text-muted">Masukkan Nama Admin</small>
  </div>
         
  

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="simpan" class="btn btn-primary">Save changes</button>
      </div>
        </form>
    </div>
  </div>
</div>

         <div class="row">
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                
                                 <th>Id Barang Masuk</th>
                                 <th>Tanggal</th>
                                 <th>No Invoice</th>
                                 <th>Supplier</th>
                                 <th>Kode Barang</th>
                                 <th>Nama Barang</th>
                                 <th>Jumlah Masuk</th>
                                 <th>Jam</th>
                                 <th>Petugas</th>
                                <th>Aksi</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                           <?php 
                                          
                                            include 'paging.php';

                                            ?>
                                        </tbody>
                                    </table>
                                        <center><ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if(isset($halaman) && $halaman > 1){ echo "href='?m=barangMasuk&s=awal&halaman=$previous'"; } ?>>Previous</a>
                </li>
                <?php 
                // Asumsi $total_halaman dan $halaman berasal dari file paging.php yang di-include
                if (isset($total_halaman)) {
                  for($x=1;$x<=$total_halaman;$x++){
                      ?> 
                      <li class="page-item"><a class="page-link" href="?m=barangMasuk&s=awal&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                      <?php
                  }
                }
                ?>              
                <li class="page-item">
                    <a  class="page-link" <?php if(isset($halaman) && isset($total_halaman) && $halaman < $total_halaman) { echo "href='?m=barangMasuk&s=awal&halaman=$next'"; } ?>>Next</a>
                </li>
            </ul>
              </center>  
                                </div>
                            </div>


      </div>
    </div>


    <footer>
      <div class="footer-below">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
            <p class="text-muted">Copyright &copy; <script>document.write(new Date().getFullYear());</script> Muhamad Zibran Fitadiyatama. All rights reserved</p>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <script src="../vendor/jquery/jquery.min.js"></script>

    <script src="../vendor/css/js/bootstrap.min.js"></script>

  </body>
</html>
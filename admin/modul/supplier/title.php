<?php 
  include '../koneksi.php';
// Cek sesi login
if ( !isset($_SESSION["idinv"])) {
  header("Location: login.php");
  exit();
}


// Variabel untuk menandai menu aktif di sidebar (sesuai dengan URL ?m=...)
$current_page = 'supplier'; 

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $judul; ?></title>

    <link href="../vendor/css/bootstrap/bootstrap.min.css" rel="stylesheet">

    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="../css/tampilanadmin.css" rel="stylesheet">
    
    <style>
      /* --- GLOBAL LAYOUT & STYLES (Diambil dari awal.php) --- */
      body {
          margin-bottom: 60px; 
          background-color: #f8f9fa; 
          font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
      }
      
      /* --- NAVBAR HEADER --- */
      .navbar-default {
          background-color: #2c3e50 !important; 
          border: 0 !important; 
          box-shadow: 0 4px 6px rgba(0,0,0,0.1); 
          min-height: 60px; 
      }
      .navbar-header {
          background-color: #2c3e50 !important; 
      }
      .navbar-brand {
          color: #ecf0f1 !important; 
          font-weight: 700; 
          font-size: 24px; 
          padding-top: 18px; 
      }
      /* Mengganti gaya dropdown yang kurang sesuai dengan gaya awal.php */
      .navbar-top-links li a { 
          color: #ecf0f1 !important; 
          padding-top: 20px;
          padding-bottom: 20px;
          transition: background-color 0.3s;
      }
      .navbar-top-links li a:hover {
          background-color: #34495e; 
      }
      
      /* --- SIDEBAR --- */
      .navbar-default.sidebar {
          background-color: #ffffff !important; 
          box-shadow: 2px 0 5px rgba(0,0,0,0.05);
      }
      .sidebar-nav.navbar-collapse {
          background-color: #2c3e50 !important; 
          padding-top: 9px; 
      }
      #side-menu a {
          color: #ffffffff; 
          padding: 14px 15px; 
          transition: background-color 0.2s, color 0.2s;
          border-left: 4px solid transparent; 
      }
      /* Perbaikan agar kelas 'active' bekerja sama dengan logika 'awal.php' */
      #side-menu a:hover, #side-menu li.active a, #side-menu a.active { 
          background-color: #e9ecef !important; 
          color: #007bff; 
          border-left: 4px solid #007bff; 
      }

      /* --- PAGE WRAPPER & HEADING --- */
      #page-wrapper {
          padding: 25px 30px; 
          min-height: calc(100vh - 60px); 
          background-color: #f8f9fa;
      }
      .page-header {
          border-bottom: 2px solid #ced4da; 
          padding-bottom: 10px;
          margin-top: 0;
          margin-bottom: 35px; 
          color: #343a40; 
          font-weight: 300; 
          font-size: 32px;
      }

      /* --- PANEL UMUM (UNTUK TABEL/FORM) --- */
      .panel {
          border-radius: 8px; 
          border: none;
          box-shadow: 0 4px 15px rgba(0,0,0,0.1); 
          margin-top: 20px; /* Tambahkan sedikit ruang dari heading */
      }
      .panel-heading {
          background-color: #f1f1f1;
          border-radius: 8px 8px 0 0;
          border-bottom: 1px solid #dee2e6;
          padding: 15px;
      }
      .panel-body {
          padding: 20px;
      }
      .panel-footer {
          background-color: #f1f1f1;
          border-top: 1px solid #dee2e6;
          border-radius: 0 0 8px 8px;
          padding: 10px 15px;
      }
      /* Tabel Styling */
      .table-responsive {
          margin-bottom: 0; /* Menghapus margin bawaan jika menggunakan panel */
      }
      .table-borderless {
          border: none !important;
      }
      .table-striped > tbody > tr:nth-of-type(odd) {
          background-color: #f7f7f7;
      }
      /* Mengganti styling table-earning agar konsisten dengan tema */
      .table-earning th {
          background-color: #007bff; /* Primary Blue */
          color: white;
          border-color: #007bff !important;
      }

      /* --- FIXED FOOTER (Diambil dari awal.php) --- */
      .footer-below {
          background-color: #343a40; 
          color: #fff;
          padding: 18px 0;
          position: fixed; 
          left: 0;
          bottom: 0; 
          width: 100%; 
          z-index: 1000; 
      }
      .footer-below p {
        font-size: 14px; 
        margin: 0;
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
          $id = $_SESSION['idinv'];
           include '../koneksi.php';
           $sql = "SELECT * FROM tb_admin WHERE id_admin = '$id'";
           $query = mysqli_query($koneksi, $sql);
            $r = mysqli_fetch_array($query);

           ?>
          
          <ul class="nav navbar-top-links navbar-right">
            <li>
                <a href="#">
                    <i class="fa fa-user fa-fw"></i> <?php echo $r['nama']; ?>
                </a>
            </li>
            
            <?php 
            // Tombol LOGOUT (Tampil di Navbar Top jika BUKAN halaman Data Admin)
            if (!isset($_GET['m']) || $_GET['m'] !== 'admin'): 
            ?>
            <li style="background-color: #007bff; border-radius: 4px; margin-left: 10px;">
              <a href="logout.php" onclick="return confirm('yakin ingin logout?');" style="color: white !important;">
                <i class="fa fa-sign-out fa-fw"></i> LOGOUT
              </a>
            </li>
            <?php 
            endif; 
            ?>
          </ul>
          
          <div class="navbar-default sidebar" role="navigation">
          <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
              <li class="<?php echo ($current_page == 'awal' ? 'active' : ''); ?>">
                <a href="?m=awal.php" class="<?php echo ($current_page == 'awal' ? 'active' : ''); ?>">
                  <i class="fa fa-dashboard fa-fw"></i> Beranda
                </a>
              </li>
              <li class="<?php echo ($current_page == 'admin' ? 'active' : ''); ?>">
                <a href="?m=admin&s=awal" class="<?php echo ($current_page == 'admin' ? 'active' : ''); ?>">
                  <i class="fa fa-user-secret fa-fw"></i> Data Admin
                </a>
              </li>
               <li class="<?php echo ($current_page == 'petugas' ? 'active' : ''); ?>">
                <a href="?m=petugas&s=awal" class="<?php echo ($current_page == 'petugas' ? 'active' : ''); ?>">
                  <i class="fa fa-users fa-fw"></i> Data Petugas
                </a>
              </li>
              <li class="<?php echo ($current_page == 'supplier' ? 'active' : ''); ?>">
                <a href="?m=supplier&s=awal" class="<?php echo ($current_page == 'supplier' ? 'active' : ''); ?>">
                  <i class="fa fa-truck fa-fw"></i> Data Supplier
                </a>
              </li>
              <li class="<?php echo ($current_page == 'rak' ? 'active' : ''); ?>">
                <a href="?m=rak&s=awal" class="<?php echo ($current_page == 'rak' ? 'active' : ''); ?>">
                  <i class="fa fa-cubes fa-fw"></i> Data Rak
                </a>
              </li>
              <li class="<?php echo ($current_page == 'barang' ? 'active' : ''); ?>">
                <a href="?m=barang&s=awal" class="<?php echo ($current_page == 'barang' ? 'active' : ''); ?>">
                  <i class="fa fa-archive fa-fw"></i> Data Barang
                </a>
              </li>
              <li class="<?php echo ($current_page == 'barangKeluar' ? 'active' : ''); ?>">
                <a href="?m=barangKeluar&s=awal" class="<?php echo ($current_page == 'barangKeluar' ? 'active' : ''); ?>">
                  <i class="fa fa-sign-out fa-fw"></i> Data Barang Keluar
                </a>
              </li>
              <li>
                <a href="logout.php" onclick="return confirm('yakin ingin logout?')">
                  <i class="fa fa-power-off fa-fw"></i> Logout
                </a>
              </li>
              
            </ul>
          </div>
        </div>

      </nav>

      <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">Data Supplier</h1>
          </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            <i class="fa fa-plus fa-fw"></i> Tambah Data Supplier
                        </button>
                    </div>
                    
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover"> 
                                <thead>
                                    <tr>
                                        <th>Id Supplier</th>
                                        <th>Nama Supplier</th>
                                        <th>Kontak Supplier</th>
                                        <th>Alamat Supplier</th>
                                        <th>Telepon Supplier</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php 
                                    // Paging dan data supplier harus diproses di sini
                                    include 'paging.php';
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="panel-footer">
                        <div class="text-center">
                            <ul class="pagination justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" <?php if($halaman > 1){ echo "href='?m=supplier&s=awal&halaman=$previous'"; } ?>>Previous</a>
                                </li>
                                <?php 
                                for($x=1;$x<=$total_halaman;$x++){
                                    ?> 
                                    <li class="page-item"><a class="page-link" href="?m=supplier&s=awal&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                                    <?php
                                }
                                ?>              
                                <li class="page-item">
                                    <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?m=supplier&s=awal&halaman=$next'"; } ?>>Next</a>
                                </li>
                            </ul>
                        </div>
                        </div>

                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Tambah data supplier</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="?m=supplier&s=simpan" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputNamaSup">Nama</label>
                    <input type="text" class="form-control" id="inputNamaSup" name="nama_sup" placeholder="Masukkan Nama Supplier">
                    <small class="form-text text-muted">Masukkan Nama Supplier</small>
                </div>
                <div class="form-group">
                    <label for="inputKontakSup">Kontak Supplier</label>
                    <input type="text" class="form-control" id="inputKontakSup" name="kontak_sup" placeholder="Masukkan Kontak Supplier">
                    <small class="form-text text-muted">Masukkan Kontak Supplier</small>
                </div>
                <div class="form-group">
                    <label for="inputAlamatSup">Alamat Supplier</label>
                    <textarea class="form-control" id="inputAlamatSup" name="alamat_sup" placeholder="Masukkan Alamat Supplier"></textarea>
                    <small class="form-text text-muted">Masukkan Alamat Supplier</small>
                </div>
                <div class="form-group">
                    <label for="inputTeleponSup">Telepon Supplier</label>
                    <input type="text" class="form-control" id="inputTeleponSup" name="telepon_sup" placeholder="Masukkan Telepon Supplier">
                    <small class="form-text text-muted">Masukkan Telepon Supplier</small>
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


    <footer class="text-center">
      <div class="footer-below">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <p style="font-size: 14px; margin: 0;">Copyright &copy; <script>document.write(new Date().getFullYear());</script> Kelompok 4. All rights reserved</p>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <script src="../vendor/jquery/jquery.min.js"></script>

    <script src="../vendor/css/js/bootstrap.min.js"></script>

  </body>
</html>
<?php 
  include '../koneksi.php';
if ( !isset($_SESSION["idinv"])) {
  header("Location: login.php");
  exit();
}


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
      /* --- GLOBAL LAYOUT & STYLES --- */
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
      #side-menu a:hover, #side-menu a.active {
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
      
      /* --- DASHBOARD PANELS (FIXED & BEAUTIFIED) --- */
      .panel {
          border-radius: 8px; 
          border: none;
          box-shadow: 0 4px 15px rgba(0,0,0,0.1); 
          transition: transform 0.3s, box-shadow 0.3s;
      }
      .panel:hover {
          transform: translateY(-5px);
          box-shadow: 0 8px 20px rgba(0,0,0,0.15);
      }

      /* Konten Panel: Stacked & Centered */
      .panel-heading-content {
          text-align: center;
          padding: 30px 15px; /* Padding lebih besar */
          position: relative;
          min-height: 150px;
          overflow: hidden;
          color: white; /* Pastikan semua teks di heading putih */
          border-radius: 8px 8px 0 0;
      }

      /* Styling Angka Statistik */
      .panel-heading-content h3 {
          font-size: 3.8em; /* Angka JAUH LEBIH BESAR */
          font-weight: 700;
          margin: 0 0 5px 0;
          position: relative;
          z-index: 10;
          line-height: 1;
      }

      /* Styling Label */
      .panel-heading-content div {
          font-size: 1.2em; 
          position: relative;
          z-index: 10;
          font-weight: 400;
      }

      /* Ikon Latar Belakang Samar */
      .panel-heading-content .fa-background {
          font-size: 5em; 
          opacity: 0.2; /* Tingkat kesamaran */
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%); /* Centered */
          color: white; 
          z-index: 5;
      }

      /* Footer Panel */
      .panel-footer {
          border-top: 1px solid rgba(255, 255, 255, 0.3);
          background-color: rgba(0,0,0,0.1);
          color: #fff;
          padding: 10px 15px;
          border-radius: 0 0 8px 8px;
          opacity: 0.9;
      }
      .panel-footer a {
          color: #fff !important;
      }
      
      /* Panel Color overrides for header background */
      .panel-primary .panel-heading-content { background-color: #007bff; }
      .panel-green .panel-heading-content { background-color: #28a745; }
      .panel-info .panel-heading-content { background-color: #17a2b8; }
      .panel-yellow .panel-heading-content { background-color: #ffc107; color: #333; } /* Khusus kuning, teks harus gelap */
      .panel-red .panel-heading-content { background-color: #dc3545; }

      .panel-yellow .panel-heading-content .fa-background { color: #333; } /* Ikon latar belakang kuning juga gelap */

      /* --- FIXED FOOTER --- */
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
            // LOGIKA: Tombol LOGOUT hanya tampil jika BUKAN halaman Data Admin (m=admin)
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
              
              <li>
                <a href="?m=awal.php" class="active">
                  <i class="fa fa-dashboard fa-fw"></i> Beranda
                </a>
              </li>
              <li>
                <a href="?m=admin&s=awal">
                  <i class="fa fa-user-secret fa-fw"></i> Data Admin
                </a>
              </li>
               <li>
                <a href="?m=petugas&s=awal">
                  <i class="fa fa-users fa-fw"></i> Data Petugas
                </a>
              </li>
              <li>
                <a href="?m=supplier&s=awal">
                  <i class="fa fa-truck fa-fw"></i> Data Supplier
                </a>
              </li>
              <li>
                <a href="?m=rak&s=awal">
                  <i class="fa fa-cubes fa-fw"></i> Data Rak
                </a>
              </li>
              <li>
                <a href="?m=barang&s=awal">
                  <i class="fa fa-archive fa-fw"></i> Data Barang
                </a>
              </li>

              <li>
                <a href="?m=barangKeluar&s=awal">
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
            <h1 class="page-header">Selamat Datang, <?php echo $r['nama']; ?></h1>
          </div>
        </div>

        <div class="row">
        
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading-content">
                    <i class="fa fa-user-secret fa-background"></i>
                    <?php
                    include_once "../koneksi.php";
                    $sql="SELECT count(id_admin) as jadmin FROM tb_admin";
                    $query=mysqli_query($koneksi,$sql);
                    $r_admin=mysqli_fetch_assoc($query); // Menggunakan variabel baru agar tidak menimpa $r
                    echo "<h3>".$r_admin['jadmin']."</h3>";
                    ?>
                    <div>Jumlah Admin</div>
                </div>
                <a href="?m=admin&s=awal">
                    <div class="panel-footer">
                        <span class="pull-left">Lihat Detail</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading-content">
                    <i class="fa fa-truck fa-background"></i>
                    <?php
                    $sql="SELECT count(id_sup) as jsup FROM tb_sup";
                    $query=mysqli_query($koneksi,$sql);
                    $r_sup=mysqli_fetch_assoc($query);
                    echo "<h3>".$r_sup['jsup']."</h3>";
                    ?>
                    <div>Jumlah Supplier</div>
                </div>
                <a href="?m=supplier&s=awal">
                    <div class="panel-footer">
                        <span class="pull-left">Lihat Detail</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading-content">
                    <i class="fa fa-cubes fa-background"></i>
                    <?php
                    $sql="SELECT count(id_rak) as jrak FROM tb_rak";
                    $query=mysqli_query($koneksi,$sql);
                    $r_rak=mysqli_fetch_assoc($query);
                    echo "<h3>".$r_rak['jrak']."</h3>";
                    ?>
                    <div>Jumlah Rak</div>
                </div>
                <a href="?m=rak&s=awal">
                    <div class="panel-footer">
                        <span class="pull-left">Lihat Detail</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading-content">
                    <i class="fa fa-archive fa-background"></i>
                    <?php
                    $sql="SELECT count(kode_brg) as jbrg FROM tb_barang";
                    $query=mysqli_query($koneksi,$sql);
                    $r_brg=mysqli_fetch_array($query);
                    echo "<h3>".$r_brg['jbrg']."</h3>";
                    ?>
                    <div>Jumlah Barang</div>
                </div>
                <a href="?m=barang&s=awal">
                    <div class="panel-footer">
                        <span class="pull-left">Lihat Detail</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading-content">
                    <i class="fa fa-sign-in fa-background"></i>
                    <?php
                    $sql="SELECT count(id_brg_in) as jbrg_in FROM tb_barang_in";
                    $query=mysqli_query($koneksi,$sql);
                    $r_brg_in=mysqli_fetch_array($query);
                    echo "<h3>".$r_brg_in['jbrg_in']."</h3>";
                    ?>
                    <div>Barang Masuk</div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Lihat Detail</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading-content">
                    <i class="fa fa-file-text-o fa-background"></i>
                    <?php
                    $sql="SELECT count(no_ajuan) as jajuan FROM tb_ajuan";
                    $query=mysqli_query($koneksi,$sql);
                    $r_ajuan=mysqli_fetch_assoc($query);
                    echo "<h3>".$r_ajuan['jajuan']."</h3>";
                    ?>
                    <div>Jumlah Ajuan</div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Lihat Detail</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading-content">
                    <i class="fa fa-sign-out fa-background"></i>
                    <?php
                    $sql="SELECT count(no_brg_out) as jbrg_out FROM tb_barang_out";
                    $query=mysqli_query($koneksi,$sql);
                    $r_brg_out=mysqli_fetch_assoc($query);
                    echo "<h3>".$r_brg_out['jbrg_out']."</h3>";
                    ?>
                    <div>Barang Keluar</div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Lihat Detail</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
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
<?php
include '../koneksi.php';

if (!isset($_SESSION["idinv2"])) {
    header("Location: login_petugas.php");
    exit();
}

$id = $_SESSION['idinv2'];
$sql = "SELECT * FROM tb_petugas WHERE id_petugas = '$id'";
$query = mysqli_query($koneksi, $sql);
$r = mysqli_fetch_array($query);

$judul = "Dashboard Petugas";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $judul; ?></title>

  <link href="../vendor/css/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/tampilanadmin.css" rel="stylesheet">

  <style>
    /* STYLE 100% SAMA DENGAN DASHBOARD ADMIN & HALAMAN LAIN */
    body { margin-bottom: 60px; background-color: #f8f9fa; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; }
    .navbar-default { background-color: #2c3e50 !important; border: 0 !important; box-shadow: 0 4px 6px rgba(0,0,0,0.1); min-height: 60px; }
    .navbar-brand { color: #ecf0f1 !important; font-weight: 700; font-size: 24px; padding-top: 18px; }
    .navbar-top-links li a { color: #ecf0f1 !important; padding: 20px 15px; transition: background-color 0.3s; }
    .navbar-top-links li a:hover { background-color: #34495e; }

    .navbar-default.sidebar { background-color: #ffffff !important; box-shadow: 2px 0 5px rgba(0,0,0,0.05); }
    .sidebar-nav.navbar-collapse { background-color: #2c3e50 !important; padding-top: 9px; }
    #side-menu a { color: #ffffff; padding: 14px 15px; transition: all 0.2s; border-left: 4px solid transparent; }
    #side-menu a:hover, #side-menu a.active { background-color: #e9ecef !important; color: #007bff; border-left: 4px solid #007bff; }

    #page-wrapper { padding: 25px 30px; min-height: calc(100vh - 60px); background-color: #f8f9fa; }
    .page-header { border-bottom: 2px solid #ced4da; padding-bottom: 10px; margin: 0 0 35px; color: #343a40; font-weight: 300; font-size: 32px; }

    /* PANEL DASHBOARD PREMIUM */
    .panel {
        border-radius: 8px; 
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1); 
        transition: transform 0.3s, box-shadow 0.3s;
        margin-bottom: 30px;
    }
    .panel:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .panel-heading-content {
        text-align: center;
        padding: 30px 15px;
        position: relative;
        min-height: 150px;
        overflow: hidden;
        color: white;
        border-radius: 8px 8px 0 0;
    }

    .panel-heading-content h3 {
        font-size: 3.8em;
        font-weight: 700;
        margin: 0 0 5px 0;
        position: relative;
        z-index: 10;
        line-height: 1;
    }

    .panel-heading-content div {
        font-size: 1.2em; 
        position: relative;
        z-index: 10;
        font-weight: 400;
    }

    .panel-heading-content .fa-background {
        font-size: 5em; 
        opacity: 0.2;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white; 
        z-index: 5;
    }

    .panel-footer {
        border-top: 1px solid rgba(255, 255, 255, 0.3);
        background-color: rgba(0,0,0,0.1);
        color: #fff;
        padding: 10px 15px;
        border-radius: 0 0 8px 8px;
    }
    .panel-footer a { color: #fff !important; }

    /* Warna Panel */
    .panel-green .panel-heading-content   { background-color: #28a745; }
    .panel-primary .panel-heading-content { background-color: #007bff; }
    .panel-info .panel-heading-content    { background-color: #17a2b8; }
    .panel-warning .panel-heading-content { background-color: #ffc107; color: #333; }
    .panel-warning .panel-heading-content .fa-background { color: #333; }
    .panel-danger .panel-heading-content  { background-color: #dc3545; }

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

  <!-- NAVBAR & SIDEBAR -->
  <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="?m=awal.php">INVENTORY</a>
    </div>

    <ul class="nav navbar-top-links navbar-right">
      <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo htmlspecialchars($r['nama']); ?></a></li>
      <li style="background-color: #007bff; border-radius: 4px; margin-left: 10px;">
        <a href="logout_petugas.php" onclick="return confirm('Yakin ingin logout?')" style="color: white !important;">
          <i class="fa fa-sign-out fa-fw"></i> LOGOUT
        </a>
      </li>
    </ul>

    <div class="navbar-default sidebar" role="navigation">
      <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
          <li><a href="?m=awal.php" class="active"><i class="fa fa-dashboard fa-fw"></i> Beranda</a></li>
          <li><a href="?m=barangMasuk&s=awal"><i class="fa fa-cart-arrow-down fa-fw"></i> Data Barang Masuk</a></li>
          <li><a href="?m=ajuan&s=awal"><i class="fa fa-gift fa-fw"></i> Data Ajuan</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- KONTEN DASHBOARD -->
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Selamat Datang, <?php echo htmlspecialchars($r['nama']); ?>!</h1>
      </div>
    </div>

    <div class="row">

      <!-- Total Barang Masuk -->
      <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
          <div class="panel-heading-content">
            <i class="fa fa-cart-arrow-down fa-background"></i>
            <?php
            $sql = "SELECT COUNT(id_brg_in) AS total FROM tb_barang_in";
            $q = mysqli_query($koneksi, $sql);
            $d = mysqli_fetch_assoc($q);
            echo "<h3>".$d['total']."</h3>";
            ?>
            <div>Barang Masuk</div>
          </div>
          <a href="?m=barangMasuk&s=awal">
            <div class="panel-footer">
              <span class="pull-left">Lihat Detail</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>

      <!-- Total Ajuan -->
      <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
          <div class="panel-heading-content">
            <i class="fa fa-gift fa-background"></i>
            <?php
            $sql = "SELECT COUNT(no_ajuan) AS total FROM tb_ajuan";
            $q = mysqli_query($koneksi, $sql);
            $d = mysqli_fetch_assoc($q);
            echo "<h3>".$d['total']."</h3>";
            ?>
            <div>Total Ajuan</div>
          </div>
          <a href="?m=ajuan&s=awal">
            <div class="panel-footer">
              <span class="pull-left">Lihat Detail</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>

      <!-- Ajuan Disetujui -->
      <div class="col-lg-3 col-md-6">
        <div class="panel panel-info">
          <div class="panel-heading-content">
            <i class="fa fa-check-square-o fa-background"></i>
            <?php
            $sql = "SELECT COUNT(no_ajuan) AS disetujui FROM tb_ajuan WHERE val = '0'"; // sesuaikan kondisi
            $q = mysqli_query($koneksi, $sql);
            $d = mysqli_fetch_assoc($q);
            echo "<h3>".$d['disetujui']."</h3>";
            ?>
            <div>Ajuan Disetujui</div>
          </div>
          <a href="?m=ajuan&s=awal">
            <div class="panel-footer">
              <span class="pull-left">Lihat Detail</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>

      <!-- Ajuan Pending / Ditolak -->
      <div class="col-lg-3 col-md-6">
        <div class="panel panel-warning">
          <div class="panel-heading-content">
            <i class="fa fa-clock-o fa-background"></i>
            <?php
            $sql = "SELECT COUNT(no_ajuan) AS pending FROM tb_ajuan WHERE val != '0'";
            $q = mysqli_query($koneksi, $sql);
            $d = mysqli_fetch_assoc($q);
            echo "<h3>".$d['pending']."</h3>";
            ?>
            <div>Pending / Ditolak</div>
          </div>
          <a href="?m=ajuan&s=awal">
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

<!-- FOOTER -->
<footer class="text-center">
  <div class="footer-below">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p style="font-size: 14px; margin: 0;">
            Copyright © <script>document.write(new Date().getFullYear());</script> Kelompok 4. All rights reserved
          </p>
        </div>
      </div>
    </div>
  </div>
</footer>

<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/css/js/bootstrap.min.js"></script>
</body>
</html> 
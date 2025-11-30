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

$judul = "Data Barang Masuk";

// Untuk tanggal & jam otomatis
date_default_timezone_set("Asia/Jakarta");
$tanggalSekarang = date("Y-m-d");
$jamSekarang     = date("H:i"); // format 24 jam lebih rapi
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
    /* === STYLE SAMA PERSIS DENGAN DASHBOARD ADMIN & PETUGAS === */
    body { margin-bottom: 60px; background-color: #f8f9fa; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; }
    .navbar-default { background-color: #2c3e50 !important; border: 0 !important; box-shadow: 0 4px 6px rgba(0,0,0,0.1); min-height: 60px; }
    .navbar-brand { color: #ecf0f1 !important; font-weight: 700; font-size: 24px; padding-top: 18px; }
    .navbar-top-links li a { color: #ecf0f1 !important; padding: 20px 15px; transition: background-color 0.3s; }
    .navbar-top-links li a:hover { background-color: #34495e; }

    .navbar-default.sidebar { background-color: #ffffff !important; box-shadow: 2px 0 5px rgba(0,0,0,0.05); }
    .sidebar-nav.navbar-collapse { background-color: #2c3e50 !important; padding-top: 9px; }
    #side-menu a { color: #ffffff; padding: 14px 15px; transition: all 0.2s; border-left: 4px solid transparent; }
    #side-menu a:hover, #side-menu a.active { background-color: #2c3e50 !important; }

    #page-wrapper { padding: 25px 30px; min-height: calc(100vh - 60px); background-color: #f8f9fa; }
    .page-header { border-bottom: 2px solid #ced4da; padding-bottom: 10px; margin: 0 0 35px; color: #343a40; font-weight: 300; font-size: 32px; }

    /* Tabel lebih rapi */
    .table { background: #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden; }
    .table thead { background-color: #2c3e50; color: white; }
    .table tbody tr:hover { background-color: #f1f3f5; }

    /* Footer fixed */
    .footer-below { background-color: #343a40; color: #fff; padding: 18px 0; position: fixed; left: 0; bottom: 0; width: 100%; z-index: 1000; }
  </style>
</head>
<body>
<div id="wrapper">

  <!-- NAVBAR & SIDEBAR -->
  <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
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
          <li><a href="?m=awal.php"><i class="fa fa-dashboard fa-fw"></i> Beranda</a></li>
          <li><a href="?m=barangMasuk&s=awal" class="active"><i class="fa fa-cart-arrow-down fa-fw"></i> Data Barang Masuk</a></li>
          <li><a href="?m=ajuan&s=awal"><i class="fa fa-gift fa-fw"></i> Data Ajuan</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- KONTEN UTAMA -->
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Data Barang Masuk</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <!-- Tombol Tambah -->
        <button type="button" class="btn btn-primary btn-lg mb-4" data-toggle="modal" data-target="#tambahBarangMasuk">
          <i class="fa fa-plus"></i> Tambah Data Barang Masuk
        </button>

        <!-- Tabel Data -->
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th width="5%">No</th>
                <th>Tanggal</th>
                <th>No Invoice</th>
                <th>Supplier</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah Masuk</th>
                <th>Jam</th>
                <th>Petugas</th>
                <th width="10%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php include 'paging.php'; ?>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <center>
          <ul class="pagination justify-content-center">
            <li class="page-item <?php if($halaman <= 1) echo 'disabled'; ?>">
              <a class="page-link" href="<?php if($halaman > 1) echo '?m=barangMasuk&s=awal&halaman='.$previous; ?>">Previous</a>
            </li>
            <?php for($x=1; $x<=$total_halaman; $x++): ?>
              <li class="page-item <?php if($x == $halaman) echo 'active'; ?>">
                <a class="page-link" href="?m=barangMasuk&s=awal&halaman=<?php echo $x; ?>"><?php echo $x; ?></a>
              </li>
            <?php endfor; ?>
            <li class="page-item <?php if($halaman >= $total_halaman) echo 'disabled'; ?>">
              <a class="page-link" href="<?php if($halaman < $total_halaman) echo '?m=barangMasuk&s=awal&halaman='.$next; ?>">Next</a>
            </li>
          </ul>
        </center>
      </div>
    </div>
  </div>
</div>

<!-- MODAL TAMBAH BARANG MASUK -->
<div class="modal fade" id="tambahBarangMasuk" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="?m=barangMasuk&s=simpan" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Barang Masuk</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Tanggal</label>
                <input type="date" class="form-control" name="tanggal" value="<?php echo $tanggalSekarang; ?>" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>No. Invoice</label>
                <input type="text" class="form-control" name="noinv" required placeholder="Contoh: INV-2025-001">
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Kode Barang</label>
            <?php
            $sql_barang = mysqli_query($koneksi, "SELECT * FROM tb_barang ORDER BY kode_brg ASC");
            $jsArray = "var prdName = new Array();\n";
            echo '<select name="kode_brg" class="form-control" onchange="changeValue(this.value)" required>';
            echo '<option value="">--- Pilih Barang ---</option>';
            while ($row = mysqli_fetch_array($sql_barang)) {
                echo '<option value="'.$row['kode_brg'].'">KDB'.$row['kode_brg'].' - '.$row['nama_brg'].'</option>';
                $jsArray .= "prdName['".$row['kode_brg']."'] = {nama_brg:'".addslashes($row['nama_brg'])."', supplier:'".addslashes($row['supplier'])."'};\n";
            }
            echo '</select>';
            ?>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" class="form-control" id="prd_nmbrg" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Supplier</label>
                <input type="text" class="form-control" id="prd_sup" name="supplier" readonly>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Jumlah Masuk</label>
                <input type="number" class="form-control" name="jml_masuk" required min="1" placeholder="Jumlah">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Jam</label>
                <input type="text" class="form-control" name="jam" value="<?php echo $jamSekarang; ?>" readonly>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Petugas</label>
            <input type="text" class="form-control" value="<?php echo $r['nama']; ?>" readonly>
            <input type="hidden" name="petugas" value="<?php echo $r['nama']; ?>">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  <?php echo $jsArray; ?>
  function changeValue(id){
    document.getElementById('prd_nmbrg').value = prdName[id].nama_brg;
    document.getElementById('prd_sup').value   = prdName[id].supplier;
  }
</script>

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
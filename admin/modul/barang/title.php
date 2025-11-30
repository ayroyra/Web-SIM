<?php 
  include '../koneksi.php';
if ( !isset($_SESSION["idinv"])) {
  header("Location: login.php");
  exit();
}

// Tambahkan logika untuk mendapatkan judul halaman
$judul = "Data Barang | Inventory"; 

// Query data user yang sedang login
$id_admin = $_SESSION['idinv'];
$sql_user = "SELECT * FROM tb_admin WHERE id_admin = '$id_admin'";
$query_user = mysqli_query($koneksi, $sql_user);
$r_user = mysqli_fetch_array($query_user); // Data user yang sedang login

// Logika untuk Paging dan Pencarian (Diambil dari file paging.php yang di-include)
// Karena paging.php tidak disertakan, saya akan membuat struktur standar:
$batas = 5; 
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;
$previous = $halaman - 1;
$next = $halaman + 1;

$cari = isset($_POST['cari']) ? $_POST['cari'] : '';

if(isset($_POST['go'])) {
    $data_query = "SELECT * FROM tb_barang WHERE kode_brg LIKE '%$cari%' OR nama_brg LIKE '%$cari%' OR rak LIKE '%$cari%' OR supplier LIKE '%$cari%'";
    $data_all = mysqli_query($koneksi, $data_query);
} else {
    $data_query = "SELECT * FROM tb_barang";
    $data_all = mysqli_query($koneksi, $data_query);
}

$jumlah_data = mysqli_num_rows($data_all);
$total_halaman = ceil($jumlah_data / $batas);

$data_barang_display = mysqli_query($koneksi, $data_query . " LIMIT $halaman_awal, $batas");

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
      .navbar-top-links li a {
          color: #ecf0f1 !important; 
          padding-top: 20px;
          padding-bottom: 20px;
          transition: background-color 0.3s;
      }
      .navbar-top-links li a:hover {
          background-color: #34495e; 
      }
      
      /* Tambahan untuk Navbar Logout */
      .navbar-top-links .logout-button {
          background-color: #007bff; 
          border-radius: 4px; 
          margin-left: 10px;
      }
      .navbar-top-links .logout-button a, .navbar-top-links .logout-button button {
          color: white !important;
          padding: 20px 15px !important;
          border: none;
          background: none;
      }
      /* Style untuk Foto Profil di Navbar */
      .navbar-top-links img {
          width: 30px; 
          height: 30px; 
          border-radius: 50%;
          object-fit: cover;
          margin-right: 5px;
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
      /* Aktifkan border-left pada menu yang sedang aktif */
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

      /* --- TABLE & BUTTON STYLING --- */
      .table-earning {
          background-color: white;
          border-radius: 8px;
          overflow: hidden;
          box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      }
      .table-earning thead th {
          background-color: #343a40;
          color: white;
          font-weight: 600;
          padding: 15px;
      }
      .table-earning tbody tr:hover {
          background-color: #f1f1f1;
      }
      .btn-primary {
          background-color: #007bff;
          border-color: #007bff;
          margin-bottom: 15px; 
          transition: background-color 0.2s;
      }
      .btn-primary:hover {
          background-color: #0056b3;
          border-color: #0056b3;
      }
      /* Style untuk tombol aksi dalam tabel */
      .btn-sm {
        margin-right: 5px;
      }
      /* Style untuk kotak pencarian */
      .search-box {
          margin-bottom: 20px;
          padding: 15px;
          background-color: #e9ecef;
          border-radius: 5px;
          display: flex;
          align-items: center;
          justify-content: center;
      }
      .search-box label {
          margin-right: 10px;
          font-weight: 600;
      }
      .search-box input[type="text"] {
          padding: 8px;
          border: 1px solid #ced4da;
          border-radius: 4px;
          width: 200px;
          margin-right: 10px;
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
          
          <ul class="nav navbar-top-links navbar-right">
            <li>
                <a href="#">
                    <img src="../images/admin/<?php echo $r_user['foto']; ?>" height="50"> <?php echo $r_user['nama']; ?>
                </a>
            </li>
            
            <li class="logout-button">
              <a href="logout.php" onclick="return confirm('yakin ingin logout?');">
                <i class="fa fa-sign-out fa-fw"></i> LOGOUT
              </a>
            </li>
          </ul>

        <div class="navbar-default sidebar" role="navigation">
          <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                            <li>
                <a href="?m=awal.php">
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
                <a href="?m=barang&s=awal" class="active">
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
            <h1 class="page-header">Data Barang</h1>
          </div>
        </div>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
          <i class="fa fa-plus"></i> Tambah data
        </button>

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah data barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="?m=barang&s=simpan" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="kode_brg">Kode Barang</label>
                    <input type="text" class="form-control" id="kode_brg" name="kode_brg" maxlength="5" placeholder="Masukkan Kode Barang">
                    <small class="form-text text-muted">Masukkan Kode Barang</small>
                </div>
                <div class="form-group">
                    <label for="nama_brg">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_brg" name="nama_brg" placeholder="Masukkan Nama Barang">
                    <small class="form-text text-muted">Masukkan Nama Barang</small>
                </div>
                <div class="form-group">
                    <label for="stok">Stok Barang</label>
                    <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan Stok Barang">
                    <small class="form-text text-muted">Masukkan Stok Barang</small>
                </div>
                <div class="form-group">
                    <label for="rak">Rak</label>
                    <select class="form-control" name="rak" required="">
                    <option value="">-- Pilih Rak --</option>
                    <?php 
                        $sql_rak = "SELECT * FROM tb_rak";
                        $hasil_rak = mysqli_query($koneksi, $sql_rak);
                        while ($data_rak = mysqli_fetch_array($hasil_rak)) {
                            echo '<option value="'.$data_rak['nama_rak'].'">'.$data_rak['nama_rak'].'</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="supplier">Supplier</label>
                    <select class="form-control" name="supplier" required="">
                    <option value="">-- Pilih Supplier --</option>
                    <?php 
                        $sql_sup = "SELECT * FROM tb_sup";
                        $hasil_sup = mysqli_query($koneksi, $sql_sup);
                        while ($data_sup = mysqli_fetch_array($hasil_sup)) {
                            echo '<option value="'.$data_sup['nama_sup'].'">'.$data_sup['nama_sup'].'</option>';
                        }
                    ?>
                    </select>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
              </div>
                </form>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="search-box">
              <form action="" method="POST" style="display: flex; align-items: center;">
                <label>Cari Barang</label>
                <input type="text" name="cari" value="<?php echo htmlspecialchars($cari); ?>"> 
                <button type="submit" name="go" class="btn btn-success"><i class="fa fa-search"></i> Cari Barang</button>
              </form>
            </div>
          </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive table--no-card m-b-30">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Stok</th>
                                <th>Rak</th>
                                <th>Supplier</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php 
                           $no = $halaman_awal + 1;
                           while($d = mysqli_fetch_array($data_barang_display)){
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $d['kode_brg']; ?></td>
                                <td><?php echo $d['nama_brg']; ?></td>
                                <td><?php echo $d['stok']; ?></td>
                                <td><?php echo $d['rak']; ?></td>
                                <td><?php echo $d['supplier']; ?></td>
                                <td>
                                    <a href="?m=barang&s=edit&id=<?php echo $d['kode_brg']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="?m=barang&s=hapus&id=<?php echo $d['kode_brg']; ?>" onclick="return confirm('Yakin akan menghapus data ini?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                            <?php 
                           }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <center>
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if($halaman > 1){ echo "href='?m=barang&s=awal&halaman=$previous'"; } else { echo "style='pointer-events: none; color: #ccc;'"; } ?>>Previous</a>
                </li>
                <?php 
                for($x=1;$x<=$total_halaman;$x++){
                    $active_class = ($x == $halaman) ? 'active' : '';
                    ?> 
                    <li class="page-item <?php echo $active_class; ?>"><a class="page-link" href="?m=barang&s=awal&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                    <?php
                }
                ?>              
                <li class="page-item">
                    <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?m=barang&s=awal&halaman=$next'"; } else { echo "style='pointer-events: none; color: #ccc;'"; } ?>>Next</a>
                </li>
            </ul>
        </center> 
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
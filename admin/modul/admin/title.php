<?php 
  include '../koneksi.php';
if ( !isset($_SESSION["idinv"])) {
  header("Location: login.php");
  exit();
}


// Tambahkan logika untuk mendapatkan judul halaman
$judul = "Data Admin | Inventory"; 

// Logika untuk Paging (jika belum ada di file paging.php)
// Asumsi variabel $koneksi sudah tersedia dari include '../koneksi.php'
$batas = 5; // Jumlah data per halaman
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous = $halaman - 1;
$next = $halaman + 1;

$data = mysqli_query($koneksi,"select * from tb_admin");
$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);

$data_admin = mysqli_query($koneksi,"SELECT * FROM tb_admin LIMIT $halaman_awal, $batas");


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
      .navbar-top-links .logout-button a {
          color: white !important;
          padding: 20px 15px !important;
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
      }
      .table-earning tbody tr:hover {
          background-color: #f1f1f1;
      }
      .btn-primary {
          background-color: #007bff;
          border-color: #007bff;
          margin-bottom: 15px; /* Tambahkan margin bawah agar tidak menempel ke tabel */
      }
      .btn-primary:hover {
          background-color: #0056b3;
          border-color: #0056b3;
      }
      /* Style untuk tombol aksi dalam tabel */
      .btn-sm {
        margin-right: 5px;
      }
      /* Style untuk Foto Profil di Navbar */
      .navbar-top-links img {
          width: 30px; 
          height: 30px; 
          border-radius: 50%;
          object-fit: cover;
          margin-right: 5px;
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
           // include '../koneksi.php'; // Sudah di include di atas
           $sql = "SELECT * FROM tb_admin WHERE id_admin = '$id'";
           $query = mysqli_query($koneksi, $sql);
            $r = mysqli_fetch_array($query); // Data user yang sedang login

           ?>
          
          <ul class="nav navbar-top-links navbar-right">
            <li>
                <a href="#">
                    <img src="../images/admin/<?php echo $r['foto']; ?>" height="50"> <?php echo $r['nama']; ?>
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
                <a href="?m=admin&s=awal" class="active">
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
            <h1 class="page-header">Data Admin</h1>
          </div>
        </div>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
          <i class="fa fa-plus"></i> Tambah data
        </button>

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="?m=admin&s=simpan" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
                  </div>
                  <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Masukkan Nomor Telepon">
                  </div>
                  <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" id="foto" name="foto">
                    <small class="form-text text-muted">Maksimal ukuran file 2MB</small>
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
                <div class="table-responsive table--no-card m-b-30">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Id Admin</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                           <?php 
                           $no = $halaman_awal + 1;
                           while($d = mysqli_fetch_array($data_admin)){
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $d['id_admin']; ?></td>
                                <td><?php echo $d['nama']; ?></td>
                                <td><?php echo $d['telepon']; ?></td>
                                <td><img src="../images/admin/<?php echo $d['foto']; ?>" width="50px"></td>
                                <td>
                                    <a href="?m=admin&s=edit&id=<?php echo $d['id_admin']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="?m=admin&s=hapus&id=<?php echo $d['id_admin']; ?>" onclick="return confirm('Yakin akan menghapus data ini?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                            <?php 
                           }
                           // Paging.php sudah diganti dengan logika PHP di atas
                            ?>

                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>

        <center>
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if($halaman > 1){ echo "href='?m=admin&s=awal&halaman=$previous'"; } else { echo "style='pointer-events: none; color: #ccc;'"; } ?>>Previous</a>
                </li>
                <?php 
                for($x=1;$x<=$total_halaman;$x++){
                    $active_class = ($x == $halaman) ? 'active' : '';
                    ?> 
                    <li class="page-item <?php echo $active_class; ?>"><a class="page-link" href="?m=admin&s=awal&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                    <?php
                }
                ?>              
                <li class="page-item">
                    <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?m=admin&s=awal&halaman=$next'"; } else { echo "style='pointer-events: none; color: #ccc;'"; } ?>>Next</a>
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
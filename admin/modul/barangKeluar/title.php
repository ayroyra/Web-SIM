<?php 
  include '../koneksi.php';
// Cek sesi login
if ( !isset($_SESSION["idinv"])) {
  header("Location: login.php");
  exit();
}

  date_default_timezone_set("Asia/Jakarta");
  $tanggalSekarang = date("Y-m-d");
  $jamSekarang = date("h:i a");

// Variabel untuk menandai menu aktif di sidebar (sesuai dengan URL ?m=...)
$current_page = 'barangKeluar'; 

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
      .table-striped > tbody > tr:nth-of-type(odd) {
          background-color: #f7f7f7;
      }
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
            <h1 class="page-header">Data Barang Keluar</h1>
          </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            <i class="fa fa-plus fa-fw"></i> Tambah Data Barang Keluar
                        </button>
                    </div>
                    
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover"> 
                                <thead>
                                    <tr>
                                        <th>No Barang Keluar</th>               
                                        <th>No Ajuan</th>
                                        <th>Tanggal Ajuan</th>
                                        <th>Tanggal Keluar</th>
                                        <th>Petugas</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jml Ajuan</th>
                                        <th>Stok</th>
                                        <th>Jml Keluar</th>
                                        <th>Admin</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php 
                                    // Paging dan data barang keluar harus diproses di sini
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
                                    <a class="page-link" <?php if($halaman > 1){ echo "href='?m=barangKeluar&s=awal&halaman=$previous'"; } ?>>Previous</a>
                                </li>
                                <?php 
                                for($x=1;$x<=$total_halaman;$x++){
                                    ?> 
                                    <li class="page-item"><a class="page-link" href="?m=barangKeluar&s=awal&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                                    <?php
                                }
                                ?>              
                                <li class="page-item">
                                    <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?m=barangKeluar&s=awal&halaman=$next'"; } ?>>Next</a>
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
            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Barang Keluar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="?m=barangKeluar&s=simpan" method="POST" enctype="multipart/form-data">
        	  <div class="form-group">
                <label for="no_brg_out">No Barang Keluar</label>
                <input type="text"  class="form-control" id="no_brg_out" name="no_brg_out" aria-describedby="emailHelp" placeholder="Masukkan Nomor Barang Keluar">
                <small id="emailHelp" class="form-text text-muted">Masukkan No Barang Keluar</small>
              </div>
        	        <div class="form-group">
                <label for="no_ajuan">Nomor Ajuan</label>
               <?php 
    						include ("../koneksi.php");
    						$supp = ("SELECT * FROM tb_ajuan WHERE val = '1' ");
    						$result = mysqli_query($koneksi, $supp);

    						$jsArray = "var prdName = new Array();";

    						echo '<select name="no_ajuan" class="form-control" onchange="changeValue(this.value)">';
    						echo '<option>--- PILIH ---</option>';

    						while ($row = mysqli_fetch_array($result)) {
    							
    								echo '<option value="'. $row['no_ajuan'] .'">AJ0'.$row['no_ajuan'].'</option>';
    								$jsArray .= "prdName['". $row['no_ajuan'] ."'] 
    								= {tanggal_ajuan:'". addslashes($row['tanggal']) ."',
    									petugas:'". addslashes($row['petugas']) ."',
    									kode_brg:'". addslashes($row['kode_brg']) ."',
    									nama_brg:'". addslashes($row['nama_brg']) ."',
    									stok:'". addslashes($row['stok']) ."',
    									jml_ajuan:'". addslashes($row['jml_ajuan']) ."',
    									val:'". addslashes($row['val']) ."'

    								};";
    							}

    						echo '</select>';
    					?>
    					<script type="text/javascript">
    						<?php echo $jsArray; ?>
    						function changeValue(id){
    							document.getElementById('prd_tanggal').value = prdName[id].tanggal_ajuan;
    							document.getElementById('prd_petugas').value = prdName[id].petugas;
    							document.getElementById('prd_kodebrng').value = prdName[id].kode_brg;
    							document.getElementById('prd_namabrg').value = prdName[id].nama_brg;
    							document.getElementById('prd_stokbrga').value = prdName[id].stok;
    							document.getElementById('prd_jmlajuan').value = prdName[id].jml_ajuan;
    							document.getElementById('prd_val').value = prdName[id].val;

    						}		
    					</script>
              </div>
            <div class="form-group">
                <label for="prd_tanggal">Tanggal Ajuan</label>
                <input type="text" readonly="" class="form-control" id="prd_tanggal" name="tanggal_ajuan" placeholder="Masukkan Tanggal Ajuan">
                <small id="emailHelp" class="form-text text-muted">Tanggal Ajuan</small>
              </div>
            <div class="form-group">
                <label for="tanggal_out">Tanggal Keluar</label>
                <input type="text" class="form-control" id="tanggal_out" name="tanggal_out" value="<?php echo $tanggalSekarang; ?>" placeholder="Masukkan Tanggal Keluar">
                <small id="emailHelp" class="form-text text-muted">Tanggal Keluar</small>
              </div>

            <div class="form-group">
                <label for="prd_petugas">Petugas</label>
                <input type="text" readonly="" class="form-control" id="prd_petugas" name="petugas" placeholder="Petugas">
            </div>
            
            <div class="form-group">
                <label for="prd_kodebrng">Kode Barang</label>
                <input type="text" readonly="" class="form-control" id="prd_kodebrng" name="kode_brg" placeholder="Kode Barang">
            </div>
            <div class="form-group">
                <label for="prd_namabrg">Nama Barang</label>
                <input type="text" name="nama_brg" class="form-control" readonly="" id="prd_namabrg" placeholder="Nama Barang">
            </div>
            <div class="form-group">
                <label for="prd_stokbrga">Stok</label>
                <input type="text" class="form-control" id="prd_stokbrga" name="stok" readonly="" placeholder="Stok Barang">
            </div>
            <div class="form-group">
                <label for="prd_jmlajuan">Jumlah Ajuan</label>
                <input type="text" class="form-control" readonly="" id="prd_jmlajuan" name="jml_ajuan" placeholder="Jumlah Ajuan">
            </div>
            <div class="form-group">
                <label for="jml_keluar">Jumlah Keluar</label>
                <input type="text" class="form-control" id="jml_keluar" name="jml_keluar" placeholder="Masukkan Jumlah Keluar">
                <small id="emailHelp" class="form-text text-muted">Masukkan Jumlah Keluar</small>
              </div>
            <div class="form-group">
                <label for="admin">Admin</label>
                <input type="text" class="form-control" id="admin" value="<?php echo $r['nama']; ?>" readonly="" name="admin" placeholder="Nama Admin">
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
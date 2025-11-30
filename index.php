<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
 <link href="vendor/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/css/bootstrap/bootstrap.css" rel="stylesheet">

    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="css/tampilan.css" rel="stylesheet">
	<title>Inventory Barang</title>

    <style>
      /* START: Style Tambahan untuk tampilan yang lebih rapih */
      .section-tentang {
          padding: 80px 0;
          background-color: #f8f8f8;
      }
      .jumbotron-custom {
          padding: 30px;
          margin-bottom: 0;
          background-color: #ffffff;
          border-radius: 6px;
          box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      }
      .jumbotron-custom h1 {
          color: #333;
          font-weight: 600;
          margin-top: 0;
      }
      .footer-custom {
          background-color: #222;
          color: #ccc;
          padding: 20px 0;
          text-align: center;
      }
      .footer-custom a {
          color: #ccc;
          transition: color 0.3s;
      }
      .footer-custom a:hover {
          color: #fff;
      }
      
      /* Style Khusus untuk Merapikan Tombol di Navbar */
      .navbar-nav > li > a.btn-nav-custom {
          margin-top: 10px;
          margin-bottom: 10px;
          line-height: 20px; 
          padding: 6px 12px;
          color: #fff !important;
          border-radius: 4px;
          text-transform: uppercase;
      }
      .navbar-nav > li:nth-last-child(2) > a.btn-nav-custom {
          margin-left: 10px;
          margin-right: 5px;
      }

      /* START: Style Kustom untuk Merapikan Gambar Banner di Tengah */
      .carousel-inner .item img {
          position: absolute;
          top: 50%;
          left: 50%;
          min-width: 100%;
          min-height: 100%;
          /* Transformasi untuk memposisikan titik tengah gambar ke titik tengah container */
          transform: translate(-50%, -50%);
          -ms-transform: translate(-50%, -50%);
          -webkit-transform: translate(-50%, -50%);
          max-width: none;
      }
      /* Mengatur tinggi minimum untuk carousel agar gambar terlihat penuh */
      #myCarousel {
          height: 60vh; /* Contoh: 60% dari tinggi viewport */
          min-height: 300px;
          overflow: hidden;
      }
      .carousel-inner {
          height: 100%;
      }
      .carousel-inner .item {
          height: 100%;
          width: 100%;
          background-color: #777; /* Warna fallback */
      }
      /* END: Style Kustom untuk Merapikan Gambar Banner di Tengah */

    </style>
</head>
<body>


<nav class="navbar navbar-default navbar-fixed-top navbar-custom  ">
      <div class="container">
        <div class="navbar-header page-scroll">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">navigation</span> Menu <i class="fa fa-bars"></i>
          </button>
          <a class="navbar-brand">Inventory</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li class="page-scroll">
              <a href="index.php">Beranda</a>
            </li>
            
            <li class="page-scroll">
              <a href="#tentang">Tentang</a>
            </li>

            <li class="page-scroll">
              <a href="admin/login.php" target="_blank" class="btn-nav-custom" style="background-color: #337ab7;">ADMIN</a>
            </li>
            
            <li class="page-scroll">
              <a href="petugas/login_petugas.php" target="_blank" class="btn-nav-custom" style="background-color: #f0ad4e;">PETUGAS</a>
            </li>
            
          </ul>
        </div>

 

      </div>
    </nav>	

               <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="images/logistic1.jpg" alt="First slide">
        </div>
        <div class="item">
          <img src="images/logistic2.jpg" alt="Second slide">
        </div>
        <div class="item">
          <img src="images/logistic3.jpg" alt="Third slide">
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
       
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        
        <span class="sr-only">Next</span>
      </a>
    </div>

   
    <section id="tentang" class="section-tentang">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <div class="jumbotron-custom">
              <h1>Tentang Website Inventory</h1><br>
              <p style="font-size: 16px; line-height: 1.6; color: #555;">
                Website inventory adalah aplikasi berbasis Web yang dirancang untuk membantu pengelolaan dan pencatatan keluar masuk barang di gudang secara efisien. Sistem ini meliputi pencatatan detail barang masuk dari Supplier dan pencatatan barang keluar untuk memastikan stok selalu akurat dan terkelola dengan baik.
              </p>  
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer class="footer-custom">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <ul class="list-inline">
              <li>
                <a href="https://www.instagram.com/ezar.rg/" target="_blank"><i class="fa fa-facebook fa-fw fa-2x"></i></a>
              </li>
              </ul>
            <hr style="border-top: 1px solid #444; width: 100px; margin: 10px auto;">
            <p class="text-muted" style="font-size: 14px; margin-bottom: 0;">Copyright &copy;<script>document.write(new Date().getFullYear());</script> Kelompok 4 All rights reserved</p>
          </div>
        </div>
      </div>
    </footer>

 <script src="vendor/jquery/jquery.min.js"></script>

    <script src="vendor/css/js/bootstrap.min.js"></script>
</body>
</html>
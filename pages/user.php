<?php 
  session_start();
  include_once('../back/conexao.php');

  $id = $_GET["id"];

  $query = "SELECT * FROM usuario 
    INNER JOIN telefone ON FK_TELEFONE = ID_TELEFONE 
    INNER JOIN cadastro ON FK_CADASTRO = ID_CADASTRO
    WHERE ID_USUARIO='$id'";
  $query = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($query);

  if(empty($row)) {
    header('Location: ../index.html');
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>BAG-A-BAGₑ</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <!-- CSS files  -->
  <link rel="stylesheet" href="../assets/css/user/user.css">
  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Groovin
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/groovin-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body>
    <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="index.html">BAG-A-BAGₑ</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">HOME</a></li>
          <li><a class="nav-link scrollto" href="#">SOBRE</a></li>
          <li><a class="nav-link scrollto" href="#">DESTINOS</a></li>
          <li><a class="nav-link scrollto " href="#">OFERTAS</a></li>
          <li><a class="nav-link scrollto" href="#">CONTATO</a></li>
          <!-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul> -->
          </li>
          <li><a class="nav-link scrollto" href="#contact" style = "margin-left: 80px;">LOGIN</a></li>
          <li><a class="getstarted scrollto" href="#about">CADASTRE-SE</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main" class="mt-5 container">
    <section class="row d-flex align-items-center justify-content-center" id="profile">
        <img src="../assets/img/user/icone_perfil.png" alt="" class="col-lg-2 col-sm-6">
        <div class="col-lg-8 col-sm-6 mt-2">
          <h1><?php echo ucfirst($row['NOME']) . ' ' . ucfirst($row['NOME_MEIO']). ' ' . ucfirst($row['SOBRENOME']) ?></h1>
          <p>E-mail: <?php echo $row['EMAIL'] ?></p>
          <p>CPF: <?php echo $row['CPF'] ?></p> 
          <p>Telefone: <?php echo $row['DDD'] . ' ' . $row['NUMERO']?></p>
        </div>
        <div class="col-lg-2">
          <a href="">     
            <button type="submit" style="min-width: 80px;"class="btn btn-outline-success text-center">
              <i class="bi bi-gear"></i>
              Editar
            </button>
          </a>
        </div>
    </section>

    <section id="reservar" class="container">
      <h2 class="text-center">Ultimas Reservas</h2>
      <div class="card col-12 mt-5" style="width: 100%;">
        <div class="card-body">
          <h5 class="card-title">ID da Reserva</h5>
          <h6 class="card-subtitle mb-2 text-body-secondary mt-4">Origem : </h6>
          <h6 class="card-subtitle mb-2 text-body-secondary mt-4">Destino : </h6>
          <p class="card-text mt-2">Tipo da passagem: </p>
          <p class="card-text mt-2">Numero do avião: </p>
          <p class="card-text mt-2">Numero do avião 2: </p>
          <p class="card-text mt-2">Preço: </p>
          <h5 class="card-title">Detalhes do(s) passageiro(s)</h5>
        </div>
      </div>
    </section>
  </main>


    <!-- ======= Footer ======= -->
    <footer id="footer">
      <div class="footer-top">
        <div class="container">
          <div class="row">
  
            <div class="col-lg-3 col-md-6">
              <div class="footer-info">
                <h3>BAG-A-BAGₑ</h3>
                <p>
                  A108 Adam Street <br>
                  NY 535022, USA<br><br>
                  <strong>Telefone:</strong>(11) 9000-0000<br>
                  <strong>Email:</strong>bag.a.bag@gmail.com<br>
                </p>
                <div class="social-links mt-3">
                  <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                  <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                  <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                  <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                  <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                </div>
              </div>
            </div>
  
            <div class="col-lg-2 col-md-6 footer-links">
              <h4>BAG-A-BAGₑ</h4>
              <ul>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Sobre</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Destinos</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Ofertas</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Contato</a></li>
              </ul>
            </div>
  
          <div class="col-lg-3 col-md-6 footer-links">
              <h4>Conta</h4>
              <ul>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Login</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Cadastre-se</a></li>
                <!-- <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li> -->
              </ul>
            </div>
  
            <div class="col-lg-4 col-md-6 footer-newsletter">
              <h4>Inscreva-se para receber ofertas exclusivas</h4>
              <!-- <p>Inscreva-se para receber ofertas exclusivas</p> -->
              <form action="" method="post">
                <input type="email" name="email"><input type="submit" value="Quero recebê-las!">
              </form>
  
            </div>
          </div>
        </div>
      </div>
    </footer><!-- End Footer -->
</body>
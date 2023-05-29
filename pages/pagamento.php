<?php
  session_start();
  include_once('../back/conexao.php');

  $id = $_SESSION['id_usuario'];
  $id_voo = $_SESSION['id_voo'];

  $query = "SELECT * FROM usuario 
    INNER JOIN telefone ON FK_TELEFONE = ID_TELEFONE 
    INNER JOIN cadastro ON FK_CADASTRO = ID_CADASTRO
    INNER JOIN rg ON FK_RG = ID_RG
    WHERE ID_USUARIO='$id'";
    $query = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($query);
    
    if(empty($row)) {
      header('Location: ../index.php');
    }

   
    
    //pegando o valor total do pagamento vindo da reserva
    $valorTotal = $_SESSION['valor_total'];
    
     
  $parcelas = array();

//Faz a divisão do valor total de 1 a 12 e armazena em um array para apresenta-lo posteriormente
for ($i = 1; $i <= 12; $i++) {
  $valorParcela = $valorTotal / $i; //Calcula o valor de cada parcela
  $valorParcela = ceil($valorParcela * 100) / 100; // arredonda para cima com duas casas decimais
  $valorParcelaFormatado = number_format($valorParcela, 2, ',', '.'); // formata o valor com duas casas decimais
  array_push($parcelas, $valorParcelaFormatado); //Armazena a parcela no array de parcelas
}

$num_pets = mysqli_query($conn, "SELECT COUNT(ID_PET) AS qt_animais FROM animal INNER JOIN passagem ON FK_PASSAGEM = ID_PASSAGEM WHERE FK_VOO = $id_voo");
$qt_pets = mysqli_fetch_assoc($num_pets);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>>Bag-a-Bagₑ - Pagamento</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/airplane_favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- Fonte: Poppins -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- Fonte: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet"> <!-- Fonte: Poppins -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- CSS Bag-a-Bag -->
  <link rel="stylesheet" href="../assets/css/pagamento/pagamento.css">

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

      <h1 class="logo"><a href="../index.php">BAG-A-BAGₑ</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="../index.php">HOME</a></li>
          <li><a class="nav-link scrollto" href="../index.php#services">SOBRE</a></li>
          <li><a class="nav-link scrollto" href="./destinos.php">DESTINOS</a></li>
          <li><a class="nav-link scrollto " href="../index.php#pricing">OFERTAS</a></li>
          <li><a class="nav-link scrollto" href="../index.php#contact">CONTATO</a></li>
          <!-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul> -->
          </li>
          <li><a class="getstarted scrollto" href="<?php echo "user.php?id=" . $row['ID_USUARIO'] ?>" style = "margin-left: 80px;">Ver perfil</a></li>
          <li><a class="nav-link scrollto" href="../back/controller/controller_logoff.php" >LOGOFF</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->


  <!-- conteudo de pagamento -->
    <main class="container">
        <form action="" method="post">
            <div class="row">
                <h3 class="h-faturamento">Detalhes do faturamento</h3>
                <?php
                  if (isset($_SESSION["msg"])) {   // isset() verifica se a variavel existe;
                      echo $_SESSION["msg"];
                      unset($_SESSION["msg"]);    // unset() destrói a variável passada como argumento, melhor utilizada em escopo global
                  }
                ?>
                <div id="caixa-detalhes" class="col-8 offset-2 shadow">
                <div class="row">
                    <div class="half-box">
                        <div class="col">
                          <label for = "name" class="required" style = "color: #5c9f24">Nome</label>
                          <input type = "name" value="<?php echo ucfirst($row['NOME']) ?>" class="form-control required" style = "background-color: #FFF; border-color: black" name = "name" id = "name" disabled>
                      </div>
                    </div>
                    <div class = "half-box">
                          <label for = "lastname" class="required" style = "color: #5c9f24">Sobrenome</label>
                          <input type = "lastname" value= "<?php echo ucfirst($row['SOBRENOME']) ?>" class="form-control required" style = "background-color: #FFF; border-color: black" name = "sobrenome" id = "sobrenome" disabled>
                        <br>
                    </div>
                </div>
                <div class="row">
                      <div class = "half-box">
                        <label for = "cpf" class="required" style = "color: #5c9f24" >CPF</label>
                        <input type = "text" value="<?php echo $row['CPF'] ?>" class="form-control required" style = "background-color: #FFF; border-color: black" name = "cpf" id = "cpf" disabled>
                    </div>
                    <div class = "half-box">
                        <label for = "rg" class="required" style = "color: #5c9f24">RG</label>
                        <input type = "text" value="<?php echo $row['NUMERO_RG'] ?>" name = "rg" id = "rg" class="form-control required" style = "background-color: #FFF; border-color: black" disabled>
                      <br>
                    </div>
                </div>
                  <div class="row">
                      <div class = "half-box">
                          <label for = "email" class="required" style = "color: #5c9f24">E-mail</label>
                          <input type = "email" value="<?php echo $row['EMAIL'] ?>" name = "email" id = "email" class="form-control required" style = "background-color: #FFF; border-color: #000" disabled>
                        </div>
                        <div class = "half-box">
                          <label for = "tel" class="required" style = "color: #5c9f24">Telefone</label>
                          <input type = "tel" value = "<?php echo $row['DDD'] . ' ' . $row['NUMERO_TELEFONE']?>" name = "telefone" id = "telefone" placeholder = "(DDD)XXXXX-XXXX" maxlength="15" class="form-control required" onkeypress="tel(this)" style = "background-color: #FFF; border-color: black" disabled>
                        <br>
                  </div>

                <div class="" style="padding-bottom: 10px; font-weight: bold;" <?php if ($qt_pets['qt_animais'] == 3) {
                  echo("hidden");
                } ?>>
                  <label><a href="cadastro-pet.php" style=" font-size: 20px;">Deseja cadastrar um pet?</a></label>
                    <!-- <div class="">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="cadastrar_pet" id="cadastrar_pet_sim" value="sim">
                            <label class="form-check-label" for="cadastrar_pet_sim">Sim</label>
                        </div>
                    </div>
                    <div class="">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="cadastrar_pet" id="cadastrar_pet_nao" value="nao" checked>
                            <label class="form-check-label" for="cadastrar_pet_nao">Não</label>
                        </div>
                    </div> -->
                    <!-- <a href="./cadastro-pet.php" id="btn-submit" style="max-width: 130px; margin: initial" class="btn btn-primary mb-3">
                        Cadastrar Pet
                    </a> -->
                </div>

            <script>
                // Obtém o campo de seleção de rádio
                var cadastrarPetRadio = document.querySelectorAll('input[name="cadastrar_pet"]');

                // Obtém o botão de cadastrar
                var cadastrarPetButton = document.getElementById('btn-submit');

                // Adiciona o evento de mudança aos campos de seleção de rádio
                cadastrarPetRadio.forEach(function(radio) {
                    radio.addEventListener('change', function() {
                        // Verifica se a opção "Não" foi selecionada
                        if (this.value === 'nao') {
                            // Oculta o botão de cadastrar
                            cadastrarPetButton.style.display = 'none';
                        } else {
                            // Mostra o botão de cadastrar
                            cadastrarPetButton.style.display = 'block';
                        }
                    });
                });

                // Verifica o estado inicial do campo de seleção de rádio
                if (document.getElementById('cadastrar_pet_nao').checked) {
                    // Oculta o botão de cadastrar inicialmente
                    cadastrarPetButton.style.display = 'none';
                }
            </script>
            </div>
         </div>
     </form>
    
     

        
        <form action="../back/controller/controller_verificar_pagamento.php" method="post">
          <div class="row">
            <h3 class="h-forma">Formas de pagamento</h3>
            <div id="caixa-pagamento" class="col-8 offset-2 shadow">
                <input type="radio" id="termos" name="pagamento"  value="credito"> <label for="">Cartão de crédito</label> 
                <div id="termoConteudo">

                  <div class="row">
                    <div class="half-box">
                      <div class="col">
                        <label for = "name" class="required" style = "color: #5c9f24">Nome impresso no cartão</label>
                        <input type = "name" class="form-control required" style = "background-color: #FFF; border-color: black" name = "name" id = "name">
                        
                      </div>
                    </div>

                    <div class = "half-box">
                        <label for = "lastname" class="required" style = "color: #5c9f24">Número do cartão</label>
                        <input type = "lastname" name="numeroCartao" class="form-control required" style = "background-color: #FFF; border-color: black" name = "sobrenome" id = "sobrenome" maxlength="19">
                        <br>
                      </div>
                    </div>
                  
                  <div class="row">
                    <div class = "half-box">
                      <label for = "cpf" class="required" style = "color: #5c9f24" >Bandeira do cartão</label>
                      <input type = "text" class="form-control required" style = "background-color: #FFF; border-color: black" name = "cpf" id = "cpf">
                    </div>

                    <div class = "half-box">
                      <label for = "rg" class="required" style = "color: #5c9f24">Validade</label>
                      <input type = "text" name = "dataValidade" id = "rg" placeholder="MM/AAAA" class="form-control required" style = "background-color: #FFF; border-color: black" maxlength="7">
                      <br>
                    </div>
                  </div>

                  <div class="row">
                      <div class = "half-box">
                        <label for = "email" class="required" style = "color: #5c9f24">Código de segurança</label>
                        <input type = "text" name = "email" id = "email" placeholder="CVV" class="form-control required" style = "background-color: #FFF; border-color: #000" maxlength="4">
                      </div>

                      <div class = "half-box">
                      <label for = "parcelas" class="required" style = "color: #5c9f24">Parcelas</label>
                      <select name="parcelas" id="parcelas" class="form-control required" style = "background-color: #FFF; border-color: black">
                        <?php foreach ($parcelas as $key => $valorParcela): ?>  <!-- estrutura de repetição -->
                        <option value="<?php echo $key+1; ?>"><?php echo ($key+1).'x de R$ '.$valorParcela; ?></option>  <!-- Número de parcelas, e seu respectivo valor -->
                        <?php endforeach; ?> <!-- Fim da estrutura de repetição -->
                      </select>
                      
                      <br>
                    </div>
                  </div>
                    
                </div>

                    <br>
                    <hr class="linha">
                    <input type="radio" id="termos2" name="pagamento" value="pix"> <label for=""> Pagar com pix </label> 
                    <div id="termoConteudo2">           
                      <img src="/assets/img/pagamento/qrcode.png" id="pix" alt="" srcset="">    
                      <!-- valor total da passagem -->

                    </div>
                    <hr class="linha">
                    <input type="radio" id="termos3" name="pagamento" value="boleto"> <label for=""> Boleto </label> 
                    <i class="bi bi-upc-scan"></i>
                    <div  id="termoConteudo3">
                      <img src="/assets/img/pagamento/codigo.jpg" id="boleto" alt="" srcset="">
                      <!-- valor total da passagem -->

                    </div>
                    <br>
                    <br>
                    <button type="submit" id="btn-submit" style="min-width: 80px;" class="btn btn-primary">Enviar</button>
                    <br>
            </div>
          </div>
            <br>
        </form>

        
    </main>  
    <!-- fim conteudo pagamento -->

    <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>BAG-A-BAGₑ</h3>
              <p>
                Av. Washington Luís<br>
                Vila Congonhas<br>
                São Paulo - SP N°4878<br><br>
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
              <li><i class="bx bx-chevron-right"></i> <a href="../index.php">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="../index.php#services">Sobre</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="./destinos.php">Destinos</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="../index.php#pricing">Ofertas</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="../index.php#contact">Contato</a></li>
            </ul>
          </div>

        <div class="col-lg-3 col-md-6 footer-links">
            <h4>Conta</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="<?php echo "user.php?id=" . $row['ID_USUARIO'] ?>">Ver perfil</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="../back/controller/controller_logoff.php">Logoff</a></li>
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

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Groovin</span></strong>. All rights Reserved.
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/groovin-free-bootstrap-theme/ -->
        Designed by  <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

    <!-- Vendor JS Files -->
  <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
</body>
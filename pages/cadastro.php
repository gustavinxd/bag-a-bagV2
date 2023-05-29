<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
$data_atual = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Bag-a-Bagₑ - Cadastro</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/airplane_favicon.png" rel="icon">
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


  <!-- Template Main CSS File -->
  <link href="../assets/css/cadastro/cadastro.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Groovin
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/groovin-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  
</script>
<!-- //quando o campo já tiver 8 caracteres, o script irá inserir um tracinho, para melhor visualização do telefone. -->
    <script type="text/javascript">
      function tel(telefone){
      if(telefone.value.length == 5)
            telefone.value = telefone.value + '-'; 
    }
    </script>

<script>
    
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('endereco').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('estado').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('endereco').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('estado').value=(conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('endereco').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('estado').value="...";


                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

    </script>

</head>

<body style="overflow-x: hidden;">

  <!-- ======= Header ======= -->
<main class="header">
    <header id="header" class="fixed-top d-flex align-items-center">
      <div class="container d-flex align-items-center justify-content-between">

        <h1 class="logo"><a href="index.php">BAG-A-BAGₑ</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar">
          <ul>
            <li><a class="nav-link scrollto active" href="../index.php">HOME</a></li>
            <li><a class="nav-link scrollto" href="../index.php#about">SOBRE</a></li>
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
            <li><a class="nav-link scrollto" href="login.php" style = "margin-left: 80px;">LOGIN</a></li>
            <li><a class="getstarted scrollto" href="cadastro.php">CADASTRE-SE</a></li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header>
</main><!-- End Header -->
<main class="airplane">
  <div class="frame">
    <div class="cloud2 cloud1">
        <div class="light"></div>
      <img  src="../assets/img/airliner-g8dca284ec_640.png" /></div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="../index.php">BAG-A-BAGₑ</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="../index.php">HOME</a></li>
          <li><a class="nav-link scrollto" href="../index.php#about">SOBRE</a></li>
          <li><a class="nav-link scrollto" href="destinos.php">DESTINOS</a></li>
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
          <li><a class="nav-link scrollto" href="./login.php" style = "margin-left: 80px;">LOGIN</a></li>
          <li><a class="getstarted scrollto" href="cadastro.php">CADASTRE-SE</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

    <main class = "main-container mb-4">
      <h1>Cadastro</h1>
      <?php
      if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
      }
      ?>
      <!-- ======= Cadastro ======= -->
      <form action ="../back/controller/controller_cadastro.php" method="post">
        <div class="row">
          <div class="half-box">
            <div class="col">
              <label for = "name" class="required" style = "color: #5c9f24">Nome</label>
              <input type = "text" name="name" class="form-control required" style = "background-color: #FFF; border-color: black" name = "name" id = "name" placeholder="Digite seu nome" required>
            </div>
          </div>
          <div class = "half-box">
              <label for = "lastname" style = "color: #5c9f24">Nome do meio (opcional)</label>
              <input type = "text" name="middlename" class="form-control required" style = "background-color: #FFF; border-color: black" name = "sobrenome" id = "sobrenome" placeholder="Digite seu nome do meio">
          </div>
        </div>
        <div class = "half-box" style = "width: 88%;">
          <div class="col-6">
            <label for = "ultname" class="required" style = "color: #5c9f24">Sobrenome</label>
            <input type="text" name="ultname"  class="form-control required" style = "background-color: #FFF; border-color: black" name = "ultname" id = "ultname" placeholder="Digite seu sobrenome" required>
          </div>
        </div>
        <div class="row">
          <div class = "half-box">
          <?php
          if (isset($_SESSION['cpf_valido'])) {
            echo $_SESSION['cpf_valido'];
            unset($_SESSION['cpf_valido']);
          }
          if (isset($_SESSION['cpf'])) {
            echo $_SESSION['cpf'];
            unset($_SESSION['cpf']);
          }
          ?>
            <label for = "cpf" class="required" style = "color: #5c9f24" >CPF</label>
            <input type = "text" class="form-control required" style = "background-color: #FFF; border-color: black" name = "cpf" maxlength="11" id = "cpf" placeholder="Digite seu CPF" required>
          </div>
          <div class = "half-box">
          <?php
          if (isset($_SESSION['rg_valido'])) {
            echo $_SESSION['rg_valido'];
            unset($_SESSION['rg_valido']);
          }
          if (isset($_SESSION['rg'])) {
            echo $_SESSION['rg'];
            unset($_SESSION['rg']);
          }
          ?>
            <label for = "rg" class="required" style = "color: #5c9f24">RG</label>
            <input type = "text" name = "rg" id = "rg" class="form-control required" style = "background-color: #FFF; border-color: black" maxlength="9" placeholder="Digite seu RG" required>
          </div>
        </div>
        <div class="row">
          <div class = "half-box">
          <?php
          if (isset($_SESSION['data_rg'])) {
            echo $_SESSION['data_rg'];
            unset($_SESSION['data_rg']);
          }
          ?>
            <label for = "date" class = "required" style = "color: #5c9f24">Data emissão (RG)</label>
            <input type = "date" name = "data_emissao" id = "data_emissao" class="form-control" style = "background-color: #FFF; border-color: black" max="<?php echo $data_atual;?>" min="1904-01-01" required>
          </div>
          <div class = "half-box">
              <label for = "date" class="required" style = "color: #5c9f24">Data de Nascimento</label>
              <input type = "date" name = "data_nasc" id = "data_nasc" class="form-control" style = "background-color: #FFF; border-color: black" max="<?php echo $data_atual;?>" min="1870-01-01" required>
          </div>
        </div>
        <div class="row">
            <div class = "half-box">
              <div class = "col-4">
                <label for = "number" class="required" style = "color: #5c9f24">DDD</label>
                <input type = "number" maxlength="2" name = "ddd" placeholder = "(XX)" id = "ddd" class="form-control required"style = "background-color: #FFF; border-color: black" required>
              </div>
            </div>
            <div class = "half-box">
              <label for = "tel" class="required" style = "color: #5c9f24">Telefone</label>
              <input type = "tel" name = "telefone" id = "telefone" placeholder = "XXXXX-XXXX" maxlength="10" class="form-control required" onkeypress="tel(this)" style = "background-color: #FFF; border-color: black" required>
            </div>
         </div>
            <div class = "half-box">
            <?php
            if (isset($_SESSION['email'])) {
              echo $_SESSION['email'];
              unset($_SESSION['email']);
            }
            ?>
              <label for = "email" class="required" style = "color: #5c9f24">E-mail</label>
              <input type = "email" name = "email" id = "email" class="form-control required" style = "background-color: #FFF; border-color: #000" placeholder="Digite seu e-mail" required>
            </div>
          <div class="row">
              <div class = "half-box">
                <label for = "number" class="required" style = "color: #5c9f24">CEP</label>
                <input type = "number" name = "cep" id = "cep" class="form-control required" style = "background-color: #FFF; border-color: #000" onblur="pesquisacep(this.value);" placeholder="Digite seu CEP" required>
              </div>
              <div class = "half-box">
                <label for = "estado" class="required" style = "color: #5c9f24">UF</label>
                <input type = "estado" name = "estado" id = "estado" class="form-control required" style = "background-color: #FFF; border-color: #000" placeholder="Digite sua UF" required>
              </div>
              
          </div>
          <div class="row">
            <div class = "half-box">
              <label for = "cidade" class="required" style = "color: #5c9f24">Cidade</label>
              <input type = "cidade" name = "cidade" id = "cidade" class="form-control required" style = "background-color: #FFF; border-color: #000" placeholder="Digite sua cidade" required>
            </div>
            <div class = "half-box">
              <label for = "bairro" class="required" style = "color: #5c9f24">Bairro</label>
              <input type = "bairro" name = "bairro" id = "bairro" class="form-control required" style = "background-color: #FFF; border-color: #000" placeholder="Digite seu bairro" required>
            </div>
          </div>
          <div class="row">
            <div class = "half-box">
              <label for = "endereco" class="required" style = "color: #5c9f24">Logradouro</label>
              <input type = "endereco" name = "endereco" id = "endereco" class="form-control required" style = "background-color: #FFF; border-color: #000" placeholder="Digite seu logradouro" required>
            </div>
          </div>
          <div class="row" style = "margin-bottom: 10%">
            <div class = "half-box">
              <label for = "number" class="required" style = "color: #5c9f24">N°</label>
              <input type = "number" name = "numero" id = "numero" class="form-control required" style = "background-color: #FFF; border-color: #000" placeholder="Digite o número da sua casa" required>
            </div>
            <div class = "half-box">
              <label for = "complemento" style = "color: #5c9f24">Complemento</label>
              <input type = "complemento" name = "complemento" id = "complemento" class = "form-control" style = "background-color: #FFF; border-color: #000" placeholder="Digite informações adicionais"> 
            </div>
          </div>
          <div class="row">
            <div class = "half-box">
              <label for = "password" class="required" style = "color: #5c9f24">Senha</label>
              <input type = "password" name = "senha" id = "senha" class="form-control required" style = "background-color: #FFF; border-color:#000" placeholder="Digite alguma senha" required>
            </div>
            <div class = "half-box">
              <label for = "password" class="required"style = "color: #5c9f24">Confirmar senha</label>
              <input type = "password" name = "confsenha" id = "confsenha" class="form-control required" style = "background-color: #FFF; border-color: #000" placeholder="Repita sua senha" required>
            </div>
          </div>
            <div class="full-box">
              <button type="submit" id = "cadastrar" class="btn btn-success">Cadastrar</button>
              <button type="button" class="btn btn-danger" onclick="limparDados()">Limpar</button>
            </div>
        </div>
      </form>
    </main>
    <!---Fim do cadastro -->

      <!-- ======= Footer ======= -->
      <footer id="footer">
    <div class="footer-top" style="margin-top: 4em;">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>BAG-A-BAGₑ</h3>
              <p>
                Av. Washington Luís<br>
                Vila Congonhas<br>
                São Paulo - SP N°4878<br><br>
                <strong>Telefone:</strong>(11) <em></em> 9000-0000<br>
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
              <li><i class="bx bx-chevron-right"></i> <a href="../index.php#about">Sobre</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="destinos.php">Destinos</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="../index.php#pricing">Ofertas</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="../index.php#contact">Contato</a></li>
            </ul>
          </div>

        <div class="col-lg-3 col-md-6 footer-links">
            <h4>Conta</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="login.php">Login</a></li>
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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>

<script>
    // Salva os valores dos campos do formulário no armazenamento local ao enviar o formulário
    document.querySelector('form').addEventListener('submit', function() {
      localStorage.setItem('form_data', JSON.stringify(Array.from(new FormData(this).entries())));
    });

    // Carrega os valores dos campos do formulário do armazenamento local ao carregar a página
    var formData = localStorage.getItem('form_data');
    if (formData) {
      formData = JSON.parse(formData);
      var form = document.querySelector('form');
      formData.forEach(function(entry) {
        var input = form.querySelector('[name="' + entry[0] + '"]');
        if (input) {
          input.value = entry[1];
        }
      });
    }

    function limparDados() {
      localStorage.removeItem('form_data');
      location.reload();
    }

  </script>
  

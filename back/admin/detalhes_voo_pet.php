<?php
session_start();
include_once('../conexao.php');

$id = $_GET['id'];


?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Avião</title>
    <!-- Favicons -->
    <link href="../../assets/img/airplane_favicon.png" rel="icon">
    <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Template Main CSS File -->
    <link href="../../assets/css/style.css" rel="stylesheet">

</head>

<body class="container">
    <!-- ======= header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="../../index.php">BAG-A-BAGₑ</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto " href="./admin.php">PAINEL</a></li>
                    <li><a class="nav-link scrollto active" href="./voo.php">VOO</a></li>
                    <li><a class="nav-link scrollto" href="./aviao.php">AVIAO</a></li>
                    <li><a class="nav-link scrollto " href="./aeroporto.php">AEROPORTO</a></li>
                    <li><a class="nav-link scrollto" href="./cupom.php">CUPOM</a></li>
                    <li><a class="nav-link scrollto" href="./relatorio.php">RELATORIO</a></li>
                    <li><a class="nav-link scrollto" href="./perfis.php">PERFIS</a></li>
                    <?php
                    // VERIFICANDO SE TEM UM USUARIO LOGADO
                    if (isset($_SESSION['id_usuario'])) {
                        $id_usuario = $_SESSION['id_usuario'];

                        $query = "SELECT * FROM usuario 
                        INNER JOIN telefone ON FK_TELEFONE = ID_TELEFONE 
                        INNER JOIN cadastro ON FK_CADASTRO = ID_CADASTRO
                        WHERE ID_USUARIO='$id_usuario'";
                        $query = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($query);
                        // SE ESTIVER LOGADO APARECERÁ AS SEGUINTES INFORMAÇÕES
                        echo '<li><a class="getstarted scrollto" href="pages/user.php?id=' . $row["ID_USUARIO"] . '" style="margin-left: 80px;">Ver perfil</a></li>';
                        echo '<li><a class="nav-link scrollto" href="back/controller/controller_logoff.php">LOGOFF</a></li>';
                    }
                    ?>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header>
    <div class="card" style="margin-top: 10em;">
        <div class="card-header">
            <h1 class="text-center">Detalhes do Voo</h1>
        </div>

        <div class="card-body d-flex flex-row gap-5 justify-content-center align-items-center row mx-1" id="divCards">
                    
        <?php

           
            $queryAnimal = "SELECT * from animal INNER JOIN passagem ON FK_PASSAGEM = ID_PASSAGEM INNER JOIN passageiro on FK_PASSAGEIRO = ID_PASSAGEIRO INNER JOIN reserva on FK_RESERVA = ID_RESERVA WHERE FK_VOO = $id"; 
            $consultaAnimal = mysqli_query($conn, $queryAnimal);
            
            // Mostar Todos os pet Cadastrados
            while($result = mysqli_fetch_assoc($consultaAnimal)){

                // Calcular idade 
                $dataN = $result['DATA_NASC_PET'];
                
                list($ano, $mes, $dia) = explode('-', $dataN);

                // data atual
                $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                // Descobre a unix timestamp da data de nascimento do fulano
                $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);

                // cálculo
                $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);

                if($idade > 1){
                    $idadeAnos = $idade.' Anos';
                } else {
                    $idadeAnos = $idade.' Ano';
                }


                // Cards com Informaçoes do Pet e Dono
                echo ('
                    <div class="card col-md-3 align-self-stretch" style="width: 20rem;">
                        <div class="card-body mx-2">
                            <h5 class="card-title">Proprietário do animal:</h5>
                            <p class="card-text" value=" ">'. $result['NOME_PASSAGEIRO'] .'</p>
                
                            <h5 class="card-title">Idade do animal:</h5>
                            <p class="card-text"  value=" ">'. $idadeAnos .'</p>
                
                            <h5 class="card-title">Peso:</h5>
                            <p class="card-text" value=" ">'. $result['PESO'] .' Kg</p>
                
                            <h5 class="card-title">Carteira de vacinação:</h5>
                                <div class="d-flex justify-content-center align-items-center my-4">
                                    <img src="'. $result['DIR_CARTEIRINHA'] .' " alt="" class="img-fluid my-4">
                                </div> ');

                            
                            
                            if($result['STATUS_RESERVA'] == "Pendente"){
                                    $_SESSION['id_voo'] = $id;
                                    echo '
                                        <form action="../controller/controller_status_reserva.php" method="POST">
                                            <button type="submit" name="status" value="Confirmada" class="btn btn-outline-success">Confirmar</button>
                                    
                                            <button type="submit" name="status" value="Cancelada" class="btn btn-outline-danger">Cancelar</button>
                                        </form>
                                        </div> 
                                        </div>
                                    ';
                                    $_SESSION['id_reserva'] = $result['ID_RESERVA'];

                            } elseif ($result['STATUS_RESERVA'] == "Confirmada"){
                                echo '
                                    <h5>Confirmada</h5>
                                    </div> 
                                    </div>
                                ';

                            } elseif ($result['STATUS_RESERVA'] == "Cancelada"){
                                echo '
                                    <h5>Cancelada</h5>
                                    </div> 
                                    </div>
                                ';
                            };
                                    
                                
                };

            ?>

        </div>
    </div>
  
</body>

</html>
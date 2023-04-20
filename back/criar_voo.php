<!-- ARQUIVO DE TESTES -->
<?php
session_start();
include_once('conexao.php');

// pegar as aeronaves disponíveis

$options_avioes_codigo_aviao = "";
$options_avioes_empresa = "";
$options_avioes_assentos = "";

$query = "SELECT * FROM aviao_codaviao";
$consulta = mysqli_query($conn, $query);

while($row_avioes = mysqli_fetch_assoc($consulta)) {
    $options_avioes_codigo_aviao = $options_avioes_codigo_aviao . "<option value='" . $row_avioes['ID_CODAVIAO'] . "'>" . $row_avioes['CODIGO_AVIAO'] . "</option>";
    $options_avioes_empresa = $options_avioes_empresa . "<option>" . $row_avioes['EMPRESA'] . "</option>";
    $options_avioes_assentos = $options_avioes_assentos . "<option>" . $row_avioes['TOTAL_ASSENTO'] . "</option>";
}


// pegar as origens dos voos

$options_siglas_aeroportos = "";
$options_nome_aeroportos = "";
$options_pais_aeroportos = "";

$query = "SELECT * FROM aeroporto";
$consulta = mysqli_query($conn, $query);

while($row_origens = mysqli_fetch_assoc($consulta)) {
    $options_avioes_codigo_aviao = $options_avioes_codigo_aviao . "<option value='" . $row_origens['ID_AEROPORTO'] . "'>" . $row_origens['SIGLA'] . "</option>";
    $options_avioes_empresa = $options_avioes_empresa . "<option>" . $row_origens['SIGLA'] . "</option>";
    $options_avioes_assentos = $options_avioes_assentos . "<option>" . $row_origens['NOME_AEROPORTO'] . "</option>";
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Criar Voo</title>
</head>
<body>
    <h1>Criar Voo</h1>

    <!-- MENSAGEM DE STATUS DO CADASTRO QUE FOI REALIZADO -->
    <?php
        if(isset($_SESSION["msg"])) {   // isset() verifica se a variavel existe;
            echo $_SESSION["msg"];
            unset($_SESSION["msg"]);    // unset() destrói a variável passada como argumento, melhor utilizada em escopo global
        }
    ?>
    
    <form name="aeronave" action="controller/controller_adicionar_voo.php" method="post">
        <label>Codigo da Aeronave: </label>
        <select name="codigo_aviao" onchange="mudaSelects()">
            <option value="0">--</option>
            <?php
                echo "$options_avioes_codigo_aviao";
            ?>
        </select>

        <label>Empresa: </label>
        <select name="empresa" disabled>
            <option value="0">--</option>
            <?php
                echo "$options_avioes_empresa";
            ?>
        </select>

        <label>Assentos: </label>
        <select name="assentos" disabled>
            <option value="0">--</option>
            <?php
                echo "$options_avioes_assentos";
            ?>
        </select>
        
        

        <input type="submit" value="Salvar">
    </form>
    
    <br>
    <script>
        function mudaSelectsAeronave() {
    
        let optionCodaviao = document.forms['aeronave'].codigo_aviao.options;
        let optionEmpresa = document.forms['aeronave'].empresa.options;
        let optionAssento = document.forms['aeronave'].assentos.options;
        
        let num = optionCodaviao.selectedIndex;

        optionEmpresa.selectedIndex = num;
        optionAssento.selectedIndex = num
        
        }

        function mudaSelectsDestino() {
            
        }

        function mudaSelectAlternado() {
        // criar uma função que altere a option do destino se a da origem for a mesma
        }
    </script>
</body>
</html>
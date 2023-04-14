<!-- para que esse arquivo funcione, deve haver registros nas tabelas de endereço, rg, cadastro, usuario e telefone -->

<?php
session_start();
include_once('../conexao.php');
include_once('../funcoes.php');

$id_usuario = filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_NUMBER_INT); // id do usurário associado ao passageiro
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$sobrenome = filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
$data_nascimento = filter_input(INPUT_POST, 'data_nascimento');
$ddd = filter_input(INPUT_POST, 'ddd', FILTER_SANITIZE_NUMBER_INT);
$numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING);
$tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);

if(validarCPF($cpf)) {
    // inserir telefone do passageiro
    $query = "INSERT INTO telefone (CODIGO_PAIS, DDD, NUMERO, TIPO, MODIFICADO) VALUES (DEFAULT, $ddd, $numero, DEFAULT, DEFAULT)";
    $consulta = mysqli_query($conn, $query);
    
    if (mysqli_insert_id($conn)) {
        $id_telefone = mysqli_insert_id($conn);
    
        // inserir dados e referenciar o telefone
        $query = "INSERT INTO passageiro (NOME_PASSAGEIRO, SOBRENOME_PASSAGEIRO, EMAIL_PASSAGEIRO, CPF_PASSAGEIRO, DATA_NASC_PASSAGEIRO, FK_TELEFONE, FK_USUARIO) VALUES ('$nome', '$sobrenome', '$email', '$cpf', '$data_nascimento', $id_telefone, $id_usuario)";
        $consulta = mysqli_query($conn, $query);
    }
    else {
        $_SESSION['msg'] = "<p style='color:red;'>Erro. Não foi possível realizar o cadastro. Tente novamente.</p>";
        header("Location: test.php");
    }
}
else {
    $_SESSION['msg'] = "<p style='color:red;'>Erro. O CPF informado é inválido.</p>";
    header("Location: test.php");
}

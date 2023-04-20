<?php
session_start(); //iniciando sessão
include_once("../conexao.php"); //incluindo banco
//pegando dados
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$senha = filter_input(INPUT_POST, 'senha');

// criptografando a senha usando md5
$senha_md5 = md5($senha);

// pegando dados do banco
$result_usuario = "SELECT * FROM cadastro WHERE email = '$email'";
$resultado_usuario = mysqli_query($conn, $result_usuario);
$row_usuario = mysqli_fetch_assoc($resultado_usuario);
$senha_banco = $row_usuario['SENHA'];

//Fazendo a validação da senha fornecida pelo usuário, e a cadastrada no db
if ($senha_md5 == $senha_banco){
    
    header("Location: ../apos_login.php?id_cadastro={$row_usuario['ID_CADASTRO']}");
} else{
    $_SESSION["msg"] = "<p style='color: red;'>Usuário inexistente / Login não realizado.</p>";
    header("Location: ../../pages/login.html");
}
?>

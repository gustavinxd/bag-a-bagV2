<?php
    session_start(); //iniciando sessão
    include_once("../conexao.php"); //incluindo conexão

  //PEGANDO DADOS
  $poltrona = filter_input(INPUT_POST, "ast");
  
  var_dump($poltrona);
  echo($poltrona);

?>
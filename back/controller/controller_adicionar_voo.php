<?php
session_start();
include_once('..conexao.php');

$codigo_aviao = filter_input(INPUT_POST, 'codigo_aviao');
$empresa = filter_input(INPUT_POST, 'empresa');
$assentos = filter_input(INPUT_POST, 'assentos', FILTER_SANITIZE_NUMBER_INT);

?>

<!-- INCOMPLETO -->
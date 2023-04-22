<?php
session_start();
include_once('../conexao.php');

// OBTER DADOS
$horario_partida = filter_input(INPUT_POST, 'horario_partida');
$horario_chegada = filter_input(INPUT_POST, 'horario_chegada');
$fk_origem_aero = filter_input(INPUT_POST, 'fk_origem_aero', FILTER_SANITIZE_NUMBER_INT);
$fk_destino_aero = filter_input(INPUT_POST, 'fk_destino_aero', FILTER_SANITIZE_NUMBER_INT);
$fk_aviao = filter_input(INPUT_POST, 'fk_aviao', FILTER_SANITIZE_NUMBER_INT);

// INSERIR DADOS NA TABELA DE VOOS
$query = "INSERT INTO voo (HORARIO_PARTIDA, HORARIO_CHEGADA, CRIADO, FK_ORIGEM_AERO, FK_DESTINO_AERO, FK_AVIAO) VALUES ('$horario_partida', '$horario_chegada', NOW(), '$fk_origem_aero', '$fk_destino_aero', '$fk_aviao')";
mysqli_query($conn, $query);

if (mysqli_insert_id($conn)) {
	echo "DEU CERTO";
} else {
	echo "DEU RUIM";
}

?>

<?php

session_start();
include_once('../conexao.php');

// id da Reserva
$id_reserva = $_SESSION['id_reserva'];

// id do Voo
$id_voo = $_SESSION['id_voo'];

// status da passagem 
$status = $_POST['status'];

echo $status;

    // UPDATE NO Banco
    if($status == "Confirmada"){
        $update = "UPDATE reserva SET STATUS_RESERVA = '$status' WHERE ID_RESERVA = '$id_reserva'";
        $query = mysqli_query($conn, $update);
        if(mysqli_affected_rows($conn)){
            header("Location: ../admin/detalhes_voo_pet.php?id=$id_voo");
        }
    } elseif ($status == "Cancelada"){
        $update = "UPDATE reserva SET STATUS_RESERVA = '$status' WHERE ID_RESERVA = '$id_reserva'";
        $query = mysqli_query($conn, $update);
        if(mysqli_affected_rows($conn)){
            header("Location: ../admin/detalhes_voo_pet.php?id=$id_voo");
        }
    }

?>
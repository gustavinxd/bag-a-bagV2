<?php
 session_start();
include_once('../conexao.php');

 $qtd_parcelas = $_POST['parcelas'];  // quantidade de parcelas escolhida pelo usuário na página pagamento.php
 $valorTotal = $_SESSION['valor_total'];
 $opcao = $_POST["pagamento"];

 $id_reserva = $_SESSION['id_reserva']; // Obter o ID_RESERVA da variável de sessão
 $id_usuario = $_SESSION['id_usuario']; // Obter o ID_USUARIO da variável de sessão

 // desfaz a session idpassagem, caso exista
if (isset($_SESSION['idpassagem'])) {
    unset($_SESSION['idpassagem']);
}
  

 function atualizar_status_reserva($conn, $id_reserva) {

    $valorTotal = $_SESSION['valor_total'];// traz session do pagamento.php

    $num_pets = mysqli_query($conn, "SELECT COUNT(ID_PET) AS qt_animais FROM animal INNER JOIN passagem ON FK_PASSAGEM = ID_PASSAGEM WHERE FK_RESERVA = $id_reserva;");
    $qt_pets = mysqli_fetch_assoc($num_pets); // serve para ver quantos pets tem na reserva da passagem da pessoa que está comprando

    $query2 = "SELECT * FROM reserva

        INNER JOIN pagamento ON FK_RESERVA = ID_RESERVA";

    $query2 = mysqli_query($conn, $query2);

    $row2 = mysqli_fetch_assoc($query2);


    // $nume_pets = mysqli_query($conn, "SELECT COUNT(ID_PET) AS qt_animais FROM animal INNER JOIN passagem ON FK_PASSAGEM = ID_PASSAGEM WHERE FK_PASSAGEM = '$id_passagem'");

    // $qtd_pets = mysqli_fetch_assoc($nume_pets);

   

    if($qt_pets['qt_animais'] > 0){ // se o número de pets na passagem da pessoa for maior que 0 ele entra no if

        $valorTotal += 150 * $qt_pets['qt_animais']; // aqui ele vai acrescentar 150 no pagamento para cada pet adicionado na passagem

        $result_usuario = "UPDATE reserva SET STATUS_RESERVA = 'Pendente'  WHERE ID_RESERVA = '$id_reserva'"; // aqui fica pensente por que depois o fúncionario tem que analisar a carteira do pet

        $resultado_usuario = mysqli_query($conn, $result_usuario);

        $result_usuario = "UPDATE reserva SET VALOR_TOTAL = $valorTotal WHERE ID_RESERVA = '$id_reserva'"; // aqui serve para atualizar o valor adicionando os 150 do valor total

        $resultado_usuario = mysqli_query($conn, $result_usuario);

    }



    elseif(!empty($row2)) {

        $result_usuario = "UPDATE reserva SET STATUS_RESERVA = 'Confirmada'  WHERE ID_RESERVA = '$id_reserva'";

        $resultado_usuario = mysqli_query($conn, $result_usuario);

    }

}
 
 
 switch($opcao){
     case "credito":
        
        // Obter o número do cartão do campo de entrada
        $numeroCartao = filter_input(INPUT_POST, 'numeroCartao', FILTER_SANITIZE_NUMBER_INT);
        
        // Obter a data de validade do cartão do campo de entrada
        $dataValidade = filter_input(INPUT_POST, 'dataValidade');
        
        
        // Função para validar dados do cartão 
        function validarDadosCartao($numeroCartao, $dataValidade) {
            // Remove espaços em branco e traços do número do cartão
            $numeroCartao = str_replace(array(' ', '-'), '', $numeroCartao);
        
            // Verifica se o número do cartão tem apenas números
            if (!ctype_digit($numeroCartao)) {
                return false;
            }
        
            // Verifica se o número do cartão tem pelo menos 13 dígitos e no máximo 16 dígitos
            $numDigitos = strlen($numeroCartao);
            if ($numDigitos < 13 || $numDigitos > 16) {
                return false;
            }
        
            
            // verificar a validade do número do cartão
            $soma = 0;
            for ($i = $numDigitos - 1; $i >= 0; $i--) {
                $digito = intval($numeroCartao[$i]);
                if ($i % 2 == $numDigitos % 2) {
                    $digito *= 2;
                    if ($digito > 9) {
                        $digito -= 9;
                    }
                }
                $soma += $digito;
            }
            if ($soma % 10 != 0) {
                return false;
            }
        
            // Verificar se a data de validade está no formato correto e é uma data futura
            if (!preg_match('/^(0[1-9]|1[0-2])\/[0-9]{4}$/', $dataValidade)) {
                return false;
            }
        
            $mesAno = explode('/', $dataValidade);
            $mes = (int) $mesAno[0];
            $ano = (int) $mesAno[1];
            $anoAtual = date('Y');
        
            if (($ano > $anoAtual) || ($ano == $anoAtual && $mes > date('m'))) {
                return true;
            } else {
                return false;
            }
        }
        
        // Inserção dos dados no banco 
        if (validarDadosCartao($numeroCartao, $dataValidade)) {
            $result_usuario = "INSERT INTO pagamento (status_pagamento, data_pagamento, tipo_pagamento, fk_reserva, parcelas) VALUES ('Aprovado',NOW(),'Crédito','$id_reserva','$qtd_parcelas')";
            $resultado_usuario = mysqli_query($conn, $result_usuario);
            $resultado = atualizar_status_reserva($conn, $id_reserva);
            $_SESSION['msg'] = "<p class='text-center' style='color:green'>Pagamento efetuado com sucesso.</p>";
            //  adicionado posteriormente - desfaz a session idpassagem, caso exista
            if (isset($_SESSION['idpassagem'])) {
                unset($_SESSION['idpassagem']);
            }
            header("Location: ../../pages/user.php?id=". $id_usuario);
        } else {
            $_SESSION['msg'] = "<p class='text-center' style='color:red'>Pagamento não confirmado.</p>";
            header("Location: ../../pages/pagamento.php?id=");
        }
        break;
    case "pix":
        // Inserção dos dados no banco 
        $result_usuario = "INSERT INTO pagamento (status_pagamento, data_pagamento, tipo_pagamento, fk_reserva, parcelas) VALUES ('Aprovado',NOW(),'Pix','$id_reserva',NULL)";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        $resultado = atualizar_status_reserva($conn, $id_reserva);
        $_SESSION['msg'] = "<p class='text-center' style='color:green'>Pagamento efetuado com sucesso.</p>";
        //  adicionado posteriormente - desfaz a session idpassagem, caso exista
        if (isset($_SESSION['idpassagem'])) {
            unset($_SESSION['idpassagem']);
        }
        header("Location: ../../pages/user.php?id=". $id_usuario);
        break;

    case "boleto":
        // Inserção dos dados no banco 
        $result_usuario = "INSERT INTO pagamento (status_pagamento, data_pagamento, tipo_pagamento, fk_reserva, parcelas) VALUES ('Aprovado',NOW(),'Boleto','$id_reserva',NULL)";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        $resultado = atualizar_status_reserva($conn, $id_reserva);
        $_SESSION['msg'] = "<p class='text-center' style='color:green'>Pagamento efetuado com sucesso.</p>";
        //  adicionado posteriormente - desfaz a session idpassagem, caso exista
        if (isset($_SESSION['idpassagem'])) {
            unset($_SESSION['idpassagem']);
        }
        header("Location: ../../pages/user.php?id=". $id_usuario);
        break;
    case "":
        $_SESSION['msg'] = "<p class='text-center' style='color:red'>Pagamento não confirmado.</p>";
        header("Location: ../../pages/pagamento.php?id=");
        break;
} 
?>

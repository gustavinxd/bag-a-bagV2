<?php
    session_start(); //iniciando sessão
    include_once("conexao.php"); //incluindo conexão

    //pegando dados
    
    $cupom = filter_input(INPUT_POST, "cupom", FILTER_SANITIZE_STRING);
    $valor = filter_input(INPUT_POST, "valor", FILTER_SANITIZE_STRING);
   

    //rgx para 3 letras e 3 numeros
    $rgx = '/[A-Z]{3}[0-9]{3}/';
    
    //verificação de código já existente no db
    $a = "SELECT * FROM desconto WHERE CODIGO_DESCONTO ='$cupom'";
    $select_cupom = mysqli_query($conn, $a);
    $row_cupom = mysqli_fetch_assoc($select_cupom);
    
    //validando o rgx
    if (preg_match($rgx, $cupom) == 1) {
        
        if(!empty($row_cupom)){
            $_SESSION["msg"] = "<p style='color: blue;'> Não foi possível cadastrar com sucesso</p>";
            echo "NÃO !";
            header("Location:cupom_desconto.php");
        }else  {
             //inserindo no banco
            $result_usuario = "INSERT INTO desconto (codigo_desconto, valor_desconto) VALUES ('$cupom','$valor')";
            $resultado_usuario = mysqli_query($conn, $result_usuario);
        }

    }else{
        echo "<p id=estilo>código não cadastrado!";
    }
    

?>
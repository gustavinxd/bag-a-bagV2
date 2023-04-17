
<?php
    session_start(); //iniciando sessão
    include_once("../conexao.php"); //incluindo conexão
    include_once("../funcoes.php");

    //pegando dados
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, "senha");
    $cep = filter_input(INPUT_POST, "cep", FILTER_SANITIZE_STRING);
    $rua = filter_input(INPUT_POST, "rua", FILTER_SANITIZE_STRING);
    $numero = filter_input(INPUT_POST, "numero", FILTER_SANITIZE_STRING);
    $bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_STRING);
    $cidade = filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_STRING);
    $uf = filter_input(INPUT_POST, "uf", FILTER_SANITIZE_STRING);
    $complemento = filter_input(INPUT_POST, "complemento", FILTER_SANITIZE_STRING);
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
    $nome_meio = filter_input(INPUT_POST, "nome_meio", FILTER_SANITIZE_STRING);
    $sobrenome = filter_input(INPUT_POST, "sobrenome", FILTER_SANITIZE_STRING);

    $cpf = filter_input(INPUT_POST, "cpf" );
    $cpf = trim($cpf);
    $cpf = str_replace(".","",$cpf);
    $cpf = str_replace("-","",$cpf);

    $rg = filter_input(INPUT_POST, "rg" );
    $data_emissao = filter_input(INPUT_POST, "data_emissao");
    $data_nascimento = filter_input(INPUT_POST, "data_nasc");
    $ddd = filter_input(INPUT_POST, "ddd", FILTER_SANITIZE_STRING);
    $numero = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_STRING);

    $cpf_valida = false;
    $rg_valida = false;
    $data_rg_valida = false;

    if (validarCPF($cpf)){
        $cpf_valida = true;
        echo "cpf valido";
    }

    echo var_dump($rg);
    if (validarRG($rg)){
        $rg_valida = true;
        echo "rg valido";
    }

    if (validarDataRg($data_emissao)){
        $data_rg_valida = true;
        echo "<br>";
        echo "data de emissao do rg valido";
    }

    if ($cpf_valida && $rg_valida && $data_rg_valida){

        //inserindo os dados no tabela cadastro
        $result_cadastro = "INSERT INTO cadastro (email, senha, data_cadastro) VALUES ('$email','" . md5($senha) . "', NOW())";
        $result_endereco = "INSERT INTO endereco (cep, rua, numero, bairro, cidade, uf, complemento) VALUES ('$cep','$rua','$numero','$bairro','$cidade','$uf','$complemento')";
        $result_telefone = "INSERT INTO telefone (codigo_pais, ddd, numero, tipo) VALUES (DEFAULT,'$ddd','$numero',DEFAULT)";
        $result_rg = "INSERT INTO rg (numero_rg, data_emissao) VALUES ('$rg', '$data_emissao')";
        $result_usuario = "INSERT INTO usuario (nome, nome_meio, sobrenome, cpf, data_nascimento, criado) VALUES ('$nome','$nome_meio', '$sobrenome', '$cpf', '$data_nascimento', NOW())";
    

        $resultado_endereco = mysqli_query($conn, $result_endereco);
        $id_endereco = mysqli_insert_id($conn);

        $resultado_cadastro = mysqli_query($conn, $result_cadastro);
        $id_cadastro = mysqli_insert_id($conn); //pegando o id do cadastro

        $resultado_telefone = mysqli_query($conn, $result_telefone);
        $id_telefone = mysqli_insert_id($conn);

        $resultado_rg = mysqli_query($conn, $result_rg);
        $id_rg = mysqli_insert_id($conn);


        $result_usuario = "INSERT INTO usuario (nome, nome_meio, sobrenome, cpf, data_nascimento, fk_cadastro, fk_rg, fk_telefone, fk_endereco, criado) VALUES ('$nome','$nome_meio', '$sobrenome', '$cpf', '$data_nascimento', '$id_cadastro', '$id_rg', '$id_telefone', '$id_endereco', NOW())";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
    


        if (mysqli_insert_id($conn)) {
            //$_SESSION["msg"] = "<p style='color: blue;'>Cadastrado realizado com sucesso</p>";
            //header("Location: ../cadastro_cliente.php");
        } else {
            $_SESSION["msg"] = "<p style='color: blue;'>Cadastro não foi realizado com sucesso</p>";
            //header("Location: ../cadastro_cliente.php");
        }
    } else{
        $_SESSION["msg"] = "<p style='color: blue;'>CPF ou RG inválido</p>";
        //header("Location: ../cadastro_cliente.php");
    }  
?>




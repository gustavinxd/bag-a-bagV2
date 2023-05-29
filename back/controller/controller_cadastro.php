
<?php
    session_start(); //iniciando sessão
    include_once("../conexao.php"); //incluindo conexão
    include_once("../funcoes.php");

    //pegando dados
    $nome = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $sobrenome = filter_input(INPUT_POST, "ultname", FILTER_SANITIZE_STRING);
    $nome_meio = filter_input(INPUT_POST, "middlename", FILTER_SANITIZE_STRING);

    $cpf = filter_input(INPUT_POST, "cpf" );
    $cpf = trim($cpf);
    $cpf = str_replace(".","",$cpf);
    $cpf = str_replace("-","",$cpf);

    $rg = filter_input(INPUT_POST, "rg" );
    $rg = trim($rg);
    $rg = str_replace(".","",$rg);
    $rg = str_replace("-","",$rg);

    $data_emissao = filter_input(INPUT_POST, "data_emissao");
    $data_nascimento = filter_input(INPUT_POST, "data_nasc");
    $ddd = filter_input(INPUT_POST, "ddd", FILTER_SANITIZE_STRING);

    $telefone = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_STRING);
    $telefone = trim($telefone);
    $telefone = str_replace("-","",$telefone);

    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);

    $cep = filter_input(INPUT_POST, "cep", FILTER_SANITIZE_STRING);
    $cep = str_replace(".","",$cep);
    $cep = str_replace("-","",$cep);

    $cidade = filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_STRING);
    $uf = filter_input(INPUT_POST, "estado", FILTER_SANITIZE_STRING);
    $rua = filter_input(INPUT_POST, "endereco", FILTER_SANITIZE_STRING);
    $numero = filter_input(INPUT_POST, "numero", FILTER_SANITIZE_STRING);
    $bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_STRING);
    $complemento = filter_input(INPUT_POST, "complemento", FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, "senha");
    $confirmar = filter_input(INPUT_POST, "confsenha");

    // colocando os validadores como falso
    $cpf_valida = false;
    $rg_valida = false;
    $data_rg_valida = false;
    $confirmar_senha = false;
    $unico_email = false;
    $unico_rg = false;
    $unico_cpf = false;

    // fazendo as verificações do formulario
    if ($senha == $confirmar){
        $confirmar_senha = true;
        echo "senha valida";
    } //verificação da senha

    if (validarCPF($cpf)){
        $cpf_valida = true;
        echo "<br>";
        echo "cpf valido";
    } //verificação do cpf 
    else {
        $_SESSION["cpf_valido"] = "<p style='color: red;'>Este CPF não é valido.</p>";
    }


    echo var_dump($rg);
    if (validarRG($rg)){
        $rg_valida = true;
        echo "<br>";
        echo "rg valido";
    } //verificação do rg
    else {
        $_SESSION["rg_valido"] = "<p style='color: red;'>Este RG não é valido.</p>";
    }

    if (validarDataRg($data_emissao)){
        $data_rg_valida = true;
        echo "<br>";
        echo "data de emissao do rg valido";
    } //verificação da data de emissão do rg
    else {
        $_SESSION["data_rg"] = "<p style='color: red;'>A data ultrapassa 10 anos.</p>";
    }

    //VERRIFICANDO SE O EMAIL É UNICO
    $a = "SELECT * FROM cadastro WHERE email ='$email'";
    $select_email = mysqli_query($conn, $a);
    $row_email = mysqli_fetch_assoc($select_email);

    if(!empty($row_email)){
        $unico_email = false;
        $_SESSION["email"] = "<p style='color: red;'>Este email já existe.</p>";
    }else  {
        echo "<br>";
        echo "email unico";
        $unico_email = true;
    }

    // VERIFICANDO SE O RG É UNICO
    $b = "SELECT * FROM rg WHERE numero_rg ='$rg'";
    $select_rg = mysqli_query($conn, $b);
    $row_rg = mysqli_fetch_assoc($select_rg);

    if(!empty($row_rg)){
        $unico_rg = false;
        $_SESSION["rg"] = "<p style='color: red;'>Este rg já esta cadastrado.</p>";
    }else  {
        echo "<br>";
        echo "rg unico";
        $unico_rg = true;
    }

    //VERIFICANDO SE O CPF É UNICO
    $c = "SELECT * FROM usuario WHERE cpf ='$cpf'";
    $select_cpf = mysqli_query($conn, $c);
    $row_cpf = mysqli_fetch_assoc($select_cpf);

    if(!empty($row_cpf)){
        $unico_cpf = false;
        $_SESSION["cpf"] = "<p style='color: red;'>Este CPF já esta cadastrado</p>";
    }else  {
        echo "<br>";
        echo "cpf unico";
        $unico_cpf = true;
    }

    //VERIFICANDO AS CONDIÇÕES 

    if ($cpf_valida && $rg_valida && $data_rg_valida && $confirmar_senha && $unico_email && $unico_rg && $unico_cpf){

        //inserindo os dados no tabela cadastro
        $result_cadastro = "INSERT INTO cadastro (email, senha, data_cadastro) VALUES ('$email','" . md5($senha) . "', NOW())";
        $result_endereco = "INSERT INTO endereco (cep, rua, numero_endereco, bairro, cidade, uf, complemento) VALUES ('$cep','$rua','$numero','$bairro','$cidade','$uf','$complemento')";
        $result_telefone = "INSERT INTO telefone (ddd, numero_telefone) VALUES ('$ddd','$telefone')";
        $result_rg = "INSERT INTO rg (numero_rg, data_emissao) VALUES ('$rg', '$data_emissao')";
        $result_usuario = "INSERT INTO usuario (nome, nome_meio, sobrenome, cpf, data_nascimento, criado) VALUES ('$nome','$nome_meio', '$sobrenome', '$cpf', '$data_nascimento', NOW())";
    

        $resultado_endereco = mysqli_query($conn, $result_endereco);
        $id_endereco = mysqli_insert_id($conn); //pegando o id do endereço

        $resultado_cadastro = mysqli_query($conn, $result_cadastro);
        $id_cadastro = mysqli_insert_id($conn); //pegando o id do cadastro

        if(!empty($row_telefone)){    
            $id_telefone = $row_telefone['ID_TELEFONE'];
        } else  {
            $resultado_telefone = mysqli_query($conn, $result_telefone);
            $id_telefone = mysqli_insert_id($conn); //pegando o id do telefone
        }

        if(!empty($row_endereco)){    
            $id_endereco = $row_endereco['ID_ENDERECO'];
        } else  {
            $resultado_endereco = mysqli_query($conn, $result_endereco);
            $id_endereco = mysqli_insert_id($conn); //pegando o id do endereco
        }

        $resultado_rg = mysqli_query($conn, $result_rg);
        $id_rg = mysqli_insert_id($conn); //pegando o id do rg

        $result_usuario = "INSERT INTO usuario (nome, nome_meio, sobrenome, cpf, data_nascimento, fk_cadastro, fk_rg, fk_telefone, fk_endereco, criado) VALUES ('$nome','$nome_meio', '$sobrenome', '$cpf', '$data_nascimento', '$id_cadastro', '$id_rg', '$id_telefone', '$id_endereco', NOW())";
        $resultado_usuario = mysqli_query($conn, $result_usuario);


    

        


        if (mysqli_insert_id($conn)) {
            $_SESSION["msg"] = "<p style='color: blue; text-align: center;'>Cadastrado realizado com sucesso</p>";
            unset($_SESSION['formulario']);
            echo "<script>location.href='../../pages/login.php';</script>";
        } else {
            $_SESSION["msg"] = "<p style='color: red; text-align: center;'>Cadastro não foi realizado com sucesso</p>";
            echo "<script>location.href='../../pages/cadastro.php';</script>";
        }
    } else {
        $_SESSION["msg"] = "<p style='color: red; text-align: center;'>Cadastro não foi realizado com sucesso.</p>";
        echo "<script>location.href='../../pages/cadastro.php';</script>";
    }  
?>




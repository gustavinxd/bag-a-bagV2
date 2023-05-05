<!-- para que esse arquivo funcione, deve haver registros nas tabelas de endereço, rg, cadastro, usuario e telefone -->

<?php
session_start();
include_once('../conexao.php');
include_once('../funcoes.php');

// PEGAR OS DADOS COM O ARRAY FAZER DO JEITO CERTO!
$array_dados = array_values($_POST);

echo var_dump($array_dados);

// for ($i=1; $i < $total_passageiros; $i++) {
    
//     $name_id_usuario = 'id_usuario' . $i;
//     $name_nome = 'nome' . $i;
//     $name_sobrenome = 'sobrenome' . $i;
//     $name_email = 'email' . $i;
//     $name_cpf = 'cpf' . $i;
//     $name_data_nascimento = 'data_nascimento' . $i;
//     $name_ddd = 'ddd' . $i;
//     $name_numero = 'numero' . $i;

//     eval("$id_usuario = filter_input(INPUT_POST, '". $name_id_usuario . "', FILTER_SANITIZE_NUMBER_INT"); // id do usurário associado ao passageiro
//     eval("$nome = filter_input(INPUT_POST, '" . $name_nome . "', FILTER_SANITIZE_STRING");
//     eval("$sobrenome = filter_input(INPUT_POST, '" . $name . "', FILTER_SANITIZE_STRING);
//     eval("$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
//     eval("$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
//     eval("$data_nascimento = filter_input(INPUT_POST, 'data_nascimento');
//     eval("$ddd = filter_input(INPUT_POST, 'ddd', FILTER_SANITIZE_NUMBER_INT);
//     eval("$numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING);
// }


if(validarCPF($cpf)) {
    // procura pelo telefone informado
    $query = "SELECT * FROM TELEFONE WHERE DDD=$ddd AND NUMERO=$numero";
    $consulta = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($consulta) == 0) {
        // inserir telefone do passageiro
        $query = "INSERT INTO telefone (DDD, NUMERO, MODIFICADO) VALUES ($ddd, $numero, NOW())";
        $consulta = mysqli_query($conn, $query);

        if (mysqli_insert_id($conn)) {
            $id_telefone = mysqli_insert_id($conn);
        }
        else {
            $_SESSION['msg'] = "<p style='color:red;'>Erro. Não foi possível realizar o cadastro. Tente novamente.</p>";
            header("Location: test.php");
        }

    } else {
        $row = mysqli_fetch_assoc($consulta);
        $id_telefone = $row['ID_TELEFONE'];
    }

    // inserir dados e referenciar o telefone
    $query = "INSERT INTO passageiro (NOME_PASSAGEIRO, SOBRENOME_PASSAGEIRO, EMAIL_PASSAGEIRO, CPF_PASSAGEIRO, DATA_NASC_PASSAGEIRO, FK_TELEFONE, FK_USUARIO) VALUES ('$nome', '$sobrenome', '$email', '$cpf', '$data_nascimento', $id_telefone, $id_usuario)";
    $consulta = mysqli_query($conn, $query);
    
    if (mysqli_insert_id($conn)) {
        $_SESSION['msg'] = "<p style='color:green;'>Cadastro realizado com sucesso.</p>";
        header("Location: test.php");
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

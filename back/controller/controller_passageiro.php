<!-- para que esse arquivo funcione, deve haver registros nas tabelas de endereço, rg, cadastro, usuario e telefone -->

<?php
session_start();
include_once('../conexao.php');
include_once('../funcoes.php');

// ID_USUARIO
$id_usuario = 1;

// /\ 
// esses dados serão recebidos por variaveis SESSION ou pelo <form>
// \/ 

// ID_VOO
$id_voo = 1;

// RECEBER OS IDs DOS ASSENTOS
$assentos = ?;  // (tipo array)

// PEGAR OS DADOS DO(S) PASSAGEIRO(S) COM O ARRAY POST
$array_dados = array_values($_POST);
$total_passageiros = sizeof($array_dados) / 7;

// Pegar o preço da passagem do voo
$query = "SELECT VALOR_PASSAGEM FROM voo WHERE ID_VOO=$id_voo";
$consulta = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($consulta);
$valor_passagem = $row['VALOR_PASSAGEM'];

$valor_total = $valor_passagem * $total_passageiros;

// // CRIA A RESERVA
// $query = "INSERT INTO reserva (STATUS_RESERVA, VALOR_TOTAL, DATA_RESERVA, DATA_STATUS) VALUES ('Pendente', $valor_total, NOW(), NOW())";
// $consulta = mysqli_query($conn, $query);

// if (mysqli_insert_id($conn)) {
//     $id_reserva = mysqli_insert_id($conn);
// } else {
//     $_SESSION['msg'] = "<p style='color:red;'>Erro. Não foi possível criar a reserva. Tente novamente.</p>";
//     echo $_SESSION['msg'];
// }

for ($i=0, $passageiro=0; $passageiro < $total_passageiros; $passageiro++) {
    $nome_passageiro = $array_dados[$i++];
    $sobrenome_passageiro = $array_dados[$i++];
    $cpf_passageiro = $array_dados[$i++];
    $data_nasc_passageiro = $array_dados[$i++];
    $ddd = $array_dados[$i++];
    $numero_telefone = $array_dados[$i++]; 
    $numero_telefone = str_replace("-", "", $numero_telefone);
    $email_passageiro = $array_dados[$i++];
    $fk_assento = $assentos[$passageiro];

    if(validarCPF($cpf_passageiro)) {
        // procura por um passageiro com os dados informados no banco
        $query = "SELECT * FROM passageiro WHERE CPF_PASSAGEIRO=$cpf_passageiro";
        $consulta = mysqli_query($conn, $query);
        
        // SE NÃO HOUVER PASSAGEIRO COM OS DADOS INFORMADOS...
        if (mysqli_num_rows($consulta) == 0) {
            // ...procura pelo telefone informado
            $query = "SELECT * FROM telefone WHERE DDD=$ddd AND NUMERO_TELEFONE=$numero_telefone";
            $consulta = mysqli_query($conn, $query);

            // SE NÃO HOUVER ESTE TELEFONE NO BANCO...
            if (mysqli_num_rows($consulta) == 0) {
                // ...inserir telefone do passageiro no banco
                $query = "INSERT INTO telefone (DDD, NUMERO_TELEFONE, MODIFICADO) VALUES ($ddd, $numero, NOW())";
                $consulta = mysqli_query($conn, $query);

                if (mysqli_insert_id($conn)) {
                    $id_telefone = mysqli_insert_id($conn);
                } else {
                    $_SESSION['msg'] = "<p style='color:red;'>Erro. Não foi possível realizar o cadastro. Tente novamente.</p>";
                    header("Location: test.php");
                }

            } else {
                $row = mysqli_fetch_assoc($consulta);
                $id_telefone = $row['ID_TELEFONE'];
            }

            // CRIAR REGISTRO DE PASSAGEIRO
            $query = "INSERT INTO passageiro (NOME_PASSAGEIRO, SOBRENOME_PASSAGEIRO, EMAIL_PASSAGEIRO, CPF_PASSAGEIRO, DATA_NASC_PASSAGEIRO, FK_TELEFONE) VALUES ('$nome_passageiro', '$sobrenome_passageiro', '$email_passageiro', '$cpf_passageiro', '$data_nasc_passageiro', $id_telefone)";
            $consulta = mysqli_query($conn, $query);
            
            if (mysqli_insert_id($conn)) {
                $_SESSION['msg'] = "<p style='color:green;'>Cadastro realizado com sucesso.</p>";
                // header("Location: test.php");
            } else {
                $_SESSION['msg'] = "<p style='color:red;'>Erro. Não foi possível realizar o cadastro. Tente novamente.</p>";
                // header("Location: test.php");
            }
        }
        // SE HOUVER PASSAGEIRO COM OS DADOS INFORMADOS...
        else {
            $row = mysqli_fetch_assoc($consulta);
            $id_passageiro = $row['ID_PASSAGEIRO'];
        }

        // CRIAR PASSAGEM
        $query = "INSERT INTO passagem (FK_ASSENTO, FK_PASSAGEIRO, FK_VOO, FK_CUPOM, FK_RESERVA) VALUES ($assentos[$passageiro], $id_passageiro, $id_voo, DEFAULT, $id_reserva)";
        
    } else {
        $_SESSION['msg'] = "<p style='color:red;'>Erro. O CPF informado é inválido.</p>";
        // header("Location: test.php");
    }
    echo $_SESSION['msg'];
}
?>

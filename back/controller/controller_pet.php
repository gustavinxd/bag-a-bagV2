<?php
session_start();
include_once('../conexao.php');

// ID_USUARIO
$id_usuario = $_SESSION['id_usuario'];
// ID VOO
$id_voo = $_SESSION['id_voo'];

// Quantidade de assentos adquiridos na passagem
$qt_passageiros = $_SESSION['qt_passageiros'];

//Verifica se ja há mais de 3 pets no voo
$num_pets = mysqli_query($conn, "SELECT COUNT(ID_PET) AS qt_animais FROM animal INNER JOIN passagem ON FK_PASSAGEM = ID_PASSAGEM WHERE FK_VOO = $id_voo");
$qt_pets = mysqli_fetch_assoc($num_pets);

// pega os ids da passagem
$idpassagens = $_SESSION['idpassagem'];

if ($qt_pets['qt_animais'] < 3){

    for ($i=1; $i <= $qt_passageiros; $i++) {
        $peso_animal = filter_input(INPUT_POST, "peso" . $i, FILTER_SANITIZE_STRING);
        $data_nas_pet = filter_input(INPUT_POST, "data_nasc_pet" . $i, FILTER_SANITIZE_STRING);
        $idpassagem = $idpassagens[$i - 1];

        if (isset($_FILES["img". $i])) {
            // seleção do diretório
            $dir = "../../assets/img/imgpet/";
            $dirBcd = "../../assets/img/imgpet/";
            // pega dados da imagem (nome, nome temporário, tipo do arquivo)
            $image = $_FILES["img". $i];
            $tmp_name = $image['tmp_name'];
            $name = basename($image["name"]);
            $fileType = strtolower(pathinfo($name, PATHINFO_EXTENSION)); 
            // cria um id único pro arquivo (evita arquivos com nome repetido se substituirem) e cria o caminho onde vai armazenar o arquivo
            $name = uniqid();
            $path = $dir . $name . "." . $fileType;
            $pathBcd = $dirBcd . $name . "." . $fileType;
            // caso seja png, jpg ou jpeg, move o arquivo para a pasta images/imgCliente com o nome dele
            $allowTypes = array('jpg','png','jpeg');

            if(in_array($fileType, $allowTypes) && $image['size'] <= 2097152){

                //upload do caminho da imagem no banco upload da imagem em um diretório
                move_uploaded_file($tmp_name, $path);
                $insereImagem = mysqli_query($conn, "INSERT INTO animal(FK_PASSAGEM, DATA_NASC_PET, PESO, DIR_CARTEIRINHA) VALUES ('$idpassagem', '$data_nas_pet', '$peso_animal', '$pathBcd');");


                // inserção de imagem por @zerobugs-tutorial em https://youtu.be/ae83c8Zpoxo (acesso em 13/04/2023)

                $_SESSION['msg'] = "<center><span style='color:blue;'>Pet cadastrado com sucesso!</span></center>";
                header('Location: ../../pages/pagamento.php');
            }
            else{
                if($image['size'] > 2097152){   
                    $_SESSION['msg'] = "<center><span style='color:red;'>Pet não cadastrado. Tamanho de imagem não aceita. Máx 2MB.</span></center>";
                    header('Location: ../../pages/cadastro-pet.php');
                } 
            }
        }
        else {
            $_SESSION['msg'] = "<center><span style='color:red;'>Pet não cadastrado. Nenhuma imagem foi adicionada.</span></center>";         
            header('Location: ../../pages/cadastro-pet.php');
        }

    }
}else{
    $_SESSION['msg'] = "<center><span style='color:red;'>Já há mais de 3 pets nesse voo.</span></center>";
    header('Location: ../../pages/cadastro-pet.php');
}

?>
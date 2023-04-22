<?php
session_start();
include_once('../conexao.php');

$codaviao = filter_input(INPUT_POST, 'codaviao');
$empresa  = filter_input(INPUT_POST, 'empresa');

// adicionar o avião ao banco
$query = "INSERT INTO aviao_codaviao (CODIGO_AVIAO, EMPRESA, TOTAL_ASSENTO, CRIADO) VALUES ('$codaviao', '$empresa', DEFAULT, NOW())";
$consulta = mysqli_query($conn, $query);

if (mysqli_insert_id($conn)) {
    $id_aviao = mysqli_insert_id($conn);

    // adiciona 50 assentos de primeira classe do aviao
    $query_assentos_primeira_classe = "INSERT INTO assentos_codaviao (NUMERO_ASSENTO, CLASSE, FK_AVIAO)
    SELECT 
        LPAD(ROW_NUMBER() OVER (ORDER BY (SELECT NULL)), 3, '0') AS NUMERO_ASSENTO,
        'Primeira' AS CLASSE,
        $id_aviao AS FK_AVIAO
    FROM
        information_schema.tables t1
        CROSS JOIN information_schema.tables t2
    LIMIT 50";
    
    $consulta = mysqli_query($conn, $query_assentos_primeira_classe);

    // adiciona 150 assentos de classe economica do aviao
    $query_assentos_classe_economica = "INSERT INTO assentos_codaviao (NUMERO_ASSENTO, CLASSE, FK_AVIAO)
    SELECT 
        LPAD((ROW_NUMBER() OVER (ORDER BY (SELECT NULL))) + 50, 3, '0') AS NUMERO_ASSENTO,
        'Econômica' AS CLASSE,
        $id_aviao AS FK_AVIAO
    FROM
        information_schema.tables t1
        CROSS JOIN information_schema.tables t2
    LIMIT 150";
    
    $consulta = mysqli_query($conn, $query_assentos_classe_economica);
    
}
else {
    $_SESSION['msg'] = "<p style='color:red;'>Erro. Não foi possível inserir o avião ao banco de dados. Tente novamente</p>";
    header('Location: ../cadastro_aviao.php');
}

?>

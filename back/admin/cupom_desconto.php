<?php
session_start();
include_once('../conexao.php');

$id = $_SESSION['id_adm'] ;
  
$query = "SELECT * FROM admin 
  WHERE ID_ADM='$id'";
$query = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($query);

if(empty($row)) {
  echo "<script>location.href='../../index.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro-Cupom</title>

</head>

<body >
<?php
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
  
    <form action="../controller/controller_cupom.php" method="post">

       
        
        <label>Código Cupom:</label>
        <input type="text" id="cupom" name="codigo_cupom" placeholder="XXX000" maxlength="6" required>

        <label>Valor em Porcentagem:</label>
        <input type="number" id="valor" name="valor_desconto" maxlength="3" placeholder="20" required>

       
      
      <!-- Botão -->
      <br><br><br><button type="submit">ENVIAR</button>
                 

    </form>
  
                
    


</body>
</html>

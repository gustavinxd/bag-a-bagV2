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
<html>
<head>
	<title>Formulário de Aeroportos</title>
</head>
<body>

	<h1>Cadastro de Aeroportos</h1>
	<?php
	if (isset($_SESSION['msg'])) {
		echo $_SESSION['msg'];
		unset($_SESSION['msg']);
	}
	?>
	<form action="../controller/controller_cadastro_aeroporto.php" method="POST">

		<label for="sigla">Sigla:</label>
		<input type="text" id="sigla" name="sigla" required><br>

		<label for="nome_aeroporto">Nome do Aeroporto:</label>
		<input type="text" id="nome_aeroporto" name="nome_aeroporto" required><br>

		<label for="pais">País:</label>
		<input type="text" id="pais" name="pais" required><br>

		<label for="cidade">Cidade:</label>
		<input type="text" id="cidade" name="cidade" required><br>

		<input type="submit" value="Enviar">

	</form>

</body>
</html>

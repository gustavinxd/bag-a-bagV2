<?php
session_start();
$id_cadastro = $_GET['id_cadastro']; // obtendo o ID do usuário da URL
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<p>O ID do seu cadastro é <?php echo $id_cadastro; ?></p>

</body>
</html>
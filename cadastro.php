<?php
    $conecta = pg_connect("host=127.0.0.1 port=5432 dbname=1_72A_AULAS_2018 user=alunocti password=alunocti");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro</title>
</head>
<body>
    <form action="" method="post">
        Nome:&nbsp; <input type="text" name="nome" id=""><br>
        <input type="submit" value="Cadastrar" name="sub">
    </form>
    <?php
        if(isset($_POST['sub']))
        {
            $nome = $_POST['nome'];
            $sql = "INSERT INTO e24.bixos (nome) VALUES ('$nome')";
            $query = pg_query($conecta, $sql);
            echo pg_last_error();
        }
    ?>
</body>
</html>
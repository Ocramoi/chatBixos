<?php
    $conecta = pg_connect("host=127.0.0.1 port=5432 dbname=1_72A_AULAS_2018 user=alunocti password=alunocti");
    $id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <script src="../jquery.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script>
        var id = <?php echo($_GET['id']) ?>;
    </script>
    <title>Comentários</title>
</head>
<body>
    <a href="#topo" id="cima"><i class="fas fa-arrow-circle-up"></i></a>
    <header>
        <a name="topo"></a>
        <?php
            if(isset($_GET['id']))
            {
                $sql = "SELECT nome FROM e24.bixos WHERE id = $id";
                $query = pg_query($conecta, $sql);
                $res = pg_fetch_array($query);
        
                echo $res['nome'];
            }
            else
            {
                echo 'SAI BIXO';
            }
        ?>
    </header>
    <main>
        <div id="comentsBixo"></div>
        <div id="voltar"><a href="../"><i class="fas fa-arrow-left"></i>&nbsp;Voltar</a></div>
        <form action="" method="post">
            <div id="acoesComent">
                <textarea name="coment" id="inComent" rows="4"></textarea><br>
                <input type="submit" name="subComent" value="Postar" id="subComent">
            </div>
        </form>

        <?php
            if(!isset($_GET['id']))
            {
                echo "<center>PARA DE TENTAR QUEBRAR O SITGE BIXO SUJO!!!</center>";
            }
            else
            {
                echo '<script src="bixo.js"></script>';
            }

            if(isset($_POST['subComent']) && trim($_POST['coment']) != '')
            {
                $coment = htmlspecialchars(trim($_POST['coment']));
                $sql = "INSERT INTO e24.comentarios (bixo, comentario) VALUES ($id, '$coment')";
                $query = pg_query($conecta, $sql);
                echo pg_last_error();
            }
        ?>
    </main>

    <footer></footer>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
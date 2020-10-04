<?php
    $conecta = pg_connect("host=127.0.0.1 port=5432 dbname=1_72A_AULAS_2018 user=alunocti password=alunocti");
    if(isset($_GET['tipo']))
    {
        $tipo = $_GET['tipo'];
    }
    if(!isset($_GET['tipo']))
    {
        $tipo = 'bixos';
    }
    if(isset($_GET['bixo']))
    {
        $bixo = $_GET['bixo'];
    }
    if(!isset($_GET['bixo']) && $tipo == 'comentarios')
    {
        $bixo = 1;
    }
    if(isset($_GET['qnt']))
    {
        $qnt = $_GET['qnt'];
    }
    if(isset($_GET['idComentario']))
    {
        $idC = $_GET['idComentario'];
    }
    switch($tipo)
    {
        case 'bixos':
            $tabela = 'bixos';
            break;
        case 'comentarios':
            $tabela = 'comentarios';
            break;
        default:
        $tabela = 'bixos';
            break;
    }
    if($tabela == 'bixos')
    {
        $arr = array();
        $cont = 0;
        if(isset($_GET['nome']))
        {
            $nome = $_GET['nome'];
            $sql = "SELECT * FROM e24.$tabela WHERE nome ILIKE '%$nome%' ORDER BY nome ASC";
        }
        else
        {
            $sql = "SELECT * FROM e24.$tabela ORDER BY nome ASC";
        }
        $query = pg_query($conecta, $sql);
        $result = pg_fetch_assoc($query);

        do{
            $arr[$cont] = array('id' => $result['id'], 'nome' => $result['nome']);
            $cont++;
        } while($result = pg_fetch_assoc($query));

        $final = array('tipo' => 'Bixos', 'data' => $arr);

        $json = json_encode($final);
        echo $json;
    }
    else
    {
        $arr = array();
        $cont = 0;
        if(isset($idC))
        {
            $sql = "SELECT * FROM e24.$tabela WHERE id = $idC";
        }
        else
        {
            if(isset($qnt))
            {
                $sql = "SELECT * FROM e24.$tabela WHERE bixo = $bixo LIMIT $qnt";
            }
            else
            {
                $sql = "SELECT * FROM e24.$tabela WHERE bixo = $bixo";
            }
        }
        $query = pg_query($conecta, $sql);
        $result = pg_fetch_assoc($query);

        do{
            $arr[$cont] = array('id' => $result['id'], 'comentario' => $result['comentario']);
            $cont++;
        } while($result = pg_fetch_assoc($query));

        $final = array('tipo' => 'Comentários', 'data' => $arr);

        $json = json_encode($final);
        echo $json;
    }
?>
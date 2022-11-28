<?php

    require_once '../classes/laCafezito.php';
    $u = new laCafezito();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/pedir.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap" rel="stylesheet">
    <link rel="icon"  href="../imagens/iconLogo.png"/>
    <title>La Cafezito</title>
</head>
<body>
<div id="background">
    <div id="navegador">
        <a href="../home.php" id="cancelar"><p>X | Cancelar</p></a>
        <img src="../imagens/navegador.png" id="imgNavegador">
    </div>
        <div id="etapa">
            <h2>Tamanho do Cafe</h2>
        </div>
        <div id="campo">
            <form method="post">
            <p>* Campo obrigatório</p>
            <br>
            <h3>Escolha o modelo: </h3>
                <?php
            
                    session_start();
                    if(!$_SESSION['id']){
                        header("location: login.php");
                    }

                    $u->conectar("cafe", "localhost", "root", "");

                    $tamanho = $u->procurarTamanho();

                    //form
                    for($i=0; $i<count($tamanho); $i++){
                        $nome = $tamanho[$i]["unidade"];
                        $preco = $tamanho[$i]["preco"];
                        $id = $tamanho[$i]["id"];
                        echo " 
                        <br> 
                        <input type='radio' name='tamanho' value='$id' id='$id'>
                        <label for='$id'>$nome</label>
                        <label for='$id'>R$: $preco</label>
                        <br>";
                    }
            
                ?>
                <input type="submit" value="Proximo" name="proximo" class="btnProximo">
                </form>
        </div>
    </div>
</body>
</html>

<?php
    $tamanho = $_POST["tamanho"] = (isset($_POST["tamanho"])) ? $_POST["tamanho"] : null;
    $_SESSION['tamanho'] = $tamanho;
    $proximo = $_POST["proximo"] = (isset($_POST["proximo"])) ? $_POST["proximo"] : null;
    if($proximo){
        if ($_SESSION['tamanho'] != 0) {
            print_r($tamanho);
            $_SESSION['tamanho'] = $tamanho;
            $valor = $u -> buscarPrecosTamanhos($tamanho);
            $_SESSION['precoT'] = $valor['preco'];
            echo"<br>";
            print_r($_SESSION['precoT']);
            header("Location: saborCafe.php");
        } else {
            echo "
            <script>
                alert('Escolha um tamanho para prosseguir!');
            </script>
            ";
        }
    }
?>

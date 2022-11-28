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
   
    <div id="navegador">
        <a href="../home.php" id="cancelar"><p>X | Cancelar</p></a>
        <img src="../imagens/navegador4.png" id="imgNavegador">
    </div>
    <div id="background">
        <div id="etapa">
            <h2>Creme do Café</h2>
        </div>
        <div id="campo">
        <form method="post">
            <p>* Campo obrigatório</p>
            <br>
            <h3>Escolha o creme do café:</h3>
            
            <?php
        
                session_start();
                if(!$_SESSION['id']){
                    header("location: login.php");
                }

                $u->conectar("cafe", "localhost", "root", "");

                $cremes = $u->procurarCreme();

                //form
                for($i=0; $i<count($cremes); $i++){
                    $nome = $cremes[$i]["nome"];
                    $preco = $cremes[$i]["preco"];
                    $id = $cremes[$i]["id"];
                    echo " 
                    <br>
                        <input type='radio' name='cremes' value='$id' id='$id'>
                        <label for='$id'>$nome</label>
                        <label for='$id'>R$: $preco</label>
                    <br>
                    ";
                }
        
            ?>
                <input type="submit" value="Proximo" name="proximo" class="btnProximo">
                <?php
                    $proximo = $_POST["proximo"] = (isset($_POST["proximo"])) ? $_POST["proximo"] : null;
                    $preco = isset($preco);

                    if($proximo){
                        $cremes = $_POST["cremes"] = (isset($_POST["cremes"])) ? $_POST["cremes"] : null;
                        if ($cremes != 0) {
                            
                            $_SESSION['cremes'] = $cremes;
                            $valor = $u -> buscarPrecosCremes($cremes[0]);
                            $_SESSION['precoC'] = $valor['preco'];
                            echo"<br>";
                            echo($_SESSION['precoC']);
                            header("Location: temperaturaCafe.php");
                        }  else {
                            echo "
                            <script>
                                alert('Escolha um creme para prosseguir!');
                            </script>
                            ";
                        }
                    }
                ?>
            </form>
        </div>
    </div>
</body>
</html>
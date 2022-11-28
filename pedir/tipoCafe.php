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
        <img src="../imagens/navegador3.png" id="imgNavegador">
    </div>
    <div id="background">
        <div id="etapa">
            <h2>Tipo do Café</h2>
        </div>
        <div id="campo">
        <form method="post">
            <p>* Campo obrigatório</p>
            <br>
            <h3>Escolha o tipo do café:</h3>
            
            <?php
        
                session_start();
                if(!$_SESSION['id']){
                    header("location: login.php");
                }

                $u->conectar("cafe", "localhost", "root", "");

                $tipos = $u->procurarTipo();

                //form
                for($i=0; $i<count($tipos); $i++){
                    $nome = $tipos[$i]["nome"];
                    $preco = $tipos[$i]["preco"];
                    $id = $tipos[$i]["id"];
                    echo " 
                    <br>
                        <input type='radio' name='tipos' value='$id' id='$id'>
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
                        $tipos = $_POST["tipos"] = (isset($_POST["tipos"])) ? $_POST["tipos"] : null;
                        if ($tipos != 0) {
                            $_SESSION['tipos'] = $tipos;
                            print_r($tipos[0]);
                            $valor = $u -> buscarPrecosTipos($tipos);
                            $_SESSION['precoTi'] = $valor['preco'];
                            echo"<br>";
                            echo($_SESSION['precoTi']);
                            header("Location: cremeCafe.php");
                        }  else {
                            echo "
                            <script>
                                alert('Escolha um tipo para prosseguir!');
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
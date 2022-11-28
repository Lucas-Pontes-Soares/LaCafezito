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
        <img src="../imagens/navegador2.png" id="imgNavegador">
    </div>
    <div id="background">
        <div id="etapa">
            <h2>Sabor do Café</h2>
        </div>
        <div id="campo">
        <form method="post">
            <p>* Campo obrigatório</p>
            <br>
            <h3>Escolha o sabor do café:</h3>
            
            <?php
        
                session_start();
                if(!$_SESSION['id']){
                    header("location: login.php");
                }

                $u->conectar("cafe", "localhost", "root", "");

                $sabores = $u->procurarSabor();

                //form
                for($i=0; $i<count($sabores); $i++){
                    $nome = $sabores[$i]["nome"];
                    $preco = $sabores[$i]["preco"];
                    $id = $sabores[$i]["id"];

                    echo " 
                    <br>
                        <input type='radio' name='sabores' value='$id' id='$id'>
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
                        $sabores = $_POST["sabores"] = (isset($_POST["sabores"])) ? $_POST["sabores"] : null;
                        if ($sabores != 0) {
                            $_SESSION['sabores'] = $sabores;
                            print_r($_SESSION['sabores']);
                            $valor = $u -> buscarPrecosSabores($sabores);
                            print_r($valor);
                            $_SESSION['precoS'] = $valor[0]['preco'];
                            echo"<br>";
                            echo($_SESSION['precoS']);
                            header("Location: tipoCafe.php");
                        }  else {
                            echo "
                            <script>
                                alert('Escolha um sabor para prosseguir!');
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
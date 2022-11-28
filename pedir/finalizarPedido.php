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
        <img src="../imagens/navegador6.png" id="imgNavegador">
    </div>
    <div id="background">
        <div id="etapa">
            <h2>Pagamento do Cafe</h2>
        </div>
        <div id="campo">
        <form method="post">
            <label>Preço Total: $</label>
            <?php
                session_start();
                $_SESSION['preco'] = $_SESSION["precoT"] + $_SESSION["precoS"] + $_SESSION["precoTi"] + $_SESSION["precoC"];
                echo($_SESSION["preco"]);
                //echo "$_SESSION[preco]";
            ?>
            <br>
            <h3>Endereço para entrega:</h3>
            <br>
            <label>Bairro</label> <br>
            <input type="text" name="bairro">
            <br> 
            <label>Rua</label> <br>
            <input type="text" name="rua">
            <br>
            <label>Número</label> <br>
            <input type="text" name="numero">
            <br>
            <label>Complemento</label> <br>
            <input type="text" name="complemento">
            <?php
                if(!$_SESSION['id']){
                    header("location: login.php");
                }

                $u->conectar("cafe", "localhost", "root", "");
            ?>
            <br>
            <br>
            <img src="../imagens/pix.png" alt="">
            <p>Chave do pix: c75a0308-da76-450d-be3c-967bc57867f7</p>
            <br>
            <br>
            <br>
                <input type="submit" value="Concluir" name="concluir" class="btnProximo">
                <?php
                    $concluir = $_POST["concluir"] = (isset($_POST["concluir"])) ? $_POST["concluir"] : null;
                    if($concluir){
                        $bairro = $_POST["bairro"] = (isset($_POST["bairro"])) ? $_POST["bairro"] : null;
                        $rua = $_POST["rua"] = (isset($_POST["rua"])) ? $_POST["rua"] : null;
                        $numero = $_POST["numero"] = (isset($_POST["numero"])) ? $_POST["numero"] : null;
                        $complemento = $_POST["complemento"] = (isset($_POST["complemento"])) ? $_POST["complemento"] : null;
                        if ($bairro != "" && $rua != "" && $numero != ""){
                            $id_pedido = $u->finalizarPedidos($bairro, $rua, $numero, $complemento, $_SESSION["preco"]);
                            print_r($id_pedido[0]);
                            $u->finalizarComplementos($id_pedido[0]);
                            echo "
                            <script>
                                alert('Pedido Feito com sucesso!');
                            </script>
                            ";
                            header("location: ../home.php");
                        } else {
                            echo "
                            <script>
                                alert('Preencha todos os campos! ');
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

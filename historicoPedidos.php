<?php
    session_start();
    if(!$_SESSION['id']){
        header("location: login.php");
    }

    require_once 'classes/laCafezito.php';
    $u = new laCafezito();


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>La Cafezito</title>
    <link rel="stylesheet" href="styles/home4.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap" rel="stylesheet">
    <link rel="icon"  href="imagens/iconLogo.png"/>
</head>
<body>
<div class="fundo">
    <div id="superior">
        <div id="botaoLogo">
            <img src="imagens/logoCafezito.png" alt="" width="200px" height="80px">
        </div>
        <div id="botaoHome">
            <a class="navegador" href="home.php">Home</a>
        </div>
        <div id="botaoContato">
            <a class="navegador" href="contato.php">Contato</a>
        </div>
        <div id="botaoCafe">
            <a class="navegador" href="pedir/tamanhoCafe.php">Pedir Café</a>
        </div>
        <div id="botaoCarrinho">
            <a href="">
                <img src="imagens/carrinho2.png" id="imagemSuperior" alt="" width="50px" height="50px">
            </a>
        </div>
        <div id="botaoPerfil">
            <a href="perfil.php">
                <img src="imagens/perfil.png" id="imagemSuperior" alt="" width="50px" height="50px">
            </a>
        </div>
    </div>
    <div id="campo">
        <h2>Histórico de pedidos: ☕</h2>
        <div id="campoPedidos">
        <?php
        $u->conectar("cafe", "localhost", "root", "");

        $pedidos = $u->buscarPedidosCliente();
        $quantidadePedidos = count($pedidos);
        for($i = 0; $i < $quantidadePedidos; $i++){
            echo "<br>";
            $complementos = $u->buscarComplementos($pedidos[$i]["id"]);

            echo "Data da compra: ";
            echo "<br> Data: ";
            echo date_format (new DateTime($pedidos[$i]["DataCompra"]), 'd/m/Y');
            echo "<br> Horas: ";
            echo date_format (new DateTime($pedidos[$i]["DataCompra"]), 'H:i:s');
            echo "<br>";     

            $tamanho = $u->buscarTamanho($complementos["id_tamanho"]);
            echo "Tamanho: ";
            echo $tamanho[0]["unidade"];
            echo "<br>";     

            $sabor = $u->buscarSabor($complementos["id_sabor"]);
            echo "Sabor: ";
            echo $sabor[0]["nome"];
            echo "<br>";

            $tipo = $u->buscarTipo($complementos["id_tipo"]);
            echo "Tipo: ";
            echo $tipo[0]["nome"];
            echo "<br>";     

            $creme = $u->buscarCreme($complementos["id_creme"]);
            echo "Creme: ";
            echo $creme[0]["nome"];
            echo "<br>";     
            
            $temperatura = $u->buscarTemperatura($complementos["id_temperatura"]);
            echo "Temperatura: ";
            echo $temperatura[0]["nome"];
            echo "<br>"; 

            $precoTotal = $u->buscarPrecoTotal($pedidos[$i]["id"]);
            echo "Preco Total: $ ";
            print_r($precoTotal[0]);
            echo "<br>";   
        }
        
        ?>        
        </div>
    </div>
</div>
</body>   

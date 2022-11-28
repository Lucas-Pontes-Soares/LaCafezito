<?php
    session_start();
    if(!$_SESSION['idAdmin']){
        header("location: login.php");
    }
    
    require_once 'classes/LaCafezito.php';
    $u = new LaCafezito();
    $precoTotal = 0;
    $u->conectar("cafe", "localhost", "root", "");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Admin - LaCafezito</title>
    <link rel="icon"  href="imagens/iconLogo.png"/>
    <link rel="stylesheet" href="styles/admin4.css">
    <script>
        deslogar(){
            unset($_SESSION['idAdmin']);
        }
    </script>
</head>
<body>
    <div id="fundo">
    <div id="superior">
        <div id="botaoLogo">
            <img src="imagens/logoCafezito.png" alt="" width="200px" height="80px">
        </div>
        <div id="botaoKanban">
            <a class="navegador" id="selecionado" href="">Kanban - Pedidos</a>
        </div>
        <div id="botaoComplementos">
            <a class="navegador" href="adminCafe.php">Complementos</a>
        </div>
        <div id="botaoPerfil">
            <a href="login.php" onclick="deslogar()">
                <img src="imagens/iconSair.png" id="imagemSuperior" alt="" width="50px" height="50px">
            </a>
        </div>
</div>
    <h1>Pedidos de todos os clientes</h1>
    <div id="kanban">
        <div id="analise">
            <h2>Pedidos em análise: </h2>
            <?php
                $pedidos = $u->PedidosClientesAnalise();
                if ($pedidos != null){
                    $quantidadePedidos = count($pedidos);
                    for($i = 0; $i < $quantidadePedidos; $i++){
                        $estado = $pedidos[$i]["estado"];
                        echo "<br>";
                        echo "Cliente: ";
                        $dadosUsuario = $u->buscarUsuario($pedidos[$i]["id_user"]);
                        print_r($dadosUsuario[0]["nome"]);
                        echo"<br>";
                        print_r($dadosUsuario[0]["email"]);
                        echo"<br>";
                        echo "Entrega: ";
                        echo "<br> Bairro: ";
                        print_r($pedidos[$i]["bairro"]);
                        echo "<br> Rua: ";
                        print_r($pedidos[$i]["rua"]);
                        echo "<br> Numero: ";
                        print_r($pedidos[$i]["numero"]);
                        echo "<br> Complemento: ";
                        print_r($pedidos[$i]["complemento"]);
                        echo "<br>";
                        echo "Data da compra: ";
                        echo "<br> Data: ";
                        echo date_format (new DateTime($pedidos[$i]["DataCompra"]), 'd/m/Y');
                        echo "<br> Horas: ";
                        echo date_format (new DateTime($pedidos[$i]["DataCompra"]), 'H:i:s');
                        echo "<br>";     
                        echo"<br>";
                        $complementos = $u->buscarComplementos($pedidos[$i]["id"]);
                
                        $tamanhos = $u->buscarTamanho($complementos["id_tamanho"]);
                        $qtdtamanhos = count($tamanhos);
                        for($m = 0; $m < $qtdtamanhos; $m++){
                            echo "Tamanhos: ";
                            echo $tamanhos[$m]["unidade"];
                            echo "<br>";     
                        }
                        $tipo = $u->buscarTipo($complementos["id_tipo"]);
                        $qtdTipo = count($tipo);
                        for($c = 0; $c < $qtdTipo; $c++){
                            echo "tipo: ";
                            echo $tipo[$c]["nome"];
                            echo "<br>";     
                        }
                        $temperatura = $u->buscarTemperatura($complementos["id_temperatura"]);
                        $qtdTemperatura = count($temperatura);
                        for($a = 0; $a < $qtdTemperatura; $a++){
                            echo "Temperatura: ";
                            echo $temperatura[$a]["nome"];
                            echo "<br>";     
                        }
                        $sabor = $u->buscarSabor($complementos["id_sabor"]);
                        $qtdSabor = count($sabor);
                        for($a = 0; $a < $qtdSabor; $a++){
                            echo "Sabor: ";
                            echo $sabor[$a]["nome"];
                            echo "<br>";     
                        }
                        $creme = $u->buscarCreme($complementos["id_creme"]);
                        $qtdCreme = count($creme);
                        for($a = 0; $a < $qtdCreme; $a++){
                            echo "Cremes: ";
                            echo $creme[$a]["nome"];
                            echo "<br>";     
                        }
                        $precoTotal = $pedidos[$i]['preco'];
                        echo "Preço: $  $precoTotal";
                        echo"<br>";
                        echo "Estado do pedido: ";
                        print_r($pedidos[$i]["estado"]);
                        $pedido = $pedidos[$i]['id'];
                        echo "
                            <a class='avancar' value='em producao' id='avancar'  name='producao' href='processar_pedido.php?status=1&id=$pedido'>Avançar Estágio ➡️</a>
                            <br>
                        ";
                    
                    }
                }
            ?>
        </div>
        <div id="producao">
            <h2>Pedidos em produção: </h2>
            <?php
                $pedidos = $u->PedidosClientesProducao();
                if($pedidos != null){
                    $quantidadePedidos = count($pedidos);
                    for($i = 0; $i < $quantidadePedidos; $i++){
                        $estado = $pedidos[$i]["estado"];
                        echo "<br>";
                        echo "Cliente: ";
                        $dadosUsuario = $u->buscarUsuario($pedidos[$i]["id_user"]);
                        print_r($dadosUsuario[0]["nome"]);
                        echo"<br>";
                        print_r($dadosUsuario[0]["email"]);
                        echo"<br>";
                        echo "Entrega: ";
                        echo "<br> Bairro: ";
                        print_r($pedidos[$i]["bairro"]);
                        echo "<br> Rua: ";
                        print_r($pedidos[$i]["rua"]);
                        echo "<br> Numero: ";
                        print_r($pedidos[$i]["numero"]);
                        echo "<br> Complemento: ";
                        print_r($pedidos[$i]["complemento"]);
                        echo "<br>";
                        echo "Data da compra: ";
                        echo "<br> Data: ";
                        echo date_format (new DateTime($pedidos[$i]["DataCompra"]), 'd/m/Y');
                        echo "<br> Horas: ";
                        echo date_format (new DateTime($pedidos[$i]["DataCompra"]), 'H:i:s');
                        echo "<br>";     
                        echo"<br>";
                        $complementos = $u->buscarComplementos($pedidos[$i]["id"]);

                        $tamanhos = $u->buscarTamanho($complementos["id_tamanho"]);
                        $qtdtamanhos = count($tamanhos);
                        for($m = 0; $m < $qtdtamanhos; $m++){
                            echo "Tamanhos: ";
                            echo $tamanhos[$m]["unidade"];
                            echo "<br>";     
                        }
                        $tipo = $u->buscarTipo($complementos["id_tipo"]);
                        $qtdTipo = count($tipo);
                        for($c = 0; $c < $qtdTipo; $c++){
                            echo "tipo: ";
                            echo $tipo[$c]["nome"];
                            echo "<br>";     
                        }
                        $temperatura = $u->buscarTemperatura($complementos["id_temperatura"]);
                        $qtdTemperatura = count($temperatura);
                        for($a = 0; $a < $qtdTemperatura; $a++){
                            echo "Temperatura: ";
                            echo $temperatura[$a]["nome"];
                            echo "<br>";     
                        }
                        $sabor = $u->buscarSabor($complementos["id_sabor"]);
                        $qtdSabor = count($sabor);
                        for($a = 0; $a < $qtdSabor; $a++){
                            echo "Sabor: ";
                            echo $sabor[$a]["nome"];
                            echo "<br>";     
                        }
                        $creme = $u->buscarCreme($complementos["id_creme"]);
                        $qtdCreme = count($creme);
                        for($a = 0; $a < $qtdCreme; $a++){
                            echo "Cremes: ";
                            echo $creme[$a]["nome"];
                            echo "<br>";     
                        }
                        $precoTotal = $pedidos[$i]['preco'];
                        echo "Preço: $  $precoTotal";
                        echo"<br>";
                        echo "Estado do pedido: ";
                        print_r($pedidos[$i]["estado"]);
                        $pedido = $pedidos[$i]['id'];

                        echo "
                            <a class='avancar' value='indo para entrega' name='entregando' href='processar_pedido.php?status=2&id=$pedido'>Avançar estágio ➡️</a>
                            <br>

                        ";
                    
                    }
                }
            ?>
        </div>
        <div id="entregando">
            <h2>Pedidos sendo entregues: </h2>
            <?php
                $pedidos = $u->PedidosClientesEntregando();
                if ($pedidos != null){
                    $quantidadePedidos = count($pedidos);
                    for($i = 0; $i < $quantidadePedidos; $i++){
                        $estado = $pedidos[$i]["estado"];
                        echo "<br>";
                        echo "Cliente: ";
                        $dadosUsuario = $u->buscarUsuario($pedidos[$i]["id_user"]);
                        print_r($dadosUsuario[0]["nome"]);
                        echo"<br>";
                        print_r($dadosUsuario[0]["email"]);
                        echo"<br>";
                        echo "Entrega: ";
                        echo "<br> Bairro: ";
                        print_r($pedidos[$i]["bairro"]);
                        echo "<br> Rua: ";
                        print_r($pedidos[$i]["rua"]);
                        echo "<br> Numero: ";
                        print_r($pedidos[$i]["numero"]);
                        echo "<br> Complemento: ";
                        print_r($pedidos[$i]["complemento"]);
                        echo "<br>";
                        echo "Data da compra: ";
                        echo "<br> Data: ";
                        echo date_format (new DateTime($pedidos[$i]["DataCompra"]), 'd/m/Y');
                        echo "<br> Horas: ";
                        echo date_format (new DateTime($pedidos[$i]["DataCompra"]), 'H:i:s');
                        echo "<br>";     
                        echo"<br>";
                        $complementos = $u->buscarComplementos($pedidos[$i]["id"]);
                
                        $tamanhos = $u->buscarTamanho($complementos["id_tamanho"]);
                        $qtdtamanhos = count($tamanhos);
                        for($m = 0; $m < $qtdtamanhos; $m++){
                            echo "Tamanhos: ";
                            echo $tamanhos[$m]["unidade"];
                            echo "<br>";     
                        }
                        $tipo = $u->buscarTipo($complementos["id_tipo"]);
                        $qtdTipo = count($tipo);
                        for($c = 0; $c < $qtdTipo; $c++){
                            echo "tipo: ";
                            echo $tipo[$c]["nome"];
                            echo "<br>";     
                        }
                        $temperatura = $u->buscarTemperatura($complementos["id_temperatura"]);
                        $qtdTemperatura = count($temperatura);
                        for($a = 0; $a < $qtdTemperatura; $a++){
                            echo "Temperatura: ";
                            echo $temperatura[$a]["nome"];
                            echo "<br>";     
                        }
                        $sabor = $u->buscarSabor($complementos["id_sabor"]);
                        $qtdSabor = count($sabor);
                        for($a = 0; $a < $qtdSabor; $a++){
                            echo "Sabor: ";
                            echo $sabor[$a]["nome"];
                            echo "<br>";     
                        }
                        $creme = $u->buscarCreme($complementos["id_creme"]);
                        $qtdCreme = count($creme);
                        for($a = 0; $a < $qtdCreme; $a++){
                            echo "Cremes: ";
                            echo $creme[$a]["nome"];
                            echo "<br>";     
                        }
                        $precoTotal = $pedidos[$i]['preco'];
                        echo "Preço: $  $precoTotal";
                        echo"<br>";
                        echo "Estado do pedido: ";
                        print_r($pedidos[$i]["estado"]);
                        $pedido = $pedidos[$i]['id'];

                        echo "
                            <a class='avancar' 'value='entregue' name='entregue' href='processar_pedido.php?status=3&id=$pedido'>Avançar Estágio ➡️ </a>
                            <br>
                        ";
                    
                    }
                }
        ?>
        </div>
    </div>
            </div>
</body>
</html>

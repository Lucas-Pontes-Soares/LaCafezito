<?php
    session_start();
    if(!$_SESSION['idAdmin']){
        header("location: login.php");
    }
    
    require_once 'classes/laCafezito.php';
    $u = new laCafezito();
    $u->conectar("cafe", "localhost", "root", "");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <title>Admin - LaCafezito</title>
    <link rel="stylesheet" href="styles/admin4.css">
    <link rel="icon"  href="imagens/iconLogo.png"/>
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
            <a class="navegador" href="admin.php">Kanban - Pedidos</a>
        </div>
        <div id="botaoComplementos">
            <a class="navegador" id="selecionado" href="">Complementos</a>
        </div>
        <div id="botaoPerfil">
            <a href="login.php" onclick="deslogar()">
                <img src="imagens/iconSair.png" id="imagemSuperior" alt="" width="50px" height="50px">
            </a>
        </div>
</div>
    <h1>Complementos do café: </h1>
    <div class="novo">
            <h2>Adicionar novo complemento +</h2>
            <br>
            <form method="post">
                <label>Complemento: </label>
                    <select name="Complemento">
                        <option value = "" selected> Selecione a opção </option>
                        <option value = "tamanho" > Tamanho </option>
                        <option value = "sabor" > Sabor </option>
                        <option value = "tipo" >  Tipo </option>
                        <option value = "creme" > Creme </option>
                        <option value = "temperatura"> Temperatura </option>
                    </select>
                    <br>
                    <br>
                    <label>Nome: </label> 
                    <input class="inputComplemento" type="text" name="nomeComplemento">
                    <br>
                    <br>
                    <label>Preco: </label> 
                    <input class="inputComplemento" type="text" name="precoComplemento">
                    <br>
                    <br>
                    <input id="btnCriar" type="submit" name="btnCriar" value="Criar">
            </form>
        </div>
    <div class="complementos">

    
    <div class="tamanhos">
        <h2>Tamanhos: </h2>
        <?php
            $tamanhos = $u -> procurarTamanho();
            $quantTamanho = count($tamanhos);
            for ($x = 0; $x < $quantTamanho; $x++){
                echo $tamanhos[$x]['unidade'];
                echo " ";
                $idTamanho = $tamanhos[$x]['id'];
                $nomeTamanho = $tamanhos[$x]['unidade'];
                $precoTamanho = $tamanhos[$x]['preco'];

                echo $tamanhos[$x]['preco'];
                echo "<a href='editarComplemento.php?complemento=tamanho&id=$idTamanho&nome=$nomeTamanho&preco=$precoTamanho'>Editar </a>";
                echo "<br>";
                echo "<br>";
            }
        ?>
    </div>
    <div class="sabores">
        <h2>Sabores: </h2>
        <?php
            $sabores = $u -> procurarSabor();
            $quantSabores = count($sabores);
            for ($x = 0; $x < $quantSabores; $x++){
                echo $sabores[$x]['nome'];
                echo " ";
                $idSabor = $sabores[$x]['id'];
                $nomeSabor = $sabores[$x]['nome'];
                $precoSabor = $sabores[$x]['preco'];

                echo $sabores[$x]['preco'];
                echo " <a href='editarComplemento.php?complemento=sabor&id=$idSabor&nome=$nomeSabor&preco=$precoSabor'>Editar </a>";
                echo "<br>";
                echo "<br>";
            }
        ?>
    </div>
    <div class="tipos">
        <h2>Tipos: </h2>
        <?php
            $tipos = $u -> procurarTipo();
            $quantTipos = count($tipos);
            for ($x = 0; $x < $quantTipos; $x++){
                echo $tipos[$x]['nome'];
                echo " ";
                $idTipo = $tipos[$x]['id'];
                $nomeTipo = $tipos[$x]['nome'];
                $precoTipo = $tipos[$x]['preco'];

                echo $tipos[$x]['preco'];
                echo " <a href='editarComplemento.php?complemento=tipo&id=$idTipo&nome=$nomeTipo&preco=$precoTipo'>Editar </a>";
                echo "<br>";
                echo "<br>";
            }
        ?>
    </div>
        </div>
        <div class="complementos2">
    <div class="cremes">
        <h2>Cremes: </h2>
        <?php
            $cremes = $u -> procurarCreme();
            $quantCremes = count($cremes);
            for ($x = 0; $x < $quantCremes; $x++){
                echo $cremes[$x]['nome'];
                echo " ";
                $idCreme = $cremes[$x]['id'];
                $nomeCreme = $cremes[$x]['nome'];
                $precoCreme = $cremes[$x]['preco'];

                echo $cremes[$x]['preco'];
                echo " <a href='editarComplemento.php?complemento=creme&id=$idCreme&nome=$nomeCreme&preco=$precoCreme'>Editar </a>";
                echo "<br>";
                echo "<br>";
            }
        ?>
    </div>
    <div class="temperaturas">
        <h2>Temperaturas: </h2>
        <?php
            $temperaturas = $u -> procurarTemperatura();
            $quantTemp = count($temperaturas);
            for ($x = 0; $x < $quantTemp; $x++){
                echo $temperaturas[$x]['nome'];
                $idTemp = $temperaturas[$x]['id'];
                $nomeTemp = $temperaturas[$x]['nome'];
                $precoTemp = 0;
                echo " <a href='editarComplemento.php?complemento=temperatura&id=$idTemp&nome=$nomeTemp&preco=$precoTemp'>Editar </a>";
                echo "<br>";
                echo "<br>";
            }
        ?>
    </div>
    </div>
        </div>
</body>
</html>

<?php
    $nomeComplemento = $_POST["nomeComplemento"] = (isset($_POST["nomeComplemento"])) ? $_POST["nomeComplemento"] : null;
    $precoComplemento = $_POST["precoComplemento"] = (isset($_POST["precoComplemento"])) ? $_POST["precoComplemento"] : null;

    if(!empty($_POST['Complemento'])) {
        $selecionado = $_POST['Complemento'];
        if($nomeComplemento != "" || $precoComplemento != ""){
            if($selecionado == "tamanho"){
                $u->criarTamanho($nomeComplemento, $precoComplemento);
                header("Location: adminCafe.php");
            } else if($selecionado == 'sabor'){
                $u->criarSabor($nomeComplemento, $precoComplemento);
                header("Location: adminCafe.php");
            } else if($selecionado == "tipo"){
                $u->criarTipo($nomeComplemento, $precoComplemento);
                header("Location: adminCafe.php");
            } else if($selecionado == "creme"){
                $u->criarCreme($nomeComplemento, $precoComplemento);
                header("Location: adminCafe.php");
            } else if ($selecionado == "temperatura"){
                $u->criarTemperatura($nomeComplemento);
                header("Location: adminCafe.php");
            }
        } else {
            echo "
            <script>
            alert('Preencha todos os campos!')
            </script>
            ";
        }
    }
?>

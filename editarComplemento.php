<?php
    session_start();
    if(!$_SESSION['idAdmin']){
        header("location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/admin4.css">
    <title>Admin - LaCafezito</title>
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
                <a class="navegador" href="adminCafe.php">Complementos</a>
            </div>
            <div id="botaoPerfil">
                <a href="login.php" onclick="deslogar()">
                    <img src="imagens/iconSair.png" id="imagemSuperior" alt="" width="50px" height="50px">
                </a>
            </div>
        </div>
        <h1>Edição dos Complementos: </h1>
        <div id="editarComplemento">
            <?php
                    require_once 'classes/LaCafezito.php';
                    $u = new LaCafezito();

                    $u->conectar("cafe", "localhost", "root", "");

                    $complemento = $_GET["complemento"];
                    $id = $_GET["id"];
                    $nome = $_GET["nome"];
                    $preco = $_GET["preco"];

                    echo "
                        <h2>Editar $complemento:</h2>
                        <form method='post'>
                            <label id='lblId'>ID = $id</label> <br>
                            <label class='lbl'>Nome: </label>
                            <input class='escrever' type='text' name='nomeEditado' placeholder='$nome'> <br>
                            <label class='lbl'>Preço R$: </label>
                            <input class='escrever' type='text' name='precoEditado' placeholder='$preco'> <br>
                            <input id='btnExcluir' type='submit' name='btnExcluir' value='Excluir 🗑️'> 
                            <input id='btnEditar' type='submit' name='btnEditar' value='Editar ✏️'> 
                        </form>
                    ";
                ?>
        </div>
    </div>
</body>
</html>

<?php
    $nomeEditado = $_POST["nomeEditado"] = (isset($_POST["nomeEditado"])) ? $_POST["nomeEditado"] : null;
    $precoEditado = $_POST["precoEditado"] = (isset($_POST["precoEditado"])) ? $_POST["precoEditado"] : null;
    $btnEditar = $_POST["btnEditar"] = (isset($_POST["btnEditar"])) ? $_POST["btnEditar"] : null;
    $btnExcluir = $_POST["btnExcluir"] = (isset($_POST["btnExcluir"])) ? $_POST["btnExcluir"] : null;

    if ($nomeEditado == ""){
        $nomeEditado = $nome;
    }
    if ($precoEditado == ""){
        $precoEditado = $preco;
    }

    if ($btnEditar){
        if ($complemento == 'tamanho'){
            $u->editarTamanho($nomeEditado, $precoEditado, $id);
            header("Location: adminCafe.php");
        } else if ($complemento == 'sabor') {
            $u->editarSabor($nomeEditado, $precoEditado, $id);
            header("Location: adminCafe.php");
        } else if ($complemento == 'tipo') {
            $u->editarTipo($nomeEditado, $precoEditado, $id);
            header("Location: adminCafe.php");
        } else if ($complemento == 'creme'){
            $u->editarCreme($nomeEditado, $precoEditado, $id);
            header("Location: adminCafe.php");
        } else if ($complemento == 'temperatura'){
            $u->editarTemperatura($nomeEditado, $id);
            header("Location: adminCafe.php");
        }
    } else if($btnExcluir){
        if ($complemento == 'tamanho'){
            $u->excluirTamanho($id);
            header("Location: adminCafe.php");
        } else if ($complemento == 'sabor') {
            $u->excluirSabor($id);
            header("Location: adminCafe.php");
        } else if ($complemento == 'tipo') {
            $u->excluirTipo($id);
            header("Location: adminCafe.php");
        } else if ($complemento == 'creme'){
            $u->excluirCreme($id);
            header("Location: adminCafe.php");
        } else if ($complemento == 'temperatura'){
            $u->excluirTemperatura($id);
            header("Location: adminCafe.php");
        }
    }
?>
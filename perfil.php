<?php

    require_once 'classes/laCafezito.php';
    $u = new laCafezito();

    session_start();
    if(!$_SESSION['id']){
        header("location: login.php");
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/perfil3.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap" rel="stylesheet">
    <title>La Cafezito</title>
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
            <a href="historicoPedidos.php">
                <img src="imagens/carrinho2.png" id="imagemSuperior" alt="" width="50px" height="50px">
            </a>
        </div>
        <div id="botaoPerfil">
            <a href="">
                <img src="imagens/perfil.png" id="imagemSuperior" alt="" width="50px" height="50px">
            </a>
        </div>
    </div>
    <div class="campo">
        <div class="foto">
            <?php
                $u->conectar("cafe", "localhost", "root", "");

                $fotoBanco = $u->buscarFoto();
                if($fotoBanco[0] != ""){
                    echo "<br>
                    <img src='arquivos/$fotoBanco[0]' class='foto' width='150px' height='150px'> 
                    <br>
                    ";
                } else {
                    echo "<br>
                    <img src='arquivos/63337562c51d1.png' class='foto' width='150px' height='150px'> 
                    <br>
                    ";
                }
            ?>
        </div>

    <div class="atualizarImagem">
        <h3>Imagem do Perfil</h3>
            <form enctype="multipart/form-data" method="post">
                <p><label for="">Selecione o arquivo</label></p>
                <input name="arquivo" type="file" id="escolherImagem"> <br> <br>
                <input type="submit" name="botaoImg" id="enviar" value="Enviar Imagem">
            </form>
    </div>
    <br>
    <br>
    <br>
    <div id="usuario">
        <br>
        <?php
            $perfil = $u->buscarCliente();
            echo"<p>Nome: </p>";
            print_r($perfil["nome"]);
            echo"<p>Email: </p>";
            print_r($perfil["email"]);
        ?>
        <br>
        <br>
        <br>
  </div>
<?php
        echo "
        <div id='atualizarDados'>
        <h3>Atualizar Dados</h3>
        <form method='POST'>
            <p>Nome:</p><input type='text' class='inptAtualizar' name='nome' placeholder='$perfil[nome]'> 
            <p>Email:</p><input type='email' class='inptAtualizar' name='email' placeholder='$perfil[email]''>
            <br>
            <br>
            <input type='submit' id='btnAtualizar' name='atualizar' value='Atualizar'>
        </form>
        </div>
        <br>
        ";

        
    ?>
    <div id="sair"> 
    <h3>Sair da Conta</h3>
    <br>
        <form method="post">
            <input type="submit" name="sair" value="X | Sair" id="btnsair">
        </form>
    </div>
    <div id="excluir">
    <h3>Excluir a Conta</h3>
    <br>
        <form method="post">
            <input type="submit" name="excluir" value="🗑 | Excluir" id="btnexcluir">
        </form>
    </div>

    </div>
</body>
</html>

<?php
    $nome = $_POST["nome"] = (isset($_POST["nome"])) ? $_POST["nome"] : null;
    $email = $_POST["email"] = (isset($_POST["email"])) ? $_POST["email"] : null;
    $atualizar = $_POST["atualizar"] = (isset($_POST["atualizar"])) ? $_POST["atualizar"] : null;
    $sair = $_POST["sair"] = (isset($_POST["sair"])) ? $_POST["sair"] : null;
    $excluir = $_POST["excluir"] = (isset($_POST["excluir"])) ? $_POST["excluir"] : null;
    $botaoImg = $_POST["botaoImg"] = (isset($_POST["botaoImg"])) ? $_POST["botaoImg"] : null;

    if($atualizar){
        if($email == ""){
            $email = $perfil['email'];
        }
        if($nome == ""){
            $nome = $perfil['nome'];
        }

        $perfil = $u->atualizarCliente($nome, $email);
        echo "
            <script>
                alert('Escolha um tamanho para prosseguir!');
            </script>
        ";
        header("Refresh:0");
    }

    if($sair){
        unset($_SESSION['id']);
        header('location: login.php');
    }

    if($excluir){
        $u -> deletarCliente();
        unset($_SESSION['id']);
        header('location: login.php');
    }

    if($botaoImg){
        if(isset($_FILES["arquivo"])){
            $arquivo = $_FILES["arquivo"];
            $pasta = "arquivos/";
    
            if($arquivo['error']){
                die("Falha ao enviar arquivo");
            }
    
            $nome = $arquivo["name"];
            $novoNome = $_SESSION['id'];
            $extensao = strtolower(pathinfo($nome,PATHINFO_EXTENSION));
    
            if($extensao != "jpg" && $extensao != "png" && $extensao != "jpeg"){
                die("Tipo de arquivo não aceito");
            }
    
            $upload = move_uploaded_file($arquivo["tmp_name"], $pasta . $novoNome . "." . $extensao);
    
            if($upload){
                $u->adicionarFoto($novoNome.".".$extensao);
                header("Refresh:0");
            } else {
                echo "
                <script>
                    alert('Erro ao enviar arquivo!');
                </script>
            ";
            }
        }
    }
?>
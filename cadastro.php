<?php
    require_once 'classes/LaCafezito.php';
    $u = new LaCafezito();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>La Cafezito</title>
    <link rel="stylesheet" href="styles/login1.css">
    <link rel="icon" href="imagens/iconLogo.png"/>
</head>

<body>
<div id="fundo">
    <img id="logo" src="imagens/LogoCafezito.png" alt=""  alt="" width="200px" height="80px">

    <div id="forms">
        <br>
        <img src="imagens/BEM-VINDO.png" alt="">
        <br>
        <br>
        <h1>Complete seu cadastro</h1>
        <br>
        <form method="POST">
            <input class="entrar" type="name" placeholder="👨🏻 Nome" name="nome">
            <br>
            <input class="entrar" type="email" placeholder="📧 Email" name="email">
            <br>
            <input class="entrar" type="password" placeholder="🔒 Senha" name="senha">
            <br>

            <br>
            <input id="btnEntrar" type="submit" value="Cadastrar">
            <br>
   
            <div id="botao">
                <p>Já possui conta? <a id="botaoCriar" href="login.php">Logar</a></p>
            </div>
            <?php
                if(isset($_POST['email'])){
                    $nome = addslashes($_POST['nome']);
                    $email = addslashes($_POST['email']);
                    $senha = addslashes($_POST['senha']);

                    if(!empty($email) && !empty($senha) && !empty($nome)){
                        $u->conectar("cafe", "localhost", "root", "");

                        if($u->msgERRO == ""){
                            if($u->cadastrar($nome, $email, $senha)){

                                header("location: home.php");
                            } 
                            
                            else {
                                ?>
                                <div class="msg-erro">
                                    Esse e-mail já foi cadastrado!!
                                </div>
                                <?php
                            }

                        } else {
                            ?>
                            <div class="msg-erro">  
                                <?php echo "Erro: ".$u->msgERRO; ?>
                            </div>
                            <?php
                        } 
                    }
                }
            ?>
        </form>
    </div>
</div>
</body>
</html>


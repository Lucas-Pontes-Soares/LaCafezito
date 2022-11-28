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
    <link rel="icon"  href="imagens/iconLogo.png"/>
</head>

<body>
<div id="fundo">

    <img id="logo" src="imagens/LogoCafezito.png" alt=""  alt="" width="200px" height="80px">

    <div id="forms">
        <br><br>
        <img src="imagens/BEM-VINDO.png" alt="">
        <br>
        <br>
        <h1>Faça seu login</h1>

        <form method="POST">
            <br>
            <input class="entrar" type="email" placeholder="📧 Email" name="email">
            <br>
            <input class="entrar" type="password" placeholder="🔒 Senha" name="senha">
            <br>
            <input type="checkbox" name="admin" id="admin">
            <label for="admin">Entrar como administrador?</label>
            <br><br>
            <input id="btnEntrar" type="submit" value="Entrar">
            <br><br>
            <div id="botao">
                <p>Não possui conta? <a id="botaoCriar" href="cadastro.php">Fazer Cadastro</a></p>
                <br>
            </div>
            <?php
                if(isset($_POST['email'])){
                    $email = addslashes($_POST['email']);
                    $admin = $_POST["admin"] = (isset($_POST["admin"])) ? $_POST["admin"] : null;
                    $senha = addslashes($_POST['senha']);

                    if ($admin){
                        if(!empty($email) && !empty($senha)){
                            $u->conectar("cafe", "localhost", "root", "");

                            if($u->msgERRO == ""){
                                if($u->logarAdmin($email, $senha)){

                                    header("location: admin.php");
                                }

                                else {
                                    ?>
                                    <div class="msg-erro">
                                        E-mail e/ou Senha Incorretos!
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
                    }else {
                        if(!empty($email) && !empty($senha)){
                            $u->conectar("cafe", "localhost", "root", "");

                            if($u->msgERRO == ""){
                                if($u->logar($email, $senha)){

                                    header("location: home.php");
                                }

                                else {
                                    ?>
                                    <div class="msg-erro">
                                        E-mail e/ou Senha Incorretos!
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
                }
            ?>
        </form>
    </div>
</div>
</body>
</html>


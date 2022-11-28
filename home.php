
<?php
    session_start();
    if(!$_SESSION['id']){
        header("location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>LaCafezito</title>
    <link rel="stylesheet" href="styles/home4.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap" rel="stylesheet">
    <link rel="icon"  href="imagens/iconLogo.png"/>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<div class="fundo">
    <div id="superior">
        <div id="botaoLogo">
            <img src="imagens/logoCafezito.png" alt="" width="200px" height="80px">
        </div>
        <div id="botaoHome">
            <a class="navegador" id="selecionado" href="">Home</a>
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
            <a href="perfil.php">
                <img src="imagens/perfil.png" id="imagemSuperior" alt="" width="50px" height="50px">
            </a>
        </div>
    </div>
    <div class="fundo">
        <img src="imagens/cafesCremosos.png" id="famosos" alt="" width="530px" height="67px">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2" class="active"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="imagens/backgroundcafe2.png" height="650px" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="imagens/backgroundcafe1.png" height="650px" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="imagens/backgroundcafe3.png" height="650px" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        

    </div>
</div>
</body>


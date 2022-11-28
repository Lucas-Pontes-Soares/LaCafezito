<?php
 require_once 'classes/LaCafezito.php';
 $u = new LaCafezito();

$u->conectar("cafe", "localhost", "root", "");

$status = $_GET["status"];
$pedido = $_GET["id"];

echo $status;
echo $pedido;
if ($status == 1){
    $estado = "em produção";
    $atualizado = $u->atualizarEstado($estado, $pedido);
    if($atualizado == 1){
        header("Location: admin.php");
    }
    
} if($status == 2){
    $estado = "entregando";
    $atualizado = $u->atualizarEstado($estado, $pedido);
    if($atualizado == 1){
        header("Location: admin.php");
    }
    
} if($status == 3){
    $estado = "entregue";
    $atualizado = $u->atualizarEstado($estado, $pedido);
    if($atualizado == 1){
        header("Location: admin.php");
    }
    
}
?>
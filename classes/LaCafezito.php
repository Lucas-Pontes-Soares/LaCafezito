<?php

    class LaCafezito{

        private $pdo; 
        public $msgERRO = "";

       // CONECTAR
       public function conectar($nome, $host, $usuario, $senha){

        global $pdo;
        global $msgERRO;

        try{
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);

        }
        catch (PDOException $e){
            $msgERRO = $e->getMessage();

        }
    }

    // LOGAR
    public function logar($email, $senha){

        global $pdo;

        $sql= $pdo->prepare("SELECT id FROM clientes WHERE email = :e AND senha = :s");

        $sql-> bindValue(":e", $email);
        $sql-> bindValue(":s", md5($senha));
        
        $sql-> execute();

        if($sql->rowCount() == 1){
            $dado = $sql->fetch();

            session_start();
            $_SESSION['id'] = $dado['id'];
            return true;

        } else {
            return false;

        } 
    }

    public function logarAdmin($email, $senha){

        global $pdo;

        $sql= $pdo->prepare("SELECT id FROM administradores WHERE email = :e AND senha = :s");

        $sql-> bindValue(":e", $email);
        $sql-> bindValue(":s", md5($senha));
        $sql-> execute();

        if($sql->rowCount() == 1){
            $dado = $sql->fetch();

            session_start();
            $_SESSION['idAdmin'] = $dado['id'];
            return true;

        } else {
            return false;

        }
    }

    // CADASTRAR
    public function cadastrar($nome, $email, $senha){
        
        global $pdo;
        $sql = $pdo->prepare("SELECT id FROM clientes WHERE email = :e");
        $sql-> bindValue(":e", $email);
        $sql-> execute();

        if ($sql->rowCount()>0){
            
            return false; 
        
        }else{
            $sql = $pdo->prepare("INSERT INTO clientes (nome, email, senha) VALUES (:n, :e, :s)");
            $sql-> bindValue(":n", $nome);
            $sql-> bindValue(":e", $email);
            $sql-> bindValue(":s", md5($senha));

            
            $sql->execute(); // cria o cliente e dps loga

            $sql= $pdo->prepare("SELECT id FROM clientes WHERE email = :e AND senha = :s");
            $sql-> bindValue(":e", $email);
            $sql-> bindValue(":s", md5($senha));
            $sql-> execute();
            if($sql->rowCount() == 1){
                $dado = $sql->fetch();
    
                session_start();
                $_SESSION['id'] = $dado['id'];
                return true;
    
            } else {
                return false;
    
            } 
            
        }
        
    }

        public function buscarPedidos($pedidosClientes){
            global $pdo;
            $sql = $pdo->prepare("SELECT * FROM pedidos WHERE id_user = :u");
            $sql-> bindValue(":u", $pedidosClientes);
            $sql-> execute();
    
            if($sql->rowCount()>0){
                $dados = $sql->fetchAll();
                
                return $dados; 
            }
        }

        public function buscarPedidosCliente(){
            global $pdo;
            $sql = $pdo->prepare("SELECT * FROM pedidos WHERE id_user = :u");
            $sql-> bindValue(":u", $_SESSION['id']);
            $sql-> execute();
    
            if($sql->rowCount()>0){
                $dados = $sql->fetchAll();
                
                return $dados; 
            }
        }

        public function atualizarEstado($estado, $id){
            echo $id;
            echo "caiu";
            global $pdo;
            $sql = $pdo->prepare("UPDATE pedidos SET estado = :e WHERE id = :u");
            $sql-> bindValue(":u", $id);
            $sql-> bindValue(":e", $estado);
            $sql-> execute();
            
            $atualizado = 1;

            return $atualizado;
        }

        public function buscarUsuario($idUser){
            global $pdo;
            $sql = $pdo->prepare("SELECT * FROM clientes WHERE id = :u");
            $sql-> bindValue(":u", $idUser);
            $sql-> execute();
    
            if($sql->rowCount()>0){
                $dados = $sql->fetchAll();
                
                return $dados; 
            }
        }

        public function PedidosClientesAnalise(){
            global $pdo;
            $sql= $pdo->prepare("SELECT * FROM pedidos WHERE estado = 'Em análise'");
            $sql-> execute();
            if($sql->rowCount()>0){
                $quantidadeClientes = $sql->fetchAll();
                return $quantidadeClientes;
            } 
        }

        public function PedidosClientesProducao(){
            global $pdo;
            $sql= $pdo->prepare("SELECT * FROM pedidos WHERE estado = 'Em produção'");
            $sql-> execute();
            if($sql->rowCount()>0){
                $quantidadeClientes = $sql->fetchAll();
                return $quantidadeClientes;
            } 
        }

        public function PedidosClientesEntregando(){
            global $pdo;
            $sql= $pdo->prepare("SELECT * FROM pedidos WHERE estado = 'Entregando'");
            $sql-> execute();
            if($sql->rowCount()>0){
                $quantidadeClientes = $sql->fetchAll();
                return $quantidadeClientes;
            } 
        }

        public function buscarComplementos($id_pedido){
            global $pdo;
            $sql = $pdo->prepare("SELECT * FROM pedidos_complementos WHERE id_pedido = :i");
            $sql-> bindValue(":i", $id_pedido);
            $sql-> execute();
    
            if($sql->rowCount()>0){
                $dados = $sql->fetch();
                
                return $dados; 
            }
        }

        public function buscarTamanho($tamanho){
            $tamanhoEx = explode(",", $tamanho);
            $quantidadeTamanho = count($tamanhoEx);
             
            $arrayT = [];
            for($i = 0; $i < $quantidadeTamanho; $i++){
                global $pdo;
                $sql = $pdo->prepare("SELECT unidade, preco FROM tamanhos WHERE id = :m");
                $sql-> bindValue(":m", $tamanhoEx[$i]);
                $sql-> execute();
    
                if($sql->rowCount()>0){
                    $dados = $sql->fetch();
                    array_push($arrayT, $dados);
                }
            } 
            return $arrayT;
    
        }

        public function buscarTipo($tipo){
            $tipoEx = explode(",", $tipo);
            $quantidadeTipo = count($tipoEx);
             
            $arrayTi = [];
            for($i = 0; $i < $quantidadeTipo; $i++){
                global $pdo;
                $sql = $pdo->prepare("SELECT nome, preco FROM tipos WHERE id = :t");
                $sql-> bindValue(":t", $tipoEx[$i]);
                $sql-> execute();
    
                if($sql->rowCount()>0){
                    $dados = $sql->fetch();
                    array_push($arrayTi, $dados);
                }
            } 
            return $arrayTi;
    
        }


        public function buscarTemperatura($temperatura){
            $temperaturaEx = explode(",", $temperatura);
            $quantidadeTemperatura = count($temperaturaEx);
             
            $arrayTe = [];
            for($i = 0; $i < $quantidadeTemperatura; $i++){
                global $pdo;
                $sql = $pdo->prepare("SELECT nome FROM temperaturas WHERE id = :t");
                $sql-> bindValue(":t", $temperaturaEx[$i]);
                $sql-> execute();
    
                if($sql->rowCount()>0){
                    $dados = $sql->fetch();
                    array_push($arrayTe, $dados);
                }
            } 
            return $arrayTe;
    
        }

        public function buscarSabor($sabor){
            $saborEx = explode(",", $sabor);
            $quantidadeSabor = count($saborEx);
             
            $arrayS = [];
            for($i = 0; $i < $quantidadeSabor; $i++){
                global $pdo;
                $sql = $pdo->prepare("SELECT nome, preco FROM sabores WHERE id = :s");
                $sql-> bindValue(":s", $saborEx[$i]);
                $sql-> execute();
    
                if($sql->rowCount()>0){
                    $dados = $sql->fetch();
                    array_push($arrayS, $dados);
                }
            } 
            return $arrayS;
    
        }

        public function buscarCreme($creme){
            $cremeEx = explode(",", $creme);
            $quantidadeCreme = count($cremeEx);
             
            $arrayC = [];
            for($i = 0; $i < $quantidadeCreme; $i++){
                global $pdo;
                $sql = $pdo->prepare("SELECT nome, preco FROM cremes WHERE id = :c");
                $sql-> bindValue(":c", $cremeEx[$i]);
                $sql-> execute();
    
                if($sql->rowCount()>0){
                    $dados = $sql->fetch();
                    array_push($arrayC, $dados);
                }
            } 
            return $arrayC;
    
        }

        public function procurarTamanho(){

            global $pdo;
    
            $sql= $pdo->prepare("SELECT * FROM tamanhos");
    
            $sql-> execute();
    
            if($sql->rowCount()>0){
                $dados = $sql->fetchAll();
               
                return $dados; 

            } else {
                return [];
            }
    
        }

        public function buscarPrecosTamanhos($tamanho){
                global $pdo;
                $sql = $pdo->prepare("SELECT preco FROM tamanhos WHERE id = :m");
                $sql-> bindValue(":m", $tamanho);
                $sql-> execute();
    
                if($sql->rowCount()>0){
                    $dados = $sql->fetch();
                    return $dados;
                }
        }

        public function procurarSabor(){

            global $pdo;
    
            $sql= $pdo->prepare("SELECT * FROM sabores");
    
            $sql-> execute();
    
            if($sql->rowCount()>0){
                $dados = $sql->fetchAll();
               
                return $dados; 
                
            } else {
                return [];
            }
    
        }

        public function buscarPrecosSabores($sabores){
                global $pdo;
                $sql = $pdo->prepare("SELECT preco FROM sabores WHERE id = :s");
                $sql-> bindValue(":s", $sabores);
                $sql-> execute();
    
                if($sql->rowCount()>0){
                    $dados = $sql->fetchAll();
                    return $dados;
                }
        }

        public function procurarTipo(){

            global $pdo;
    
            $sql= $pdo->prepare("SELECT * FROM tipos");
    
            $sql-> execute();
    
            if($sql->rowCount()>0){
                $dados = $sql->fetchAll();
               
                return $dados; 
                
            } else {
                return [];
            }
    
        }

        public function buscarPrecosTipos($tipos){
            global $pdo;
                $sql = $pdo->prepare("SELECT preco FROM tipos WHERE id = :m");
                $sql-> bindValue(":m", $tipos);
                $sql-> execute();
    
                if($sql->rowCount()>0){
                    $dados = $sql->fetch();
                    return $dados;
                }
        }

        public function procurarCreme(){

            global $pdo;
    
            $sql= $pdo->prepare("SELECT * FROM cremes");
    
            $sql-> execute();
    
            if($sql->rowCount()>0){
                $dados = $sql->fetchAll();
               
                return $dados; 
                
            } else {
                return [];
            }
    
        }

        public function buscarPrecosCremes($cremes){
            global $pdo;
                $sql = $pdo->prepare("SELECT preco FROM cremes WHERE id = :m");
                $sql-> bindValue(":m", $cremes);
                $sql-> execute();
    
                if($sql->rowCount()>0){
                    $dados = $sql->fetch();
                    return $dados;
                }
        }

        public function procurarTemperatura(){

            global $pdo;
    
            $sql= $pdo->prepare("SELECT * FROM temperaturas");
    
            $sql-> execute();
    
            if($sql->rowCount()>0){
                $dados = $sql->fetchAll();
               
                return $dados; 
                
            } else {
                return [];
            }
    
        }

        public function finalizarPedidos($bairro, $rua, $numero, $complemento, $preco){
            global $pdo;
            
            $sql = $pdo->prepare("INSERT INTO pedidos (id_user, bairro, rua, numero, complemento, preco) VALUES (:u, :b, :r, :n, :c, :p)");
            $sql-> bindValue(":u", $_SESSION['id']);
            $sql-> bindValue(":b", $bairro);
            $sql-> bindValue(":r", $rua);
            $sql-> bindValue(":n", $numero);
            $sql-> bindValue(":c", $complemento);
            $sql-> bindValue(":p", $preco);
            $sql->execute();
    
            $sql = $pdo->prepare("SELECT LAST_INSERT_ID()");
            $sql->execute();
            $id = $sql->fetch();
    
            return $id;
        }
    
        public function finalizarComplementos($id_pedido){
            global $pdo;
            echo $id_pedido;
            
            $sql = $pdo->prepare("INSERT INTO pedidos_complementos (id_pedido, id_tamanho, id_tipo, id_temperatura, id_sabor, id_creme) VALUES (:i, :t, :l, :b, :s, :c)");
            $sql-> bindValue(":i", $id_pedido);
            $sql-> bindValue(":t", $_SESSION['tamanho']);
            $sql-> bindValue(":l", $_SESSION['tipos']);
            $sql-> bindValue(":b", $_SESSION['temperaturas']);
            $sql-> bindValue(":s", $_SESSION['sabores']);
            $sql-> bindValue(":c", $_SESSION['cremes']);
            $sql->execute();
            return true;
        }

        public function buscarPrecoTotal($id_pedido){
            global $pdo;
            $sql = $pdo->prepare("SELECT preco FROM pedidos WHERE id = :i");
            $sql-> bindValue(":i", $id_pedido);
            $sql-> execute();
    
            if($sql->rowCount()>0){
                $dados = $sql->fetch();
                return $dados;
                
            }
        }

        public function buscarCliente(){
        
            global $pdo;
            $sql = $pdo->prepare("SELECT nome, email FROM clientes WHERE id = :i");
            $sql-> bindValue(":i", $_SESSION['id']);
            $sql-> execute();
    
            if($sql->rowCount()>0){
                $dados = $sql->fetch();
                
                return $dados; 
            } 
        }
        
        public function atualizarCliente($nome, $email){
    
            global $pdo;
            $sql = $pdo->prepare("UPDATE clientes SET nome = :n, email = :e WHERE id = :i");
            $sql-> bindValue(":i", $_SESSION['id']);
            $sql-> bindValue(":n", $nome);
            $sql-> bindValue(":e", $email);
            $sql-> execute();
    
            return;
        }
    
        public function deletarCliente(){
    
            global $pdo;
            $sql = $pdo->prepare("DELETE FROM clientes WHERE id = :i");
            $sql-> bindValue(":i", $_SESSION['id']);
            $sql-> execute();
    
            return;
        }

        public function buscarFoto(){
            global $pdo;
            $sql = $pdo->prepare("SELECT img FROM clientes WHERE id = :i");
            $sql-> bindValue(":i", $_SESSION['id']);
            $sql-> execute();
    
            $dados = $sql->fetch();
                
            return $dados; 
        }
    
        public function adicionarFoto($imagem){
            global $pdo;
            $sql = $pdo->prepare("UPDATE clientes SET img = :m WHERE id = :i");
            $sql-> bindValue(":i", $_SESSION['id']);
            $sql-> bindValue(":m", $imagem);
            $sql-> execute();
    
            return;
        }

        public function editarTamanho($nomeTamanho, $precoTamanho, $idTamanho){
            global $pdo;
            $sql = $pdo->prepare("UPDATE tamanhos SET unidade = :n, preco = :p WHERE id = :i");
            $sql-> bindValue(":n", $nomeTamanho);
            $sql-> bindValue(":p", $precoTamanho);
            $sql-> bindValue(":i", $idTamanho);
            $sql-> execute();
    
            return;
        }

        public function editarSabor($nomeSabor, $precoSabor, $idSabor){
            global $pdo;
            $sql = $pdo->prepare("UPDATE sabores SET nome = :n, preco = :p WHERE id = :i");
            $sql-> bindValue(":n", $nomeSabor);
            $sql-> bindValue(":p", $precoSabor);
            $sql-> bindValue(":i", $idSabor);
            $sql-> execute();
    
            return;
        }

        public function editarTipo($nomeTipo, $precoTipo, $idTipo){
            global $pdo;
            $sql = $pdo->prepare("UPDATE tipos SET nome = :n, preco = :p WHERE id = :i");
            $sql-> bindValue(":n", $nomeTipo);
            $sql-> bindValue(":p", $precoTipo);
            $sql-> bindValue(":i", $idTipo);
            $sql-> execute();
    
            return;
        }

        public function editarCreme($nomeCreme, $precoCreme, $idCreme){
            global $pdo;
            $sql = $pdo->prepare("UPDATE cremes SET nome = :n, preco = :p WHERE id = :i");
            $sql-> bindValue(":n", $nomeCreme);
            $sql-> bindValue(":p", $precoCreme);
            $sql-> bindValue(":i", $idCreme);
            $sql-> execute();
    
            return;
        }

        public function editarTemperatura($nomeTemperatura, $idTemperatura){
            global $pdo;
            $sql = $pdo->prepare("UPDATE temperaturas SET nome = :n WHERE id = :i");
            $sql-> bindValue(":n", $nomeTemperatura);
            $sql-> bindValue(":i", $idTemperatura);
            $sql-> execute();
    
            return;
        }

        public function excluirTamanho($idTamanho){
            global $pdo;
            $sql = $pdo->prepare("DELETE FROM tamanhos WHERE id = :i");
            $sql-> bindValue(":i", $idTamanho);
            $sql-> execute();
    
            return;
        }

        public function excluirSabor($idSabor){
            global $pdo;
            $sql = $pdo->prepare("DELETE FROM sabores WHERE id = :i");
            $sql-> bindValue(":i", $idSabor);
            $sql-> execute();
    
            return;
        }

        public function excluirTipo($idTipo){
            global $pdo;
            $sql = $pdo->prepare("DELETE FROM tipos WHERE id = :i");
            $sql-> bindValue(":i", $idTipo);
            $sql-> execute();
    
            return;
        }

        public function excluirCreme($idCreme){
            global $pdo;
            $sql = $pdo->prepare("DELETE FROM cremes WHERE id = :i");
            $sql-> bindValue(":i", $idCreme);
            $sql-> execute();
    
            return;
        }

        public function excluirTemperatura($idTemperatura){
            global $pdo;
            $sql = $pdo->prepare("DELETE FROM temperaturas WHERE id = :i");
            $sql-> bindValue(":i", $idTemperatura);
            $sql-> execute();
    
            return;
        }

        public function criarTamanho($nomeTamanho, $precoTamanho){
            global $pdo;
            $sql = $pdo->prepare("INSERT INTO tamanhos (unidade, preco) VALUES (:n, :p)");
            $sql-> bindValue(":n", $nomeTamanho);
            $sql-> bindValue(":p", $precoTamanho);
            $sql->execute();
            return;
        }

        public function criarSabor($nomeSabor, $precoSabor){
            global $pdo;
            $sql = $pdo->prepare("INSERT INTO sabores (nome, preco) VALUES (:n, :p)");
            $sql-> bindValue(":n", $nomeSabor);
            $sql-> bindValue(":p", $precoSabor);
            $sql->execute();
            return;
        }

        public function criarTipo($nomeTipo, $precoTipo){
            global $pdo;
            $sql = $pdo->prepare("INSERT INTO tipos (nome, preco) VALUES (:n, :p)");
            $sql-> bindValue(":n", $nomeTipo);
            $sql-> bindValue(":p", $precoTipo);
            $sql->execute();
            return;
        }

        public function criarCreme($nomeCreme, $precoCreme){
            global $pdo;
            $sql = $pdo->prepare("INSERT INTO cremes (nome, preco) VALUES (:n, :p)");
            $sql-> bindValue(":n", $nomeCreme);
            $sql-> bindValue(":p", $precoCreme);
            $sql->execute();
            return;
        }

        public function criarTemperatura($nomeTemperatura){
            global $pdo;
            $sql = $pdo->prepare("INSERT INTO temperaturas (nome) VALUES (:n)");
            $sql-> bindValue(":n", $nomeTemperatura);
            $sql->execute();
            return;
        }
    }
?>
<?php
    require 'conn.php';

    class Produtos {

        public $pdo;

        /**
         * Conctando com Banco de Dados.
         *
         * @author Brendon
        */
        public function __construct($pdo){
            $this->pdo = $pdo;
        }

        /**
         * Conctando com Baco de Dados.
         *
         * @author Brendon
        */
        public function getAllProducts(){
            $sql = $this->pdo->prepare("SELECT A.idprod, A.nome, A.cor, B.preco, B.valor_desc FROM produtos AS A LEFT JOIN preco AS B ON (A.idprod = B.idprod)");
            $sql->execute();

            if($sql->rowCount()){
                $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $dados;
            }
        }

        
        /**
         * Inserção de Produtos
         *
         * @author Brendon
        */
        public function insert($nome, $preco, $cor, $valor_desc){
            $sql1 = $this->pdo->prepare("INSERT INTO produtos (nome, cor) VALUES (:nome, :cor)");
            $sql1->bindValue(':nome', $nome);
            $sql1->bindValue(':cor', $cor);
            $sql1->execute();
            $idprod = $this->pdo->lastInsertId();

            $sql2 = $this->pdo->prepare("INSERT INTO preco (idprod, preco, valor_desc) VALUES (:idprod, :preco, :valor_desc)");
            $sql2->bindValue(':idprod', $idprod);
            $sql2->bindValue(':preco', $preco);
            $sql2->bindValue(':valor_desc', $valor_desc);
            $sql2->execute();
            
        }

        /**
         * Pegando os dados de um determinado Produto
         *
         * @author Brendon
        */
        public function edit($idprod){
            $sql = $this->pdo->prepare("SELECT * FROM produtos AS A LEFT JOIN preco AS B ON (A.idprod = B.idprod) WHERE A.idprod = :idprod");
            $sql->bindValue(':idprod', $idprod);
            $sql->execute();

            if($sql->rowCount()){
                $dados = $sql->fetch(PDO::FETCH_ASSOC);
            }

            return $dados;
        }

        /**
         * Fazendo alteração/edição em um produto
         *
         * @author Brendon
        */
        public function update($idprod, $nome, $preco, $cor, $valor_desc){
            $sql1 = $this->pdo->prepare("UPDATE produtos SET nome = :nome, cor = :cor WHERE idprod = :idprod");
            $sql1->bindValue(':nome', $nome);
            $sql1->bindValue(':cor', $cor);
            $sql1->bindValue(':idprod', $idprod);
            $sql1->execute();

            $sql2 = $this->pdo->prepare("UPDATE preco SET preco = :preco, valor_desc = :valor_desc WHERE idprod = :idprod");
            $sql2->bindValue(':preco', $preco);
            $sql2->bindValue(':valor_desc', $valor_desc);
            $sql2->bindValue(':idprod', $idprod);
            $sql2->execute();
        }

        
        /**
         * Exclusão do Produto
         *
         * @author Brendon
        */
        public function delete($idprod){
            $sql1 = $this->pdo->prepare("DELETE FROM produtos WHERE idprod = :idprod");
            $sql1->bindValue(':idprod', $idprod);
            $sql1->execute();

            $sql2 = $this->pdo->prepare("DELETE FROM preco WHERE idprod = :idprod");
            $sql2->bindValue(':idprod', $idprod);
            $sql2->execute();
        }

        
        /**
         * Filtro de Pesquisa
         *
         * @author Brendon
        */
        public function getProductsFilter($procurar = null, $filter = null, $cor = null, $preco = null){
            if($filter == 1){
                $condicao = "WHERE nome LIKE '$procurar%'";
            }else if($filter == 2){
                $condicao = "WHERE cor = '$cor'";
            }else if($filter == 3){
                $condicao = "WHERE preco = '$preco'";
            }else{
                $condicao = "";
            } 

            $sql = $this->pdo->prepare("SELECT A.idprod, A.nome, A.cor, B.preco, B.valor_desc FROM produtos AS A LEFT JOIN preco AS B ON (A.idprod = B.idprod) $condicao");

            $sql->execute();

            if($sql->rowCount()){
                $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $dados;
            }
        }
    }
?>
<?php
    require 'conn.php';
    require 'classes/ProdutosClass.php';

    $classProducts = new Produtos($conn);

    if(!empty($_REQUEST['idprod'])){
        $classProducts->delete($_REQUEST['idprod']);
    }
?>
<?php
    require 'conn.php';
    require 'classes/ProdutosClass.php';
    require 'functions.php';

    $classProducts = new Produtos($conn);

    if(isset($_POST['nome']) && !empty($_POST['nome']) 
        && isset($_POST['preco']) && !empty($_POST['preco'])
            && isset($_POST['cor']) && !empty($_POST['cor'])){
        $nome = $_POST['nome'];
        $preco = substr($_POST['preco'], 3);
        $cor = $_POST['cor'];
        $valor_desc = substr($_POST['valor_desc'], 3);

        $preco_format_db = formataValorDecimal($preco);
        $valor_desc_format_db = formataValorDecimal($valor_desc);

        $classProducts->insert($nome, $preco_format_db, $cor, $valor_desc_format_db);

        header('location: index.php');
    }
?>
<?php include 'header.php'; ?>

    <fieldset style='width:50%'>
        <legend>Adicionar</legend>
        <form action="" method="post">
            <div class='div_form'>
                <label for="">Nome do Produto: </label>
                <input type="text" name="nome" id="" style='width: 75%' required>
            </div>

            <div class='div_form'>
                <label for="">Preço: </label>
                <input type="text" name="preco" id="preco" style='width: 80%' required>
            </div>

            <div class='div_form'>
                <label for="">Valor: </label>
                <input type="text" name="valor_desc" id="valor_desc_hidden" hidden value=''>

                <input type="text" name="valor_desc" id="valor_desc" style='width: 80%' disabled>
            </div>

            <div class='div_form'>
                <label for="">Cor: </label>
                <div style='display: inline-flex;'>
                    <input type="radio" id="cor" name="cor" value="white" checked>
                    <div class="block_none"></div>    

                    <input type="radio" id="cor" name="cor" value="blue">
                    <div class="block_blue"></div>      

                    <input type="radio" id="cor" name="cor" value="red">
                    <div class="block_red"></div>

                    <input type="radio" id="cor" name="cor" value="yellow">
                    <div class="block_yellow"></div>
                </div>
            </div>

            <br> 
            
            <i><strong>Legendas das Cores:</strong></i>
            <div>
                <div class="block_none mt-2 mb-2"></div> 
                <div class="desc">
                    - Sem Desconto
                </div>
            </div>

            <div>
                <div class="block_blue mt-2 mb-2"></div>
                <div class="desc">
                    - <strong>20%</strong> de Desconto
                </div>
            </div>

            <div>
                <div class="block_red mt-2 mb-2"></div>
                <div class="desc">
                    - <strong>20%</strong> de Desconto (Obs: Caso o preço for <i><strong>Maior</strong></i> que R$ 50,00 será aplicado um desconto de <strong>5%</strong>)
                </div>
            </div>

            <div>
                <div class="block_yellow mt-2 mb-2"></div>
                <div class="desc">
                    - <strong>10%</strong> de Desconto
                </div>
            </div>

            <div class='div_form right'>
                <a class='voltar' href="index.php">Voltar </a>
                <input type="submit" value="Cadastrar">
            </div>
        </form>
    </fieldset>
<?php include 'footer.php'; ?>

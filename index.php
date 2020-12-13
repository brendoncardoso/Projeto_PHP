<?php
    require 'conn.php';
    require 'classes/ProdutosClass.php';
    require 'functions.php';

    $classProducts = new Produtos($conn);

    if(isset($_REQUEST['filter']) && !empty($_REQUEST['filter'])){
        $filter = $_REQUEST['filter'];
        $procurar =  $_REQUEST['procurar'];
        $preco =  $_REQUEST['filter_preco'];

        if($filter == 3){
            $preco_formart = substr($preco, 3);
            $preco_format_db = formataValorDecimal($preco_formart);
            $getProducts = $classProducts->getProductsFilter(null, $filter, null, $preco_format_db);
        }else{
            if($filter != 2){
                $getProducts = $classProducts->getProductsFilter($procurar, $filter, null, null);
            }else{
                $cor = $_REQUEST['cor'];
                $getProducts = $classProducts->getProductsFilter(null, $filter, $cor, null);
            }
        }
    }else{
        $getProducts = $classProducts->getAllProducts();
    }
?>

<?php include 'header.php'; ?>
    <fieldset>
        <legend>Filtro de Pesquisa</legend>    
        <form action="" method="post">
            <div class="campo_procurar">
                <label for="">Procurar:</label>
                
                <input type="text" name="procurar" id="procurar" value="<?= !empty($_REQUEST['procurar']) ? $_REQUEST['procurar'] : ''; ?>" <?= isset($_REQUEST['filter']) && $_REQUEST['filter'] != 0 ? '' : 'disabled'; ?> <?= isset($_REQUEST['filter']) && $_REQUEST['filter'] == 2 || isset($_REQUEST['filter']) && $_REQUEST['filter'] == 3 ? "style=display:none" : 'style=display:inline-block'; ?>>
                <input type="text" name="filter_preco" id="filter_preco" value="<?= !empty($_REQUEST['filter_preco']) ? $_REQUEST['filter_preco'] : ''; ?>" <?= isset($_REQUEST['filter']) && $_REQUEST['filter'] == 3 ? 'style=display:inline-block' : 'style=display:none'; ?>>

                <select id='cor' name="cor" id="" <?= isset($_REQUEST['filter']) && $_REQUEST['filter'] == 2 ? "style='display: show; width:80%'" : "style='display: none; width:80%'"; ?>>
                    <option value="white" <?= isset($_REQUEST['cor']) && $_REQUEST['cor'] == 'white' ? 'selected' : '';?>>Branco</option>
                    <option value="red" <?= isset($_REQUEST['cor']) && $_REQUEST['cor'] == 'red' ? 'selected' : '';?>>Vermelho</option>
                    <option value="blue" <?= isset($_REQUEST['cor']) && $_REQUEST['cor'] == 'blue' ? 'selected' : '';?>>Azul</option>
                    <option value="yellow" <?= isset($_REQUEST['cor']) && $_REQUEST['cor'] == 'yellow' ? 'selected' : '';?>>Amarelo</option>
                </select>
            </div>

            <label for="">Buscar por: </label>
            <div class="campo_busca">
                <input type="radio" id="nda" name="filter" value="0" <?= isset($_REQUEST['filter']) && $_REQUEST['filter'] == 0 || empty($_REQUEST['filter']) ? 'checked' : ''; ?>>
                <label for="">Nenhum</label>

                <input type="radio" id="nome" name="filter" value="1" <?=  isset($_REQUEST['filter']) && $_REQUEST['filter'] == 1 ? 'checked' : ''; ?>> 
                <label for="">Nome</label><br>
                
                <input type="radio" id="cor" name="filter" value="2" <?=  isset($_REQUEST['filter']) && $_REQUEST['filter'] == 2 ? 'checked' : ''; ?>>
                <label for="">Cor</label><br>
                
                <input type="radio" id="preco_filter" name="filter" value="3" <?=  isset($_REQUEST['filter']) && $_REQUEST['filter'] == 3 ? 'checked' : ''; ?>>
                <label for="">Preço</label>
            </div>
            
            <br>
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

            <br>
            
            <input class='button_filter' type="submit" value="Filtrar">
        </form>    
    </fieldset>

    <br>

    <a href="add.php">Adicionar Produto</a>

    <table border='1'>
        <thead>
            <tr>
                <th>Produtos</th>
                <th>Preços</th>
                <th>Cor</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($getProducts)) { ?>
                <?php foreach($getProducts as $values) { ?>
                    <tr>
                        <td><?= $values['nome']; ?></td>
                        <td>
                            <?php if($values['preco'] != NULL || $values['preco'] != 0.00) { ?>
                                R$ <?= number_format($values['preco'], 2, ',', '.');  ?>
                            <?php } ?>
                        </td>
                        <td class='<?= $values['cor']; ?>'></td>
                        <td>R$ <?= number_format($values['valor_desc'], 2, ',', '.'); ?></td>
                        <td>
                            <a href="edit.php?idprod=<?= $values['idprod']; ?>">[Editar]</a>
                            <a class='delete' data-idprod=<?= $values['idprod'];?>>[Excluir]</a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="5">Não há registros na tabela.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php include 'footer.php'; ?>
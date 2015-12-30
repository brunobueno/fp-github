<?php include_once "../templates/header.php"; include_once "../templates/menu.php";
/**
 * Created by PhpStorm.
 * User: BrunoWillian
 * Date: 21/12/2015
 * Time: 18:04
 */

require_once "../action/produtoAction.php";

?>

<!-- Coluna da esquerda -->
<div class="col-md-6 col-xs-12">
    <!-- Alerta -->
    <?php if(!empty($erro)) {?>
    <div class="bs-example bs-example-standalone" data-example-id="dismissible-alert-js">
        <div class="alert alert-<?=$tipoErro?> alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p class="text-center"><?=$erro?></p>
        </div>
    </div>
    <?php } ?>

    <!-- Form -->
    <form action="index.php" method="post">
        <input type="hidden" name="codigo" value="<?=$codigo?>">
        <label for="descricao">Descrição: </label>
        <input name="descricao" class="form-control" type="text" value="<?=$descricao?>"><br>
        <label for="unidade">Unidade:</label>
        <input name="unidade" class="form-control" type="text" value="<?=$unidade?>"><br>
        <label for="preco">Preço:</label>
        <input name="preco" class="form-control" type="text" value="<?=$preco?>"><br>
        <button type="submit" class="btn btn-success btn-block" name="cadastrar"><span class="glyphicon glyphicon-plus"></span></button>
    </form>
</div>

<!-- Coluna da direita -->
<div class="col-md-6 col-xs-12">
    <br>
    <p class="text-center"><strong>Registros</strong></p>
    <!-- Tabela -->
    <div class="table-responsive">
        <table class="table table-striped table-hover table-condensed">
            <thead>
                <th>Código:</th>
                <th>Descrição:</th>
                <th>Unidade:</th>
                <th>Preço:</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
            <?php
            $produto = new Produto();
            $dados = $produto->listar();
            foreach ($dados as $dado) { ?>
                <tr>
                    <td><?=$dado->produto_id?></td>
                    <td><?=$dado->descricao?></td>
                    <td><?=$dado->unidade?></td>
                    <td>R$ <?= number_format($dado->preco, 2, ',', '.')?></td>
                    <td>
                        <form action="index.php" method="post">
                            <input type="hidden" name="codigo" value="<?=$dado->produto_id?>">
                            <button type="submit" name="editar" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></button>
                        </form>
                    </td>
                    <td>
                        <form action="index.php" method="post">
                            <input type="hidden" name="codigo" value="<?=$dado->produto_id?>">
                            <button type="submit" name="excluir" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                        </form>
                    </td>
                </tr>
            <?php }
            ?>
            </tbody>
        </table>
    </div>
</div>


<?php include_once "../templates/footer.php";?>

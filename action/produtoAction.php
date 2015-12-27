<?php
require_once "../class/Produto.php";
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 26/12/2015
 * Time: 20:22
 */

$descricao = "";
$unidade = "";
$preco = "";

$erro = "";
$tipoErro = "";
$acao = "cadastrar";
$campos = "";

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $produtoInfo = array(
        "Descrição" => isset($_POST['descricao']) ? $_POST['descricao'] : "",
        "Unidade" => isset($_POST['unidade']) ? $_POST['unidade'] : "",
        "Preço" => isset($_POST['preco']) ? $_POST['preco'] : ""
    );

    foreach($produtoInfo as $info => $valor)
    {
        $campos = empty($valor) ? $campos . ", {$info}" : "";
        switch($info)
        {
            case "Descrição":
                $descricao = $valor;
                break;
            case "Unidade":
                $unidade = $valor;
                break;
            case "Preço":
                $preco = $valor;
                break;
        }
    }

    if(!empty($campos))
    {
        $erro = "Preencha os campos: ". substr($campos, 2, strlen($campos)).".";
        $tipoErro = empty($erro) ? "" : "danger";
    }

    /*
    if(empty($erro)) {
        $produto = new Produto();
        switch ($acao) {
            case "cadastrar":
                try {
                    $produto->descricao = $_POST['descricao'];
                    $produto->unidade = $_POST['unidade'];
                    $produto->preco = $_POST['preco'];
                    $produto->inserir();
                    $erro = "O produto {$produto->descricao} foi adicionado.";
                } catch (Exception $e) {
                    $erro = $e->getMessage();
                }
                break;
            case "editar":
                try {
                    $produto->codigo = $_POST['codigo'];
                    $produto->descricao = $_POST['descricao'];
                    $produto->unidade = $_POST['unidade'];
                    $produto->preco = $_POST['preco'];
                    $produto->atualizar();
                    $erro = "O produto foi atualizado.";
                } catch (Exception $e) {
                    $erro = $e->getMessage();
                }
                break;
            case "excluir":
                try {
                    $produto->codigo = $_POST['codigo'];
                    $produto->deletar();
                    $erro = "O produto foi deletado.";
                } catch (Exception $e) {
                    $erro = $e->getMessage();
                }
                break;
        }
    }
    */
}
?>

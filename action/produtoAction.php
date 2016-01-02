<?php
require_once "../class/Produto.php";
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 26/12/2015
 * Time: 20:22
 */

$codigo = "";
$descricao = "";
$unidade = "";
$preco = "";

$erro = "";
$tipoErro = "";
$campos = "";

$produto = new Produto();

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $codigo = isset($_POST['codigo']) ? trim($_POST['codigo']) : "";
    $descricao = isset($_POST['descricao']) ? trim($_POST['descricao']) : "";
    $unidade = isset($_POST['unidade']) ? trim($_POST['unidade']) : "";
    $preco = isset($_POST['preco']) ? trim($_POST['preco']) : "";

    switch (isset($_POST))
    {
        case isset($_POST['cadastrar']):

            if(empty($descricao))
            {
                $campos = ", Descrição";
            }
            if(empty($unidade))
            {
                $campos = $campos.", Unidade";
            }
            if(empty($preco))
            {
                $campos = $campos.", Preço";
            }

            if(!empty($campos))
            {
                $erro = "Preencha os campos: ". substr($campos, 2, strlen($campos)).".";
                $tipoErro = empty($erro) ? "" : "danger";
            }
            else
            {
                try {
                    $produto->descricao = $_POST['descricao'];
                    $produto->unidade = $_POST['unidade'];
                    $produto->preco = str_replace(',', '.', $_POST['preco']);;
                    if(!empty($codigo))
                    {
                        $produto->codigo = $codigo;
                        $produto->atualizar();
                        $produtoAt = $produto->listarId();
                        $erro = "O produto {$produto->descricao} foi alterado.";
                    }
                    else
                    {
                        $produto->inserir();
                        $erro = "O produto {$produto->descricao} foi adicionado.";
                    }
                    $tipoErro = "success";
                } catch (Exception $e)
                {
                    $erro = $e->getMessage();
                }
                finally
                {
                    $codigo = "";
                    $descricao = "";
                    $unidade = "";
                    $preco = "";
                }
            }
            break;
        //Atribuir os valores do produto clicado na tabela para o form.
        case isset($_POST['editar']):
            $codigo = $produto->codigo = $codigo;
            $prod = $produto->listarId();
            $descricao = $prod->descricao;
            $unidade = $prod->unidade;
            $preco = $prod->preco;
            break;
        case isset($_POST['excluir']):
            try
            {
                $produto->codigo = $codigo;
                $produto->deletar();
                $erro = "O produto foi deletado.";
                $tipoErro = "success";
            } catch (Exception $e) {
                $erro = $e->getMessage();
            }
            break;
    }
}
?>



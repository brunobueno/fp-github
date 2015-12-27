<?php
require_once "../class/Produto.php";
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 26/12/2015
 * Time: 20:22
 */
    $erro = "";
    $tipoErro = "";
    $acao = "cadastrar";

    if($_SERVER['REQUEST_METHOD'] == $_POST)
    {
        $post = $_POST;
        $produtoInfo = array($post['descricao'], $post['unidade'], $post['preco']);

        foreach($produtoInfo as $info)
        {
            $erro = empty($info) ? "Preencha o campo {$info}" : "";
            $tipoErro = empty($erro) ? "" : "danger";
        }

        if(empty($erro))
        {
            $produto = new Produto();
            switch ($acao)
            {
                case "cadastrar":
                    try
                    {
                        $produto->descricao = $_POST['descricao'];
                        $produto->unidade = $_POST['unidade'];
                        $produto->preco = $_POST['preco'];
                        $produto->inserir();
                        $erro = "O produto {$produto->descricao} foi adicionado.";
                    }
                    catch(Exception $e)
                    {
                        $erro = $e->getMessage();
                    }
                    break;
                case "editar":
                    try
                    {
                        $produto->codigo = $_POST['codigo'];
                        $produto->descricao = $_POST['descricao'];
                        $produto->unidade = $_POST['unidade'];
                        $produto->preco = $_POST['preco'];
                        $produto->atualizar();
                        $erro = "O produto foi atualizado.";
                    }
                    catch(Exception $e)
                    {
                        $erro = $e->getMessage();
                    }
                    break;
                case "excluir":
                    try
                    {
                        $produto->codigo = $_POST['codigo'];
                        $produto->deletar();
                        $erro = "O produto foi deletado.";
                    }
                    catch(Exception $e)
                    {
                        $erro = $e->getMessage();
                    }
                    break;
            }
        }
    }
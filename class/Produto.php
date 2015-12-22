<?php

/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 21/12/2015
 * Time: 22:29
 */
class Produto
{
    public $codigo;
    public $descricao;
    public $unidade;
    public $preco;

    public function inserir()
    {
        try
        {
            $con = Conexao::conectar();
            $stmt = $con->prepare("INSERT INTO produto (descricao, unidade, preco) VALUES (?, ?, ?)");
            $stmt->bindParam(1, $this->descricao);
            $stmt->bindParam(2, $this->unidade);
            $stmt->bindParam(3, $this->preco);
            $stmt->execute();
        }
        catch(PDOException $e)
        {
            echo "Erro: {$e->getMessage()}";
        }
    }
}
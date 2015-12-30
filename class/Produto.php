<?php
require_once 'Conexao.php';
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

    public function atualizar()
    {
        $con = Conexao::conectar();
        $stmt = $con->prepare("UPDATE produto SET descricao = ?, unidade = ?, preco = ? WHERE produto_id = ?");
        $stmt->bindParam(1, $this->descricao);
        $stmt->bindParam(2, $this->unidade);
        $stmt->bindParam(3, $this->preco);
        $stmt->bindParam(4, $this->codigo);
        $stmt->execute();
    }

    public function deletar()
    {
        $con = Conexao::conectar();
        $stmt = $con->prepare("DELETE FROM produto WHERE produto_id = ?");
        $stmt->bindParam(1, $this->codigo);
        $stmt->execute();
    }

    public function listar()
    {
        $con = Conexao::conectar();
        $stmt = $con->prepare("SELECT * FROM produto");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function listarId()
    {
        $con = Conexao::conectar();
        $stmt = $con->prepare("SELECT * FROM produto WHERE produto_id = ?");
        $stmt->bindParam(1, $this->codigo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
<?php

use Especialidade as GlobalEspecialidade;

class RepoEspecialidade{

    public function __construct(){
        $this->db = Db::getInstance();
    }


    public function listar($dadosConsulta){
        $sql =" SELECT * FROM especialidade ";
        $sql.=" WHERE ";
        $sql.=" id IS NOT NULL ";
        if(isset($dadosConsulta["id"])){
            $sql.=" AND id = ".$dadosConsulta["id"]." ";
        }
        if(isset($dadosConsulta["especialidade"])){
            $sql.=" AND idespecialidade = '".$dadosConsulta["especialidade"]."' ";
        }
        return Db::getInstance()->select($sql);
    }

    public function salvar(Especialidade $obj){
        $sql =" Insert into idespecialidade (";
        $sql.=" descricao,";
        $sql.=" )values( ";
        $sql.= "'".$obj->getDescricao()."', ";
        $sql.=" ) ";        
        return Db::getInstance()->executar($sql);
    }


    public function alterar(Especialidade $obj){
        $sql =" UPDATE especialidade SET ";
        $sql.=" descricao = '".$obj->getDescricao()."',";
              
        $sql.=" WHERE id = ".$obj->getId()." ";          
        return Db::getInstance()->executar($sql);
    }



}









?>
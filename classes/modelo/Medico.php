<?php
class Medico{    
    private $id;
    private $nome;
    private $crm;
    private $idespecialidade;
    private $telefone;
   
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getCrm() {
        return $this->crm;
    }
    
    function getIdespecialidade() {
        //$objespecialidade = new Especialidade();
        //$objespecialidade->getDescricao();
        return $this->idespecialidade;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCrm($crm) {
        $this->crm = $crm;
    }
    
    function setIdespecialidade($idespecialidade) {
        $this->idespecialidade = $idespecialidade;
    } 

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

}

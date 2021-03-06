<?php

class NegMedico {
    public function __construct(){}
    
    public function salvarMedico($dadosPost){
        $obj = $this->factory($dadosPost);
        $objRepoMedico = new RepoMedico();
        return $objRepoMedico->salvar($obj);
    }
    
    public function alterarMedico($dadosPost){
        $obj = $this->factory($dadosPost);
        $objRepoMedico = new RepoMedico();
        return $objRepoMedico->alterar($obj);
    }

    public function excluirMedico($dadosPost){
        $obj = $this->factory($dadosPost);
        $objRepoMedico = new RepoMedico();
        return $objRepoMedico->excluir($obj);
    }
    
    private function factory($dados){
        $objMedico = new Medico();
        if(isset($dados["id"])){
            $objMedico->setId($dados["id"]);
        }
        if(isset($dados["nome"])){
            $objMedico->setNome($dados["nome"]);
        }
        if(isset($dados["crm"])){
            $objMedico->setCrm($dados["crm"]);
        }
        if(isset($dados["idespecialidade"])){
            $objMedico->setIdespecialidade($dados["idespecialidade"]);
        }
        if(isset($dados["telefone"])){
            $objMedico->setTelefone($dados["telefone"]);
        }        
        return $objMedico;
    }
    
    private function consultarMedico($dadosFiltro) {
        $dadosFiltroConsulta = $this->trataConsulta($dadosFiltro);        
        $objRepoMedico = new RepoMedico();
        $arrDadosMedico = $objRepoMedico->listar($dadosFiltroConsulta);         
        $listaObjMedico=null;
        if($arrDadosMedico>0){
            foreach ($arrDadosMedico as $dadoMedico) {
                $listaObjMedico[] = $this->factory($dadoMedico);
            }
        }
        return $listaObjMedico;
    }
    
    public function listarMedico($dadosFiltro){        
        $listaMedico = $this->consultarMedico($dadosFiltro);        
        $htmlRetorno = '<table class="table table-striped">';
            $htmlRetorno .= '<thead>';
                $htmlRetorno .= '<tr>';
                    $htmlRetorno .= '<th>ID</th>';
                    $htmlRetorno .= '<th>Nome</th>';
                    $htmlRetorno .= '<th>CRM</th>';
                    $htmlRetorno .= '<th>Especialidade</th>';
                    $htmlRetorno .= '<th>Telefone</th>';
                    $htmlRetorno .= '<th>A????o</th>';
                $htmlRetorno .= '</tr>';
            $htmlRetorno .= '</thead>';
            $htmlRetorno .= '<tbody>';
        
            if($listaMedico!=null ){
                foreach ($listaMedico as $objMedico) {
                    $htmlRetorno .= '<tr>';
                        $htmlRetorno .= '<td>';
                            $htmlRetorno .= $objMedico->getId();                    
                        $htmlRetorno .= '</td>';
                        $htmlRetorno .= '<td>';
                            $htmlRetorno .= $objMedico->getNome();                    
                        $htmlRetorno .= '</td>';
                        $htmlRetorno .= '<td>';
                            $htmlRetorno .= $objMedico->getCrm();                    
                        $htmlRetorno .= '</td>';
                        $htmlRetorno .= '<td>';
                            $htmlRetorno .= $objMedico->getIdespecialidade();                    
                        $htmlRetorno .= '</td>';
                        $htmlRetorno .= '<td>';
                            $htmlRetorno .= $objMedico->getTelefone();                    
                        $htmlRetorno .= '</td>';
                        $htmlRetorno .= '<td>';
                            $htmlRetorno .= ' <button class="btn btn-warning" type="button" onclick="editar('.$objMedico->getId().');" >Editar</button>';
                            $htmlRetorno .= ' <button class="btn btn-danger " type="button" onclick="Excluir('.$objMedico->getId().');">Excluir</button>';
                        $htmlRetorno .= '</td>';

                    $htmlRetorno .= '</tr>';
                }
            }else{
                $htmlRetorno .= '<tr>';
                    $htmlRetorno .= '<td colspan="6">Nenhum m??dico encontrado!</td>';            
                $htmlRetorno .= '</tr>';
            }
            $htmlRetorno .= '</tbody>';
        $htmlRetorno .= '</table>';
        return $htmlRetorno;
    }
    
    private function trataConsulta($dadosFiltro){
        $dadosFiltroConsulta=null;
        if(isset($dadosFiltro["id"])){
            if($dadosFiltro["id"]>0){
                $dadosFiltroConsulta["id"] = $dadosFiltro["id"];
            }
        }
        if(isset($dadosFiltro["nome"])){
            if(strlen(trim($dadosFiltro["nome"]))>0){
                $dadosFiltroConsulta["nome"] = trim($dadosFiltro["nome"]);
            }
        }
        if(isset($dadosFiltro["crm"])){
            if(strlen(trim($dadosFiltro["crm"]))>0){
                $dadosFiltroConsulta["crm"] = trim($dadosFiltro["crm"]);
            }
        }
        if(isset($dadosFiltro["idespecialidade"])){
            if(strlen(trim($dadosFiltro["idespecialidade"]))>0){
                $dadosFiltroConsulta["idespecialidade"] = trim($dadosFiltro["idespecialidade"]);
            }
        }
        if(isset($dadosFiltro["telefone"])){
            if(strlen(trim($dadosFiltro["telefone"]))>0){
                $dadosFiltroConsulta["telefone"] = trim($dadosFiltro["telefone"]);
            }
        }
        return $dadosFiltroConsulta;
    }
    
    public function consultaMedicoEdicao($dadosFiltro){
        $listaMedico = $this->consultarMedico($dadosFiltro); 
        if($listaMedico!=null){
            $objMedico = $listaMedico[0];
            return json_encode(array(
                'id' => $objMedico->getId(),
                'nome' => $objMedico->getNome(),
                'crm' => $objMedico->getCrm(),
                'idespecialidade' => $objMedico->getIdespecialidade(),
                'telefone' => $objMedico->getTelefone()                
            ));
        }else{
            return null;
        }        
    } 
}
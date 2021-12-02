<?php 
    class NegEspecialidade{

        private function factory($dados){
            $objEspecialidade = new Especialidade();
            if(isset($dados["id"])){
                $objEspecialidade->setId($dados["id"]);
            }
            if(isset($dados["descricao"])){
                $objEspecialidade->setDescricao($dados["descricao"]);
            }
            
            return $objEspecialidade;
        }

        private function consultarMedico($dadosFiltro) {
            $dadosFiltroConsulta = $this->trataConsulta($dadosFiltro);        
            $objRepoEspecialidade = new RepoEspecialidade();
            $arrDadosEspecialidade = $objRepoEspecialidade->listar($dadosFiltroConsulta);         
            $listaObjEspecialidade=null;
            if($arrDadosEspecialidade>0){
                foreach ($arrDadosEspecialidade as $dadoMedico) {
                    $listaObjMedico[] = $this->factory($dadoMedico);
                }
            }
            return $listaObjMedico;
        }
        
        public function listarMedico($dadosFiltro){      
            $listaEspecialidade = $this->consultarMedico($dadosFiltro);
            foreach($listaEspecialidade as $objlista){  
            $htmlRetorno = $objlista->getIdespecialidade();
        }
            return $htmlRetorno;
        }
        
        private function trataConsulta($dadosFiltro){
            $dadosFiltroConsulta=null;
            if(isset($dadosFiltro["id"])){
                if($dadosFiltro["id"]>0){
                    $dadosFiltroConsulta["id"] = $dadosFiltro["id"];
                }
            }
            if(isset($dadosFiltro["descricao"])){
                if(strlen(trim($dadosFiltro["descricao"]))>0){
                    $dadosFiltroConsulta["descricao"] = trim($dadosFiltro["descricao"]);
                }
            }
            
            return $dadosFiltroConsulta;
        }
    }

?>
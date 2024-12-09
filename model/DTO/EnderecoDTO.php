<?php

    class EnderecoDTO{
        private $id_endereco;
        private $cep;
        private $estado;
        private $cidade;
        private $bairro;
        private $rua;
        private $casa;
        private $referencia;

        public function setIdEndereco($id_endereco){
            $this->id_endereco = $id_endereco;
        }
        public function getIdEndereco(){
            return $this->id_endereco;
        }
    
        
        public function setCep($cep){
            $this->cep = $cep;
        }
        public function getCep(){
            return $this->cep;
        }
    
        
        public function setEstado($estado){
            $this->estado = $estado;
        }
        public function getEstado(){
            return $this->estado;
        }
        
        
        public function setCidade($cidade){
            $this->cidade = $cidade;
        }
        public function getCidade(){
            return $this->cidade;
        }
    
        
        public function setBairro($bairro){
            $this->bairro = $bairro;
        }
        public function getBairro(){
            return $this->bairro;
        }


        public function setRua($rua){
            $this->rua = $rua;
        }
        public function getRua(){
            return $this->rua;
        }
    
        
        public function setCasa($casa){
            $this->casa = $casa;
        }
        public function getCasa(){
            return $this->casa;
        }


        public function setReferencia($referencia){
            $this->referencia = $referencia;
        }
        public function getReferencia(){
            return $this->referencia;
        }
    
        
    }
    


?>
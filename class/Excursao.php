<?php

class Excursao {
    private $titulo_excursao;
    private $desc_excursao;
    private $valor_excursao;
    private $data_excursao_ida;
    private $data_excursao_volta;
    private $excursao_valida;
    private $intro_excursao;

    
    public function getTitulo_excursao() {
        return $this->titulo_excursao;
    }
    public function getDesc_excursao() {
        return $this->desc_excursao;
    }
    public function getValor_excursao() {
        return $this->valor_excursao;
    }
    public function getData_excrusao_ida() {
        return $this->data_excursao_ida;
    }
    public function getData_excrusao_volta() {
        return $this->data_excursao_volta;
    }
    public function getExcursao_valida():bool {
        return $this->excursao_valida;
    }
    public function getIntro_excursao(){
        return $this->intro_excursao;
    }
    public function setTitulo_excursao($titulo_excursao) {
        $this->titulo_excursao = $titulo_excursao;
    }
    public function setDesc_excursao($desc_excursao) {
        $this->desc_excursao = $desc_excursao;
    }
    public function setValor_excursao($valor_excursao) {
        $this->valor_excursao = $valor_excursao;
    }
    public function setData_excursao_ida($data_excursao_ida) {
        $this->data_excursao_ida = $data_excursao_ida;
    }
    public function setData_excursao_volta($data_excursao_volta) {
        $this->data_excursao_volta = $data_excursao_volta;
    }
    public function setExcursao_valida($excursao_valida) {
        $this->excursao_valida = $excursao_valida;
    }
    public function setIntro_excursao($intro_excursao) {
        $this->intro_excursao = $intro_excursao;
    }

}

?>
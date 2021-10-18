<?php

class Cliente {

    private $nome_cliente;
    private $tel_cliente;
    private $email_cliente;
    private $cpf_cliente;
    private $rg_cliente;
    private $end_cliente;
    private $data_nasc;

    public function getNome_cliente() {
        return $this->nome_cliente;
    }
    public function getTel_cliente() {
        return $this->tel_cliente;
    }
    public function getEmail_cliente() {
        return $this->email_cliente;
    }
    public function getCpf_cliente() {
        return $this->cpf_cliente;
    }
    public function getRg_cliente() {
        return $this->rg_cliente;
    }
    public function getEnd_cliente() {
        return $this->end_cliente;
    }
    public function getData_nasc() {
        return $this->data_nasc;
    }
    public function setNome_cliente($nome_cliente) {
        return $this->nome_cliente = $nome_cliente;
    }
    public function setTel_cliente($tel_cliente) {
        return $this->tel_cliente = $tel_cliente;
    }
    public function setEmail_cliente($email_cliente) {
        return $this->email_cliente = $email_cliente;
    }
    public function setCpf_cliente($cpf_cliente) {
        return $this->cpf_cliente = $cpf_cliente;
    }
    public function setRg_cliente($rg_cliente) {
        return $this->rg_cliente = $rg_cliente;
    }
    public function setEnd_cliente($end_cliente) {
        return $this->end_cliente = $end_cliente;
    }
    public function setData_nasc($data_nasc) {
        return $this->data_nasc = $data_nasc;
    }
}

?>
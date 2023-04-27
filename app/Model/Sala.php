<?php

class Sala {
    private $id;
    private $id_user;
    private $sala;
    private $status;
    private $data_ultima_alteracao;
    private $user;
    private $id_sala;    
    private $inicio;
    private $fim;
    private $setor;

    public function set_id($id) {
        $this->id = $id;
    }
    
    public function get_id() {
        return $this->id;
    }
    
    public function set_setor($setor) {
        $this->setor = $setor;
    }
    
    public function get_setor() {
        return $this->setor;
    }
    
    public function set_id_user($id_user) {
        $this->id_user = $id_user;
    }
    
    public function get_id_user() {
        return $this->id_user;
    }
    
    public function set_sala($sala) {
        $this->sala = $sala;
    }
    
    public function get_sala() {
        return $this->sala;
    }
    
    public function set_status($status) {
        $this->status = $status;
    }
    
    public function get_status() {
        return $this->status;
    }
    
    public function set_data_ultima_alteracao($data_ultima_alteracao) {
        $this->data_ultima_alteracao = $data_ultima_alteracao;
    }
    
    public function get_data_ultima_alteracao() {
        return $this->data_ultima_alteracao;
    }
    
    public function set_user($user) {
        $this->user = $user;
    }
    
    public function get_user() {
        return $this->user;
    }
    
    public function set_id_sala($id_sala) {
        $this->id_sala = $id_sala;
    }
    
    public function get_id_sala() {
        return $this->id_sala;
    }
    
    public function set_inicio($inicio) {
        $this->inicio = $inicio;
    }
    
    public function get_inicio() {
        return $this->inicio;
    }
    
    public function set_fim($fim) {
        $this->fim = $fim;
    }
    
    public function get_fim() {
        return $this->fim;
    }
}
<?php

class Usuario {

    private $id;
    private $login;
    private $pass;
    private $nome_extenso;
    private $id_setor;
    private $admin;
    private $status;

    public function set_id($id) {
        $this->id = $id;
    }

    public function get_id() {
        return $this->id;
    }

    public function set_login($login) {
        $this->login = $login;
    }

    public function get_login() {
        return $this->login;
    }

    public function set_pass($pass) {
        $this->pass = $pass;
    }

    public function get_pass() {
        return $this->pass;
    }

    public function set_nome_extenso($nome_extenso) {
        $this->nome_extenso = $nome_extenso;
    }

    public function get_nome_extenso() {
        return $this->nome_extenso;
    }

    public function set_id_setor($id_setor) {
        $this->id_setor = $id_setor;
    }

    public function get_id_setor() {
        return $this->id_setor;
    }

    public function set_admin($admin) {
        $this->admin = $admin;
    }

    public function get_admin() {
        return $this->admin;
    }

    public function set_status($status) {
        $this->status = $status;
    }

    public function get_status() {
        return $this->status;
    }
}
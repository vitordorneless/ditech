<?php

class Queries {

    public function usuarios_listar() {
        $sql = "select id,nome_extenso,id_setor,admin,status from usuarios where status in (1) order by nome_extenso asc, id_setor asc";
        return $sql;
    }

    public function usuarios_setor($id) {
        $sql = "select id,setor from usuarios_setores where id = " . $id;
        return $sql;
    }

    public function pega_nome_funcionario($id) {
        $sql = "select nome_extenso from usuarios where id = " . $id;
        return $sql;
    }

    public function pega_sala($id) {
        $sql = "select sala from salas where id = " . $id;
        return $sql;
    }

    public function listar_setor() {
        $sql = "select id,setor from usuarios_setores order by setor" . $id;
        return $sql;
    }

    public function salas_listar() {
        $sql = "select id,sala,status from salas where status in (1) order by sala asc";
        return $sql;
    }

    public function salas_listar_reunioes() {
        $sql = "select id,id_user,id_sala,inicio,fim,status from salas_reserva where status in (1) order by inicio asc";
        return $sql;
    }

    public function salas_listar_reunioes_id($id) {
        $sql = "select id,id_user,id_sala,inicio,fim,status from salas_reserva where id_user = " . $id . " order by inicio asc";
        return $sql;
    }

    public function listar_inicio() {
        $sql = "select id,horario from horarios where id not in (13) order by horario asc";
        return $sql;
    }

    public function pegar_inicio($id) {
        $sql = "select horario from horarios where id in (" . $id . ") order by horario asc";
        return $sql;
    }

    public function marcar_mesmo_horario($id_horario, $id_user,$id_sala) {
        $sql = "select count(id) as temos from salas_reserva where id_sala = ".$id_sala." and id_user = " . $id_user . " and inicio = '" . $id_horario . ":00" . "'";
        return $sql;
    }
    
    public function marcar_mesmo_horario_salas($id_horario, $id_sala) {
        $sql = "select count(id) as temos from salas_reserva where id_sala = ".$id_sala." and inicio = '" . $id_horario . ":00" . "'";
        return $sql;
    }

    public function marcar_mesmo_horario_sala($id_horario, $id_sala) {
        $sql = "select count(id) as temos,id_user,inicio,fim,status from salas_reserva where id_sala = " . $id_sala . " and inicio = '" . $id_horario . ":00" . "'";
        return $sql;
    }
}

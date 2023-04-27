<?php
class Reuniao extends Sala {
    public function save($id_user,$id_sala,$inicio,$fim) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO salas_reserva(id_user,id_sala,inicio,fim,status,data_ultima_alteracao) VALUES(?,?,?,?,?,?)");
        $smtp->bindParam(1, $id_user, PDO::PARAM_INT);
        $smtp->bindParam(2, $id_sala, PDO::PARAM_INT);        
        $smtp->bindParam(3, $inicio, PDO::PARAM_STR);
        $smtp->bindParam(4, $fim, PDO::PARAM_STR);
        $smtp->bindParam(5, $status, PDO::PARAM_INT);
        $smtp->bindParam(6, $data_ultima_alteracao, PDO::PARAM_STR);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit($id, $id_user,$id_sala,$inicio,$fim,$status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("UPDATE salas_reserva SET id_user = ?,id_sala = ?, inicio = ?,fim = ?,status = ?,data_ultima_alteracao = ? WHERE id = ?");
        $smtp->bindParam(1, $id_user, PDO::PARAM_INT);
        $smtp->bindParam(2, $id_sala, PDO::PARAM_INT);        
        $smtp->bindParam(3, $inicio, PDO::PARAM_STR);
        $smtp->bindParam(4, $fim, PDO::PARAM_STR);
        $smtp->bindParam(5, $status, PDO::PARAM_INT);
        $smtp->bindParam(6, $data_ultima_alteracao, PDO::PARAM_STR);
        $smtp->bindParam(7, $id, PDO::PARAM_INT);
        $confirm = $smtp->execute();
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }
    
    public function delete($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $smtp = $pdo->prepare("DELETE FROM salas_reserva WHERE id = ?");
        $smtp->bindParam(1, $id, PDO::PARAM_INT);
        $confirm = $smtp->execute();
        Database::disconnect();
        $delete = $confirm == TRUE ? TRUE : FALSE;
        return $delete;        
    }

    public function Dados($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,id_user,id_sala,inicio,fim,status,data_ultima_alteracao from salas_reserva where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Dados_existe($sala) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as temos from salas_reserva where sala = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($sala));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $temos = $data['temos'] < 1 ? true : false;
        return $temos;
    }
}
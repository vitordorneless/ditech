<?php

class Salas extends Sala {
    public function saveSala($sala,$user) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO salas(sala,status,data_ultima_alteracao,user) VALUES(?,?,?,?)");
        $smtp->bindParam(1, $sala, PDO::PARAM_STR);        
        $smtp->bindParam(2, $status, PDO::PARAM_INT);
        $smtp->bindParam(3, $data_ultima_alteracao, PDO::PARAM_STR);
        $smtp->bindParam(4, $user, PDO::PARAM_INT);
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_Sala($id, $sala,$user,$status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("UPDATE salas SET sala = ?,status = ?,data_ultima_alteracao = ?,user = ? WHERE id = ?");
        $smtp->bindParam(1, $sala, PDO::PARAM_STR);        
        $smtp->bindParam(2, $status, PDO::PARAM_INT);
        $smtp->bindParam(3, $data_ultima_alteracao, PDO::PARAM_STR);
        $smtp->bindParam(4, $user, PDO::PARAM_INT);
        $smtp->bindParam(5, $id, PDO::PARAM_INT);
        $confirm = $smtp->execute();
        Database::disconnect();
        $edit = $confirm == TRUE ? TRUE : FALSE;
        return $edit;
    }

    public function Dados_Sala($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,sala,status,data_ultima_alteracao,user from salas where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Dados_Sala_existe($sala) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as temos from salas where sala = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($sala));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $temos = $data['temos'] < 1 ? true : false;
        return $temos;
    }
}

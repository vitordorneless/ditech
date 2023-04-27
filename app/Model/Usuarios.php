<?php

class Usuarios extends Usuario {

    public function saveUser($login, $pass, $nome_extenso, $id_setor, $admin) {
        include_once '../config/database_mysql.php';
        $status = 1;
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("INSERT INTO usuarios(login,pass,nome_extenso,id_setor,admin,status,data_ultima_alteracao) VALUES(?,?,?,?,?,?,?)");
        $smtp->bindParam(1, $login, PDO::PARAM_STR);
        $smtp->bindParam(2, $pass, PDO::PARAM_STR);
        $smtp->bindParam(3, $nome_extenso, PDO::PARAM_STR);
        $smtp->bindParam(4, $id_setor, PDO::PARAM_INT);
        $smtp->bindParam(5, $admin, PDO::PARAM_INT);
        $smtp->bindParam(6, $status, PDO::PARAM_INT);
        $smtp->bindParam(7, $data_ultima_alteracao, PDO::PARAM_STR);        
        $confirm = $smtp->execute();
        Database::disconnect();
        $save = $confirm == TRUE ? TRUE : FALSE;
        return $save;
    }

    public function edit_User($id, $login, $pass, $nome_extenso, $id_setor, $admin,$status) {
        include_once '../config/database_mysql.php';
        $data_ultima_alteracao = date('Y-m-d H:i:s');
        $pdo = Database::connect();
        $smtp = $pdo->prepare("UPDATE usuarios SET login = ?,pass = ?,nome_extenso = ?,id_setor = ?,admin = ?,status = ?,data_ultima_alteracao = ? WHERE id = ?");
        $smtp->bindParam(1, $login, PDO::PARAM_STR);
        $smtp->bindParam(2, $pass, PDO::PARAM_STR);
        $smtp->bindParam(3, $nome_extenso, PDO::PARAM_STR);
        $smtp->bindParam(4, $id_setor, PDO::PARAM_INT);
        $smtp->bindParam(5, $admin, PDO::PARAM_INT);
        $smtp->bindParam(6, $status, PDO::PARAM_INT);
        $smtp->bindParam(7, $data_ultima_alteracao, PDO::PARAM_STR);
        $smtp->bindParam(8, $id, PDO::PARAM_INT);
        $confirm = $smtp->execute();
        Database::disconnect();
        $editUser = $confirm == TRUE ? TRUE : FALSE;
        return $editUser;
    }

    public function Dados_User($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select id,login,pass,nome_extenso,id_setor,admin,status,data_ultima_alteracao from usuarios where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Dados_User_setor($id) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select setor from usuarios_setores where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }
    
    public function Dados_User_existe($login) {
        include_once '../config/database_mysql.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select count(id) as temos from usuarios where login = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($login));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $temos = $data['temos'] < 1 ? true : false;
        return $temos;
    }
}
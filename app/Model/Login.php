<?php
class Login extends Usuario {
    public function Logar($user, $pass) {
        include_once '../config/database_mysql.php';;        
        $logue = new Usuario();        
        $logue->set_login($user);
        $logue->set_pass($pass);
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT COUNT(id) AS contar, id, login,nome_extenso, id_setor,admin FROM usuarios where status in (1) and login = ? AND pass = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($logue->get_login(), $logue->get_pass()));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $logando = $data['contar'] == 1 ? TRUE : FALSE;        
        session_start();
        $_SESSION['user'] = $logue->get_login();
        $_SESSION['user_id'] = $data['id'];        
        $_SESSION['setor'] = $data['id_setor'];
        $_SESSION['admin'] = $data['admin'];        
        $_SESSION['nome_extenso'] = $data['nome_extenso'];        
        Database::disconnect();
        return $logando;
    }          
}
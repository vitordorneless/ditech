<?php
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
include '../class/alertas.php';
$logar = new Login();
$logar->set_nome_extenso(filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING));
$logar->set_pass(filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING));
$confirm = $logar->Logar($logar->get_nome_extenso(), $logar->get_pass());
$logou = $confirm == TRUE ? TRUE : FALSE;
if ($logou === TRUE) {    
    $caminho1 = "../View/index.php";    
    echo "<script type='text/javascript'>";        
        echo "window.location.href='$caminho1';";
    echo "</script>"; 
}  else {
    $msg = "Erro, Usu\u00e1rio ou senha inv\u00e1lidos, tente novamente!!";
    $caminho = "../../index.html";
    alerta($msg, $caminho);
}
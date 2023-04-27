<?php
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$user = new Usuarios();
$user->set_login(filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING));
$user->set_pass(filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING));
$user->set_nome_extenso(filter_input(INPUT_POST, 'nome_extenso', FILTER_SANITIZE_STRING));
$user->set_id_setor(filter_input(INPUT_POST, 'id_setor', FILTER_SANITIZE_NUMBER_INT));
$user->set_admin(filter_input(INPUT_POST, 'admin', FILTER_SANITIZE_NUMBER_INT));
$user->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$user->set_status(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT));
$confirm = $user->edit_User($user->get_id(), $user->get_login(), $user->get_pass(), $user->get_nome_extenso(), $user->get_id_setor(), $user->get_admin(), $user->get_status());
if ($confirm === TRUE) {
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Editado com Sucesso!!</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI...</div>';
}
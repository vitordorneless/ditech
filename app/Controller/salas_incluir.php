<?php
function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$sala = new Salas();
$sala->set_sala(filter_input(INPUT_POST, 'sala', FILTER_SANITIZE_STRING));
$sala->set_user(filter_input(INPUT_POST, 'user', FILTER_SANITIZE_NUMBER_INT));
$temos = $sala->Dados_Sala_existe($sala->get_sala());
if ($temos === TRUE) {
    $confirm = $sala->saveSala($sala->get_sala(), $sala->get_user());
    if ($confirm === TRUE) {
        echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Gravado com Sucesso!!</div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI...</div>';
    }
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Sala já existe...</div>';
}
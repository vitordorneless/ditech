<?php

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}

include '../config/database_mysql.php';
$pdo = Database::connect();
$querie = new Queries();
$sala = new Reuniao();
$sala->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$sala->set_status(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT));

if ($sala->get_status() === '0') {
    $confirm = $sala->delete($sala->get_id());
    if ($confirm === TRUE) {
        echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Cancelado com Sucesso!!</div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI...</div>';
    }
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Sala Não Cancelada...</div>';
}
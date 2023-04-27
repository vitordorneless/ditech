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
$sala->set_id_user(filter_input(INPUT_POST, 'id_user', FILTER_SANITIZE_NUMBER_INT));
$sala->set_id_sala(filter_input(INPUT_POST, 'id_sala', FILTER_SANITIZE_NUMBER_INT));
$sala->set_inicio(filter_input(INPUT_POST, 'inicio', FILTER_SANITIZE_NUMBER_INT));
$qq = $pdo->prepare($querie->pegar_inicio(bcadd($sala->get_inicio(), 1)));
$qq->execute();
$horario = $qq->fetch(PDO::FETCH_ASSOC);
$qqq = $pdo->prepare($querie->pegar_inicio($sala->get_inicio()));
$qqq->execute();
$horarios_inicio = $qqq->fetch(PDO::FETCH_ASSOC);

//Um usuário não pode reservar mais de 1 sala no mesmo período
//1 sala não pode estar reservado por mais de 1 usuário no mesmo período,simultaneamente.
//As reservas de salas tem duração de 1 hora, ou seja, posso reservar a sala as 14:00, e ela estará “bloqueada” para reserva até o próximo horário 15:00.
$qqqq = $pdo->prepare($querie->marcar_mesmo_horario($horarios_inicio['horario'], $sala->get_id_user(), $sala->get_id_sala()));
$qqqq->execute();
$mesmo_horario = $qqqq->fetch(PDO::FETCH_ASSOC);

if ($mesmo_horario['temos'] < 1) {
    $qqqqs = $pdo->prepare($querie->marcar_mesmo_horario_salas($horarios_inicio['horario'], $sala->get_id_sala()));
    $qqqqs->execute();
    $mesmo_sala = $qqqqs->fetch(PDO::FETCH_ASSOC);

    if ($mesmo_sala['temos'] < 1) {
        $confirm = $sala->save($sala->get_id_user(), $sala->get_id_sala(), $horarios_inicio['horario'] . ':00', $horario['horario'] . ':00');
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
Erro!! Esta Sala tem reunião nesse horário...</div>';
    }
} else {
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Você já tem reunião nesse horário e nessa Sala...</div>';
}
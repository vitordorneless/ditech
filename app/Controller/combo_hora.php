<?php

include '../config/database_mysql.php';

$inicio = filter_input(INPUT_GET, 'inicio', FILTER_SANITIZE_NUMBER_INT);

$pdo = Database::connect();
$sql = "select horario from horarios where id = " . bcadd($inicio,1) . " order by horario asc";
$qq = $pdo->prepare($sql);
$qq->execute();
$fim = $qq->fetch(PDO::FETCH_ASSOC);
echo '<option value="na">'.$fim['horario'].'</option>';
Database::disconnect();

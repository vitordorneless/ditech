<?php
session_start();
if ($_SESSION["user_id"] == NULL) {
    session_destroy();
    header("Location:../../index.html");
}
include '../config/database_mysql.php';
$pdo = Database::connect();

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}

$querie = new Queries();
?>
<div id="refresca">
    <script src="../js/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
    <link rel="stylesheet" type="text/css" href="../../tools/DataTables/media/css/jquery.dataTables.css">
    <style type="text/css" class="init"></style>    
    <script type="text/javascript" language="javascript" src="../../tools/DataTables/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function () {
            $('#funcionarios').DataTable();
        });
    </script>    
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Listar </strong> Reuniões</h2>
                    <div class="additional-btn">
                        <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                        <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                        <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                    </div>                    
                </div>
                <div class="widget-content">                    
                    <br>
                    <div class="table-responsive">
                        <form class='form-horizontal' role='form'>
                            <table id="funcionarios" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Sala</th>
                                        <th>Funcionário</th>                                        
                                        <th>Início</th>
                                        <th>Fim</th>                                        
                                        <th>Status</th>                                        
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Sala</th>
                                        <th>Funcionário</th>                                        
                                        <th>Ínicio</th>
                                        <th>Fim</th>                                        
                                        <th>Status</th>                                        
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    foreach ($pdo->query($querie->salas_listar()) as $value) {
                                        foreach ($pdo->query($querie->listar_inicio()) as $values) {
                                            $qqqq = $pdo->prepare($querie->marcar_mesmo_horario_sala($values['horario'], $value['id']));
                                            $qqqq->execute();
                                            $temos_nesse_horario = $qqqq->fetch(PDO::FETCH_ASSOC);

                                            if ($temos_nesse_horario['temos'] < 1) {
                                                $sala = $value['sala'];
                                                $funcionario = 'aguardando';
                                                $inicio = $values['horario'];
                                                $qqqqq = $pdo->prepare($querie->pegar_inicio(bcadd($values['id'], 1)));
                                                $qqqqq->execute();
                                                $fim_array = $qqqqq->fetch(PDO::FETCH_ASSOC);
                                                $fim = $fim_array['horario'];
                                                $situation = "Livre";
                                            } else {
                                                $qqqqqq = $pdo->prepare($querie->pega_nome_funcionario($temos_nesse_horario['id_user']));
                                                $qqqqqq->execute();
                                                $nome_funcionario = $qqqqqq->fetch(PDO::FETCH_ASSOC);
                                                $sala = '<strong>'.$value['sala'].'</strong>';
                                                $funcionario = '<strong>'.$nome_funcionario['nome_extenso'].'</strong>';
                                                $inicio = '<strong>'.substr($temos_nesse_horario['inicio'],0,5).'</strong>';
                                                $qqqqq = $pdo->prepare($querie->pegar_inicio(bcadd($values['id'], 1)));
                                                $qqqqq->execute();
                                                $fim_array = $qqqqq->fetch(PDO::FETCH_ASSOC);
                                                $fim = '<strong>'.$fim_array['horario'].'</strong>';
                                                $situation = $temos_nesse_horario['status'] == 1 ? "<strong>Reservado</strong>" : "Livre";
                                            }
                                            echo '<tr>';
                                            echo '<td>' . $sala . '</td>';
                                            echo '<td>' . $funcionario . '</td>';
                                            echo '<td>' . $inicio . '</td>';
                                            echo '<td>' . $fim . '</td>';
                                            echo '<td>' . $situation . '</td>';
                                            echo '</tr>';
                                        }
                                    }
                                    Database::disconnect();
                                    ?>
                                </tbody>
                            </table>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
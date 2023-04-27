<?php
session_start();
if ($_SESSION["user_id"] == NULL) {
    session_destroy();
    header("Location:../../index.html");
}
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
        <div class="col-md-8">
            <a href="usuarios_incluir.php" data-toggle="modal" data-target="#myModal1" class="btn btn-default btn-dropbox">Incluir Usuário <span class="glyphicon glyphicon-save" aria-hidden="true"></span></a><br><br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Listar </strong>Usuários</h2>
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
                                        <th>Nome</th>                                        
                                        <th>Setor</th>
                                        <th>Admin?</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nome</th>                                        
                                        <th>Setor</th>
                                        <th>Admin?</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include '../config/database_mysql.php';
                                    $pdo = Database::connect();
                                    function __autoload($file) {
                                        if (file_exists('../Model/' . $file . '.php'))
                                            require_once('../Model/' . $file . '.php');
                                        else
                                            exit('O arquivo ' . $file . ' não foi encontrado!');
                                    }
                                    $querie = new Queries();                                    
                                    foreach ($pdo->query($querie->usuarios_listar()) as $value) {                                        
                                        $qq = $pdo->prepare($querie->usuarios_setor($value['id_setor']));
                                        $qq->execute();
                                        $setor = $qq->fetch(PDO::FETCH_ASSOC);                                        
                                        $situation = $value['status'] == 1 ? "Ativo" : "Inativo";
                                        $admin = $value['admin'] == 1 ? "Sim" : "Não";
                                        echo '<tr>';
                                        echo '<td>' . $value['nome_extenso'] . '</td>';                                        
                                        echo '<td>' . $setor['setor'] . '</td>';
                                        echo '<td>' . $admin . '</td>';
                                        echo '<td>' . $situation . '</td>';
                                        echo '<td><a href="usuarios_editar.php?id=' . $value['id'] . '" data-toggle="modal" data-target="#myModal" class="btn btn-default btn-dropbox">Editar Usuário<span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>';
                                        echo '</tr>';
                                    }
                                    Database::disconnect();
                                    ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="modal large" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content"></div>
                        </div>
                    </div>
                    <div class="modal large" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
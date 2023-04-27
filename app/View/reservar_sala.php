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

$user = new Usuarios();
$querie = new Queries();
$dados_user = $user->Dados_User($_SESSION['user_id']);
$setor = $user->Dados_User_setor($dados_user['id_setor']);
?>
<script src="../js/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script>
    $(document).ready(function () {

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_usuario").empty();            
            var id_user = $("#id_user").val();
            var id_sala = $("#id_sala").val();            
            var inicio = $("#inicio").val();            
            
            if ($("#id_sala").val() === 'na')
            {
                $("#id_sala_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                $("#id_sala").focus();
                return false;
            }
            
            if ($("#inicio").val() === 'na')
            {
                $("#inicio_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                $("#inicio").focus();
                return false;
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/reservar_sala.php",
                data: "id_user=" + id_user + "&id_sala=" + id_sala +  "&inicio=" + inicio,
                beforeSend: function () {
                    $("#conteudo_usuario").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_usuario").html(response);
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="row">
    <div class="widget">
        <div class="widget-header transparent">
            <h2><strong>Reservar</strong> Sala</h2>
            <div class="additional-btn">
                <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
            </div>
        </div>
        <div class="widget-content padding">
            <div id="basic-form">
                <form id="form" method="POST">
                    <div class="form-group">
                        <label for="label_nome_extenso">Nome do Usuário:</label>
                        <input type="text" class="form-control" value="<?php echo $dados_user['nome_extenso']; ?>" disabled="disabled">
                        <input type="hidden" id="id_user" name="id_user" value="<?php echo $dados_user['id']; ?>" disabled="disabled">
                        <div class="form-inline" id="nome_extenso_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="setor_label">Sala:</label>
                        <select class="form-control selectpicker" id="id_sala" name="id_sala" required>
                            <option selected value="na">
                                Selecione...
                            </option>
                            <?php                                                        
                            foreach ($pdo->query($querie->salas_listar()) as $value) {
                                echo '<option value="' . $value['id'] . '">' . $value['sala'] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="form-inline" id="id_sala_error"></div>
                    </div>                    
                    <div class="form-group">
                        <label for="setor_label">Início:</label>
                        <select class="form-control selectpicker" id="inicio" name="inicio" required>
                            <option selected value="na">
                                Selecione...
                            </option>
                            <?php                                                        
                            foreach ($pdo->query($querie->listar_inicio()) as $value) {
                                echo '<option value="' . $value['id'] . '">' . $value['horario'] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="form-inline" id="inicio_error"></div>
                    </div>
                    <button class="btn btn-primary btn-dropbox" id="envia" type="submit">Gravar Reunião</button>
                </form>
            </div>
        </div>
    </div>
    <div class="widget">
        <div class="widget-content padding">
            <div id="conteudo_usuario"></div>
        </div>        
    </div>
</div>
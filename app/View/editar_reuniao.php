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
$usuarios = new Usuarios();
$sala = new Reuniao();
$array_reuniao = $sala->Dados(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$dados_user = $usuarios->Dados_User($array_reuniao['id_user']);
?>
<script src="../js/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#fechar_modal").click(function () {
            $("#refresca").load('cancelar_sala.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca").load('cancelar_sala.php');
            }
        });

        $("#form").submit(function () {
            return false;
        });
        $("#envia").click(function () {
            envia_form();
        });
        function envia_form() {
            $("#conteudo_form").empty();
            var id = $("#id").val();
            var status = $("#status").val();

            if ($("#status").val() === 'na')
            {
                $("#status_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                        $("#status").focus();
                return false;
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/editar_reuniao.php",
                data: "id=" + id + "&status=" + status,
                beforeSend: function () {
                    $("#conteudo_form").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive' id='imgpos'>");
                },
                success: function (response) {
                    $("#conteudo_form").html(response);
                },
                error: function () {
                    alert("Ocorreu um erro durante a requisição");
                }
            });
        }
    });
</script>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="fechar_modal">&times;</button>
    <h4 class="modal-title">Cancelar Reunião</h4>
</div>			
<div class="modal-body">
    <form id="form" method="POST">
        <div class="form-group">
            <label for="label_nome_extenso">Nome do Usuário:</label>
            <input type="text" class="form-control" value="<?php echo $dados_user['nome_extenso']; ?>" disabled="disabled">
            <input type="hidden" id="id" name="id" value="<?php echo $array_reuniao['id']; ?>" disabled="disabled">            
        </div>
        <div class="form-group">
            <label for="setor_label">Sala:</label>
            <select class="form-control selectpicker" disabled="disabled">
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                foreach ($pdo->query($querie->salas_listar()) as $value) {
                    $option = $value['id'] == $array_reuniao['id_sala'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                    echo '<option ' . $option . '>' . $value['sala'] . '</option>';                    
                }
                ?>
            </select>            
        </div>                    
        <div class="form-group">
            <label for="setor_label">Início:</label>
            <input type="text" class="form-control" value="<?php echo $array_reuniao['inicio']; ?>" disabled="disabled">            
        </div>
        <div class="form-group">
            <label for="setor_label">Final:</label>
            <input type="text" class="form-control" value="<?php echo $array_reuniao['fim']; ?>" disabled="disabled">            
        </div>
        <div class="form-group">
            <label class="sr-only" for="label_status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <?php
                $seleciona1 = $array_reuniao['status'] == 1 ? " selected " : " ";
                $seleciona2 = $array_reuniao['status'] == 0 ? " selected " : " ";
                ?>
                <option <?php echo $seleciona1; ?> value="1">
                    Reservada
                </option>
                <option <?php echo $seleciona2; ?> value="0">
                    Cancelar
                </option>
            </select>
        </div>
        <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Cancelar <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_form"></div>
</div>
<?php
session_start();
if ($_SESSION["user_id"] == NULL) {
    session_destroy();
    header("Location:../../index.html");
}

function __autoload($file) {
    if (file_exists('../Model/' . $file . '.php'))
        require_once('../Model/' . $file . '.php');
    else
        exit('O arquivo ' . $file . ' não foi encontrado!');
}
$sala = new Salas();
$array = $sala->Dados_Sala(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
?>
<script src="../js/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#fechar_modal").click(function () {
            $("#refresca").load('salas_listar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca").load('salas_listar.php');
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
            var sala = $("#sala").val();            
            var id = $("#id").val();
            var status = $("#status").val();
            var user = $("#user").val();

            if ($("#sala").val() === '')
            {
                $("#sala_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                        $("#sala").focus();
                return false;
            } else {
                $("#sala_error").empty();
            }            
            
            if ($("#status").val() === 'na')
            {
                $("#status_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                        $("#status").focus();
                return false;
            } else {
                $("#status_error").empty();
            }

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/salas_editar.php",
                data: "sala=" + sala + "&id=" + id + "&status=" + status + "&user" + user,
                beforeSend: function () {
                    $("#conteudo_form").html("<img src='../../images/loading/load.gif' class='img-rounded img-responsive'>");
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
    <h4 class="modal-title">Editar Sala</h4>
</div>			
<div class="modal-body">
    <form id="form" method="POST">
        <div class="form-group">
            <label for="label_nome">Nome da Sala:</label>
            <input type="text" class="form-control" id="sala" name="sala" placeholder="Informe o nome da Sala..." value="<?php echo $array['sala']; ?>" autofocus>
            <input type="hidden" class="hidden" id="id" name="id" value="<?php echo $array['id']; ?>">
            <input type="hidden" class="hidden" id="user" name="user" value="<?php echo $_SESSION['user_id']; ?>">
            <div class="form-inline" id="sala_error"></div>
        </div>
        <div class="form-group">
            <label for="label_status">Status:</label>
            <select class="form-control" id="status" name="status">
                <?php
                $seleciona1 = $array['status'] == '1' ? "selected" : " ";
                $seleciona2 = $array['status'] == '0' ? "selected" : " ";                
                ?>
                <option value="1" <?php echo $seleciona1; ?>>
                    Ativo
                </option>
                <option value="0" <?php echo $seleciona2; ?>>
                    Inativo
                </option>                
            </select>            
            <div class="form-inline" id="status_error"></div>            
        </div>        
        <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Editar <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_form"></div>
</div>
<?php
session_start();
if ($_SESSION["user_id"] == NULL) {
    session_destroy();
    header("Location:../../index.html");
}
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
            var user = $("#user").val();

            if ($("#sala").val() === '')
            {
                $("#sala_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                        $("#sala").focus();
                return false;
            } else {
                $("#sala_error").empty();
            }            

            $.ajax({
                type: "POST",
                dataType: "HTML",
                url: "../Controller/salas_incluir.php",
                data: "sala=" + sala + "&user=" + user,
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
    <h4 class="modal-title">Incluir Sala</h4>
</div>			
<div class="modal-body">
    <form id="form" method="POST">
        <div class="form-inline">
            <label for="label_nome">Nome da Sala:</label>
            <input type="text" class="form-control" id="sala" name="sala" placeholder="Informe Sala..." autofocus>
            <input type="hidden" class="hidden" id="user" name="user" value="<?php echo $_SESSION['user_id']; ?>">
            <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Salvar <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
            <div class="form-inline" id="sala_error"></div>
        </div>    
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_form"></div>
</div>
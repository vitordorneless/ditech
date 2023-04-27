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
$array = $usuarios->Dados_User(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
?>
<script src="../js/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {

        $("#fechar_modal").click(function () {
            $("#refresca").load('usuarios_listar.php');
        });

        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {
                $("#refresca").load('usuarios_listar.php');
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
            var nome_extenso = $("#nome_extenso").val();
            var login = $("#login").val();
            var pass = $("#pass").val();
            var id_setor = $("#id_setor").val();
            var admin = $("#admin").val();
            var id = $("#id").val();
            var status = $("#status").val();

            if ($("#nome_extenso").val() === '')
            {
                $("#nome_extenso_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                        $("#nome_extenso").focus();
                return false;
            } else {
                $("#nome_extenso_error").empty();
            }

            if ($("#login").val() === '')
            {
                $("#login_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                        $("#login").focus();
                return false;
            } else {
                $("#login_error").empty();
            }

            if ($("#pass").val() === '')
            {
                $("#pass_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                        $("#pass").focus();
                return false;
            } else {
                $("#pass_error").empty();
            }

            if ($("#id_setor").val() === 'na')
            {
                $("#id_setor_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                        $("#id_setor").focus();
                return false;
            } else {
                $("#id_setor_error").empty();
            }

            if ($("#admin").val() === 'na')
            {
                $("#admin_error").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Informe...</div>").hide(9000),
                        $("#admin").focus();
                return false;
            } else {
                $("#admin_error").empty();
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
                url: "../Controller/usuarios_editar.php",
                data: "nome_extenso=" + nome_extenso + "&login=" + login + "&id_setor=" + id_setor + "&pass=" + pass + "&admin=" + admin + "&id=" + id + "&status=" + status,
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
    <h4 class="modal-title">Editar Usuário</h4>
</div>			
<div class="modal-body">
    <form id="form" method="POST">
        <div class="form-group">
            <label for="label_nome">Nome do Usuário:</label>
            <input type="text" class="form-control" id="nome_extenso" name="nome_extenso" placeholder="Informe o nome do Usuário(a)..." value="<?php echo $array['nome_extenso']; ?>" autofocus>
            <input type="hidden" class="hidden" id="id" name="id" value="<?php echo $array['id']; ?>">
            <div class="form-inline" id="nome_extenso_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">Login:</label>
            <input type="text" class="form-control" id="login" name="login" placeholder="Informe o login" value="<?php echo $array['login']; ?>">
            <div class="form-inline" id="login_error"></div>
        </div>
        <div class="form-group">
            <label for="label_nome">Senha:</label>
            <input type="password" class="form-control" id="pass" name="pass" placeholder="Informe a senha" value="<?php echo $array['pass']; ?>">
            <div class="form-inline" id="senha_error"></div>
        </div>
        <div class="form-group">
            <label for="agencia_label">Setor:</label>
            <select class="form-control" id="id_setor" name="id_setor">
                <option selected value="na">
                    Selecione...
                </option>
                <?php
                foreach ($pdo->query($querie->listar_setor()) as $value) {
                    $option = $value['id'] == $array['id_setor'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                    echo '<option ' . $option . '>' . $value['setor'] . '</option>';                    
                }                
                ?>
            </select>
            <div class="form-inline" id="id_setor_error"></div>
        </div>        
        <div class="form-group">
            <label for="agencia_label">Admin:</label>
            <select class="form-control" id="admin" name="admin">
                <?php
                $seleciona11 = $array['admin'] == '1' ? "selected" : " ";
                $seleciona22 = $array['admin'] == '0' ? "selected" : " ";                
                ?>
                <option selected value="na">
                    Aguardando...
                </option>
                <option value="1" <?php echo $seleciona11; ?>>
                    Sim
                </option>
                <option value="0" <?php echo $seleciona22; ?>>
                    Não
                </option>
            </select>
            <div class="form-inline" id="admin_error"></div>            
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
            <?php Database::disconnect();?>
        </div>        
        <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Editar <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
    </form>
</div>
<div class="modal-footer">
    <div id="conteudo_form"></div>
</div>
$(document).ready(function () {
    $("#usuarios").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").empty();
        $("#conteudo_exclusivo").html("<img src='../images/loading/loading.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#conteudo_exclusivo").fadeIn('slow').load('usuarios_listar.php');
    });
    $("#salas").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").empty();
        $("#conteudo_exclusivo").html("<img src='../images/loading/loading.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#conteudo_exclusivo").fadeIn('slow').load('salas_listar.php');
    });
    $("#reservar_sala").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").empty();
        $("#conteudo_exclusivo").html("<img src='../images/loading/loading.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#conteudo_exclusivo").fadeIn('slow').load('reservar_sala.php');
    });
    $("#listar_reunioes").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").empty();
        $("#conteudo_exclusivo").html("<img src='../images/loading/loading.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#conteudo_exclusivo").fadeIn('slow').load('listar_reunioes.php');
    });
    $("#cancelar_sala").click(function (event) {
        event.preventDefault();
        $("#conteudo_exclusivo").empty();
        $("#conteudo_exclusivo").html("<img src='../images/loading/loading.gif' class='img-rounded img-responsive' id='imgpos'>");
        $("#conteudo_exclusivo").fadeIn('slow').load('cancelar_sala.php');
    });
});